<?php

namespace App\Controller;

use App\Entity\Articles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/articles")
 */
class ArticlesController extends AbstractController
{
    /**
     * Method to show all articles
     *
     * @Route("/", name="articles_all")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
        $articles = $em->getRepository(Articles::class)->findAll();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
