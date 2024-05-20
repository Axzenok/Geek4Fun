<?php

namespace app\Controllers;

use App\Controllers\BaseController;
use app\Models\Admin;
use app\Models\Connexion;
use Config\Services;

class PrincipaleController extends BaseController
{
    public function index(): string
    {
        //permet l'affichage de la page d'accueil
        return
            view('BarreNav')
            . view('Accueil')
            . view('Footer');
    }

    //Affichage "Nous conernant" (Page Contact et mention légale)
    public function Mention()
    {
        return
            view('BarreNav')
            . view('Mention_legale')
            . view('Footer');
    }

    public function Contact()
    {
        return
            view('BarreNav')
            . view('Contact')
            . view('Footer');
    }

    public function Reglementation()
    {
        return
            view('BarreNav')
            . view('Reglementation')
            . view('Footer');
    }

    public function Lots()
    {
        return
            view('BarreNav')
            . view('lots')
            . view('Footer');
    }

    public function Note()
    {
        return
            view('BarreNav')
            . view('Notes')
            . view('Footer');
    }
    public function compte()
    {
        return
            view('BarreNav')
            . view('compte')
            . view('Footer');
    }

    public function changerLogin()
    {


        $validation = Services::validation();

        // vérifie si il y a eu une méthode post
        if ($this->request->getMethod() === 'post') {
            // vérifie si il y a eu un submit pour le changement de pseudo
            if ($this->request->getPost('submit_form') !== null) {
                // création des règles/codes d'erreurs
                $rules = ['login' => 'required|min_length[6]'];

                $errors = [
                    'login' => [
                        'required' => 'Le champ login est obligatoire.',
                        'min_length' => 'Ton pseudo doit faire au moins 6 caractères.'
                    ],
                ];

                $validation->setRules($rules, $errors);

                if ($this->validate($rules, $errors)) {
                    $session = Services::session();

                    // stocke le pseudo
                    $changerpseudo_pseudo = $this->request->getPost('login');

                    $model = new Admin();

                    $pseudomodifie = $model->updLogin($changerpseudo_pseudo, $session->get('numero'));

                    if ($pseudomodifie === '-1') {
                        // indique que le pseudo est déjà utilisé
                        $info['titre'] = "Pseudo déjà utilisé !";
                        $info['validation'] = $this->validator;
                        return view('BarreNav') . view('ModifLOGIN', $info) . view('Footer');
                    } elseif ($pseudomodifie > 0) {
                        // pseudo modifie
                        $info['titre'] = '';
                        $info['validation'] = $this->validator;
                        $session->remove('login');
                        $session->set('login', $changerpseudo_pseudo);
                        //MODIF ICI
                        return view('BarreNav') . view('ModifLOGIN', $info) . view('Footer');
                    } else {
                        var_dump($changerpseudo_pseudo);
                        var_dump($pseudomodifie);

                        // pseudo non modifie
                        $info['titre'] = "Ton pseudo n'a pas pu être modifiée";
                        $info['validation'] = $this->validator;
                        return view('BarreNav') . view('ModifLOGIN', $info) . view('Footer');
                    }
                } else {
                    // Critères non respectés
                    $info['titre'] = "Changement de pseudo impossible, corrige ta saisie !";
                    $info['validation'] = $this->validator;
                    return view('BarreNav') . view('ModifLOGIN', $info) . view('Footer');
                }
            }
        } else {
            return view('BarreNav')
                . view('ModifLOGIN', ['validation' => $validation, 'titre' => ""])
                . view('Footer');


        }
    }
}