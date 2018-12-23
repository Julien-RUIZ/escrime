<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 03/12/2018
 * Time: 19:00
 */

namespace AppBundle\Controller;

use AppBundle\Entity\horaire;
use AppBundle\Entity\Information;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LeClubController extends Controller
{


    /**
     * Cette route va nous donner la possibilité d'afficher différentes informations contenu dans une base de donnée, ainsi en utilisant le numero
     * de l'id concerné dans l'url nous pourrons afficher les informations souhaitées
     * @Route("/leClub/{id}", name="le_club_presentation")
     */
    public function listeInfoAction($id){
        //on a besoin du repository pour récupérer le contenu de la table
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository information (avec Information::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(Information::class);
        //la variable info aura pour répository toutes les données selon la valeur de l'id, ainsi pour chaque
        // valeur nous aurons une redirection sur un twig
        $info = $repository->find($id);

        if ($id==2){
            return $this->render("@App/pages/LeClub/salle.html.twig",
                [
                    'infos' => $info
                ]);
        }elseif ($id==4){
            return $this->render("@App/pages/InfoPiedPage/credit.html.twig",
            [
                'infos' => $info
            ]);

        }elseif ($id==3){
            return $this->render("@App/pages/InfoPiedPage/mentionlegal.html.twig",
                [
                    'infos' => $info
                ]);
        } else{ return $this->render("@App/pages/LeClub/Presentation.html.twig",
            [
                'infos' => $info
            ]);
        }

    }


    /**
     * Route permettant d'afficher les horaires d'entrainement, route appelé par un lien dans la base principale
     * @Route("/leClubHoraire", name="le_club_les_horaires")
     */
    public function HoraireAction(){
        //on a besoin du repository pour récupérer le contenu de la table
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository horaire (avec horaire::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(horaire::class);
        //la variable info aura pour répository toutes les données de la base de donnée
        $horaires = $repository->findAll();


        return $this->render("@App/pages/LeClub/horaire.html.twig",
            [
                'horaires' => $horaires
            ]

        );

    }
}