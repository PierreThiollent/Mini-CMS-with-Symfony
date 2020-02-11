<?php


namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Form\ArticlesType;
use Doctrine\ORM\EntityManagerInterface;
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
     * Liste les articles
     * @Route("/articles", methods={"GET"}, name="admin_articles_all")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
        $post_list = $em->getRepository(Articles::class)->findBy([], ['id' => 'DESC']);

        return $this->render(
            'admin/index.html.twig',
            ['articles' => $post_list]
        );
    }


    /**
     * Création d'un article
     * @Route("/new", methods={"GET", "POST"}, name="admin_article_new")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $em): Response
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

            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('articles_all');
        }

        return $this->render('admin/new_article.html.twig', [
            'form_post' => $form_post->createView()
        ]);
    }
}