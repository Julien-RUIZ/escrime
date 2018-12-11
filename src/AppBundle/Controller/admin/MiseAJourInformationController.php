<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 05/12/2018
 * Time: 18:43
 */

namespace AppBundle\Controller\admin;

use AppBundle\Entity\Information;
use AppBundle\Entity\Tarif;
use AppBundle\Form\InformationType;
use AppBundle\Form\TarifType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MiseAJourInformationController extends Controller
{
//--------------partie qui va nous permettre de lister le contenue de la base de donnée---------------------
    /**
     * @Route("/admin/listeinformation", name="liste_information")
     */
    public function listInfoAction(){


        $repository = $this->getDoctrine()->getRepository(Information::class);
        $infos = $repository->findAll();

        return $this->render("@App/pages/admin/listeInformation.html.twig",
            [
                'infos' => $infos
            ]
        );
    }

//--------------partie pour la mise a jour des informations-------------------------------------

    /**
     * @Route("/admin/miseajourlivre/{id}", name="mise_a_jour_information")
     */

    public function MiseajourLivreAction(Request $request, $id)
    {

        //on a besoin du repository Livre pour récupérer le contenu de la table Auteur
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository Auteur (avec Auteur::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(Information::class);
        //on déclare la variable auteur en écrivant $id, car c est par l'id
        $info = $repository->find($id);



        //
        $form = $this->createform(InformationType::class, $info);
//associe les données envoyé via le formulaire a mettre sur la variable $form, donc la variable $form contient bien le $°post[]
        $form->handleRequest($request);


        //on regarde si le formulaire a etait envoyé
        if ($form->isSubmitted() && $form->isValid()) {

            $info = $form->getData();


            // getDoctrine va appeler la methode getManager
            // get manager va prendre les données et les convertir en données sql
            $entityManager = $this->getDoctrine()->getManager();

            //indique à Doctrine que vous souhaitez (éventuellement) enregistrer le produit
            $entityManager->persist($info);
            //exécute réellement les requêtes
            $entityManager->flush();

            return $this->redirectToRoute('mise_a_jour_information');

        } else {

            return $this->render('@App/pages/form/forminformation.html.twig',
                [
                    'forminfo' => $form->createView(),

                ]

            );

        }
    }








}