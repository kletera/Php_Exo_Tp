<?php 
class ModelInscription {
    // Attribut
    private int $idUser;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private string $createdAt;
    private int $role;
    private PDO $pdo;

    // Constructeur
    public function __construct(PDO $pdo)
    {
        $this->pdo=$pdo;
    }

    // Getter Setter

    /**
     * Get the value of idUser
     *
     * @return int
     */
    public function getIdUser(): int {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @param int $idUser
     *
     * @return self
     */
    public function setIdUser(int $idUser): self {
        $this->idUser = $idUser;
        return $this;
    }

    /**
     * Get the value of firstname
     *
     * @return string
     */
    public function getFirstname(): string {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param string $firstname
     *
     * @return self
     */
    public function setFirstname(string $firstname): self {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return string
     */
    public function getLastname(): string {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname(string $lastname): self {
        $this->lastname = $lastname;
        return $this;
    }

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
     * Get the value of role
     *
     * @return int
     */
    public function getRole(): int {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param int $role
     *
     * @return self
     */
    public function setRole(int $role): self {
        $this->role = $role;
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
    //Traitement du formulaire
    function traitement(): string
    {
        // tester si les champs sont remplis
        if (empty($this->firstname) || empty($this->lastname) || empty($this->email) || empty($this->password)) { 
            return "Veuillez remplir tous les champs";
        }
        //nettoyer les données (trim, strip_tag)
        $this->setFirstname( strip_tags(trim($this->firstname)));
        $this->setLastname(strip_tags(trim($this->lastname)));
        $this->setEmail( strip_tags(trim($this->email)));
        $this->setPassword(strip_tags(trim($this->password)));

        // valider le format des données
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return "Le mail est invalide";
        }
        if (strlen($this->password) < 8) {
            return "Le mot de passe est trop court";
        }
        // ajout en BDD si il n'existe pas
        if ($this->find_user_by_email($this->email)) {
            return "Le compte existe déja";
        }
        if (false === $this->add_user($_POST)) {
            return "Le compte n'a pas pu étre ajouté en BDD";
        }

        $_SESSION["compte"] = [
            "firstname" => $this->firstname, 
            "lastname" => $this->lastname, 
            "email" => $this->email,
            "role" => $this->role,
            "createdAt" => (new DateTime())->format('Y-m-d H:i:s'),
        ];
        header("Location:index.php?page=accueil");
        return "Le compte " . $this->email . " a été ajouté avec succés";
    }

    function find_user_by_email(string $email): bool
    {
        try {
            $sql = "SELECT u.Id_user FROM `users` AS u WHERE u.email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch() !== false;
        } catch (PDOException $e) {
            return false;
        }
    }
    function add_user(array $user): string|int|bool
    {
        try {
            // ecrire la requête (INSERT)
            $sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`, `Id_Role`)
            VALUE(?,?,?,?,?)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(1, $user["firstname"], PDO::PARAM_STR);
            $stmt->bindValue(2, $user["lastname"], PDO::PARAM_STR);
            $stmt->bindValue(3, $user["email"], PDO::PARAM_STR);
            $stmt->bindValue(4, $user["password"], PDO::PARAM_STR);
            $stmt->bindValue(5, 2, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}