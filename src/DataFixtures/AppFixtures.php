<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        $roleSupAdmin = new Role();
        $roleSupAdmin->setWording('super_admin');
        $manager->persist($roleSupAdmin);

        $roleAdmin = new Role();
        $roleAdmin->setWording('admin');
        $manager->persist($roleAdmin);

        $roleCashier = new Role();
        $roleCashier->setWording('cashier');
        $manager->persist($roleCashier);

        $RoleClient = new Role();
        $RoleClient->setWording('client');
        $manager->persist($RoleClient);

        $RolePartner = new Role();
        $RolePartner->setWording('partner');
        $manager->persist($RolePartner);

        $superAdmin = new User();
        $superAdmin->setFirstname($faker->firstName());
        $superAdmin->setLastname($faker->lastName());
        $superAdmin->setEmail($faker->email());
        $superAdmin->setTelephone($faker->phoneNumber());
        $superAdmin->setRole($roleSupAdmin);
        $superAdmin->setPassword($this->encoder->encodePassword($superAdmin, "super.admin"));
        $manager->persist($superAdmin);

        for ($i=0; $i < 20; $i++) {
            $admin = new User();
            $admin->setFirstname($faker->firstName());
            $admin->setLastname($faker->lastName());
            $admin->setEmail($faker->email());
            $admin->setTelephone($faker->phoneNumber());
            $admin->setRole($roleSupAdmin);
            $admin->setPassword($this->encoder->encodePassword($admin, "admin"));
            $manager->persist($admin);


            $cashier = new User();
            $cashier->setFirstname($faker->firstName());
            $cashier->setLastname($faker->lastName());
            $cashier->setEmail($faker->email());
            $cashier->setTelephone($faker->phoneNumber());
            $cashier->setRole($roleSupAdmin);
            $cashier->setPassword($this->encoder->encodePassword($cashier, "cashier"));
            $manager->persist($cashier);
        }
        
        $manager->flush();
    }
}
