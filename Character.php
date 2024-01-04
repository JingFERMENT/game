<?php
// nom de classe toujour singulier et masjuscule
class Character
{
    // visibilité: lecture et écriture / méthode: fonction déclaré dans une classe
    // private / public: depuis l'exérieur de la classe / protected
    private int $health;
    private int $rage;
    
    // méthode magique: les uns après les autres
    // hydrater notre objet
    // par convention: au début des toutes les méthodes
    // méthode magique est toujours public : automatiquement appelé lorsque l'on construit / appelé un instant précis
    // permettre les deux paramètres optionelles 
    public function __construct(int $health=100, int $rage=0)
    {
        $this->health = $health;
        $this->rage = $rage;
    }

    /**
     * méthode permettant de définir une valeur à l'attribut health
     * @param int $health
     * 
     * @return void
     */
    public function setHealth(int $health)
    {
        $this->health = $health; 
        // toujours les valeurs sauf les valeurs par défaut
    }

    
    /**
     * méthode permettant de retounrer une valeur du 'health'
     * @return int
     */
    public function getHealth():int
    {
        return $this->health;
    }

    /**
     * méthode permettant de définir une valeur à l'attribut rage
     * @param int $rage
     * 
     * @return [type]
     */

    public function setRage(int $rage)
    {
        $this->rage = $rage;
    }

        /**
     * méthode permettant de retounrer une valeur du 'rage'
     * @return int
     */
    public function getRage():int
    // array / float / bool: true or false / object / int / string 
    {
        return $this->rage;
    }



}

// $character1 = new Character(health:10000,rage: 22);
// $character1->setHealth(12);
// var_dump($character1);

?>

<!-- php 8: parametre nomme : dans l'ordre -->