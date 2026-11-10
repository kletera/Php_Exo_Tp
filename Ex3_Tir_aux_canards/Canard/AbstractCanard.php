<?php
abstract class Canard{
    // Atribut
    private ?string $vole;
    private bool $nage;
    private bool $flote;
    private string $cri;

    // Construct
    public function __construct( ) {
        
    }

    // Getter Setter
    /**
     * Get the value of vole
     *
     * @return string
     */
    public function getVole(): string {
        return $this->vole;
    }

    /**
     * Set the value of vole
     *
     * @param string $vole
     *
     * @return self
     */
    public function setVole(string $vole): self {
        $this->vole = $vole;
        return $this;
    }

    /**
     * Get the value of nage
     *
     * @return bool
     */
    public function getNage(): bool {
        return $this->nage;
    }

    /**
     * Set the value of nage
     *
     * @param bool $nage
     *
     * @return self
     */
    public function setNage(bool $nage): self {
        $this->nage = $nage;
        return $this;
    }

    /**
     * Get the value of flote
     *
     * @return bool
     */
    public function getFlote(): bool {
        return $this->flote;
    }

    /**
     * Set the value of flote
     *
     * @param bool $flote
     *
     * @return self
     */
    public function setFlote(bool $flote): self {
        $this->flote = $flote;
        return $this;
    }

    /**
     * Get the value of cri
     *
     * @return string
     */
    public function getCri(): string {
        return $this->cri;
    }

    /**
     * Set the value of cri
     *
     * @param string $cri
     *
     * @return self
     */
    public function setCri(string $cri): self {
        $this->cri = $cri;
        return $this;
    }
}