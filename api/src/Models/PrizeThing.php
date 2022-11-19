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
    private PrizeThingStatus $status = PrizeThingStatus::PENDING;

    public function getType(): PrizeType
    {
        return PrizeType::Thing;
    }

    public function jsonSerialize(): mixed
    {
        $data = parent::jsonSerialize();
        $data['thing'] = $this->thing;
        $data['status'] = $this->status;

        return $data;
    }

    public function setStatus(PrizeThingStatus $status): void
    {
        if (!PrizeThingStatus::isChangeAllowed($this->status, $status)) {
            return;
        }
        $this->status = $status;
    }
}