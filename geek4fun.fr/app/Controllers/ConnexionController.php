<?php

namespace app\Controllers;

use App\Controllers\BaseController;
use App\Models\Connexion;
use Config\Services;

class ConnexionController extends BaseController
{
    //methode qui permet la connexion à notre site web
    public function index()
    {
        $controle = $this->request->getPost('submit');
        if (!isset($controle)) {
            $data['Titre'] = "Veuillez vous inscrire";
            $data['validation'] = Services::validation();
            
            return
                view('BarreNav')
                . view('Connexion', $data)
                . view('Footer');
        } else {
            $validation = Services::validation();
            //gestion des règles de validation
            $rules = ['login' => 'required|min_length[6]',
                'password' => 'required|min_length[12]',
            ];
            //gestion des erreurs et des affichages associés
            //Erreurs
            $errors = [
                'login' => ['required' => '* Login obligatoire',
                    'min_length' => '* 6 caractère minimum'],
                'password' => ['required' => '* Mot de Passe obligatoire',
                    'min_length' => '* 12 caractère minimum']
            ];
            $validation->setRules($rules, $errors);
            if ($this->validate($rules, $errors)) {
                //mise en place de la gestion des sessions
                $session = Services::session();

                $login = $this->request->getPost('login');

                $modelUser = new Connexion();
                $recup = $modelUser->verifUser($login);
                if ($recup == false) {
                    $data['Titre'] = "Connexion impossible ";
                    $data['validation'] = $this->validator;

                    //gestion des données de sessions
                    $session->setFlashdata('resultConnect', "Vérifier vos identifiants");

                    return
                        view('BarreNav')
                        . view('Connexion', $data)
                        . view('Footer');
                } else {
                    //le login est trouvé
                    $pwd = $recup[0]->utilisateur_motDePasse;
                    //comparaison des mots de passe
                    //$password = password_hash($this->request->getPost('password'),PASSWORD_DEFAULT);
                    $verifPassword = password_verify($this->request->getPost('password'), $pwd);
                    //$verifPassword= $this->request->getPost('password')==$pwd;
                    //ils sont identiques
                    if ($verifPassword) {
                        //mise en place des sessions
                        $session->set('login', $recup[0]->utilisateur_login);
                        $session->set('password', $recup[0]->utilisateur_motDePasse);
                        $session->set('id', $recup[0]->id_type);
                        return
                            view('BarreNav')
                            . view('Accueil')
                            . view('Footer');
                    } else {
                        $data['Titre'] = "Problème de mot de passe ";
                        $data['validation'] = $this->validator;
                        $session->setFlashdata('resultConnect', "Problème lors de la connexion !");
                        //var_dump($session);
                        var_dump($pwd);
                        //var_dump($password);
                        return
                            view('BarreNav')
                            . view('Connexion', $data)
                            . view('Footer');
                    }
                }

            } else {
                //login et mot de passe ne respecte pas les règles attendues
                $data['Titre'] = "Connexion impossible, vérifier votre saisie";
                $data['validation'] = $this->validator;
                return
                    view('BarreNav')
                    . view('Connexion', $data)
                    . view('Footer');
            }
        }
    }
    //methode pour gerer la déconnexion des utilisateurs
    public function deconnexion()
    {
        $session = Services::session();
        $session->remove('login');
        $session->destroy();
        //$session->close();
        return
            view('BarreNav')
            .view('Accueil')
            .view('Footer');
    }
    public function Inscription()
    {
        $controle = $this->request->getPost('submit');
        if(!isset($controle)){
            $data['Titre']="Veuillez vous inscrire";
            $data['validation']=Services::validation();
        }else {
            $validation= Services::validation();
            $rules = ['login' => 'required|min_length[6]',
                'password' => 'required|min_length[12]',
                'email' => 'required|min_length[16]',
                'nom'=>'required|min_length[6]',
                'prenom'=>'required|min_length[6]',
                'telephone'=>'required|numeric|min_length[10]',
                'dateNaiss'=>'required',
                'ville'=>'required',
            ];

            $errors = [
                'login' => ['required' => '* Login obligatoire',
                    'min_length' => '* 6 caractère minimum'],
                'password' => ['required' => '* Mot de Passe obligatoire',
                    'min_length' => '* 12 caractère minimum'],
                'email' => ['required' => '* E-Mail obligatoire',
                    'min_length' => '* 16 caractère minimum'],
                'nom' => ['required' => '* Nom de famille obligatoire',
                    'min_length' => '* 6 caractère minimum'],
                'prenom' => ['required' => '* Prenom obligatoire',
                    'min_length' => '* 6 caractère minimum'],
                'telephone' => ['required' => '* Numéro de téléphone obligatoire',
                    'numeric'=> '* Chiffre seulement',
                    'min_length' => '* 10 caractère minimum'],
                'dateNaiss' => ['required' => '* Date de naissance obligatoire'],
                'ville' => ['required' => '* Ville obligatoire'],
            ];
            $validation->setRules($rules, $errors);
            //verifier la saisie du mot de passe
            $mdp1=$this->request->getPost('password');
            $mdp2=$this->request->getPost('password2');
            if($this->validate($rules,$errors)&&($mdp1==$mdp2)){
                $donnees = array(
                    'utilisateur_id'=> '',
                    'utilisateur_nom'=> $this->request->getPost('nom'),
                    'utilisateur_prenom'=>$this->request->getPost('prenom'),
                    'utilisateur_dateDeNaissance'=>$this->request->getPost('dateNaiss'),
                    'utilisateur_mail'=>$this->request->getPost('email'),
                    'utilisateur_telephone'=>$this->request->getPost('telephone'),
                    'utilisateur_ville'=>$this->request->getPost('ville'),
                    'utilisateur_login'=> $this->request->getPost('login'),
                    'utilisateur_motDePasse'=>password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
                    'utilisateur_accepterCharte'=>1,
                    'utilisateur_droitImage'=>1,
                    'id_type'=>2,

                );

                $model = new Connexion();
                //$data['Titre']="defaut";
                $recup = $model->inscription($donnees);
                if ($recup==1062){
                    $data['Titre']="Vous êtes déjà inscrit !";
                }elseif ($recup==1){
                    $data['Titre']="Inscription réussite !";
                }
                $data['validation']=$this->validator;
                //$data['Titre']=var_dump($donnees);
            } else {
                $data['Titre']="Problème lors de l'inscription";
                $data['validation']=$this->validator;
            }
        }
        return
            view('BarreNav')
            .view('Inscription',$data)
            .view('Footer');
    }
}