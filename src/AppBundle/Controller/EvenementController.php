<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 19/12/2018
 * Time: 15:57
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Evenement;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EvenementController extends Controller
{

    /**
     * @Route("/evenement", name="evenement")
     */
    public function indexActusAction()
    {
// Attention c est ici que ce trouve la partie affichage en plublic des actus

        $repository = $this->getDoctrine()->getRepository(Evenement::class);
        //affiche dans l'ordre décroissant des id
        $evens = $repository->findBY(array(), array('id' => 'desc'));

        return $this->render("@App/pages/Evenement/evenement.php.twig",
            [
                'evens' => $evens
            ]

        );
    }







}