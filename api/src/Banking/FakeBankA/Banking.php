<?php

namespace OlZyuzin\Banking\FakeBankA;


use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Banking\Exceptions\BankAuthenticationFailed;
use OlZyuzin\Banking\Exceptions\GetAccountDetailsFailed;
use OlZyuzin\Banking\Exceptions\InsufficientAppFunds;
use OlZyuzin\Banking\FakeBankA\Responses\FailedResponse;
use OlZyuzin\Banking\FakeBankA\Responses\GetAccountDetailsResponse;
use OlZyuzin\Banking\FakeBankA\Responses\ResponseErrorCode;
use OlZyuzin\Models\PaymentAccount;
use OlZyuzin\Models\Transaction\Transaction;
use OlZyuzin\Models\Transaction\TransactionStatus;
use OlZyuzin\Models\Transaction\TransactionType;
use Psr\Http\Message\ResponseInterface;

/**
 * Class purpose is to get application accoutnt details such as balance
 */
class Banking
{
    public function __construct(
        private HttpClient $httpClient,
        private EntityManagerInterface $em,
    )
    {
    }


    /**
     * @return int amount of eurocents on the application balance
     * @throws BankAuthenticationFailed
     * @throws GetAccountDetailsFailed
     */
    public function getBalance(): int
    {
        $response = $this->httpClient->getAccountDetails();

        if ($response->getStatusCode() !== 200) {
            throw new GetAccountDetailsFailed();
        }

        $dto = GetAccountDetailsResponse::initFromResponse($response);

        return $dto->balance;
    }

    /**
     * @throws BankAuthenticationFailed
     * @throws GetAccountDetailsFailed
     */
    public function haveSufficientFunds(
        int $payoutAmount
    ): bool  {
        $appBalance = $this->getBalance();

        if ($appBalance < $payoutAmount) {
            return false;
        }

        return true;
    }

    /**
     * @throws BankAuthenticationFailed
     * @throws InsufficientAppFunds
     * @throws GetAccountDetailsFailed
     *
     * Returns true in case of success
     */
    public function performPayout(
        PaymentAccount $paymentAccount,
        int            $payoutAmount,
    ): bool {
        if (!$this->haveSufficientFunds($payoutAmount)) {
            throw new InsufficientAppFunds();
        }

        $response = $this->httpClient->sendPayoutRequest(
            $payoutAmount,
            $paymentAccount->bankCard,
        );

        $transaction = $this->createTransaction(
            $paymentAccount,
            $payoutAmount,
            TransactionType::PAYOUT,
        );

        $this->processPayoutResponse(
            $response,
            $transaction,
        );

        $success = ($transaction->status === TransactionStatus::SUCCESS);

        return $success;
    }


    private function processPayoutResponse(
        ResponseInterface $response,
        Transaction $transaction,
    ): void {
        if ($response->getStatusCode() === 200) {
            $status = TransactionStatus::SUCCESS;
        } else {
            $dto = FailedResponse::initFromResponse($response);
            $transaction->errorDetails = $dto->message;
            $transaction->errorType = ResponseErrorCode::translateIntoErrorType($dto->code);
            $status = TransactionStatus::FAILED;
        }

        $transaction->status = $status;
        $this->em->flush();
    }

    private function createTransaction(
        PaymentAccount $paymentAccount,
        int $payoutAmount,
        TransactionType $type,
    ): Transaction {
        $transaction = new Transaction();
        $transaction->paymentAccount = $paymentAccount;
        $transaction->type = $type;
        $transaction->amount = $payoutAmount;
        $this->em->persist($transaction);

        return $transaction;
    }
}