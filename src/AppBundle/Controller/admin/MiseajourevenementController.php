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
     * Une route pour la création de nouveau évenements, seulement accessible par l'admin
     * @Route("/admin/formajouteven", name="form_ajout_even")
     */

    public function formAjoutLivreAction(Request $request){


        //associe les données envoyé via le formulaire a mettre sur la variable $form, donc la variable $form contient bien le $°post[]
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















}