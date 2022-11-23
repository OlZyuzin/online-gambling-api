<?php

namespace OlZyuzin\Banking\FakeBankA;

use GuzzleHttp\Client;
use OlZyuzin\Banking\Exceptions\BankAuthenticationFailed;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    private Client  $httpClient;

    private ?string $authToken;

    public function __construct(
        private string $bankHost,
        private string $clientId,
        private string $clientSecret,
        private string $certificatePath,
        private string $certificatePassword,
    )
    {
        $this->httpClient = new Client();
    }

    public function authenticate(): bool
    {
        if ($this->authToken) {
            return true;
        }

        $url = $this->bankHost . Uri::AUTH();
        $response = $this->httpClient->post(
            $url,
            [
                'cert' => [
                    $this->certificatePath,
                    $this->certificatePassword,
                ],
                'json' => [
                    'id' => $this->clientId,
                    'secret' => $this->clientSecret,
                ]
            ]
        );

        if ($response->getStatusCode() !== 201) {
            return false;
        }

        $responseContent = $response->getBody()->getContents();
        $responseData = json_decode($responseContent, true);

        $this->authToken = $responseData['token'];

        return true;
    }

    /**
     * @throws BankAuthenticationFailed
     */
    public function sendRequest(
        Uri $uri,
        string $httpMethod,
        array $data = [],
    ): ResponseInterface {
        if (!$this->authenticate()) {
            throw new BankAuthenticationFailed();
        }

        $url = $this->bankHost . $uri();

        $options =   [
            'cert' => [
                $this->certificatePath,
                $this->certificatePassword,
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $this->authToken,
            ]
        ];

        if (!empty($data)) {
            $options['json'] = $data;
        }

        $response = $this->httpClient->request(
            $httpMethod,
            $url,
            $options,
        );

        return $response;
    }

    public function getAccountDetails(): ResponseInterface
    {
        $response = $this->sendRequest(
            Uri::ACCOUNT_DETAILS,
            'GET',
        );

        return $response;
    }

    /**
     * @throws BankAuthenticationFailed
     */
    public function sendPayoutRequest(
        int $payoutAmount,
        string $bankCard,
    ): ResponseInterface {
        $response = $this->sendRequest(
            Uri::PAYOUT,
            'POST',
            [
                'receiver' => [
                    'cardNumber' => $bankCard,
                    'currency' => 'euro',
                    'amount' => $payoutAmount / 100,
                ],
            ],
        );

        return $response;
    }
}