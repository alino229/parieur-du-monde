<?php

namespace App\Entity;

use App\Repository\PronosticsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PronosticsRepository::class)
 * @Vich\Uploadable
 */
class Pronostics
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
    private $home;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $away;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $competition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pronostics;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $cote;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $resultat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $resultValue=0;

    /**
     * @ORM\Column(type="date")
     */
    private $day;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $homeFlag;
    /**
     * @Vich\UploadableField(mapping="pronostics_images", fileNameProperty="homeFlag")
     * @var File
     */
    private $homeFlagFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $awayFlag;
    /**
     * @Vich\UploadableField(mapping="pronostics_images", fileNameProperty="awayFlag")
     * @var File
     */
    private $awayFlagFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $addDate;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published=0;

    /**
     * @ORM\ManyToOne(targetEntity=CategoriePronostics::class)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHome(): ?string
    {
        return $this->home;
    }

    public function setHome(string $home): self
    {
        $this->home = $home;

        return $this;
    }

    public function getAway(): ?string
    {
        return $this->away;
    }

    public function setAway(string $away): self
    {
        $this->away = $away;

        return $this;
    }

    public function getCompetition(): ?string
    {
        return $this->competition;
    }

    public function setCompetition(string $competition): self
    {
        $this->competition = $competition;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getPronostics(): ?string
    {
        return $this->pronostics;
    }

    public function setPronostics(string $pronostics): self
    {
        $this->pronostics = $pronostics;

        return $this;
    }

    public function getCote(): ?string
    {
        return $this->cote;
    }

    public function setCote(string $cote): self
    {
        $this->cote = $cote;

        return $this;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getResultValue(): ?bool
    {
        return $this->resultValue;
    }

    public function setResultValue(bool $resultValue): self
    {
        $this->resultValue = $resultValue;

        return $this;
    }

    public function getDay(): ?\DateTimeInterface
    {
        return $this->day;
    }

    public function setDay(\DateTimeInterface $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getHomeFlag(): ?string
    {
        return $this->homeFlag;
    }

    public function setHomeFlag(string $homeFlag): void
    {
        $this->homeFlag = $homeFlag;


    }
    /**
     * @param File|UploadedFile|null $image
     * @return void
     */
    public function setHomeFlagFile(File $image = null): void
    {
        $this->homeFlagFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
    /**
     * @return File|null
     */

    public function getHomeFlagFile(): ?File
    {
        return $this->homeFlagFile;
    }

    public function getAwayFlag(): ?string
    {
        return $this->awayFlag;
    }

    public function setAwayFlag(string $awayFlag): void
    {
        $this->awayFlag = $awayFlag;


    }
    /**
     * @param File|UploadedFile|null $image
     * @return void
     */
    public function setAwayFlagFile(File $image = null): void
    {
        $this->awayFlagFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
    /**
     * @return File|null
     */
    public function getAwayFlagFile(): ?File
    {
        return $this->awayFlagFile;
    }

    public function getAddDate(): ?\DateTimeInterface
    {
        return $this->addDate;
    }

    public function setAddDate(\DateTimeInterface $addDate): self
    {
        $this->addDate = $addDate;

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

    public function getCategory(): ?CategoriePronostics
    {
        return $this->category;
    }

    public function setCategory(?CategoriePronostics $category): self
    {
        $this->category = $category;

        return $this;
    }
}
