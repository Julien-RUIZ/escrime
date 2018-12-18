<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Actualites;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
//---------------------partie accueil qui va afficher les actus------------------------------------------------------------
    /**
     * @Route("/", name="homepage")
     */
    public function indexActusAction()
    {

        $repository = $this->getDoctrine()->getRepository(Actualites::class);
        $actus = $repository->findAll();


       return $this->render("@App/pages/accueil.html.twig",
           [
               'actus' => $actus
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


}
