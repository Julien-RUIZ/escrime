<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 11/12/2018
 * Time: 19:08
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Tarif;


class InfoPratiqueController extends Controller
{

    /**
     * @Route("/location", name="location_materiel")
     */

    public function prixLocationAction(){

            $repository = $this->getDoctrine()->getRepository(Tarif::class);
//la variable info aura pour répository toutes les données de la base de donnée Information
            $tarifs = $repository->findAll();


            return $this->render("@App/pages/InfoPratique/Prix.html.twig",
                [
                    'tarifs' => $tarifs
                ]

            );

        }



    /**
     * @Route("/licence", name="licence")
     */

    public function prixlicenceAction(){

        $repository = $this->getDoctrine()->getRepository(Tarif::class);
//la variable info aura pour répository toutes les données de la base de donnée Information
        $licences = $repository->findAll();


        return $this->render("@App/pages/InfoPratique/Licence.html.twig",
            [
                'licences' => $licences
            ]

        );

    }





















}