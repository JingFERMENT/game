<?php
class Character // Nom de classe => toujour singulier et masjuscule
{
    // Visibilité : protected / private / public => par rapport à l'extérieur de la classe
    // Déclaration des attributs
    protected int $health;
    protected int $rage;

    // Méthode : fonction déclarée dans une classe
    // "control" + "clic" = aller directement sur la méthode
    // "control" + "entrer" = commentaire du doc du méthode

    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * par convention: elles sont au début des toutes les méthodes
     * 
     * @param int $healthValue
     * @param int $rageValue
     */
    public function __construct(int $healthValue, int $rageValue = 0)
    {
        $this->health = $healthValue;
        $this->rage = $rageValue;
    }
    
    /**
     * Méthode permettant d'affecter la valeur passée en paramètre à l'attribut health
     * @param int $value
     * 
     * @return void
     */
    public function setHealth(int $value = 100): void
    {
        $this->health = $value;
    }

    /**
     * Méthode permettant de retourner la valeur de l'attribut 'health"
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * Méthode permettant d'affecter la valeur passée en paramètre à l'attribut 'rage'
     * @param int $value
     * 
     * @return void
     */
    public function setRage(int $value = 0): void
    {
        $this->rage = $value;
    }

    /**
     * Méthode permettant de retourner la valeur de l'attribut 'rage"
     * @return int
     */
    public function getRage(): int
    // type des valeurs retournées : array / float / booléen / objet / int / string 
    {
        return $this->rage;
    }
}

?>

<!-- php 8: parametre nomme : dans l'ordre -->