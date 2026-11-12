<?php
class Agent{
    // Atribut
    private int $idAgent;
    private string $name;
    private string $dob;
    private string $createdAt;
    private int $idArchetype;
    private int $idTier;
    private int $idTeam;
    private PDO $pdo;

    // Constructeur
    public function __construct(PDO $pdo){
        $this->pdo=$pdo;
    }

    // Getter Setter
    /**
     * Get the value of idAgent
     *
     * @return int
     */
    public function getIdAgent(): int {
        return $this->idAgent;
    }

    /**
     * Set the value of idAgent
     *
     * @param int $idAgent
     *
     * @return self
     */
    public function setIdAgent(int $idAgent): self {
        $this->idAgent = $idAgent;
        return $this;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of dob
     *
     * @return string
     */
    public function getDob(): string {
        return $this->dob;
    }

    /**
     * Set the value of dob
     *
     * @param string $dob
     *
     * @return self
     */
    public function setDob(string $dob): self {
        $this->dob = $dob;
        return $this;
    }

    /**
     * Get the value of createdAt
     *
     * @return string
     */
    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param string $createdAt
     *
     * @return self
     */
    public function setCreatedAt(string $createdAt): self {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get the value of idArchetype
     *
     * @return int
     */
    public function getIdArchetype(): int {
        return $this->idArchetype;
    }

    /**
     * Set the value of idArchetype
     *
     * @param int $idArchetype
     *
     * @return self
     */
    public function setIdArchetype(int $idArchetype): self {
        $this->idArchetype = $idArchetype;
        return $this;
    }

    /**
     * Get the value of idTier
     *
     * @return int
     */
    public function getIdTier(): int {
        return $this->idTier;
    }

    /**
     * Set the value of idTier
     *
     * @param int $idTier
     *
     * @return self
     */
    public function setIdTier(int $idTier): self {
        $this->idTier = $idTier;
        return $this;
    }

    /**
     * Get the value of idTeam
     *
     * @return int
     */
    public function getIdTeam(): int {
        return $this->idTeam;
    }

    /**
     * Set the value of idTeam
     *
     * @param int $idTeam
     *
     * @return self
     */
    public function setIdTeam(int $idTeam): self {
        $this->idTeam = $idTeam;
        return $this;
    }

    /**
     * Get the value of pdo
     *
     * @return PDO
     */
    public function getPdo(): PDO {
        return $this->pdo;
    }

    /**
     * Set the value of pdo
     *
     * @param PDO $pdo
     *
     * @return self
     */
    public function setPdo(PDO $pdo): self {
        $this->pdo = $pdo;
        return $this;
    }

    // Methode

    function traitement(): string {
        if (empty($_POST["name"]) || empty($_POST["date"]) || empty($_POST["archetype"]) || empty($_POST["tier"])) {
            return "Veuillez remplir tous les champs";
        }
        
        $_POST["name"]=trim($_POST["name"]);
        $_POST["date"]=trim($_POST["date"]);
        $_POST["archetype"]=trim( $_POST["archetype"]);
        $_POST["tier"]=trim($_POST["tier"]);
        
        if($this->find_agent_by_name($_POST["name"])){
            return "Ce nom est déja utiliser";
        }

        if (false === $this->add_agent($_POST)) {
            return "Le compte n'a pas pu être ajouté en BDD";
        }
        
        return "Enregistrement réussi";
    }

    function find_tiers(){
        try {
            $sql = "SELECT `Id_Tier`, `tier` FROM `tiers` ORDER BY `Id_Tier`";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            return [];
        }
    }
    function find_archetype(){
        try {
            $sql = "SELECT `Id_Archetype`, `archetype` FROM `archetypes` ORDER BY `Id_Archetype`";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException ) {
            return [];
        }
    }

    function find_teams(){
        try {
            $sql = "SELECT `Id_Team`, `team_name` FROM `teams` ORDER BY `Id_Team`";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException ) {
            return [];
        }
    }

    function find_agent_by_name(string $name):bool{
        try {
            $sql = "SELECT a.Id_agent FROM `agents` AS a WHERE a.`name` = ?" ;
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch() !== false;
        } catch (PDOException $e) {
            return false;
        }
    }


    function add_agent(array $user): bool {
        try {
            $sql = "INSERT INTO `agents` (`name`, `dob`, `Id_Archetype`, `Id_Tier`, `Id_Team`)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);

            $team = ($user["team"] !== "") ? (int) $user["team"] : null;

            $stmt->bindValue(1, $user["name"], PDO::PARAM_STR);
            $stmt->bindValue(2, $user["date"], PDO::PARAM_STR);
            $stmt->bindValue(3, $user["archetype"], PDO::PARAM_INT);
            $stmt->bindValue(4, $user["tier"], PDO::PARAM_INT);
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
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException ) {
            return [];
        }
    }


    
}