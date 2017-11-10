<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Genus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDataFixtures extends Fixture
 {
    public function load(ObjectManager $manager): void
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $genus = new Genus();
            $genus->setName('Octopus ' . random_int(1, 100));
            $genus->setSpeciesCount(random_int(100,10000));
            $genus->setSubfamily("Septopaediae");
            $manager->persist($genus);
        }

        $manager->flush();
    }
}