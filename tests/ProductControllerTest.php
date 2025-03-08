<?php

namespace App\Tests;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class ProductControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ProductRepository $productRepository;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();
        $repository = $container->get(ProductRepository::class);
        assert($repository instanceof ProductRepository);
        $this->productRepository = $repository;
    }

    public function testIndex(): void
    {
        $this->client->request('GET', '/products/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Products');
    }

    public function testShow(): void
    {
        $product = $this->productRepository->findOneBy([]);
        $this->assertNotNull($product);

        $this->client->request('GET', '/products/'.$product->getId());
        $this->assertResponseIsSuccessful();
        
        $title = $product->getTitle();
        $this->assertNotNull($title);
        $this->assertSelectorTextContains('h1', $title);
    }

    public function testNew(): void
    {
        $this->client->request('GET', '/products/new');
        $this->assertResponseIsSuccessful();

        $uploadedFile = new UploadedFile(
            __DIR__.'/fixtures/test-image.jpg',
            'test-image.jpg',
            'image/jpeg',
            null
        );

        $this->client->submitForm('Create Product', [
            'product[title]' => 'Test Product',
            'product[shortDescription]' => 'Test Description',
            'product[price]' => 99.99,
            'product[vat]' => 18.00,
            'product[category]' => 'Electronics',
            'product[image]' => $uploadedFile,
        ]);

        $this->assertResponseRedirects('/products/');
        $product = $this->productRepository->findOneBy(['title' => 'Test Product']);
        $this->assertNotNull($product);
    }
}
