<?php

/**
 * 1. Importez la table user dans une base de données que vous aurez créée au préalable via PhpMyAdmin
 * 2. En utilisant l'objet de connexion qui a déjà été défini =>
 *    --> Remplacez les informations de connexion ( nom de la base et vérifiez les paramètres d'accès ).
 *    --> Supprimez le dernier utilisateur de la liste, faites une capture d'écran dans PhpMyAdmin pour me montrer que vous avez supprimé l'entrée et pushez la avec votre code.
 *    --> Faites un truncate de la base de données, les auto incréments présents seront remis à 0
 *    --> Insérez un nouvel utilisateur dans la table ( faites un screenshot et ajoutez le au repo )
 *    --> Finalement, vous décidez de supprimer complètement la table
 *    --> Et pour finir, comme vous n'avez plus de table dans la base de données, vous décidez de supprimer aussi la base de données.
 */
require './Classes/DB.php';

try {
    $database = new DB('localhost','table_test_deux','root', 'dev');

    $sql ="DELETE FROM user WHERE id = 4";
    if ($database>exec($sql) !== false) {
        echo "Sara n'est plus là!";
    }

    $database->exec($sql);

    $sql ="TRUNCATE TABLE user";
    if ($database->exec($sql) !== false) {
        echo " Le contenu supprimé et remis à zéro!";
    }
    $database->exec($sql);

    $sql="INSERT INTO user ('nom', 'prenom', 'rue', 'numero', 'code_postal', 'ville', 'pays', 'mail') 
          VALUES ('Bu bulle', 'Jean', 'Rue du Moulin', 45, 59610, 'Bastia', 'France', 'bubulleJean@gmail.com')
          ";
    $database->exec($sql);

    $sql="DROP TABLE user";
    $database>exec($sql);

    $sql ="DROP DARABASE table_test_deux";
    $database->exec($sql);
          
}
catch(PDOException $exeption) {
    echo $exeption->getMessage();
}