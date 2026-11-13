<?php
class ModelTiers{
    // Attribut
    private int $id;
    private string $tiers;
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
     * Get the value of tiers
     *
     * @return string
     */
    public function getTiers(): string {
        return $this->tiers;
    }

    /**
     * Set the value of tiers
     *
     * @param string $tiers
     *
     * @return self
     */
    public function setTiers(string $tiers): self {
        $this->tiers = $tiers;
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
}