<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Genus;
use DateTime;
use Doctrine\ORM\EntityRepository;

class GenusNoteEntityRepository extends EntityRepository
{

    public function findAllRecentNotesForGenus(Genus $genus, int $limit = 3)
    {
        $query = $this->createQueryBuilder('genus_notes')->
            select('genus_notes')
            ->where('genus_notes.genus = :genus')
            ->andWhere('genus_notes.createdAt > :limit')
            ->orderBy('genus_notes.createdAt', 'DESC')
            ->setParameters(['limit' => new DateTime('-'. $limit.' months'), 'genus' => $genus])
            ->getQuery();

        return $query->execute();
    }


}
