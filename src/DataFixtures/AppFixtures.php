<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {

        for ($c = 0; $c < 3; $c++) {
            $category = new Category();
            $category->setName("Category n°$c")
                ->setSlug(strtolower($this->slugger->slug($category->getName())));

            $manager->persist($category);

            for ($p = 0; $p < mt_rand(15, 20); $p++) {
                $product = new Product();
                $product->setName("Product n°$p")
                    ->setPrice(mt_rand(1, 200))
                    ->setShortDescription("voici ma petit description du produit n°$p, elle est coute mais très sympa à lire")
                    ->setPicture('https://gaak.fr/wp-content/uploads/2021/12/19D08427-C94E-447F-8D9B-8AD55199C947.jpeg')
                    ->setSlug(strtolower($this->slugger->slug($product->getName())))
                    ->setCategory($category);

                $manager->persist($product);
            }
        }
        $manager->flush();
    }
}
