<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 12/11/18
 * Time: 11:05
 */

namespace App\Controller;

use App\Entity;
use App\Form;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\Slugify;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{

    /**
     * @Route("/", name="article_index", methods="GET")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', ['articles' => $articleRepository->findAll()]);
    }

    /**
     * @Route("/article_add", name="article_add", methods={"GET|POST"})
     */
    public function article(Request $request, Slugify $slugify) : Response
    {
        $article = new Entity\Article();
        $form = $this->createForm(
            Form\ArticleAddType::class,
            $article
        );
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $slug = $slugify->generate($article->getTitle());
            $article->setSlug($slug);
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_add');
        }
        return $this->render(
            'article_add.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("article/{id}/edit", name="article_edit", methods="GET|POST")
     */
    public function edit(Request $request, Article $article, Slugify $slugify): Response
    {
        $slug = $slugify->generate($article->getTitle());
        $article->setSlug($slug);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_edit', ['id' => $article->getId()]);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_id", methods={"GET|POST"})
     */
    public function tagsByArticle(Entity\Article $article) : Response
    {
        return $this->render('article.html.twig', ['tags' => $article->getTags(), 'title' => $article->getTitle()]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods="DELETE")
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('article_index');
    }
}