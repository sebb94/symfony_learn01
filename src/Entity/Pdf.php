<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PdfRepository")
 */
class Pdf extends File
{

    /**
     * @ORM\Column(type="integer")
     */
    private $pages_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orient;

    public function getPagesNumber(): ?int
    {
        return $this->pages_number;
    }

    public function setPagesNumber(int $pages_number): self
    {
        $this->pages_number = $pages_number;

        return $this;
    }

    public function getOrient(): ?string
    {
        return $this->orient;
    }

    public function setOrient(string $orient): self
    {
        $this->orient = $orient;

        return $this;
    }
}
