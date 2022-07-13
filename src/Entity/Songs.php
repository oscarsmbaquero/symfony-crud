<?php

namespace App\Entity;

use App\Repository\SongsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SongsRepository::class)]
class Songs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Extremoduro::class, inversedBy: 'songs')]
    private $extremoduro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getExtremoduro(): ?Extremoduro
    {
        return $this->extremoduro;
    }

    public function setExtremoduro(?Extremoduro $extremoduro): self
    {
        $this->extremoduro = $extremoduro;

        return $this;
    }
}
