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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article_add", name="article_add", methods={"GET|POST"})
     */
    public function article(Request $request) : Response
    {
        $article = new Entity\Article();
        $form = $this->createForm(
            Form\ArticleAddType::class,
            $article
        );
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
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
     * @Route("/article/{id}", name="article_id", methods={"GET|POST"})
     */
    public function tagsByArticle(Entity\Article $article) : Response
    {
        return $this->render('article.html.twig', ['tags' => $article->getTags(), 'title' => $article->getTitle()]);
    }
}