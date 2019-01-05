<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 04/01/2019
 * Time: 22:05
 */

namespace AppBundle\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class SportController extends Controller
{


    /**
     * @Route("/LeSports", name="le_sport")
     */
    public function affichageSportAction()
    {
        $var='L\'escrime';

        //Redirection pour l'affichage sur la page html.twig
        return $this->render("@App/pages/LeSport/sport.html.twig",
            [
                'var' => $var
            ]
        );
    }


    /**
     * @Route("/LesTroisArmes", name="les_trois_armes")
     */
    public function affichageTroisArmesAction()
    {
        $var='les trois armes';

        //Redirection pour l'affichage sur la page html.twig
        return $this->render("@App/pages/LeSport/troisArmes.html.twig",
            [
                'var' => $var
            ]
        );
    }














}