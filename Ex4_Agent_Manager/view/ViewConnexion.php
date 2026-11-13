<?php
class ViewConnexion{
    private string $msg="";

    /**
     * Get the value of msg
     *
     * @return string
     */
    public function getMsg(): string {
        return $this->msg;
    }

    /**
     * Set the value of msg
     *
     * @param string $msg
     *
     * @return self
     */
    public function setMsg(string $msg): self {
        $this->msg = $msg;
        return $this;
    }

    // Methode
    public function display(){


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
    <link rel="stylesheet" href="./style.css">
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
        <p><?= htmlspecialchars($this->msg) ?></p>
        <p class="lien-secondaire">Pas encore de compte ? <a href="inscription">Créer un compte</a></p>
    </form>
</body>
</html>
<?php
   }
}