<?php

namespace OlZyuzin\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'settings')]
class Setting
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    public string $name;

    #[ORM\Column(type: 'string')]
    public string $value;

    #[ORM\Column(type: 'string')]
    public string $type;
}