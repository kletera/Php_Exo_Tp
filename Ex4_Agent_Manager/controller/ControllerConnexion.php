<?php
include './model/ModelUsers.php';
include './view/ViewConnexion.php';

class ControllerConnexion{
    // Attribut
    private ModelUsers $model;
    private ViewConnexion $view;

    // Construct
    public function __construct(ModelUsers $model,ViewConnexion $view)
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
     * @return ViewConnexion
     */
    public function getView(): ViewConnexion {
        return $this->view;
    }

    /**
     * Set the value of view
     *
     * @param ViewConnexion $view
     *
     * @return self
     */
    public function setView(ViewConnexion $view): self {
        $this->view = $view;
        return $this;
    }

    // Methode
    function traitement(): string
    {
        $_POST["email"] = strip_tags(trim($_POST["email"]));
        $_POST["password"] = strip_tags(trim($_POST["password"]));
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            return "Veuillez remplir tous les champs";
        }
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            return "Erreur : email pas au bon format";
        }

        $_SESSION["compte"] = $this->model->selectUser();
        header("Location: index.php?page=accueil");
        exit;
    }

    public function render(){
        if (isset($_POST["submit"])) {

            $this->view->setMsg($this->traitement());
        }
        $this->view->display();
    }
}
$model = new ModelUsers(connect_bdd());
$view = new ViewConnexion();

$controller = new ControllerConnexion($model, $view);
$controller->render();