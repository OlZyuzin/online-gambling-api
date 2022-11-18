<?php

namespace OlZyuzin\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'prize_thing')]
class PrizeThing extends Prize implements \JsonSerializable
{
    #[ORM\ManyToOne(targetEntity: Thing::class)]
    public Thing $thing;

    #[ORM\Column(type: 'string', enumType: PrizeThingStatus::class)]
    public PrizeThingStatus $status = PrizeThingStatus::PENDING;

    public function getType(): PrizeType
    {
        return PrizeType::Score;
    }

    public function jsonSerialize(): mixed
    {
        $data = parent::jsonSerialize();
        $data['thing'] = $this->thing;
        $data['status'] = $this->status;

        return $data;
    }
}