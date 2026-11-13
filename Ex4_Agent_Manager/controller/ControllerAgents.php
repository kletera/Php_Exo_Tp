<?php
include 'model/Agents.php';
include 'view/ViewAgents.php';


class ControllerAgents{
    // Attribut 
    private Agent $model;
    private ViewAgents $view;

    // Controleur
    public function __construct(Agent $model, ViewAgents $view)
    {
        $this->model=$model;
        $this->view=$view;
    }

    /**
     * Get the value of model
     *
     * @return Agent
     */
    public function getModel(): Agent {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @param Agent $model
     *
     * @return self
     */
    public function setModel(Agent $model): self {
        $this->model = $model;
        return $this;
    }

    /**
     * Get the value of view
     *
     * @return ViewAgents
     */
    public function getView(): ViewAgents {
        return $this->view;
    }

    /**
     * Set the value of view
     *
     * @param ViewAgents $view
     *
     * @return self
     */
    public function setView(ViewAgents $view): self {
        $this->view = $view;
        return $this;
    }

    // Methode
    public function render(){
        if(!isset($_SESSION["compte"])){
            header('Location:index.php');
            exit;
        }
        $team=$this->model->find_teams();
        $archetype=$this->model->find_archetype();
        $tiers=$this->model->find_tiers();
        $agent=$this->model->find_agent();

        $this->view->setFindTeams($team);
        $this->view->setFindArchetype($archetype);
        $this->view->setFindTiers($tiers);
        $this->view->setFindAgent($agent);

        if (isset($_POST["submit"])) {
            $this->view->setMsg($this->model->traitement());
        }
        $this->view->display();
    }
}

$model= new Agent(connect_bdd());

$view= new ViewAgents();

$ControllerAgents = new ControllerAgents($model,$view);
$ControllerAgents->render();