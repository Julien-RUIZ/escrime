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
     * @Route("/admin/formajouteven", name="form_ajout_even")
     */

    public function formAjoutLivreAction(Request $request){



        $form=$this->createform(EvenementType::class, new Evenement());

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $even=$form->getData();



            $entityManager=$this->getDoctrine()->getManager();

            $entityManager->persist($even);
            $entityManager->flush();
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