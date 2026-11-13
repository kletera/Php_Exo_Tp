<?php
include './model/ModelUsers.php';
include './view/ViewAccueil.php';
include './view/ViewHeader.php'; 

class ControllerAcccueil{
    private ModelUsers $model;
    private ViewAccueil $view;
    private ViewHeader $viewHead;

    // Constructeur
    public function __construct(ModelUsers $model, ViewAccueil $view,ViewHeader $viewHead) {
        $this->model = $model;
        $this->view = $view;
        $this->viewHead = $viewHead;
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

    /**
     * Get the value of viewHead
     *
     * @return ViewHeader
     */
    public function getViewHead(): ViewHeader {
        return $this->viewHead;
    }

    /**
     * Set the value of viewHead
     *
     * @param ViewHeader $viewHead
     *
     * @return self
     */
    public function setViewHead(ViewHeader $viewHead): self {
        $this->viewHead = $viewHead;
        return $this;
    }

    // Methode

    public function render(){
        if(!isset($_SESSION["compte"])){
            header('Location:index.php');
            exit;
        }
        $this->viewHead->displayHeader();
        $this->view->setFindManager($this->model->find_manager())->dispay();
    }
}

$model= new ModelUsers(connect_bdd());

$view= new ViewAccueil();
$viewHead =new ViewHeader();

$ControllerAcccueil = new ControllerAcccueil($model,$view,$viewHead);
$ControllerAcccueil->render();