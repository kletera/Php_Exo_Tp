<?php
include './view/ViewMonCompte.php';

class ControllerMonCompte{
  // Attribut
    private ViewMonCompte $view;

    // Construct
    public function __construct(ViewMonCompte $view)
    {
        $this->view=$view;
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
    // Methode
    public function render(){
        if(!isset($_SESSION["compte"])){
            header('Location:index.php');
            exit;
        }
        $this->view->display();
    }
}
$view = new ViewMonCompte();

$controller = new ControllerMonCompte($view);
$controller->render();