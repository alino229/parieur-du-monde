<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"titre"}, message="Vous avez déjà un article avec ce titre")
 *
 */
class Article
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $images;
    /**
     * @Vich\UploadableField(mapping="article_images", fileNameProperty="images")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $updatedAt;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageAlt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageTitre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $metaDesciption;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published=0;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="article")
     */
    private $commentaires;

    /**
     * @ORM\OneToOne(targetEntity=HomePageMostVisited::class, mappedBy="article", cascade={"persist", "remove"})
     */
    private $homePageMostVisited;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function initializeSlug(): void
    {
        $slugify=new Slugify(['regexp' => '/([^A-Za-z0-9]|-)+/']);

        $slugify->activateRuleSet('french');
       $this->slug= $slugify->slugify($this->getTitre());
    }

    public function setImageFile(File $image = null): void
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

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

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): void
    {
        $this->images = $images;


    }

    public function getImageAlt(): ?string
    {
        return $this->imageAlt;
    }

    public function setImageAlt(string $imageAlt): self
    {
        $this->imageAlt = $imageAlt;

        return $this;
    }

    public function getImageTitre(): ?string
    {
        return $this->imageTitre;
    }

    public function setImageTitre(string $imageTitre): self
    {
        $this->imageTitre = $imageTitre;

        return $this;
    }

    public function getMetaDesciption(): ?string
    {
        return $this->metaDesciption;
    }

    public function setMetaDesciption(?string $metaDesciption): self
    {
        $this->metaDesciption = $metaDesciption;

        return $this;
    }

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getId().'';
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setArticle($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getArticle() === $this) {
                $commentaire->setArticle(null);
            }
        }

        return $this;
    }

    public function getComment(): array
    {
        return $this->commentaires->toArray();
    }

    public function getHomePageMostVisited(): ?HomePageMostVisited
    {
        return $this->homePageMostVisited;
    }

    public function setHomePageMostVisited(?HomePageMostVisited $homePageMostVisited): self
    {
        $this->homePageMostVisited = $homePageMostVisited;

        // set (or unset) the owning side of the relation if necessary
        $newArticle = null === $homePageMostVisited ? null : $this;
        if ($homePageMostVisited->getArticle() !== $newArticle) {
            $homePageMostVisited->setArticle($newArticle);
        }

        return $this;
    }
}
