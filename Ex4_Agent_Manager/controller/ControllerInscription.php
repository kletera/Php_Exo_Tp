<?php
include './model/ModelInscription.php';
include './view/ViewInscription.php';

class ControllerInscription{
    // Attribut
    private ModelInscription $model;
    private ViewInscription $view;

    // Constructeur
    public function __construct(ModelInscription $model, ViewInscription $view)
    {
        $this->model=$model;
        $this->view=$view;
    }

    // Getter Setter

    /**
     * Get the value of model
     *
     * @return ModelInscription
     */
    public function getModel(): ModelInscription {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @param ModelInscription $model
     *
     * @return self
     */
    public function setModel(ModelInscription $model): self {
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
    public function render(){
        
        if (isset($_POST["submit"])) {
            $this->model->setFirstname($_POST["firstname"]);
            $this->model->setLastname($_POST["lastname"]);
            $this->model->setEmail($_POST["email"]);
            $this->model->setPassword($_POST["password"]);
            $this->model->setRole(2);

            $this->view->setMsg($this->model->traitement());

        }
        $this->view->display();
    }
}

$model = new ModelInscription(connect_bdd());
$view = new ViewInscription();

$controller = new ControllerInscription($model, $view);
$controller->render();
