<?php
class ViewInscription{
    // Attribut
    private string $msg="";

    // Getter Setter
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

        <p><?= htmlspecialchars($this->msg) ?></p>

        <input type="submit" name="submit" value="Créer un compte">

        <p>Vous avez déjà un compte ? <a href="index.php?page=connexion">Connectez-vous</a></p>
    </form>
</body>
</html>

<?php
   }
}