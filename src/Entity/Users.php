<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $detail_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $detail_2;

    /**
     * @ORM\Column(type="boolean")
     */
    private $detail_3;

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getDetail1(): ?string
    {
        return $this->detail_1;
    }

    public function setDetail1(?string $detail_1): self
    {
        $this->detail_1 = $detail_1;

        return $this;
    }

    public function getDetail2(): ?string
    {
        return $this->detail_2;
    }

    public function setDetail2(?string $detail_2): self
    {
        $this->detail_2 = $detail_2;

        return $this;
    }

    public function getDetail3(): ?bool
    {
        return $this->detail_3;
    }

    public function setDetail3(bool $detail_3): self
    {
        $this->detail_3 = $detail_3;

        return $this;
    }
}
