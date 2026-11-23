<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $Book =
            [
                ['titre' => 'React', 'read' => false, 'rating' => 4],
                ['titre' => 'Dune', 'read' => true, 'rating' => 1],
                ['titre' => 'Symfony 7', 'read' => true, 'rating' => 5],
                ['titre' => 'Base de données', 'read' => false, 'rating' => 1]
            ];

        foreach ($Book as $b) {

            $book = new Book();

            $book->setTitre($b['titre']);
            $book->setRead($b['read']);
            $book->setRating($b['rating']);
            $manager->persist($book);
            $manager->flush();
        }
    }
}