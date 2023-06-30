<?php
/**
 * Task fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Bug;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use App\Repository\UserRepository;

/**
 * Class TaskFixtures.
 */
class BugFix extends Fixture
{
    /**
     * Faker.
     *
     * @var Generator
     */
    protected Generator $faker;

    /**
     * Persistence object manager.
     *
     * @var ObjectManager
     */
    protected ObjectManager $manager;

    /**
     * Load.
     *
     * @param ObjectManager $manager Persistence object manager
     */
    public function load(ObjectManager $manager): void
    {   
        $this->faker = Factory::create();

        
        
        for ($i = 0; $i < 10; ++$i) {
            $user = new User;
            $user->setUsername($this->faker->userName());
            $user->setPassword("e");
            $manager->persist($user);
            
            $bug = new Bug();
            $bug->setTitle($this->faker->sentence(3));
            $bug->setBody($this->faker->sentence(200));
            $bug->setCreatedAt(
                DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', '-1 days'))
            );
            $bug->setAuthor($user);
            
            $manager->persist($bug);
        }

        $manager->flush();
    }
}