<?php

namespace AppBundle\Entity;


use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenusEntityRepository")
 * @ORM\Table(name="genus")
 */
class Genus
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SubFamily")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subfamily;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min=0, minMessage="genus.speciesCount.notInRange")
     * @ORM\Column(type="integer")
     */
    private $speciesCount;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $funFact;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished = true;

    /**
     * @Assert\NotBlank()
     * @Assert\Date()
     * @ORM\Column(type="date")
     */
    private $firstDiscoveredAt;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GenusNote", mappedBy="genus")
     * @ORM\OrderBy({"createdAt"="DESC"})
     */
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function setIsPublished(bool $isPublished): void
    {
        $this->isPublished = $isPublished;
    }

    public function getSubfamily(): ?SubFamily
    {
        return $this->subfamily;
    }

    public function setSubfamily(SubFamily $subfamily): void
    {
        $this->subfamily = $subfamily;
    }

    public function getSpeciesCount(): ?int
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
    public function setFunFact(?string $funFact): void
    {
        $this->funFact = $funFact;
    }

    public function getName(): ?string
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

    /**
     * @return Collection|GenusNote[]
     */
    public function getNotes(): ?Collection
    {
        return $this->notes;
    }

    public function getFirstDiscoveredAt(): ?DateTime
    {
        return $this->firstDiscoveredAt;
    }

    public function setFirstDiscoveredAt(?DateTime $firstDiscoveredAt): void
    {
        $this->firstDiscoveredAt = $firstDiscoveredAt;
    }

    public function getisPublished(): bool
    {
        return $this->isPublished;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}