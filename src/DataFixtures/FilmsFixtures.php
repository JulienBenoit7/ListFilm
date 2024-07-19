<?php

namespace App\DataFixtures;

use App\Entity\Films;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FilmsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $films = new Films();
        $films->setTitle('Rocky');
        $films->setSynopsis('Un loubard fait sensation contre le champion du monde des poids lourds');
        $films->setCategory($this->getReference('category_Action'));
        $manager->persist($films);
        $manager->flush();

        $films = new Films();
        $films->setTitle('Rocky 2');
        $films->setSynopsis('La suite du premier film et cette fois Rocky gagne a la fin.');
        $films->setCategory($this->getReference('category_Action'));
        $manager->persist($films);
        $manager->flush();

        $films = new Films();
        $films->setTitle('Terminator');
        $films->setSynopsis('Un robot futuriste vient pour tuer Sarah Connor.');
        $films->setCategory($this->getReference('category_Science-fiction'));
        $manager->persist($films);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }


}