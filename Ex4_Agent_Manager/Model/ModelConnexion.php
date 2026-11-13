<?php
class ModelConnexion{
    // Attribut
    private string $email;
    private string $password;
    private PDO $pdo;

    // Construct 
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Getter Setter
    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of password
     *
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password): self {
        $this->password = $password;
        return $this;
    }

    // Methode
    function traitement(): string
    {
        $em = strip_tags(trim($this->email));
        $pw = strip_tags(trim($this->password));
        if (empty($em) || empty($pw)) {
            return "Veuillez remplir tous les champs";
        }
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            return "Erreur : email pas au bon format";
        }

        try {
            $sql = "SELECT  `firstname`, `lastname`, `email`, `created_at` AS createdAt, `Id_Role` AS `role`  FROM `users` WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $em, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException) {
            return "Erreur technique, réessayez plus tard";
        }

        $_SESSION["compte"] = $user;
        header("Location: index.php?page=accueil");
        exit;
    }

    
}