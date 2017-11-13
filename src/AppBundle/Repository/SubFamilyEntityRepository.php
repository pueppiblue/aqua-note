<?php

namespace AppBundle\Repository;


use AppBundle\Entity\SubFamily;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;


class SubFamilyEntityRepository extends EntityRepository
{

    /**
     * @return QueryBuilder
     */
    public function createAlphabeticalQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('subfamily')
            ->orderBy('subfamily.name', 'ASC');
    }
    /**
     * This allows to inject the repository instead of the
     * entitymanager(-registry) when persist functionality is needed.
     *
     * @param SubFamily $subFamily
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(SubFamily $subFamily)
    {
        $this->_em->persist($subFamily);
        $this->_em->flush();

    }

}