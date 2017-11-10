<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="genus")
 */
class Genus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $subfamily;
    /**
     * @ORM\Column(type="integer")
     */
    private $speciesCount;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $funFact;

    public function getSubfamily(): string
    {
        return $this->subfamily;
    }

    public function setSubfamily(string $subfamily): void
    {
        $this->subfamily = $subfamily;
    }

    public function getSpeciesCount(): int
    {
        return $this->speciesCount;
    }

    public function setSpeciesCount(int $speciesCount): void
    {
        $this->speciesCount = $speciesCount;
    }

    public function getFunFact(): string
    {
        return $this->funFact;
    }
    public function setFunFact(string $funFact): void
    {
        $this->funFact = $funFact;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }
}