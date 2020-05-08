<?php

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Admin\ContentRepository")
 */
class Content
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $firsttext;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $secondtext;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $othertext;

    /**
     * @ORM\Column(type="string")
     */
    private $contentType;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active = false;

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

    public function getFirsttext(): ?string
    {
        return $this->firsttext;
    }

    public function setFirsttext(string $firsttext): self
    {
        $this->firsttext = $firsttext;

        return $this;
    }

    public function getSecondtext(): ?string
    {
        return $this->secondtext;
    }

    public function setSecondtext(string $secondtext): self
    {
        $this->secondtext = $secondtext;

        return $this;
    }

    public function getOthertext(): ?string
    {
        return $this->othertext;
    }

    public function setOthertext(string $othertext): self
    {
        $this->othertext = $othertext;

        return $this;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

}
