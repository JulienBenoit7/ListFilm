<?php

namespace App\DataFixtures;

use App\Entity\Series;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeriesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $series = new Series();
        $series->setTitle('Dr House');
        $series->setSynopsis("Gregory House est un médecin misanthrope et sarcastique, ayant visiblement du mal à supporter ses patients. Mais il n'en est pas moins surdoué, résolvant avec son équipe les cas médicaux les plus complexes.");
        $series->setCategory($this->getReference('category_Action'));
        $manager->persist($series);
        $manager->flush();

        $series = new Series();
        $series->setTitle('Magnum');
        $series->setSynopsis('Un super detective enquete sur les crimes de Hawaii dans une superbe chemise.');
        $series->setCategory($this->getReference('category_Action'));
        $manager->persist($series);
        $manager->flush();

    }
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}