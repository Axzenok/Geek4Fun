<?php

namespace app\Models;

use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Model;

class Connexion extends Model
{
    //methode pour verifier le login utiliser et ceux dans la base de données
    function verifUser($loginVerif)
    {
        $db = db_connect();
        $query = $db->table('utilisateur');
        $result = $query->getWhere(['utilisateur_login'=>$loginVerif]);
        if($result->getFieldCount() > 0){
            return $result->getResult();
        }else{
            return false;
        }
    }

    //Methode pour s'inscrire (ajout à la base de données)
    function inscription($newUser)
    {
        $db = db_connect();
        try {
            $query = $db->table('utilisateur')->insert($newUser);
            return $db->affectedRows();
        } catch (DatabaseException $e){
            return $e->getCode();
        }
    }
    //Methode pour modifier les utilisateurs
    function modifierUtilisateur($id, $updatedUserData)
    {
        $db = db_connect();
        try {
            $db->table('utilisateur')
                ->where('utilisateur_id', $id)
                ->update($updatedUserData);

            return $db->affectedRows();
        } catch (DatabaseException $e) {
            return $e->getCode();
        }
    }
    public function updateLogin($newLogin)
    {
        $db = db_connect();
        $session = session();
        $userId = $session->get('id');  // Assurez-vous que l'ID utilisateur est stocké dans la session lors de la connexion

        try {
            $builder = $db->table('utilisateur');
            $builder->where('id', $userId);
            $builder->update(['login' => $newLogin]);

            return $db->affectedRows();
        } catch (DatabaseException $e) {
            return $e->getCode();
        }
    }
}