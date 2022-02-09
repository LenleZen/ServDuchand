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
        $reponse = $manager -> getRepository(Utilisateur :: class) -> findOneBy(['login' => $login]);
        if ($reponse==NULL)
            $message = "L'identifiant n'existe pas❌";
        else{
            $hash = $reponse -> getPassword();
            if (password_verify($password, $hash))
                $message = "vous avez réussi a vous connecter ✔️";
             else
                $message = "Le mot de passe ne correspond pas❌";
        }
        return $this->render('serv_duchand/login.html.twig', [
            'login' => $login,
            'password' => $password,
            'message' => $message,
        ]);
    }
    /**
     * @Route("/serv/nouvutil", name="Creation_Utilisateur")
     */
    public function nouvutil(): Response
    {
        return $this->render('serv_duchand/nouvutil.html.twig', [
            'controller_name' => 'ServDuchandController',
        ]);
    }
 
     /**
     * @Route("/serv/inserutil", name="Insertion_Utilisateur")
     */
    public function inserutil(Request $request,EntityManagerInterface $manager): Response
    {
        $login = $request->request->get("login");
        $password = $request->request->get("password");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $monUtilisateur = new Utilisateur ();
        $monUtilisateur -> setlogin($login);
        $monUtilisateur -> setpassword($password);
        $manager -> persist($monUtilisateur);
        $manager -> flush ();
        return $this->redirectToRoute ('Creation_Utilisateur'); 
    }
  
    /**
     * @Route("/serv/tableau", name="Tableau_Utilisateur")
     */
    public function tableau(Request $request,EntityManagerInterface $manager): Response
    {
        $mesUtilisateurs=$manager->getRepository(Utilisateur::class)->findAll();
        return $this->render('serv_duchand/tableutil.html.twig',['lst_utilisateurs' => $mesUtilisateurs]);
    }    
}