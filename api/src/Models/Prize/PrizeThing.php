<?php

namespace OlZyuzin\Models\Prize;

use Doctrine\ORM\Mapping as ORM;
use OlZyuzin\Models\Thing;

#[ORM\Entity]
#[ORM\Table(name: 'prize_thing')]
class PrizeThing extends Prize
{
    #[ORM\ManyToOne(targetEntity: Thing::class)]
    public Thing $thing;

    #[ORM\Column(type: 'string', enumType: PrizeThingStatus::class)]
    private PrizeThingStatus $status = PrizeThingStatus::PENDING;

    public function getType(): PrizeType
    {
        return PrizeType::Thing;
    }

    public function setStatus(PrizeThingStatus $status): void
    {
        if (!PrizeThingStatus::isChangeAllowed($this->status, $status)) {
            return;
        }
        $this->status = $status;
    }

    public function getStatus(): PrizeThingStatus
    {
        return $this->status;
    }
}