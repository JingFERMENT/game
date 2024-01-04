<?php 

require_once __DIR__.'/Character.php';

class Orc extends Character 

{
    private int $damage;

    public function __construct (int $health, int $rage) {
        parent::__construct($health, $rage); 
        // attention: ne jamais mettre "return" dans la fonction __construct
    }

    // méthode pour les développeurs 
    public function __toString(): string
    {
        return 'L\'Orc a une santé de '.$this->getHealth(). ' points, il a '.$this->getRage(). ' points de rage.';
    }

    public function setDamage(int $damage)
    {
        $this->damage = $damage;
    }

    public function getDamage():int {
        return $this->damage;
    }


    /**
     * @return int
     */

    //  "control" + "clic" = aller directement sur la méthode
    //  "control" + "entrer" = commentaire du doc du méthode

    public function attack():int {
        // utiliser plutôt la fonction "setter" ou "getter"
        $this->setDamage(rand(600, 800));
        return $this->getDamage();
        // return $this->damage = rand(600,800);
    }

    public function attacked(int $hit)
    {
        $remainingHealth = $this->getHealth() - $hit;
        $this->setHealth($remainingHealth);
    }  
}
?>

