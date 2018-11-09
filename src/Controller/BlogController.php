<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 09/11/18
 * Time: 14:38
 */

// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{slug}", requirements={"slug"="[a-z0-9-]+"}, methods={"GET"}, name="blog_show")
     */
    public function show($slug="Article Sans Titre")
    {
        $slug=ucwords(str_replace("-", " ", $slug));
        return $this->render('slug.html.twig', ['slug' => $slug]);
    }
}