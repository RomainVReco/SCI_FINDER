<?php

namespace App\DataFixtures;

use App\Entity\Sci;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i<30; $i++) {
            $sci = new Sci();
            $randomBytes = random_bytes(30);
            $encodedBytes  = base64_encode($randomBytes);
            $sci->setIdSCI($encodedBytes);
            $sci->setSiren("SIREN ".$i);
            $sci->setDateCreation(new DateTime());
            $sci->setEtablieEnFrance(true);
            $sci->setSalarieEnFrance(false);
            $sci->setFormeJuridique("Forme juridique ".$i);
            $sci->setDenomination("Denomination ".$i);
            $sci->setDateImmat(new DateTime());
            $sci->setMontantCapital(rand(1000, 150000));
            $sci->setDeviseCapital("Devise capital ".$i);
            $manager->persist($sci);
        }
        // $product = new Product();
        $manager->flush();
    }
}
