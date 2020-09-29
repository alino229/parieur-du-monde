<?php

namespace App\Entity;

use App\Repository\CategoriePronosticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriePronosticsRepository::class)
 */
class CategoriePronostics
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
    private $type;


    public function getId(): ?int
    {
        return $this->id;
    }



    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getType().'';
    }
}
