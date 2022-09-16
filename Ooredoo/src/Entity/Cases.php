<?php

namespace App\Entity;

use App\Repository\CasesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CasesRepository::class)
 */
class Cases
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */

    private $CaseId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Node;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Severity;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Status;

    /**
     * @ORM\Column(type="date")
     */
    private $start;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $end;


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

    public function getCaseId(): ?int
    {
        return $this->CaseId;
    }

    public function setCaseId(int $CaseId): self
    {
        $this->CaseId = $CaseId;

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

    public function getNode(): ?string
    {
        return $this->Node;
    }

    public function setNode(string $Node): self
    {
        $this->Node = $Node;

        return $this;
    }

    public function getSeverity(): ?string
    {
        return $this->Severity;
    }

    public function setSeverity(string $Severity): self
    {
        $this->Severity = $Severity;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->Status;
    }

    public function setStatus(bool $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(?\DateTimeInterface $end): self
    {
        $this->end = $end;

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
