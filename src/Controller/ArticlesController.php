<?php

namespace App\Controller;

use App\Entity\Articles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticlesController extends AbstractController
{
    /**
     * Affiche les articles
     * @Route("/articles", name="articles_all")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
        $articles = $em->getRepository(Articles::class)->findAll();
        return $this->render('articles/index.html.twig',
            ['articles' => $articles]
        );
    }


    /**
     * Affiche un article par rapport à son slug
     * @Route("/{slug}", name="article_show")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function show(Request $request, EntityManagerInterface $em): Response
    {
        $slug = $request->get('slug');
        $article = $em->getRepository(Articles::class)->findOneBy(['slug' => $slug]);

        if (empty($article)) {
            return $this->redirectToRoute('articles_all');
        }

        return $this->render('articles/show_article.html.twig',
            ['article' => $article]
        );
    }
}
