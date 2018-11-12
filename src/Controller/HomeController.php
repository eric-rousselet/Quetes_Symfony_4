<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 08/11/18
 * Time: 09:48
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form;

class HomeController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function index()
    {
        $form = $this->createForm(
            Form\ArticleSearchType::class,
            null,
            ['method' => Request::METHOD_GET]
        );
        return $this->render(
            'home.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }
}