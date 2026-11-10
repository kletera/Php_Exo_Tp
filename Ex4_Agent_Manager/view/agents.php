<?php
include_once '../database.php';
session_start();

if(!isset($_SESSION["compte"])){
    header('Location:index.php');
    exit;
}
$msg="";
if (isset($_POST["submit"])) {
    $msg = traitement();
}

function traitement(): string {
    if (empty($_POST["name"]) || empty($_POST["date"]) || empty($_POST["archetype"]) || empty($_POST["tier"])) {
        return "Veuillez remplir tous les champs";
    }
    if (false === add_agent($_POST)) {
        return "Le compte n'a pas pu être ajouté en BDD";
    }
    return "Enregistrement réussi";
}

function find_tiers(){
    try {
        $sql = "SELECT `Id_Tier`, `tier` FROM `tiers` ORDER BY `Id_Tier`";
        $stmt = connect_bdd()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException) {
        return [];
    }
}
function find_archetype(){
    try {
        $sql = "SELECT `Id_Archetype`, `archetype` FROM `archetypes` ORDER BY `Id_Archetype`";
        $stmt = connect_bdd()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException ) {
        return [];
    }
}

function find_teams(){
    try {
        $sql = "SELECT `Id_Team`, `team_name` FROM `teams` ORDER BY `Id_Team`";
        $stmt = connect_bdd()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException ) {
        return [];
    }
}

function add_agent(array $user): bool {
    try {
        $sql = "INSERT INTO `agents` (`name`, `dob`, `Id_Archetype`, `Id_Tier`, `Id_Team`)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = connect_bdd()->prepare($sql);

        $team = ($user["team"] !== "") ? (int) $user["team"] : null;

        $stmt->bindValue(1, $user["name"], PDO::PARAM_STR);
        $stmt->bindValue(2, $user["date"], PDO::PARAM_STR);
        $stmt->bindValue(3, (int) $user["archetype"], PDO::PARAM_INT);
        $stmt->bindValue(4, (int) $user["tier"], PDO::PARAM_INT);
        $stmt->bindValue(5, $team, $team === null ? PDO::PARAM_NULL : PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function find_agent(){
    try {
        $sql = "SELECT ag.`Id_Agent`, ag.`name`, ar.`archetype`, t.`tier`, tea.`team_name`, GROUP_CONCAT(ab.`ability` SEPARATOR ', ') AS abilities
                FROM `agents` AS ag
                INNER JOIN `tiers` AS t ON ag.`Id_Tier` = t.`Id_Tier`
                INNER JOIN `archetypes` AS ar ON ag.`Id_Archetype` = ar.`Id_Archetype`
                LEFT JOIN `teams` AS tea ON ag.`Id_Team` = tea.`Id_Team`
                LEFT JOIN `archetypes_abilities` AS p ON ar.`Id_Archetype` = p.`Id_Archetype`
                LEFT JOIN `abilities` AS ab ON p.`Id_Ability` = ab.`Id_Ability`
                GROUP BY ag.`Id_Agent`
                ORDER BY ag.`Id_Agent`";
        $stmt = connect_bdd()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException ) {
        return [];
    }
}


include 'header.php';
?>

    <main>
        <h1>Agents of Shield</h1>

        <section class="panneau" aria-labelledby="titre-ajout">
            <h2 id="titre-ajout">Inscrire un nouvel agent</h2>

            <form action="" method="post" class="formulaire-integre">
                <div class="champ">
                    <label for="name">Nom de l'agent</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="champ">
                    <label for="date">Date de naissance</label>
                    <input type="date" name="date" id="date">
                </div>

                <div class="champ">
                    <label for="tier">Rang - level</label>
                    <select name="tier" id="tier" required>
                        <option value="" selected disabled>Choisir un rang - level</option>
                        <?php foreach (find_tiers() as $key => $tier): ?>
                            <option value="<?= htmlspecialchars($tier['Id_Tier']) ?>">
                                <?= htmlspecialchars($tier['tier']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="champ">
                    <label for="archetype">Archétype</label>
                    <select name="archetype" id="archetype" required>
                        <option value="" selected disabled>Choisir un archétype</option>
                        <?php foreach (find_archetype() as $key => $ar): ?>
                            <option value="<?= htmlspecialchars($ar['Id_Archetype']) ?>">
                                <?= htmlspecialchars($ar['archetype']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="champ">
                    <label for="team">Équipe</label>
                    <select name="team" id="team">
                        <option value="" selected>Aucune équipe</option>
                        <?php foreach (find_teams() as $key => $team): ?>
                            <option value="<?= htmlspecialchars($team['Id_Team']) ?>">
                                <?= htmlspecialchars($team['team_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <p><?= htmlspecialchars($msg) ?></p>

                <input type="submit" name="submit" value="Inscrire l'agent">
            </form>
        </section>

        <section class="panneau" aria-labelledby="titre-liste">
            <h2 id="titre-liste">Liste des agents</h2>

            <div class="tableau-defilant">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Agent</th>
                            <th scope="col">Rang</th>
                            <th scope="col">Archétype</th>
                            <th scope="col">Capacités</th>
                            <th scope="col">Equipe</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach (find_agent() as $key => $agent) : ?>
                            <tr>
                                <td><?=  htmlspecialchars($agent["name"]) ?></td>
                                <td><?=  htmlspecialchars($agent["tier"]) ?></td>
                                <td><?= htmlspecialchars($agent["archetype"]) ?></td>
                                <td>
                                    <ul class="liste-simple">

                                        <li><?=  htmlspecialchars($agent['abilities'])?></li>

                                    </ul>
                                </td>
                                <td><?= htmlspecialchars($ar['team_name'] ?? "Pas d'équipe attribuée") ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>


            <p class="vide">Aucun agent n'est inscrit pour le moment.</p>

        </section>
    </main>
</body>
</html>