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

    /**
     * Affiche un article
     * @Route("/article/{slug}", name="admin_article_show", methods={"GET"})
     * @param Articles $articles
     * @return Response
     */
    public function show(Articles $articles): Response
    {
        return $this->render('admin/article_detail.html.twig', [
            'article' => $articles,
        ]);
    }

    /**
     * @Route("/article/{slug}/delete", name="admin_article_delete")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, EntityManagerInterface $em): Response
    {
        $slug = $request->get('slug');

        $article = $em->getRepository(Articles::class)->findOneBy(['slug' => $slug]);

        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('admin_articles_all');
    }

    /**
     * Modification d'un article
     * @Route("/article/{slug}/update", name="admin_article_edit", methods={"GET", "POST"})
     * @param Request $request
     * @param Articles $article
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(Request $request, Articles $article, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setSlug(
                preg_replace(
                    '/\s+/',
                    '-',
                    \mb_strtolower(trim(strip_tags($article->getSlug())), 'UTF-8')
                )
            );

            $em->flush();

            return $this->redirectToRoute('admin_article_edit', ['slug' => $article->getSlug()]);
        }

        return $this->render('admin/article_update.html.twig', [
            'article' => $article,
            'form_post' => $form->createView(),
        ]);
    }
}