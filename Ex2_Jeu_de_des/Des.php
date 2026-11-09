<?php
class Des{
    // Atribut
    private int $nbrface;
    private ?int $score;

    // Constructor
    public function __construct(int $nbrface){
         $this->nbrface = $nbrface;
    }

    // Getter Setter
    /**
     * Get the value of nbrface
     *
     * @return int
     */
    public function getNbrface(): int {
        return $this->nbrface;
    }

    /**
     * Set the value of nbrface
     *
     * @param int $nbrface
     *
     * @return self
     */
    public function setNbrface(int $nbrface): self {
        $this->nbrface = $nbrface;
        return $this;
    }

    /**
     * Get the value of score
     *
     * @return ?int
     */
    public function getScore(): ?int {
        return $this->score;
    }

    /**
     * Set the value of score
     *
     * @param ?int $score
     *
     * @return self
     */
    public function setScore(?int $score): self {
        $this->score = $score;
        return $this;
    }

    // Methode
    public function lancer(){
        $this->setScore(random_int(1,6));
        return $this->getScore();
    }
}