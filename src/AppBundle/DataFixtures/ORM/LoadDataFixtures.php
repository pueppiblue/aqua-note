<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadDataFixtures implements FixtureInterface
 {
    public function load(ObjectManager $manager): void
    {
        $object = Fixtures::load(__DIR__.'/genus.yml', $manager);

    }
}