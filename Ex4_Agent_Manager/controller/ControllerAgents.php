<?php
include 'model/ModelAgents.php';
include 'model/ModelArchetypes.php';
include 'model/ModelTeam.php';
include 'model/ModelTiers.php';
include 'view/ViewAgents.php';
include './view/ViewHeader.php'; 

class ControllerAgents{
    // Attribut 
    private array $model;
    private ViewAgents $view;
    private ViewHeader $viewHead;

    // Controleur
    public function __construct(array $model, ViewAgents $view,ViewHeader $viewHead)
    {
        $this->model=$model;
        $this->view=$view;
        $this->viewHead=$viewHead;
    }

    /**
     * Get the value of model
     *
     * @return array
     */
    public function getModel(): array {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @param array $model
     *
     * @return self
     */
    public function setModel(array $model): self {
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
    function traitement(): string {
        $_POST["name"]=trim($_POST["name"]);
        $_POST["date"]=trim($_POST["date"]);
        $_POST["archetype"]=trim( $_POST["archetype"]);
        $_POST["tier"]=trim($_POST["tier"]);
        if (empty($_POST["name"]) || empty($_POST["date"]) || empty($_POST["archetype"]) || empty($_POST["tier"])) {
            return "Veuillez remplir tous les champs";
        }
        
        if($this->model["agent"]->find_agent_by_name($_POST["name"])){
            return "Ce nom est déja utiliser";
        }

        if (false === $this->model["agent"]->add_agent($_POST)) {
            return "Le compte n'a pas pu être ajouté en BDD";
        }
        
        return "Enregistrement réussi";
    }

    public function render(){
        if(!isset($_SESSION["compte"])){
            header('Location:index.php');
            exit;
        }
        $team=$this->model["team"]->find_teams();
        $archetype=$this->model["archetypes"]->find_archetype();
        $tiers=$this->model["tiers"]->find_tiers();
        $agent=$this->model["agent"]->find_agent();

        $this->view->setFindTeams($team);
        $this->view->setFindArchetype($archetype);
        $this->view->setFindTiers($tiers);
        $this->view->setFindAgent($agent);

        if (isset($_POST["submit"])) {
            $this->view->setMsg($this->traitement());
        }
        $this->viewHead->displayHeader();
        $this->view->display();
    }
}
$pdo=connect_bdd();

$model= [
    "agent"=>new ModelAgents($pdo),
    "archetypes"=>new ModelArchetypes($pdo),
    "team"=>new ModelTeam($pdo),
    "tiers"=>new ModelTiers($pdo),
];

$view= new ViewAgents();
$viewHead=new ViewHeader();

$ControllerAgents = new ControllerAgents($model,$view,$viewHead);
$ControllerAgents->render();