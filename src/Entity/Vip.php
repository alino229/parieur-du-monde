<?php

namespace App\Entity;

use App\Repository\VipRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VipRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Vip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $abonnement;



    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"},inversedBy = "vip")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active=0;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;
    /**
     * @ORM\Column(type="datetime")
     */
    private $expireDate;
    public function __toString()
    {
        return $this->getUser()->getPseudo().'';
        // TODO: Implement __toString() method.
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbonnement(): ?string
    {
        return $this->abonnement ;
    }

    public function setAbonnement(?string $abonnement): self
    {
        $this->abonnement = $abonnement;

        return $this;
    }


    public function setAnnuel(?int $annuel): self
    {
        $this->annuel = $annuel;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setExpireDate(): self
    {
        $date=new dateTime();
        if($this->getAbonnement()==="MOIS"){
            $this->expireDate=strtotime("now")+24*3600*30;

            $date->setTimestamp($this->expireDate);
            $this->expireDate=$date->format('Y-m-d H:i:s');

            $this->expireDate = DateTime::createFromFormat('Y-m-d H:i:s',  $this->expireDate);


        }elseif ($this->getAbonnement()==="SEMAINE"){
            $this->expireDate=strtotime("now")+24*3600*7;

            $date->setTimestamp($this->expireDate);
            $this->expireDate=$date->format('Y-m-d H:i:s');
            $this->expireDate = DateTime::createFromFormat('Y-m-d H:i:s',  $this->expireDate);

        }
        elseif ($this->getAbonnement()==="ANNUEL"){
            $this->expireDate=strtotime("now")+24*3600*30*12;

            $date->setTimestamp($this->expireDate);
            $this->expireDate=$date->format('Y-m-d H:i:s');
            $this->expireDate = DateTime::createFromFormat('Y-m-d H:i:s',  $this->expireDate);

        }


        return $this;
    }
    public function getExpireDate(): ?\DateTimeInterface
    {
        return $this->expireDate;

    }
}
