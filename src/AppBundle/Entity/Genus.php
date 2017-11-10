<?php

namespace AppBundle\Entity;


use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenusEntityRepository")
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
     * @ORM\Column(type="boolean")
     */
    private $isPublished = true;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GenusNote", mappedBy="genus")
     */
    private $notes;

    public function __construct()
    {
        $notes = new ArrayCollection();
    }

    public function setIsPublished(bool $isPublished): void
    {
        $this->isPublished = $isPublished;
    }

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

    public function getFunFact(): ?string
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

    public function getUpdatedAt(): DateTime
    {
        return new DateTime('-'.random_int(0,100).'days');
    }

    public function getNotes()
    {
        return $this->notes;
    }
}