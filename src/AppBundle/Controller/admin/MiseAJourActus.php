<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 18/12/2018
 * Time: 17:03
 */

namespace AppBundle\Controller\admin;

use AppBundle\Entity\Actualites;
use AppBundle\Form\ActualitesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MiseAJourActus extends Controller
{

    /**
     * @Route("/listeactus", name="liste_actus")
     */
    public function indexActusAction()
    {

        $repository = $this->getDoctrine()->getRepository(Actualites::class);
        $actus = $repository->findAll();


        return $this->render("@App/pages/admin/listeactus.html.twig",
            [
                'actus' => $actus
            ]

        );
    }

















//-----------------Partie inscription formulaire d'ajout d'actus---------------------


    /**
     * @Route("/admin/ajoutActus", name="ajout_actualite")
     */

    public function formAjoutActusAction(Request $request){



        $form=$this->createform(ActualitesType::class, new Actualites());


        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){

//-----------------Partie inscription de l image en base de donnée avec extension nom---------------------
            $actualites=$form->getData();
            $image = $actualites->getPhoto();
//va creer l image dans la base de donnée avec une extension
            $imageName = md5(uniqid()).'.'.$image->guessExtension();
//tente de creer la photoet la place dans le dossier créé par images directory(dans le config.yml
            try {
                $image->move(
                    $this->getParameter('images_directory'),
                    $imageName
                );
//sinon erreur
            } catch (FileException $e) {
                ('erreur');
            }
//recupere le nom de l'extension
            $actualites->setPhoto($imageName);
//----------------------------------------------------------


            $entityManager=$this->getDoctrine()->getManager();

            $entityManager->persist($actualites);
            $entityManager->flush();
            return $this->redirectToRoute('homepage_admin');

        }else{
            return $this->render('@App/pages/form/formactus.html.twig',
                [
                    'formactus' => $form->createView()
                ]

            );
        }
    }















}