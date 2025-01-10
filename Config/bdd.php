<?php
$dsn = 'mysql:dbname=to_do_list;host=localhost';
$user = 'root';
$password ='';

try {
    $bdd = new PDO($dsn, $user, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Echec lors de la connexion : " . $e->getMessage();
}
?>