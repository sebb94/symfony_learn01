<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

   /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Length(min = 2, max = 10, minMessage = "Video title must be at least {{ limit }} characters long", maxMessage = "Video title cannot be more than {{ limit }} charakters")
    */

    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="videos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(
     * maxSize="4096k",
     * mimeTypes = {"application/pdf", "video/mp4", "audio/mpeg", "application/x-pdf"},
     * mimeTypesMessage = "Please upload a valid file"
     * )
     */
    private $file;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }
}
