<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
