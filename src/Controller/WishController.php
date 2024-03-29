<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/bucketList", name="app_serie")
     */
    public function list(WishRepository $wishRepository): Response
    {
        // récupère les Wish publiés, du plus récent au plus ancien
        $wishes = $wishRepository->findBy(['isPublished' => true], ['dateCreated' => 'DESC']);
        return $this->render('wish/list.html.twig', [
            // les passe à Twig
            "wishes" => $wishes
        ]);
    }
    public function about_us(int $id, WishRepository $wishRepository): Response
    {
        // récupère ce wish en fonction de l'id présent dans l'URL
        $wish = $wishRepository->find($id);
        // s'il n'existe pas en bdd, on déclenche une erreur 404
        if (!$wish){
            throw $this->createNotFoundException('This wish do not exists! Sorry!');
        }
        return $this->render('wish/about_us.html.twig', [
            "wish" => $wish
        ]);
    }
}
