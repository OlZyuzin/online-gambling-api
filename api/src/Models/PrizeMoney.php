<?php

namespace OlZyuzin\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'prize_money')]
class PrizeMoney extends Prize
{
    #[ORM\Column(type: 'integer', nullable: false)]
    public int $amount;
}