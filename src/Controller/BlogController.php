<?php
/**
 * Created by PhpStorm.
 * User: wilder21
 * Date: 09/11/18
 * Time: 14:38
 */

// src/Controller/BlogController.php
namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;

class BlogController extends AbstractController
{
    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/blog/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     *  @return Response A response instance
     */
    public function show($slug) : Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with '.$slug.' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/show.html.twig',
            [
                'article' => $article,
                'slug' => $slug,
            ]
        );
    }

    /**
     * @param string $category
     *
     * @Route("/category/{category}",
     *     defaults={"category" = null},
     *     name="blog_show_category")
     *  @return Response A response instance
     */
    public function showByCategory(string $category):Response
    {
        if (!$category) {
            throw $this
                ->createNotFoundException('No category has been sent to find an article in article\'s table.');
        }

        $selectedCategory = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $category]);

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['category' => $selectedCategory], ['id' => 'DESC'], 3);

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article with '.$selectedCategory.' category, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/category.html.twig',
            [
                'articles' => $articles,
                'category' => $selectedCategory,
            ]
        );
    }

    /**
     * Show all row from article's entity
     *
     * @Route("/", name="blog_index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
        );
    }
}