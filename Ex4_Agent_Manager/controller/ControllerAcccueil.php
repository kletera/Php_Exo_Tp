<?php
include './model/ModelAcccueil.php';
include './view/ViewAccueil.php';

class ControllerAcccueil{
    private ModelAcccueil $model;
    private ViewAccueil $view;

    // Constructeur
    public function __construct(ModelAcccueil $model, ViewAccueil $view) {
        $this->model = $model;
        $this->view = $view;
    }

    // Getter Setter

    /**
     * Get the value of model
     *
     * @return ModelAcccueil
     */
    public function getModel(): ModelAcccueil {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @param ModelAcccueil $model
     *
     * @return self
     */
    public function setModel(ModelAcccueil $model): self {
        $this->model = $model;
        return $this;
    }

    /**
     * Get the value of view
     *
     * @return ViewAccueil
     */
    public function getView(): ViewAccueil {
        return $this->view;
    }

    /**
     * Set the value of view
     *
     * @param ViewAccueil $view
     *
     * @return self
     */
    public function setView(ViewAccueil $view): self {
        $this->view = $view;
        return $this;
    }

    // Methode

    public function render(){
        if(!isset($_SESSION["compte"])){
            header('Location:index.php');
            exit;
        }
        $this->view->setFindManager($this->model->find_manager());
        $this->view->dispay();
    }
}

$model= new ModelAcccueil(connect_bdd());

$view= new ViewAccueil();

$ControllerAcccueil = new ControllerAcccueil($model,$view);
$ControllerAcccueil->render();