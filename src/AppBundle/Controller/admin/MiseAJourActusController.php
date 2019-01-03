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

class MiseAJourActusController extends Controller
{

    /**
     * Cette route va permettre d'afficher dans la partie admin la liste des actualitées
     * @Route("/admin/listeactus", name="liste_actus")
     */
    public function indexActusAction()
    {
        //on a besoin du repository pour récupérer le contenu de la table actualité
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository Actualites (avec Actualites::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(Actualites::class);
        //la variable actus aura pour répository toutes les données de la base de donnée
        $actus = $repository->findAll();

        // le return $this->render va nous permettre d'envoyer le array $actus a un html.twig, qui va nous permettre d'en
        // retirer les informations de la base de donnée
        return $this->render("@App/pages/admin/listeactus.html.twig",
            [
                'actus' => $actus
            ]

        );
    }
//-----------------------------------------------------------------------------------
//-----------------Partie inscription formulaire d'ajout d'actus---------------------
//-----------------------------------------------------------------------------------


    /**
     * Dans la route admin, avec cette route nous allons pour voir ajouter une nouvelle actualitée, un bouton sera présent en début de page
     * @Route("/admin/ajoutActus", name="ajout_actualite")
     */

    public function formAjoutActusAction(Request $request){
        //associe les données envoyé via le formulaire a mettre sur la variable $form, donc la variable $form contient bien le $°post[]
        $form=$this->createform(ActualitesType::class, new Actualites());

        $form->handleRequest($request);
        //on regarde si le formulaire a etait envoyé
        if($form->isSubmitted() && $form->isValid()){

//-----------------Partie inscription de l image en base de donnée avec extension nom---------------------

            $actualites=$form->getData();
            $image = $actualites->getPhoto();
            //va creer l image dans la base de donnée avec une extension
            $imageName = md5(uniqid()).'.'.$image->guessExtension();
            //tente de creer la photo et la place dans le dossier créé par images directory (dans le config.yml)
            try {
                $image->move(
                    $this->getParameter('images_directory'),
                    $imageName
                );
            //sinon erreur
            } catch (FileException $e) {
                ('erreur');
            }
            //recupere le nom de la photo et l'extension
            $actualites->setPhoto($imageName);
//---------------------------------------------------------------------------------------------------------

            // getDoctrine va appeler la methode getManager
            // get manager va prendre les données et les convertir en données sql
            $entityManager=$this->getDoctrine()->getManager();
            //indique à Doctrine que vous souhaitez (éventuellement) enregistrer le produit
            $entityManager->persist($actualites);
            //exécute réellement les requêtes
            $entityManager->flush();
            //si l'enregistrment est valide, alors il va nous renvoyer sur la page accueil admin
            return $this->redirectToRoute('homepage_admin');

        }else{
            //si il y a erreur, il y aura un retour sur le formulaire
            return $this->render('@App/pages/form/formactus.html.twig',
                [
                    'formactus' => $form->createView()
                ]

            );
        }
    }

//-----------------------------------------------------------------------------------
//-----------------Partie pour suprimer les actus------------------------------------
//-----------------------------------------------------------------------------------


    /**
     * Partie admin qui nous servira pour supprimer une actualitée, bouton présent en dessous de l'actu, seulement visible en admin
     * @Route("/admin/suppractus/{id}", name="suppr_actus")
     */
    public function supprActusAction($id){

        //on a besoin du repository Livre pour récupérer le contenu de la table Auteur
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository Auteur (avec Auteur::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(Actualites::class);

        // getDoctrine va appeler la methode getManager
        // get manager va prendre les données et les convertir en données sql
        $entityManager= $this->getDoctrine()->getManager();

        //on déclare la variable auteur en écrivant $id, car c est par l'id
        $activite=$repository->find($id);


        //Comme on pouvait s'y attendre, la méthode remove () indique à Doctrine que vous souhaitez supprimer l'objet spécifié
        // de la base de données. Cependant, la requête DELETE n'est exécutée que lorsque la méthode flush ()
        // est appelée.
        $entityManager->remove($activite);
        $entityManager->flush();

        return $this->redirectToRoute('liste_actus');



    }
//-----------------------------------------------------------------------------------
//-----------------Partie pour mise a jour information actus-------------------------
//-----------------------------------------------------------------------------------

    /**
     * Partie admin, cela va nous permettre de mettre a jour une actualité, ainsi, il reprendra toutes les informations de la base de donnée
     * , grace a cela nous allons pouvoir les modifier
     * @Route("/admin/miseajouractus/{id}", name="mise_a_jour_actus")
     */

    public function MiseajourLivreAction(Request $request, $id)
    {

        //on a besoin du repository  pour récupérer le contenu de la table
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository Auteur (avec Actualites::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(Actualites::class);
        //on déclare la variable actualites en écrivant $id, car c est par l'id
        $actualites = $repository->find($id);


        $form = $this->createform(ActualitesType::class, $actualites);
//associe les données envoyé via le formulaire a mettre sur la variable $form, donc la variable $form contient bien le $°post[]
        $form->handleRequest($request);


        //on regarde si le formulaire a etait envoyé
        if ($form->isSubmitted() && $form->isValid()) {

            $actualites = $form->getData();


//-----------------Partie inscription de l image en base de donnée avec extension nom---------------------


            $image = $actualites->getPhoto();
//va creer l image dans la base de donnée avec une extension
            $imageName = md5(uniqid()).'.'.$image->guessExtension();
//tente de creer la photo et la place dans le dossier créé par images directory(dans le config.yml
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

            // getDoctrine va appeler la methode getManager
            // get manager va prendre les données et les convertir en données sql
            $entityManager = $this->getDoctrine()->getManager();

            //indique à Doctrine que vous souhaitez (éventuellement) enregistrer le produit
            $entityManager->persist($actualites);
            //exécute réellement les requêtes
            $entityManager->flush();

            return $this->redirectToRoute('liste_actus');

        } else {

            return $this->render('@App/pages/form/formactus.html.twig',
                [
                    'formactus' => $form->createView(),

                ]

            );

        }
    }







}