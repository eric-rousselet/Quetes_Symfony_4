<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 12/11/18
 * Time: 16:37
 */

namespace App\Controller;

use App\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories")
     */
    public function show_categories()
    {
        $repository = $this->getDoctrine()->getRepository(Entity\Article::class);
        $articles = $repository->findAll();
        return $this->render('categories.html.twig', ['articles' => $articles]);
    }
}