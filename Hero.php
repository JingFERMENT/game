<?php
// __DIR__. : répértoire actuel
// require_once: charger une seule fois et c'est fait. 
require_once (__DIR__ . '/Character.php');


// "extends" permet de créer une nouvelle classe qui héritera des propriétés et des méthodes 
// d'une classe parent et qui pourra redéfinir certaines propriétés et méthodes si on le souhaite.

class Hero extends Character
{
    // Déclaration des attributs
    private ?string $weapon; //  ? cela veut dire que la valuer peut etre nul
    private int $weaponDamage;
    private ?string $shield;
    private int $shieldValue;

    /**
     * Méthode magique appelée automatiquement lors de l'instanciation d'une classe
     * Son utilité est souvent d'hydrater l'objet, mais pas pour afficher quelques choses. 
     * donc pas de 'return'
     * 
     * @param int $health
     * @param int $rage
     * @param string $weapon
     * @param int $weaponDamage
     * @param string $shield
     * @param int $shieldValue
     */
    public function __construct(int $healthValue, int $rageValue, string $weapon, int $weaponDamage, string $shield, int $shieldValue)
    {
        // hériter des deux attributs du parent
        parent::__construct($healthValue, $rageValue);
        $this->weapon = $weapon;
        $this->weaponDamage = $weaponDamage;
        $this->shield = $shield;
        $this->shieldValue = $shieldValue;
    }

    /**
     * Méthode magique est appelée automatiquement lors d'un echo de l'objet
     * 
     * @return string
     */
    public function __toString(): string
    {
        return "<strong>Héro :</strong><br>
        Santé: $this->health<br>
        Rage: $this->rage<br>
        <!-- Nom de l'arme équipée: $this->weapon<br> -->
        <!-- Dégâts infligés par l'arme du héro:  $this->weaponDamage<br> -->
        <!-- Nom de l'armure équipée:  $this->shield<br> -->
        Valeur de l'armure:  $this->shieldValue";
    }

    /**
     * Méthode permettant d'affecter la valeur passée en paramètre à l'attribut 'weapon'
     * 
     * @param string $value
     * 
     * @return void
     */
    public function setWeapon(string $value):void
    {
        $this->weapon = $value;
    }

    /**
     * Méthode permettant de retourner la valeur de l'attribut 'weapon'
     * 
     * @return string
     */
    public function getWeapon(): string
    {
        return $this->weapon;
    }

    /**
     * Méthode permettant d'affecter la valeur passée en paramètre à l'attribut "weaponDamage"
     * 
     * @param int $value
     * 
     * @return void
     */
    public function setWeaponDamage(int $value):void
    {
        $this->weaponDamage = $value;
    }

    /**
     * Méthode permettant de retourner la valeur de l'attribut 'weaponDamage'
     * 
     * @return int
     */
    public function getWeaponDamage(): int
    {
        return $this->weaponDamage;
    }

    /**
     * Méthode permettant d'affecter la valeur passée en paramètre à l'attribut 'setShield'
     * 
     * @param string $value
     * 
     * @return void
     */
    public function setShield(string $value):void
    {
        $this->shield = $value;
    }

    /**
     * Méthode permettant de retourner la valeur de l'attribut 'shield'
     * 
     * @return string
     */
    public function getShield(): string
    {
        return $this->shield;
    }

    /**
     * Méthode permettant d'affecter la valeur passée en paramètre à l'attribut 'shieldValue'
     * 
     * @param int $value
     * 
     * @return void
     */
    public function setShieldValue(int $value):void
    {
        if($value > 0) {
            $this->shieldValue = $value ;
        } else {
            $this->shieldValue = 0 ;
        }
    }

    /**
     * Méthode permettant de retourner la valeur de l'attribut 'shieldValue'
     * 
     * @return int
     */
    public function getShieldValue(): int
    {
        return $this->shieldValue;
    }

    /**
     * __set
     * La méthode magique __set() s’exécute dès qu’on tente de créer ou de mettre à jour une propriété 
     * inaccessible (ou qui n’existe pas) dans une classe. 
     * Cette méthode va prendre comme arguments le nom et la valeur de la propriété qu’on tente de créer 
     * ou de mettre à jour.
     *
     * @param string $name
     * @param mixed $value
     * 
     * @return void
     */
    public function __set(string $name, mixed $value): void
    {
        $this->$name = $value;
    }

    /**
     * _La méthode magique __get() va s’exécuter si on tente d’accéder à une propriété inaccessible 
     * (ou qui n’existe pas) dans une classe. Elle va prendre en argument le nom de la propriété à 
     * laquelle on souhaite accéder.
     *
     * @param string $name
     * 
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        return $this->$name;
    }
    
    
    /**
     * Méthode permettant de préciser la puissance de l'attaque par un Orc 
     * et ses dégâts (absorbés ou non-absorbés).
     * 
     * @param int $hit
     * 
     * @return array
     */
    public function attacked(int $hit): array
    {
        $hitAfterShieldProtectedMe = $hit - $this->getShieldValue();

        // quand le coup est suffisamment fort pour réduire la valeur du bouclier de l'Héro
        if ($hitAfterShieldProtectedMe > 0) {
            $newHealth = $this->getHealth() - $hitAfterShieldProtectedMe;
            $this->setHealth($newHealth);
        }

        // augmentation de 30 points de la rage à l'Héros pour chaque coup reçu
        $this->setRage($this->getRage() + 30);

        // quand la valeur du coup reçu est inférieur à celui du bouclier
        if ($hit <= $this->getShieldValue()) {
            $damageAbsorbedByShield = $hit;
            $damageNotAbsorbedByShield = 0;
        } else { // quand la valeur du coup reçu est supérieur à celui du bouclier
            $damageAbsorbedByShield = $this->getShieldValue();
            $damageNotAbsorbedByShield = $hit - $this->getShieldValue();
        }

        // stocker les valeurs dans un tableau
        $damageArray = array($damageAbsorbedByShield, $damageNotAbsorbedByShield);
        
        // récupérer ces valeurs afin de les utiliser plus tard
        return $damageArray;
    }
}


