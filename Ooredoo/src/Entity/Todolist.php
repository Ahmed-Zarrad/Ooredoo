<?php

namespace App\Entity;

use App\Repository\TodolistRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TodolistRepository::class)
 */
class Todolist
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     */
    private $ChangeId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Owner;

    /**
     * @ORM\Column(type="boolean")
     */
    private $NOK;

    /**
     * @ORM\Column(type="boolean")
     */
    private $OK;
    /**
     * @ORM\Column(type="string", length=7)
     */
    private $background_color;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $border_color;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $text_color;

    public function getChangeId(): ?string
    {
        return $this->ChangeId;
    }
    public function setChangeId(string $ChangeId): self
    {
        $this->ChangeId = $ChangeId;

        return $this;
    }
    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->Owner;
    }

    public function setOwner(string $Owner): self
    {
        $this->Owner = $Owner;

        return $this;
    }

    public function getNOK(): ?bool
    {
        return $this->NOK;
    }

    public function setNOK(bool $NOK): self
    {
        $this->NOK = $NOK;

        return $this;
    }

    public function getOK(): ?bool
    {
        return $this->OK;
    }

    public function setOK(bool $OK): self
    {
        $this->OK = $OK;

        return $this;
    }
    public function getBackgroundColor(): ?string
    {
        return $this->background_color;
    }

    public function setBackgroundColor(string $background_color): self
    {
        $this->background_color = $background_color;

        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->border_color;
    }

    public function setBorderColor(string $border_color): self
    {
        $this->border_color = $border_color;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->text_color;
    }

    public function setTextColor(string $text_color): self
    {
        $this->text_color = $text_color;

        return $this;
    }
}
