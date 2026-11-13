<?php
class ModelTeam{
     // Attribut
    private int $id;
    private string $team;
    private PDO $pdo;

    // Controleur
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Getter Setter
    
    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of team
     *
     * @return string
     */
    public function getTeam(): string {
        return $this->team;
    }

    /**
     * Set the value of team
     *
     * @param string $team
     *
     * @return self
     */
    public function setTeam(string $team): self {
        $this->team = $team;
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

}