<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    private array $productImages = [
        'Electronics' => [
            'iPhone' => [
                'https://picsum.photos/id/1/800/600',
                'https://picsum.photos/id/2/800/600'
            ],
            'Samsung' => [
                'https://picsum.photos/id/3/800/600',
                'https://picsum.photos/id/4/800/600'
            ],
            'MacBook' => [
                'https://picsum.photos/id/5/800/600',
                'https://picsum.photos/id/6/800/600'
            ],
            'Dell' => [
                'https://picsum.photos/id/7/800/600',
                'https://picsum.photos/id/8/800/600'
            ],
            'Sony' => [
                'https://picsum.photos/id/9/800/600',
                'https://picsum.photos/id/10/800/600'
            ]
        ],
        'Books' => [
            'Programming' => [
                'https://picsum.photos/id/11/800/600',
                'https://picsum.photos/id/12/800/600'
            ],
            'Business' => [
                'https://picsum.photos/id/13/800/600',
                'https://picsum.photos/id/14/800/600'
            ],
            'Fiction' => [
                'https://picsum.photos/id/15/800/600',
                'https://picsum.photos/id/16/800/600'
            ]
        ],
        'Clothing' => [
            'T-Shirt' => [
                'https://picsum.photos/id/17/800/600',
                'https://picsum.photos/id/18/800/600'
            ],
            'Jeans' => [
                'https://picsum.photos/id/19/800/600',
                'https://picsum.photos/id/20/800/600'
            ],
            'Jacket' => [
                'https://picsum.photos/id/21/800/600',
                'https://picsum.photos/id/22/800/600'
            ],
            'Sweater' => [
                'https://picsum.photos/id/23/800/600',
                'https://picsum.photos/id/24/800/600'
            ],
            'Dress' => [
                'https://picsum.photos/id/25/800/600',
                'https://picsum.photos/id/26/800/600'
            ]
        ],
        'Food' => [
            'Organic' => [
                'https://picsum.photos/id/27/800/600',
                'https://picsum.photos/id/28/800/600'
            ],
            'Fresh' => [
                'https://picsum.photos/id/29/800/600',
                'https://picsum.photos/id/30/800/600'
            ],
            'Premium' => [
                'https://picsum.photos/id/31/800/600',
                'https://picsum.photos/id/32/800/600'
            ]
        ]
    ];

    private function getSpecificImageUrl(string $category, string $type): string
    {
        $images = $this->productImages[$category][$type] ?? $this->productImages[$category][array_key_first($this->productImages[$category])];
        return $images[array_rand($images)];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Electronics products
        $electronicsTypes = ['iPhone', 'Samsung', 'MacBook', 'Dell', 'Sony'];
        for ($i = 0; $i < 10; $i++) {
            $type = $faker->randomElement($electronicsTypes);
            $product = new Product();
            $product->setTitle($type . ' ' . $faker->word);
            $product->setShortDescription($faker->paragraph(3));
            $product->setPrice($faker->randomFloat(2, 299, 2999));
            $product->setVat($faker->randomFloat(2, 299, 1999));
            $product->setCategory('Electronics');
            $product->setImage($this->getSpecificImageUrl('Electronics', $type));
            $product->setCreatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-1 year')->format('Y-m-d H:i:s')));
            $product->setUpdatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-6 months')->format('Y-m-d H:i:s')));
            $manager->persist($product);
        }

        // Books
        $bookTypes = ['Programming', 'Business', 'Fiction'];
        for ($i = 0; $i < 10; $i++) {
            $type = $faker->randomElement($bookTypes);
            $product = new Product();
            $product->setTitle($type . ' ' . $faker->word);
            $product->setShortDescription($faker->text(200));
            $product->setPrice($faker->randomFloat(2, 9, 99));
            $product->setVat($faker->randomFloat(2, 9, 49));
            $product->setCategory('Books');
            $product->setImage($this->getSpecificImageUrl('Books', $type));
            $product->setCreatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-1 year')->format('Y-m-d H:i:s')));
            $product->setUpdatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-6 months')->format('Y-m-d H:i:s')));
            $manager->persist($product);
        }

        // Clothing
        $clothingTypes = ['T-Shirt', 'Jeans', 'Jacket', 'Sweater', 'Dress'];
        for ($i = 0; $i < 10; $i++) {
            $type = $faker->randomElement($clothingTypes);
            $product = new Product();
            $product->setTitle($type . ' ' . $faker->word);
            $product->setShortDescription($faker->text(150));
            $product->setPrice($faker->randomFloat(2, 19, 299));
            $product->setVat($faker->randomFloat(2, 19, 299));
            $product->setCategory('Clothing');
            $product->setImage($this->getSpecificImageUrl('Clothing', $type));
            $product->setCreatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-1 year')->format('Y-m-d H:i:s')));
            $product->setUpdatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-6 months')->format('Y-m-d H:i:s')));
            $manager->persist($product);
        }

        // Food
        $foodTypes = ['Organic', 'Fresh', 'Premium'];
        for ($i = 0; $i < 10; $i++) {
            $type = $faker->randomElement($foodTypes);
            $product = new Product();
            $product->setTitle($type . ' ' . $faker->word);
            $product->setShortDescription($faker->text(100));
            $product->setPrice($faker->randomFloat(2, 4, 49));
            $product->setVat($faker->randomFloat(2, 4, 49));
            $product->setCategory('Food');
            $product->setImage($this->getSpecificImageUrl('Food', $type));
            $product->setCreatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-1 year')->format('Y-m-d H:i:s')));
            $product->setUpdatedAt(new \DateTimeImmutable($faker->dateTimeBetween('-6 months')->format('Y-m-d H:i:s')));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
