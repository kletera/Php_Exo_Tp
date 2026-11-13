<?php
class ModelAcccueil{
    private PDO $pdo;

    public function __construct( PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Getter Setter

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
    
    function find_manager(){
        try {
            $sql = "SELECT  `firstname`, `lastname`, `email`, `created_at` AS createdAt, `Id_Role` AS `role`  FROM `users` WHERE  `Id_Role`=2";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            return false;
        }
    }

}