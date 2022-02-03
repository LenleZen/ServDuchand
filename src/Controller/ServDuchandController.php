<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Utilisateur;

class ServDuchandController extends AbstractController
{
    /**
     * @Route("/serv/duchand", name="serv_duchand")
     */
    public function index(): Response
    {
        return $this->render('serv_duchand/index.html.twig', [
            'controller_name' => 'ServDuchandController',
        ]);
    }

    /**
     * @Route("/serv/login", name="login")
     */
    public function login(Request $request,EntityManagerInterface $manager): Response
    {
        //récupération des informations du formulaire
        $login = $request->request->get("login");
        $password = $request->request->get("password");
        if ($login=="root" && $password=="toor")
            $message = "vous avez réussi a vous connecter ✔️";
         else
            $message = "Pas le bon identifiant ou mot de passe ❌";

        return $this->render('serv_duchand/login.html.twig', [
            'login' => $login,
            'password' => $password,
            'message' => $message,
        ]);
    }
}
