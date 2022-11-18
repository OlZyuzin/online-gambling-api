<?php

namespace OlZyuzin\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'things')]
class Thing
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    public int $id;

    #[ORM\Column(type: 'string')]
    public string $name;

    #[ORM\Column(type: 'integer')]
    public int $count;

    #[ORM\Column(type: 'integer')]
    public int $scoreEquivalent;
}