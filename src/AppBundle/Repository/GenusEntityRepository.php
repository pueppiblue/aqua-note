<?php

namespace AppBundle\Repository;


use AppBundle\Entity\Genus;
use Doctrine\ORM\EntityRepository;


class GenusEntityRepository extends EntityRepository
{
    /**
     * @return Genus[]
     */
    public function findAllPublishedOrderedBySize(): array
    {
        return $this->createQueryBuilder('genus')
            ->select('genus')
            ->where('genus.isPublished = :isPublished')
            ->setParameter('isPublished', true)
            ->orderBy('genus.speciesCount', 'DESC')
            ->getQuery()
            ->execute();
    }

    /**
     * @return Genus[]
     */
    public function findAllPublishedOrderedByRecentlyActive(): array
    {
        return $this->createQueryBuilder('genus')
            ->select('genus')
            ->where('genus.isPublished = :isPublished')
            ->setParameter('isPublished', true)
            ->leftJoin('genus.notes', 'genus_note')
            ->orderBy('genus_note.createdAt', 'DESC')
            ->getQuery()
            ->execute();
    }

    /**
     * This allows to inject the repository instead of the
     * entitymanager(-registry) when persist functionality is needed.
     *
     * @param Genus $genus
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Genus $genus)
    {
        $this->_em->persist($genus);
        $this->_em->flush();

    }

}