<?php
class ViewAgents{
    // Atribut
    private string $msg="";
    private array $findTiers=[];
    private array $findArchetype=[];
    private array $findTeams=[];
    private array $findAgent=[];

    // Construct

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

    /**
     * Get the value of findTiers
     *
     * @return array
     */
    public function getFindTiers(): array {
        return $this->findTiers;
    }

    /**
     * Set the value of findTiers
     *
     * @param array $findTiers
     *
     * @return self
     */
    public function setFindTiers(array $findTiers): self {
        $this->findTiers = $findTiers;
        return $this;
    }

    /**
     * Get the value of findArchetype
     *
     * @return array
     */
    public function getFindArchetype(): array {
        return $this->findArchetype;
    }

    /**
     * Set the value of findArchetype
     *
     * @param array $findArchetype
     *
     * @return self
     */
    public function setFindArchetype(array $findArchetype): self {
        $this->findArchetype = $findArchetype;
        return $this;
    }

    /**
     * Get the value of findTeams
     *
     * @return array
     */
    public function getFindTeams(): array {
        return $this->findTeams;
    }

    /**
     * Set the value of findTeams
     *
     * @param array $findTeams
     *
     * @return self
     */
    public function setFindTeams(array $findTeams): self {
        $this->findTeams = $findTeams;
        return $this;
    }

    /**
     * Get the value of findAgent
     *
     * @return array
     */
    public function getFindAgent(): array {
        return $this->findAgent;
    }

    /**
     * Set the value of findAgent
     *
     * @param array $findAgent
     *
     * @return self
     */
    public function setFindAgent(array $findAgent): self {
        $this->findAgent = $findAgent;
        return $this;
    }

    // Methode
    public function display(){

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
                        <?php foreach ($this->findTiers as $key => $tier): ?>
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
                        <?php foreach ($this->findArchetype as $key => $ar): ?>
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
                        <?php foreach ($this->findTeams as $key => $team): ?>
                            <option value="<?= htmlspecialchars($team['Id_Team']) ?>">
                                <?= htmlspecialchars($team['team_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <p><?= htmlspecialchars($this->msg) ?></p>

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
                        <?php foreach ($this->findAgent as $key => $agent) : ?>
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

<?php
    }
}