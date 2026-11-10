<?php

include_once '../database.php';

session_start();
$msg="";
if (isset($_POST["submit"])) {
    $msg = traitement();
}

function traitement(): string
{
    $em = strip_tags(trim($_POST["email"]));
    $pw = strip_tags(trim($_POST["password"]));
    if (empty($em) || empty($pw)) {
        return "Veuillez remplir tous les champs";
    }
    if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
        return "Erreur : email pas au bon format";
    }

    try {
        $bdd = connect_bdd();
        $sql = "SELECT  `firstname`, `lastname`, `email`, `created_at` AS createdAt, `Id_Role` AS `role`  FROM `users` WHERE email = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(1, $em, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException) {
        return "Erreur technique, réessayez plus tard";
    }

    $_SESSION["compte"] = $user;
    header("Location: ./accueil.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form action="" method="post">
        <h1>Connexion</h1>

        <div class="champ">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" autocomplete="email" required>
        </div>

        <div class="champ">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" autocomplete="current-password" required>
        </div>

        <input type="submit" name="submit" value="Se connecter">
        <p><?= htmlspecialchars($msg) ?></p>
        <p class="lien-secondaire">Pas encore de compte ? <a href="../index.php">Créer un compte</a></p>
    </form>
</body>
</html>