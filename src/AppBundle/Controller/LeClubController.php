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
     * @Route("/leClub/{id}", name="le_club_presentation")
     */
    public function listeInfoAction($id){

        $repository = $this->getDoctrine()->getRepository(Information::class);
//la variable info aura pour répository toutes les données de la base de donnée Information
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
     * @Route("/leClubHoraire", name="le_club_les_horaires")
     */
    public function HoraireAction(){

        $repository = $this->getDoctrine()->getRepository(horaire::class);
//la variable info aura pour répository toutes les données de la base de donnée Information
        $horaires = $repository->findAll();


        return $this->render("@App/pages/LeClub/horaire.html.twig",
            [
                'horaires' => $horaires
            ]

        );

    }
}