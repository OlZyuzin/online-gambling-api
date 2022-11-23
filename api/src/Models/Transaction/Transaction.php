<?php

namespace OlZyuzin\Models\Transaction;

use Doctrine\ORM\Mapping as ORM;
use OlZyuzin\Models\PaymentAccount;

#[ORM\Entity]
#[ORM\Table(name: 'transactions')]
class Transaction
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    public int $id;

    #[ORM\Column(type: 'datetime', nullable: false)]
    public \DateTime $performedAt;

    #[ORM\Column(type: 'string', enumType: TransactionType::class)]
    public TransactionType $type;

    #[ORM\Column(type: 'string', enumType: TransactionStatus::class)]
    public TransactionStatus $status;

    #[ORM\ManyToOne(targetEntity: PaymentAccount::class)]
    public PaymentAccount $paymentAccount;

    #[ORM\Column(type: 'integer')]
    public int $amount;

    #[ORM\Column(type: 'string', enumType: TransactionErrorType::class)]
    public ?TransactionErrorType $errorType;

    #[ORM\Column(type: 'string')]
    public ?string $errorDetails;

    public function __construct()
    {
        $this->performedAt = new \DateTime();
        $this->status = TransactionStatus::INITIAL;
    }
}