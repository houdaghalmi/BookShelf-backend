<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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
    public function show(Book $book): JsonResponse
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
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(Book $book,EntityManagerInterface $em ): JsonResponse
    {
        $em->remove($book);
        $em->flush(); //envoyer la requête à la base de données
        return $this->json($book);
    } 

    #[Route('/{id}' ,name:'update',methods:['PUT','PATCH'])]
    public function update(Book $book, EntityManagerInterface $em,Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true); //true pour obtenir un tableau associatif
        if(isset($data['titre'])){$book->setTitre($data['titre']);}
        if (isset($data['read'])){$book->setRead($data['read']);}
        if (isset($data['rating'])){$book->setRating($data['rating']);}  
        $em->flush();
        return $this->json($book);   
}
}

  


