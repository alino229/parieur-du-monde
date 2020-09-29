<?php

namespace App\Entity;

use App\Repository\HomePageMostVisitedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HomePageMostVisitedRepository::class)
 */
class HomePageMostVisited
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbVisite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timestamp;

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $article;
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->id.'';
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbVisite(): ?int
    {
        return $this->nbVisite;
    }

    public function setNbVisite(int $nbVisite): self
    {
        $this->nbVisite = $nbVisite;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getArticle(): ?int
    {
        return $this->article;
    }

    public function setArticle(int $article): self
    {
        $this->article = $article;

        return $this;
    }
}
