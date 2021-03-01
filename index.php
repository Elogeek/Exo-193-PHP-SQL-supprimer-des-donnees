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
    $connect = DB::getInstance();

    $sql = $connect->prepare("DELETE FROM user WHERE id = 4");
    $sql->execute();
       // echo "Sara n'est plus là!";


    $sql = $connect->prepare("TRUNCATE TABLE user");
        //echo " Le contenu supprimé et remis à zéro!";
    $sql->execute();


    $sql = $connect->prepare("
            INSERT INTO user ('nom', 'prenom', 'rue', 'numero', 'code_postal', 'ville', 'pays', 'mail')
            VALUES (:nom, :prenom, :rue, :numero, :code_postal, :ville, :pays, :mail)
          ");

        //echo "great, add new user";
    $nom = 'Bubulle';
    $prenom = 'Jean';
    $rue = 'Rue du Moulin';
    $numero = '45';
    $code_postal = '59610';
    $ville = 'Bastia';
    $pays = 'France';
    $mail = 'bubulleJean@gmail.com';

    $sql->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':rue' => $rue,
        ':numero' => $numero,
        ':code_postal' => $code_postal,
        ':ville' => $ville,
        ':pays' => $pays,
        ':mail'=> $mail,
    ]);


    $sql = $connect->prepare("DROP TABLE user");
    $sql->execute();


    $sql = $connect->prepare("DROP DATABASE table_test_deux");
    $sql->execute();
   
}
catch(PDOException $exeption) {
    echo $exeption->getMessage();
}