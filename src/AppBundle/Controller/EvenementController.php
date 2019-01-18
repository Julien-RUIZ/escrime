<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 19/12/2018
 * Time: 15:57
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Evenement;
use AppBundle\Entity\Type;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EvenementController extends Controller
{

    /**
     * Avec cette route nous allons avoir la liste de tous les évènements dans la liste du plus ressent au plus anciens
     * @Route("/listeevenement", name="evenement")
     */
    public function listeEvenAction()
    {
        // Attention c’est ici que ce trouve la partie affichage en public des actus
        //on a besoin du repository pour récupérer le contenu de la table evenement
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository évènement (avec Évènement::class passé en paramètre)

        $repository = $this->getDoctrine()->getRepository(Evenement::class);
        //affiche dans l'ordre décroissant des id, et ainsi avoir les actualitées affiché du plus recents au plus anciens
        $evens = $repository->findBY(array(), array('id' => 'desc'));

        return $this->render("@App/pages/Evenement/evenement.php.twig",
            [
                'evens' => $evens
            ]

        );
    }





    /**
     * Cette partie est réalisé pour afficher tous les evenements en rapport a l id du type,
     * @Route("/type/{id}", name="info_type")
     */
    public function typeAction($id){
        //le repository sert a récuperer les entités depuis la base de donnée, grace a doctrine
        $repository = $this->getDoctrine()->getRepository(Type::class);
        //on déclare la variable types en utilisant $id inscrit dans l'url
        $types = $repository->find($id);

        //cette partie permet de retourner la vue types, celle qui va au final afficher le résultat apres selection
        return $this->render("@App/pages/Evenement/competition.php.twig",
            [
                'types' => $types
            ]
        );
    }






}