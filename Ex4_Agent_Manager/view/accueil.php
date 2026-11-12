<?php
session_start();

include_once '../database.php';

if(!isset($_SESSION["compte"])){
    header('Location:index.php');
    exit;
}
function find_manager(){
    try {
        $bdd = connect_bdd();
        $sql = "SELECT  `firstname`, `lastname`, `email`, `created_at` AS createdAt, `Id_Role` AS `role`  FROM `users` WHERE  `Id_Role`=2";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException) {
        return false;
    }
}

include 'header.php';
?>
    <main>
        <h1>Accueil</h1>

        <section class="panneau" aria-labelledby="titre-utilisateurs">
            <h2 id="titre-utilisateurs">Les autres manager</h2>

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
                        <?php if (find_manager()): ?>
                            <?php foreach (find_manager() as $key => $ag): ?>
                                <tr>
                                    <td><?= htmlspecialchars($ag["firstname"]) ?></td>
                                    <td><?= htmlspecialchars($ag["lastname"]) ?></td>
                                    <td><?= htmlspecialchars($ag["email"]) ?></td>
                                    <td><?= htmlspecialchars($ag["role"] == 2 ? "Manager" : "Erreur") ?></td>
                                    <td><?= htmlspecialchars($ag["createdAt"]) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Aucun manager enregistré</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>