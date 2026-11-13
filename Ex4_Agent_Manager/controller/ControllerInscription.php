<?php
include './model/ModelUsers.php';
include './view/ViewInscription.php';

class ControllerInscription{
    // Attribut
    private ModelUsers $model;
    private ViewInscription $view;

    // Constructeur
    public function __construct(ModelUsers $model, ViewInscription $view)
    {
        $this->model=$model;
        $this->view=$view;
    }

    // Getter Setter

    /**
     * Get the value of model
     *
     * @return ModelUsers
     */
    public function getModel(): ModelUsers {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @param ModelUsers $model
     *
     * @return self
     */
    public function setModel(ModelUsers $model): self {
        $this->model = $model;
        return $this;
    }

    /**
     * Get the value of view
     *
     * @return ViewInscription
     */
    public function getView(): ViewInscription {
        return $this->view;
    }

    /**
     * Set the value of view
     *
     * @param ViewInscription $view
     *
     * @return self
     */
    public function setView(ViewInscription $view): self {
        $this->view = $view;
        return $this;
    }

    // Methode 
    //Traitement du formulaire
    function traitement(): string
    {
        // tester si les champs sont remplis
        if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty( $_POST["password"])) { 
            return "Veuillez remplir tous les champs";
        }
        //nettoyer les données (trim, strip_tag)
        $_POST["firstname"]= strip_tags(trim($_POST["firstname"]));
        $_POST["lastname"]=strip_tags(trim($_POST["lastname"]));
        $_POST["email"] =strip_tags(trim($_POST["email"]));
        $_POST["password"]=strip_tags(trim($_POST["password"]));

        // valider le format des données
        if (!filter_var( $_POST["email"], FILTER_VALIDATE_EMAIL)) {
            return "Le mail est invalide";
        }
        if (strlen($_POST["password"]) < 8) {
            return "Le mot de passe est trop court";
        }
        // ajout en BDD si il n'existe pas
        if ($this->model->find_user_by_email( $_POST["email"])) {
            return "Le compte existe déja";
        }
        if (false === $this->model->add_user($_POST)) {
            return "Le compte n'a pas pu étre ajouté en BDD";
        }

        $_SESSION["compte"] = [
            "firstname" => $_POST["firstname"], 
            "lastname" => $_POST["lastname"], 
            "email" =>  $_POST["email"],
            "role" => 2,
            "createdAt" => (new DateTime())->format('Y-m-d H:i:s'),
        ];
        header("Location:index.php?page=accueil");
        return "Le compte " .  $_POST["email"] . " a été ajouté avec succés";
    }

    public function render(){
        
        if (isset($_POST["submit"])) {

            $this->view->setMsg($this->traitement());

        }
        $this->view->display();
    }
}

$model = new ModelUsers(connect_bdd());
$view = new ViewInscription();

$controller = new ControllerInscription($model, $view);
$controller->render();
