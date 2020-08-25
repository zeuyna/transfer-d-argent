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
            $admin[$i] = new User();
            $admin[$i]->setFirstname($faker->firstName());
            $admin[$i]->setLastname($faker->lastName());
            $admin[$i]->setEmail($faker->email());
            $admin[$i]->setTelephone($faker->phoneNumber());
            $admin[$i]->setRole($roleSupAdmin);
            $admin[$i]->setPassword($this->encoder->encodePassword($admin[$i], "admin"));
            $manager->persist($admin[$i]);

            $cashier[$i] = new User();
            $cashier[$i]->setFirstname($faker->firstName());
            $cashier[$i]->setLastname($faker->lastName());
            $cashier[$i]->setEmail($faker->email());
            $cashier[$i]->setTelephone($faker->phoneNumber());
            $cashier[$i]->setRole($roleSupAdmin);
            $cashier[$i]->setPassword($this->encoder->encodePassword($cashier[$i], "cashier"));
            $manager->persist($cashier[$i]);
        }

        $manager->flush();
    }
}