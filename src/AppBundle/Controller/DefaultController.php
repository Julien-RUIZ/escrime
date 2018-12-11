<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
//---------------------partie accueil------------------------------------------------------------
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

    $variable = "page d accueil";


       return $this->render("@App/pages/accueil.html.twig",
           [
               'variable' => $variable
           ]

           );
    }
//---------------------partie accueil admin-------------------------------------------------------

    /**
     * @Route("/admin", name="homepage_admin")
     */
    public function indexAdminAction()
    {

        $variable = "page d accueil de l'admin";


        return $this->render("@App/pages/accueilAdmin.html.twig",
            [
                'variable' => $variable
            ]

        );
    }

//---------------------Partie connexion-------------------------------------------------------















}
