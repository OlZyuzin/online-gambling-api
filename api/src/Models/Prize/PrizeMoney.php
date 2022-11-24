<?php

namespace OlZyuzin\Models\Prize;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'prize_money')]
class PrizeMoney extends Prize
{
    #[ORM\Column(type: 'integer', nullable: false)]
    public int $amount;

    #[ORM\Column(type: 'string', enumType: PrizeMoneyStatus::class)]
    public PrizeMoneyStatus $status = PrizeMoneyStatus::PENDING;

    public function getType(): PrizeType
    {
        return PrizeType::Money;
    }
}