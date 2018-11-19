<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 19/11/18
 * Time: 14:16
 */

namespace App\DataFixtures;

use  Faker;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = [
        'PHP',
        'Javascript',
        'Java',
        'Ruby',
        'SQL',
        ];

        foreach ($categories as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('categorie_' . $key, $category);
        }
        $manager->flush();
    }
}