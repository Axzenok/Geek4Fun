<?php

namespace app\Controllers;

use App\Controllers\BaseController;
use App\Models\Admin;
use App\Models\Connexion;
use Config\Services;

class AdminController extends BaseController
{
    public function index()
    {
        $session = Services::session();
        //Vérifie si l'utilisateur connecter est bien un administrateur

        $id=$session->get('id');
        if ($id==1){
            $model = new Admin();

            //permet d'afficher un tableau avec tout les utilisateurs
            $data['users']=$model->afficherUtilisateur();
            return
                view('BarreNav')
                .view('Administrateur',$data)
                .view('Footer');
        }else{
            return
                view('BarreNav')
                .view('Accueil')
                .view('Footer');
        }
    }
    public function SupprimerUtilisateur()
    {
        $session = Services::session();
        //Vérifie si l'utilisateur connecter est bien un administrateur
        $id=$session->get('id');
        if ($id==1){
            $model = new Admin();

            //permet d'afficher un tableau avec tout les utilisateurs

            $data['users']=$model->afficherUtilisateur();

            //permet de supprimer un utilisateur
            $request = service('request');
            $id = $request->getPost('id');
            $Model = new Admin();
            $Model->supprimerUtilisateur($id);

            return
                view('BarreNav')
                .view('Administrateur',$data)
                .view('Footer');
        }else{
            return
                view('BarreNav')
                .view('Accueil')
                .view('Footer');
        }
    }
    public function ModifierUtilisateur()
    {
        $session = Services::session();
        $id = $session->get('id');

        if ($id == 1) {
            $model = new Admin();
            $model = new Connexion();
            $request = service('request');
            $id_utilisateur = $request->getPost('id');

            // Récupérer les données du formulaire
            $nom = $request->getPost('nom');
            $prenom = $request->getPost('prenom');
            $dateNaiss = $request->getPost('dateNaiss');
            $email = $request->getPost('email');
            $telephone = $request->getPost('telephone');
            $ville = $request->getPost('ville');
            $login = $request->getPost('login');
            $password = $request->getPost('password');
            $password2 = $request->getPost('password2');

            // Créer un tableau avec les données à modifier
            $donnees = [];
            if (!empty($nom)) {
                $donnees['utilisateur_nom'] = $nom;
            }
            if (!empty($prenom)) {
                $donnees['utilisateur_prenom'] = $prenom;
            }
            if (!empty($dateNaiss)) {
                $donnees['utilisateur_dateDeNaissance'] = $dateNaiss;
            }
            if (!empty($email)) {
                $donnees['utilisateur_mail'] = $email;
            }
            if (!empty($telephone)) {
                $donnees['utilisateur_telephone'] = $telephone;
            }
            if (!empty($ville)) {
                $donnees['utilisateur_ville'] = $ville;
            }
            if (!empty($login)) {
                $donnees['utilisateur_login'] = $login;
            }
            if (!empty($password) && ($password == $password2)) {
                $donnees['utilisateur_motDePasse'] = password_hash($password, PASSWORD_DEFAULT);
            }

            // Appeler la méthode pour modifier l'utilisateur
            $recup = $model->modifierUtilisateur($id_utilisateur, $donnees);

            // Gérer les messages de succès ou d'erreur
        }
    }
}