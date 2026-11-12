<?php
include_once 'database.php';

session_start();
$msg="";
if (isset($_POST["submit"])) {
    $msg = traitement();
}

//Traitement du formulaire
function traitement(): string
{
    //2 tester si les champs sont remplis
    if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["password"])) { 
        return "Veuillez remplir tous les champs";
    }
    //3 nettoyer les données (trim, strip_tag)
    $_POST["firstname"] = strip_tags(trim($_POST["firstname"]));
    $_POST["lastname"] = strip_tags(trim($_POST["lastname"]));
    $_POST["email"] = strip_tags(trim($_POST["email"]));
    $_POST["password"] = strip_tags(trim($_POST["password"]));

    //4 valider le format des données
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        return "Le mail est invalide";
    }
    if (strlen($_POST["password"]) < 8) {
        return "Le mot de passe est trop court";
    }
    //ajout en BDD si il n'existe pas
    if (find_user_by_email($_POST["email"])) {
        return "Le compte existe déja";
    }
    if (false === add_user($_POST)) {
        return "Le compte n'a pas pu étre ajouté en BDD";
    }

    $_SESSION["compte"] = [
        "firstname" => $_POST["firstname"], 
        "lastname" => $_POST["lastname"], 
        "email" => $_POST["email"],
        "role" => 2,
        "createdAt" => (new DateTime())->format('Y-m-d H:i:s'),
    ];
    header("Location:./view/accueil.php");
    return "Le compte " . $_POST["email"] . " a été ajouté avec succés";
}

function find_user_by_email(string $email): bool
{
    try {
        $sql = "SELECT u.Id_user FROM `users` AS u WHERE u.email = ?";
        $stmt = connect_bdd()->prepare($sql);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    } catch (PDOException $e) {
        return false;
    }
}
function add_user(array $user): string|int|bool
{
    try {
        //11 ecrire la requête (INSERT)
        $sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`, `Id_Role`)
        VALUE(?,?,?,?,?)";
        $stmt = connect_bdd()->prepare($sql);

        $stmt->bindValue(1, $user["firstname"], PDO::PARAM_STR);
        $stmt->bindValue(2, $user["lastname"], PDO::PARAM_STR);
        $stmt->bindValue(3, $user["email"], PDO::PARAM_STR);
        $stmt->bindValue(4, $user["password"], PDO::PARAM_STR);
        $stmt->bindValue(5, 2, PDO::PARAM_STR);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
        <h1>Créer un compte</h1>

        <div class="ligne">
            <div class="champ">
                <label for="firstname">Prénom</label>
                <input type="text" name="firstname" id="firstname" autocomplete="given-name" required>
            </div>

            <div class="champ">
                <label for="lastname">Nom de famille</label>
                <input type="text" name="lastname" id="lastname" autocomplete="family-name" required>
            </div>
        </div>

        <div class="champ">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" autocomplete="email" required>
        </div>

        <div class="champ">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" autocomplete="new-password" required>
        </div>

        <p><?= htmlspecialchars($msg) ?></p>

        <input type="submit" name="submit" value="Créer un compte">

        <p>Vous avez déjà un compte ? <a href="./view/connexion.php">Connectez-vous</a></p>
    </form>
</body>
</html>