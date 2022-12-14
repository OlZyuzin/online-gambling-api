<?php

namespace OlZyuzin\Models\Prize;

use Doctrine\ORM\Mapping as ORM;
use OlZyuzin\Models\User;


#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    'score' => PrizeScore::class,
    'money' => PrizeMoney::class,
    'thing' => PrizeThing::class,
])]
abstract class Prize
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    public int $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    public User $user;

    abstract public function getType(): PrizeType;
}