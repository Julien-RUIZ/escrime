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
     * Création d'une route pour l'affichage des tarif le location et prix licence (voir route suivante)
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

//---------------------------------------------------------------------------------------

    /**
     * Création d'une route nous permettant d'afficher les informations de la base de donnée
     * des tarifs, la en l occurrence pour l affichage des licences
     * @Route("/licence", name="licence")
     */

    public function prixlicenceAction(){
        //on a besoin du repository pour récupérer le contenu de la table evenement
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository tarif (avec Tarif::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(Tarif::class);
        //la variable  aura pour répository toutes les données de la base de donnée Information
        $licences = $repository->findAll();

        //redirection
        return $this->render("@App/pages/InfoPratique/Licence.html.twig",
            [
                'licences' => $licences
            ]

        );

    }
//--------------------------------------------------------------------------------------

    /**
     * Réalisation un tableau associatif, qui va nous permettre d'afficher, le nom du site et son adresse
     * tout cela en faisant un renvoi avec la variable $liens, a la page twig pour traiter
     * les informations.
     * @Route("/lienUtile", name="lien_utile")
     */

    public function LienUtileAction(){

        $liens =
            [
                1 =>
                    [
                        'nom' => "La Fédération Française d'escrime",
                        'adresse'=>'www.escrime-ffe.fr'
                    ],
                2 =>
                    [
                        'nom' => "La ligue d'Aquitaine d'escrime",
                        'adresse'=>'www.escrimeaquitaine.free.fr'
                    ],
                3 =>
                    [
                        'nom' => "Le Comité Départemental d'escrime de la Gironde",
                        'adresse'=>'www.escrime33.com'
                    ],
                4 =>
                    [
                        'nom' => "La Fédération Française d'escrime",
                        'adresse'=>'www.handisport.org'
                    ],
                5 =>
                    [
                        'nom' => "Confédération européenne d'escrime",
                        'adresse'=>'www.eurofencing.info'
                    ],
                6 =>
                    [
                        'nom' => "Toute l'info sur l'escrime française et internationale",
                        'adresse'=>'www.escrime-info.com'
                    ],
                7 =>
                    [
                        'nom' => "Équipement",
                        'adresse'=>'www.escrime-diffusion.com '
                    ],
                8 =>
                    [
                        'nom' => "Site réalisé par Julien RUIZ",
                        'adresse'=>'www.julien-ruiz.fr'
                    ]
            ];
        return $this->render("@App/pages/InfoPratique/LienUtile.html.twig",
            [
                'liens' => $liens
            ]

            );
    }

















}