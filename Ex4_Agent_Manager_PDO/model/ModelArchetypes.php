<?php
class ModelArchetypes{
     // Attribut
    private int $id;
    private string $archetypes;
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
     * Get the value of archetypes
     *
     * @return string
     */
    public function getArchetypes(): string {
        return $this->archetypes;
    }

    /**
     * Set the value of archetypes
     *
     * @param string $archetypes
     *
     * @return self
     */
    public function setArchetypes(string $archetypes): self {
        $this->archetypes = $archetypes;
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

}