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

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_add", methods={"GET|POST"})
     */
    public function category(Request $request) : Response
    {
        $category = new Entity\Category();
        $form = $this->createForm(
            Form\CategoryType::class,
            $category
        );
         $form->handleRequest($request);
         if ($form->isSubmitted()) {

             $em = $this->getDoctrine()->getManager();
             $em->persist($category);
             $em->flush();

             // return $this->redirectToRoute('category_add');
         }
        return $this->render(
            'category.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }
}