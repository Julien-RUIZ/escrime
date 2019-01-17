<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 19/12/2018
 * Time: 15:27
 */

namespace AppBundle\Controller\admin;

use AppBundle\Entity\Evenement;
use AppBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MiseajourevenementController extends Controller
{



    /**
     * Cette route va permettre d'afficher dans la partie admin la liste des evenements
     * @Route("/admin/listeEven", name="liste_even")
     */
    public function listeEvenAction()
    {
        //on a besoin du repository pour récupérer le contenu de la table actualité
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository Evenement (avec Evenement::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(Evenement::class);
        //la variable actus aura pour répository toutes les données de la base de donnée
        $evens = $repository->findAll();

        // le return $this->render va nous permettre d'envoyer le array $actus a un html.twig, qui va nous permettre d'en
        // retirer les informations de la base de donnée
        return $this->render("@App/pages/admin/listeeven.html.twig",
            [
                'evens' => $evens
            ]

        );
    }


    /**
     * Une route pour la création de nouveau évenements, seulement accessible par l'admin
     * @Route("/admin/formajouteven", name="form_ajout_even")
     */

    public function formAjoutevenAction(Request $request){


        //associe les données envoyé via le formulaire a mettre sur la variable $form
        $form=$this->createform(EvenementType::class, new Evenement());

        $form->handleRequest($request);

        //on regarde si le formulaire a etait envoyé
        if($form->isSubmitted() && $form->isValid()){
            $even=$form->getData();


            // getDoctrine va appeler la methode getManager
            // get manager va prendre les données et les convertir en données sql
            $entityManager=$this->getDoctrine()->getManager();
            //indique à Doctrine que vous souhaitez (éventuellement) enregistrer le produit
            $entityManager->persist($even);
            //exécute réellement les requêtes
            $entityManager->flush();
            //redirection
            return $this->redirectToRoute('homepage_admin');

        }else{
            return $this->render('@App/pages/form/formevenement.html.twig',
                [
                    'formeven' => $form->createView()
                ]

            );
        }
    }

    /**
     * Partie admin qui nous servira pour supprimer un événement, bouton présent en dessous de la liste , seulement visible en admin
     * @Route("/admin/suppreven/{id}", name="suppr_even")
     */
    public function supprevenAction($id){

        //on a besoin du repository Livre pour récupérer le contenu de la table evenement
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository Evenement (avec Evenement::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(Evenement::class);

        // getDoctrine va appeler la methode getManager
        // get manager va prendre les données et les convertir en données sql
        $entityManager= $this->getDoctrine()->getManager();

        //on déclare la variable auteur en écrivant $id, car c est par l'id
        $even=$repository->find($id);


        //Comme on pouvait s'y attendre, la méthode remove () indique à Doctrine que vous souhaitez supprimer l'objet spécifié
        // de la base de données. Cependant, la requête DELETE n'est exécutée que lorsque la méthode flush ()
        // est appelée.
        $entityManager->remove($even);
        $entityManager->flush();

        return $this->redirectToRoute('form_ajout_even');



    }













}