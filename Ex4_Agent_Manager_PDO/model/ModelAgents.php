<?php
class ModelAgents{
    // Atribut
    private int $idAgent;
    private string $name;
    private string $dob;
    private string $createdAt;
    private string $idArchetype;
    private string $idTier;
    private string $idTeam;
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
     * @return string
     */
    public function getIdArchetype(): string {
        return $this->idArchetype;
    }

    /**
     * Set the value of idArchetype
     *
     * @param string $idArchetype
     *
     * @return self
     */
    public function setIdArchetype(string $idArchetype): self {
        $this->idArchetype = $idArchetype;
        return $this;
    }

    /**
     * Get the value of idTier
     *
     * @return string
     */
    public function getIdTier(): string {
        return $this->idTier;
    }

    /**
     * Set the value of idTier
     *
     * @param string $idTier
     *
     * @return self
     */
    public function setIdTier(string $idTier): self {
        $this->idTier = $idTier;
        return $this;
    }

    /**
     * Get the value of idTeam
     *
     * @return string
     */
    public function getIdTeam(): string {
        return $this->idTeam;
    }

    /**
     * Set the value of idTeam
     *
     * @param string $idTeam
     *
     * @return self
     */
    public function setIdTeam(string $idTeam): self {
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
        } catch (PDOException) {
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