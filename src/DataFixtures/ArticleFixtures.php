<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 19/11/18
 * Time: 15:58
 */

namespace App\DataFixtures;

use  Faker;
use App\Entity\Article;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<50; $i++) {
            $faker = Faker\Factory::create('fr_FR');

            $article = new Article();
            $article->setTitle(mb_strtolower($faker->sentence()));
            $article->setContent($faker->paragraph);

            $manager->persist($article);
            $article->setCategory($this->getReference('categorie_'.$faker->numberBetween($min = 0, $max = 4)));
        }
        $manager->flush();
    }
}