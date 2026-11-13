<?php
class ViewMonCompte{
    // Methode
    public function display(){

?>

    <main>
        <h1>Mon profil</h1>

        <section class="panneau" aria-labelledby="titre-infos">
            <h2 id="titre-infos">Informations du compte</h2>

            <dl class="infos">
                <div>
                    <dt>Prénom</dt>
                    <dd><?php echo($_SESSION["compte"]["firstname"]) ?></dd>
                </div>
                <div>
                    <dt>Nom de famille</dt>
                    <dd><?php echo($_SESSION["compte"]["lastname"]) ?></dd>
                </div>
                <div>
                    <dt>E-mail</dt>
                    <dd><?php echo($_SESSION["compte"]["email"]) ?></dd>
                </div>
                <div>
                    <dt>Rôle</dt>
                    <dd><?php echo($_SESSION["compte"]["role"]) ?></dd>
                </div>
                <div>
                    <dt>Compte créé le</dt>
                    <dd><?php echo($_SESSION["compte"]["createdAt"]) ?></dd>
                </div>
            </dl>
        </section>

        <section class="panneau" aria-labelledby="titre-equipes">
            <h2 id="titre-equipes">Les équipes que je gère</h2>

            <ul class="liste-simple">
                <!-- Répéter pour chaque équipe gérée -->
                <li>Nom de l'équipe</li>
            </ul>

            <!-- À afficher si l'utilisateur ne gère aucune équipe -->
            <p class="vide">Tu ne gères aucune équipe pour le moment.</p>
        </section>
    </main>
</body>
</html>
<?php
    }
}