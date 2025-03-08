<?php

namespace App\Controller\Api;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api')]
class ProductController extends AbstractController
{
    #[Route('/products', name: 'api_products_index', methods: ['GET'])]
    public function index(Request $request, ProductRepository $productRepository, SerializerInterface $serializer): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        $limit = $request->query->getInt('limit', 10);
        $offset = ($page - 1) * $limit;

        $products = $productRepository->findBy([], ['createdAt' => 'DESC'], $limit, $offset);
        $total = $productRepository->count([]);

        $items = array_map(function ($product) {
            return [
                'id' => $product->getId(),
                'title' => $product->getTitle(),
                'description' => $product->getShortDescription(),
                'price' => $product->getPrice(),
                'category' => $product->getCategory(),
                'image' => $product->getImage(),
                'createdAt' => $product->getCreatedAt()?->format('Y-m-d H:i:s'),
                'updatedAt' => $product->getUpdatedAt()?->format('Y-m-d H:i:s')
            ];
        }, $products);

        $data = [
            'items' => $items,
            'total' => $total,
            'page' => $page,
            'limit' => $limit,
            'pages' => ceil($total / $limit)
        ];

        $json = $serializer->serialize($data, 'json', ['groups' => 'product:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/products/{id}', name: 'api_products_show', methods: ['GET'])]
    public function show(int $id, ProductRepository $productRepository, SerializerInterface $serializer): JsonResponse
    {
        $product = $productRepository->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $json = $serializer->serialize($product, 'json', ['groups' => 'product:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }
}
