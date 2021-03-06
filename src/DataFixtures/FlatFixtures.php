<?php

namespace App\DataFixtures;

use App\Entity\Flat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FlatFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i <= 20; $i++) {
            $flat = new Flat();
            try {
                $flat->setSlots(random_int(1, 8));
            } catch (\Exception $e) {
            }
            $manager->persist($flat);
        }
        $manager->flush();
    }
}
