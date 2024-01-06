<?php

require_once (__DIR__ . '/Character.php');

class Orc extends Character

{
    // déclaration des attributs
    private int $damage;

    /**
     * 
     * Méthode magique appelée automatiquement lors de l'instanciation de la classe Orc
     * 
     * Son utilité est souvent d'hydrater l'objet
     * 
     * @param int $health
     * @param int $rage
     */
    public function __construct(int $healthValue, int $rageValue)
    {

        parent::__construct($healthValue, $rageValue);
        // attention: ne jamais mettre "return" dans la fonction __construct
    }

    /**
     * 
     * Méthode magique est appelée automatiquement lors d'un echo de l'objet 
     * Méthode pour les développeurs 
     * 
     * @return string
     */
    public function __toString(): string
    {
        return 'L\'Orc a une santé de ' . $this->health . ' points, il a ' . $this->rage . ' points de rage.';
    }


    /**
     * 
     * Méthode permettant d'affecter la valeur passée en paramètre à l'attribut 'damage'
     * 
     * @param int $value
     * 
     * @return void
     */
    public function setDamage(int $value):void
    {
        $this->damage = $value;
    }


    /**
     * 
     * Méthode permettant de retourner la valeur de l'attribut 'damage'
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }

    /**
     * 
     * Méthode appelée lorsque l'orc attaque
     * 
     * @return int
     */
    public function attack(): int
    {
        $this->setDamage(rand(600, 800));
        return $this->getDamage();
    }

    /**
     * 
     * Méthode appelée lorsque l'orc se fait attaquer
     * 
     * @param int $hit
     * 
     * @return int
     */
    public function attacked(int $hit)
    {
        $remainingHealth = $this->getHealth() - $hit;
        $this->setHealth($remainingHealth);
    }
}
