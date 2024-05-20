<?php

namespace app\Models;

use CodeIgniter\Model;
use mysqli_sql_exception;

class Admin extends Model
{
    function afficherUtilisateur()
    {
        $db = db_connect();
        $query = $db->table('utilisateur');
        $result = $query->get();

        // Vérifiez s'il y a des résultats
        if ($result->getResult()) {
            // Retournez les résultats sous forme de tableau
            return $result->getResultArray();
        } else {
            // Aucun utilisateur trouvé
            return false;
        }
    }
    public function supprimerUtilisateur($id)
    {
        //Permet la suppression d'un utilisateur en fonction de son id (unique)
        $db = db_connect();
        $query = $db->table('utilisateur');
        return $query->delete(['utilisateur_id' => $id]);
    }
    function afficherUtilisateurModif($id)
    {
        $db = db_connect();
        $query = $db->table('utilisateur');
        $result = $query->getWhere(['utilisateur_id'=>$id]);

        // Vérifiez s'il y a des résultats
        if ($result->getResult()) {
            // Retournez les résultats sous forme de tableau
            return $result->getResultArray();

        } else {
            // Aucun utilisateur trouvé
            return false;
        }
    }
    public function retourPrenomNom($id)
    {
        $db = db_connect();
        $query = $db->table('utilisateur');
        $result = $query->getWhere(['utilisateur_id'=>$id])->getResultArray();
        $resultat="";
        // Vérifiez s'il y a des résultats
        if ($result!=0) {
            foreach ($result as $row) {
                $resultat .= $row['utilisateur_prenom'] . ' ' . $row['utilisateur_nom'];
            }
            // Retournez le prenom et le nom
            return $resultat;

        } else {
            // Aucun utilisateur trouvé
            return false;
        }
    }
    public function updLogin($login, $id) {
        {
            try {
                $db = db_connect();

                $stmt1 = "SET @p0 = ?";
                $stmt2 = "SET @p1 = ?";


                $db->query($stmt1, [$login]);
                $db->query($stmt2, [$id]);

                $query = "SELECT `func_updLogin`(@p0, @p1) AS `func_updLogin`";
                $result = $db->query($query);

                if ($result) {
                    return $result->getResult()[0]->func_updLogin;
                } else {
                    return 'Erreur lors de l\'exécution de la requête';
                }
            } catch (mysqli_sql_exception $e) {
                $errorCode = $e->getCode();
                $errorMessage = $e->getMessage();

                return "Erreur : $errorCode - Message : $errorMessage";
            }
        }
    }
}