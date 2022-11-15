<?php

namespace OlZyuzin\Models;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    public int $id;

    #[ORM\Column(type: 'string', nullable: false, unique: true)]
    public string $email;

    #[ORM\Column(type: 'integer', nullable: false)]
    public int $score = 0;

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'score' => $this->score,
        ];
    }
}