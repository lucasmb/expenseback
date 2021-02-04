<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PropertyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 */
class Property
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
    private $functional_unit;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $floor;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $appartment;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=4, nullable=true)
     */
    private $coefficient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFunctionalUnit(): ?int
    {
        return $this->functional_unit;
    }

    public function setFunctionalUnit(int $functional_unit): self
    {
        $this->functional_unit = $functional_unit;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(?string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getAppartment(): ?string
    {
        return $this->appartment;
    }

    public function setAppartment(?string $appartment): self
    {
        $this->appartment = $appartment;

        return $this;
    }

    public function getCoefficient(): ?string
    {
        return $this->coefficient;
    }

    public function setCoefficient(?string $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }
}
