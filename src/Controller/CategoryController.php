<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 12/11/18
 * Time: 13:19
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function show(Entity\Category $category):Response
    {
        return $this->render('category.html.twig', ['category' => $category]);
    }
}
