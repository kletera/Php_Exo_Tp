<?php
session_start();

if(!isset($_SESSION["compte"])){
    header('Location:index.php');
    exit;
}
$roles = [1 => "Admin", 2 => "Agent"];

include 'header.php';
?>
    <main>
        <h1>Accueil</h1>

        <section class="panneau" aria-labelledby="titre-utilisateurs">
            <h2 id="titre-utilisateurs">Les autres utilisateurs</h2>

            <div class="tableau-defilant">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Prénom</th>
                            <th scope="col">Nom de famille</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Rôle</th>
                            <th scope="col">Inscrit le</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($_SESSION["agents"])): ?>
                            <?php foreach ($_SESSION["agents"] as $key => $ag): ?>
                                <tr>
                                    <td><?= htmlspecialchars($ag["firstname"]) ?></td>
                                    <td><?= htmlspecialchars($ag["lastname"]) ?></td>
                                    <td><?= htmlspecialchars($ag["email"]) ?></td>
                                    <td><?= htmlspecialchars($ag["id_role"] == 2 ? "Manager" : "Erreur") ?></td>
                                    <td><?= htmlspecialchars($ag["create_at"]) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Aucun agent enregistré</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- À afficher quand il n'y a aucun autre utilisateur -->
            <p class="vide">Il n'y a pas encore d'autre utilisateur.</p>
        </section>
    </main>
</body>
</html>