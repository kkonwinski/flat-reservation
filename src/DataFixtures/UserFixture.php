<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{

    private $passwordEncoder;

    private $user;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->user = new User();
    }

    public function load(ObjectManager $manager)
    {
        $this->user->setEmail("admin@gmail.com");
        $this->user->setPassword($this->passwordEncoder->encodePassword($this->user, 'admin'));
        $this->user->setRoles(["ADMIN_ROLE"]);
        // $product = new Product();
         $manager->persist($this->user);

        $manager->flush();
    }
}
