<?php

namespace App\Entity;

use App\Repository\StrategieRelationCategorieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StrategieRelationCategorieRepository::class)
 */
class StrategieRelationCategorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
