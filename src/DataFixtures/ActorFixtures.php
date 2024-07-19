<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public const ACTOR = [
        'Jean Claude Van Damme',
        'Sylvester Stallone',
        'Robert Downey Jr',
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::ACTOR as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $manager->persist($actor);
            $this->addReference('actor_' . $actorName, $actor);
        }
        $manager->flush();
    }
}