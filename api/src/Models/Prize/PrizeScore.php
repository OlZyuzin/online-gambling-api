<?php

namespace OlZyuzin\Models\Prize;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'prize_score')]
class PrizeScore extends Prize implements \JsonSerializable
{
    #[ORM\Column(type: 'integer', nullable: false)]
    public int $amount;

    public function getType(): PrizeType
    {
        return PrizeType::Score;
    }

    public function jsonSerialize(): mixed
    {
        $data = parent::jsonSerialize();
        $data['amount'] = $this->amount;

        return $data;
    }
}