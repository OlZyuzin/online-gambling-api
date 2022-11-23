<?php

namespace OlZyuzin\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'payment_accounts')]
class PaymentAccount
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    public int $id;

    #[ORM\OneToOne(targetEntity: User::class)]
    public User $user;

    #[ORM\Column(type: 'string', nullable: false)]
    public string $bankCard;
}