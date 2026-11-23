<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Doctrine\ORM\EntityManagerInterface;


#[Route('/api/books', name: 'api_books_')]
final class BookController extends AbstractController
{
    #[Route('', name: 'findAll', methods: ['GET'])]
    public function index(BookRepository $rep): JsonResponse
    {
        $books = $rep->findAll();
        return $this->json($books);
    }
    #[Route('/{id}', name: 'find', methods: ['GET'])]
    public function show(Books $book): JsonResponse
    {
        return $this->json($book);
    }  
    #[Route('', name: 'create', methods: ['POST'])]
    public function create(#[MapRequestPayload] Book $book,EntityManagerInterface $em ): JsonResponse
    {
        $em->persist($book);
        $em->flush();
        return $this->json($book);
    }
}

  


