<?php
class ViewHeader{
    // Attribut
    private string $title="Accueil";
    
    // Getter Setter
    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }

    // Methode
    public function displayHeader(){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?></title>
    <link rel="stylesheet" href="./style.css">
</head>
<body class="page">
    <header class="entete">
        <div class="entete-contenu">
            <a href="#" class="logo">Agents of S.H.I.E.L.D.</a>
    
            <nav aria-label="Navigation principale">
                <ul>
                    <li><a href="index.php?page=accueil">Accueil</a></li>
                    <li><a href="index.php?page=agents">Agents of Shield</a></li>
                    <li><a href="index.php?page=moncompte">Mon profil</a></li>
                </ul>
            </nav>
            <a href="index.php?page=deconnexion">Déconexion</a>
        </div>
    </header>
<?php
    }
}

