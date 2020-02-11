<?php


namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Form\ArticlesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin")
 */
class ArticlesController extends AbstractController
{

    /**
     * Création d'un article
     *
     * @Route("/new", methods={"GET", "POST"}, name="admin_post_new")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $article = new Articles();
        $form_post = $this->createForm(ArticlesType::class, $article);

        $form_post->handleRequest($request);

        if ($form_post->isSubmitted() && $form_post->isValid()) {
            $article = $form_post->getData();

            $article->setSlug(
                preg_replace(
                    '/\s+/',
                    '-',
                    \mb_strtolower(trim(strip_tags($article->getSlug())), 'UTF-8')
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('articles_all');
        }

        return $this->render('admin/new_article.html.twig', [
            'form_post' => $form_post->createView()
        ]);
    }
}