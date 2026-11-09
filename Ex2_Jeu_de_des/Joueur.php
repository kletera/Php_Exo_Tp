<?php

class Joueur extends Des{
    // Atribut
    private string $nom;
    private int $valeurLance;
    private Des $des;

    // Construct
    public function __construct(string $nom, Des $des){
        $this->nom = $nom;
        $this->des = $des;
    }

    // Getter Setter
    /**
     * Get the value of nom
     *
     * @return string
     */
    public function getNom(): string {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param string $nom
     *
     * @return self
     */
    public function setNom(string $nom): self {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get the value of valeurLance
     *
     * @return int
     */
    public function getValeurLance(): int {
        return $this->valeurLance;
    }

    /**
     * Set the value of valeurLance
     *
     * @param int $valeurLance
     *
     * @return self
     */
    public function setValeurLance(int $valeurLance): self {
        $this->valeurLance = $valeurLance;
        return $this;
    }

    /**
     * Get the value of des
     *
     * @return Des
     */
    public function getDes(): Des {
        return $this->des;
    }

    /**
     * Set the value of des
     *
     * @param Des $des
     *
     * @return self
     */
    public function setDes(Des $des): self {
        $this->des = $des;
        return $this;
    }

    // Methodes
    public function lancerDes(){
        $this->setValeurLance($this->lancer());
        echo("Le joueur ".$this->getNom()." a fait ".$this->getValeurLance()."<br>");
    }

}