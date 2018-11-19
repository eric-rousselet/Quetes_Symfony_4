<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 16/11/18
 * Time: 11:38
 */

namespace App\Controller;

use App\Entity;
use App\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TagController  extends AbstractController
{
    /**
     * @Route("/tag/{name}", name="tag_name", methods={"GET|POST"})
     */
    public function articlesByTag(Entity\Tag $tag) : Response
    {
        return $this->render('tag.html.twig', ['articles' => $tag->getArticles(), 'tagName' => $tag->getName()]);
    }
}
