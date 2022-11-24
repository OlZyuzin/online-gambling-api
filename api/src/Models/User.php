<?php

namespace OlZyuzin\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    public int $id;

    #[ORM\Column(type: 'string', nullable: false, unique: true)]
    public string $email;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $score = 0;

    public function topUpBalance(int $amount): void
    {
        $this->balance += $amount;
    }

    public function topUpScore(int $amount): void
    {
        $this->score += $amount;
    }
}