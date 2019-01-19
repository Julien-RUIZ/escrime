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
     * C'est notre page principale sur laquelle nous allons avoir la liste des actus
     * @Route("/", name="homepage")
     */
    public function indexActusAction()
    {
        // Attention c est ici que ce trouve la partie affichage en plublic des actus
        //on a besoin du repository  pour récupérer le contenu de la table
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository Auteur (avec Actualites::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(Actualites::class);
        //affiche dans l'ordre décroissant des id
        $actus = $repository->findBy(array(), array('id' => 'desc'));




        //Redirection pour l'affichage sur la page html.twig
       return $this->render("@App/pages/accueil.html.twig",
           [
               'actus' => $actus
           ]

       );
    }


    /**
     * C'est notre page principale sur laquelle nous allons avoir la liste des actus
     * @Route("/afficheActus/{id}", name="affiche_actus")
     */
    public function afficheActusAction($id)
    {
        // Attention c est ici que ce trouve la partie affichage en plublic des actus
        //on a besoin du repository  pour récupérer le contenu de la table
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository Auteur (avec Actualites::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(Actualites::class);
        //affiche dans l'ordre décroissant des id
        $actus = $repository->find($id);




        //Redirection pour l'affichage sur la page html.twig
        return $this->render("@App/pages/AfficheActus/afficheactus.html.twig",
            [
                'actus' => $actus
            ]

        );
    }
//---------------------partie accueil admin-------------------------------------------------------

    /**
     * Page principale admin
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
