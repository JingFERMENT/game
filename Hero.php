<?php

require_once __DIR__ . '/Character.php';
require_once __DIR__ . '/Orc.php';

// toujours _DIR_. '/'
// charger la première fois 

class Hero extends Character
{
    private ?string $weapon;
    //  ? peut etre nul
    private int $weaponDamage;
    private ?string $shield;
    private int $shieldValue;

    // la méthode "construct": ne pas pour afficher quelques choses. No return 
    public function __construct(int $health = 100, int $rage = 0, string $weapon = 'pistolet', int $weaponDamage = 0, string $shield = 'bouclier', int $shieldValue = 10)
    {
        parent::__construct($health, $rage);
        $this->weapon = $weapon;
        $this->weaponDamage = $weaponDamage;
        $this->shield = $shield;
        $this->shieldValue = $shieldValue;
    }

    /**
     * méthode permettant de définir une valeur à l'attribut weapon
     * @param string $weapon
     * 
     * @return string
     */
    public function setWeapon(string $weapon)
    {
        $this->weapon = $weapon;
    }

    /**
     * méthode permettant de retourner une valeur du 'weapon'
     * @return string
     */

    public function getWeapon(): string
    {
        return $this->weapon;
    }

    public function setWeaponDamage(int $weaponDamage)
    {
        $this->weaponDamage = $weaponDamage;
    }

    public function setShield(string $shield)
    {
        $this->shield = $shield;
    }

    public function setShieldValue(int $shieldValue)
    {
        $this->shieldValue = $shieldValue;
    }

    public function getWeaponDamage(): int
    {
        return $this->weaponDamage;
    }

    public function getShield(): string
    {
        return $this->shield;
    }

    public function getShieldValue(): int
    {
        return $this->shieldValue;
    }

    public function __toString(): string
    {
        return 'Le héro a une santé de ' . $this->getHealth() . ' points, il a ' . $this->getRage() . ' point(s) de rage. Il a un ' . $this->getWeapon() . ', et il a eu ' . $this->getWeaponDamage() . ' points de dégâts. Il a un ' . $this->getShield() . ', sa valeur est de ' . $this->getShieldValue() . ' points.';
    }

    public function attacked(int $hit)
    {
        $hitAfterShieldProtectedMe = $hit - $this->getShieldValue();

        if ($hitAfterShieldProtectedMe > 0) {
            $newHealth = $this->getHealth() - $hitAfterShieldProtectedMe;
            $this->setHealth($newHealth);
        }

        $this->setRage($this->getRage() + 30);

        if ($hit <= $this->getShieldValue()) {
            $damageAbsorbedByShield = $hit;
            $damageNotAbsorbedByShield = 0;  
        }  else {
            $damageAbsorbedByShield = $this->getShieldValue();
            $damageNotAbsorbedByShield = $hit - $this->getShieldValue();
        }

        $damageArray = array($damageAbsorbedByShield, $damageNotAbsorbedByShield);
        return $damageArray;
    }
}

// $superman = new Hero(100, 0, 'gun', 50, 'golden shield', 10);
// var_dump($Hero);
// var_dump($superman->displayHero());
// echo $superman;
// echo $batman;
