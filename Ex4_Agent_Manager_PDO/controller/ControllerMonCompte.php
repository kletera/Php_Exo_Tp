<?php
include './view/ViewMonCompte.php';
include './view/ViewHeader.php'; 

class ControllerMonCompte{
  // Attribut
    private ViewMonCompte $view;
    private ViewHeader $viewHead;

    // Construct
    public function __construct(ViewMonCompte $view, ViewHeader $viewHead)
    {
        $this->view=$view;
        $this->viewHead=$viewHead;
    }
    // Getter Setter

    /**
     * Get the value of view
     *
     * @return ViewMonCompte
     */
    public function getView(): ViewMonCompte {
        return $this->view;
    }

    /**
     * Set the value of view
     *
     * @param ViewMonCompte $view
     *
     * @return self
     */
    public function setView(ViewMonCompte $view): self {
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
        $this->view->display();
    }
}

$view = new ViewMonCompte();
$viewHead = new ViewHeader();

$controller = new ControllerMonCompte($view, $viewHead);
$controller->render();