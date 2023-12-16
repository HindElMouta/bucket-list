<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }
    /**
     * @Route("/about_us", name="main_about_us")
     */
    public function details(): Response
    {
        return $this->render('main/about-us.html.twig');
    }

    /**
     * @Route("/list", name="main_list")
     */
    public function list(WishRepository $wishRepository): Response
    {
        // récupère les Wish publiés, du plus récent au plus ancien
        $wishes = $wishRepository->findBy(['isPublished' => true], ['dateCreated' => 'DESC']);
        return $this->render('main/list.html.twig', [
            // les passe à Twig
            "wishes" => $wishes
        ]);
    }

}