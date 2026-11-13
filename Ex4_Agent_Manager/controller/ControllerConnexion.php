<?php
include './model/ModelConnexion.php';
include './view/ViewConnexion.php';

class ControllerConnexion{
    // Attribut
    private ModelConnexion $model;
    private ViewConnexion $view;

    // Construct
    public function __construct(ModelConnexion $model,ViewConnexion $view)
    {
        $this->model=$model;
        $this->view=$view;
    }
    // Getter Setter
    /**
     * Get the value of model
     *
     * @return ModelConnexion
     */
    public function getModel(): ModelConnexion {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @param ModelConnexion $model
     *
     * @return self
     */
    public function setModel(ModelConnexion $model): self {
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

    public function render(){
        if (isset($_POST["submit"])) {
            $this->model->setEmail($_POST["email"]);
            $this->model->setPassword($_POST["password"]);
            $this->view->setMsg($this->model->traitement());
        }
        $this->view->display();
    }
}
$model = new ModelConnexion(connect_bdd());
$view = new ViewConnexion();

$controller = new ControllerConnexion($model, $view);
$controller->render();