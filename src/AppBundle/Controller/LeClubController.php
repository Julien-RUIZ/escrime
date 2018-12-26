<?php
/**
 * Created by PhpStorm.
 * User: lapiscine
 * Date: 03/12/2018
 * Time: 19:00
 */

namespace AppBundle\Controller;

use AppBundle\Entity\horaire;
use AppBundle\Entity\Information;
use AppBundle\Entity\Role;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LeClubController extends Controller
{


    /**
     * Cette route va nous donner la possibilité d'afficher différentes informations contenu dans une base de donnée, ainsi en utilisant le numero
     * de l'id concerné dans l'url nous pourrons afficher les informations souhaitées
     * @Route("/leClub/{id}", name="le_club_presentation")
     */
    public function listeInfoAction($id){
        //on a besoin du repository pour récupérer le contenu de la table
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository information (avec Information::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(Information::class);
        //la variable info aura pour répository toutes les données selon la valeur de l'id, ainsi pour chaque
        // valeur nous aurons une redirection sur un twig
        $info = $repository->find($id);

        if ($id==2){
            return $this->render("@App/pages/LeClub/salle.html.twig",
                [
                    'infos' => $info
                ]);
        }elseif ($id==4){
            return $this->render("@App/pages/InfoPiedPage/credit.html.twig",
            [
                'infos' => $info
            ]);

        }elseif ($id==3){
            return $this->render("@App/pages/InfoPiedPage/mentionlegal.html.twig",
                [
                    'infos' => $info
                ]);
        } else{ return $this->render("@App/pages/LeClub/Presentation.html.twig",
            [
                'infos' => $info
            ]);
        }

    }


    /**
     * Route permettant d'afficher les horaires d'entrainement, route appelé par un lien dans la base principale
     * @Route("/leClubHoraire", name="le_club_les_horaires")
     */
    public function HoraireAction(){
        //on a besoin du repository pour récupérer le contenu de la table
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository horaire (avec horaire::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(horaire::class);
        //la variable info aura pour répository toutes les données de la base de donnée
        $horaires = $repository->findAll();


        return $this->render("@App/pages/LeClub/horaire.html.twig",
            [
                'horaires' => $horaires
            ]

        );

    }

//--------------------------------------Affiche les membres du burreau et liste inscrit en admin------------------
    /**
     * Une route nour permettant de faire la liste des inscrits, utiliser le lien many to one entre user et role pour afficher, le poste et le nom des
     * membre du bureau
     * @Route("/lesMembresDuClub", name="les_membres_du_club")
     */
    public function staffAction(){
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository horaire (avec User::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(User::class);
        //la variable info aura pour répository toutes les données de la base de donnée
        $membres = $repository->findAll();


        return $this->render("@App/pages/LeClub/LeBureau.html.twig",
            [
                'membres' => $membres
            ]

        );

    }

    /**
     * Liste seulement pour la partie admin et a gérer les membre, action possible (supprimer un membre) voir route suivante
     * @Route("/admin/listeInscrit", name="liste_inscrit")
     */
    public function listeInscritAction(){
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository horaire (avec User::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(User::class);
        //la variable info aura pour répository toutes les données de la base de donnée
        $membres = $repository->findAll();


        return $this->render("@App/pages/admin/listeInscrit.html.twig",
            [
                'membres' => $membres
            ]

        );

    }

    /**
     * Cette route va nous permettre de supprimer les membres
     * @Route("/admin/supprmembre/{id}", name="suppr_membre")
     */
    public function supprMembreAction($id){

        //on a besoin du repository Livre pour récupérer le contenu de la table Auteur
        // pour récupérer ce repository :
        // on appelle Doctrine (qui gère les répository)
        // pour appeler la méthode getRepository qui récupère le repository Auteur (avec Auteur::class passé en parametre)
        $repository = $this->getDoctrine()->getRepository(User::class);

        // getDoctrine va appeler la methode getManager
        // get manager va prendre les données et les convertir en données sql
        $entityManager= $this->getDoctrine()->getManager();

        //on déclare la variable auteur en écrivant $id, car c est par l'id
        $membre=$repository->find($id);


        //Comme on pouvait s'y attendre, la méthode remove () indique à Doctrine que vous souhaitez supprimer l'objet spécifié
        // de la base de données. Cependant, la requête DELETE n'est exécutée que lorsque la méthode flush ()
        // est appelée.
        $entityManager->remove($membre);
        $entityManager->flush();

        return $this->redirectToRoute('liste_inscrit');



    }
}