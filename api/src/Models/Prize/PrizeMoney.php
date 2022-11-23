<?php

namespace OlZyuzin\Models\Prize;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'prize_money')]
class PrizeMoney extends Prize
{
    #[ORM\Column(type: 'integer', nullable: false)]
    public int $amount;

    public function getType(): PrizeType
    {
        return PrizeType::Money;
    }

    public function jsonSerialize(): mixed
    {
        $data = parent::jsonSerialize();
        $data['amount'] = $this->amount;

        return $data;
    }
}