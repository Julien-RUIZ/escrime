<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 05/12/2018
 * Time: 18:43
 */

namespace AppBundle\Controller\admin;

use AppBundle\Entity\Tarif;
use AppBundle\Form\TarifType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MiseAJourPrixController extends Controller
{



    /**
     * @Route("/admin/miseajourprix/{id}", name="mise_a_jour_prix")
     */

    public function MiseajourauteurAction(Request $request,$id){




        //on a besoin du repository Livre pour récupérer le contenu de la table Auteur
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository Auteur (avec Auteur::class passé en parametre)

        $repository = $this->getDoctrine()->getRepository(Tarif::class);

        //on déclare la variable auteur en écrivant $id, car c est par l'id

        $tarif=$repository->find($id);

        $form = $this->createform(TarifType::class, $tarif);
        //associe les données envoyé via le formulaire a mettre sur la variable $form, donc la variable $form contient bien le $°post[]
        $form->handleRequest($request);


//on regarde si le formulaire a etait envoyé
        if($form->isSubmitted() && $form->isValid()){

            $tarif=$form->getData();
            // getDoctrine va appeler la methode getManager
            // get manager va prendre les données et les convertir en données sql
            $entityManager=$this->getDoctrine()->getManager();

            //indique à Doctrine que vous souhaitez (éventuellement) enregistrer le produit
            $entityManager->persist($tarif);
            //exécute réellement les requêtes
            $entityManager->flush();

            return $this->redirectToRoute('homepage_admin');

        }


        else {
            return $this->render('@App/pages/form/formPrix.html.twig',
                [
                    'formprix' => $form->createView()
                ]

            );
        }
    }


















}