<!-- séparer les logiques avec les affichages -->
<?php
require_once (__DIR__ . '/Hero.php');
require_once (__DIR__ . '/Orc.php');

// Nouvel instance de la classe "heros"
$heros = new Hero(1000, 0, 'laser', 150, 'bouclier', 450);

// Nouvel instance de la classe "badOrc"
$badOrc = new Orc(250, 0);

// Stocker les valeurs du héros et je veux qu'elles ne bougent plus
$initialOrcHealth = $badOrc->getHealth();
$initialOrcRage = $badOrc->getRage();
$initialOrcDamage = $badOrc->attack();

// Stocker les valeurs de l'orc et je veux qu'elles ne bougent plus
$initialHerosHealth = $heros->getHealth();
$initialHerosRage = $heros->getRage();
$initialHerosWeaponDamage = $heros->getWeaponDamage();
$initialHerosShieldValue = $heros->getShieldValue();

$myFight = [];
$whoHasWon = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $myFight[] = '<h2 class="main-title text-center py-5">Déroulement du combat</h2>';
    $countAttacks = 0;
    $reverts = 0;

    // Tant que le héro et l'orc sont en vie
    while ($heros->getHealth() > 0 && $badOrc->getHealth() > 0) {

        $countAttacks++;
        $myFight[] = '<h5 class="main-title text-center py-3">Attaque</strong> ' . $countAttacks . '</h5>';

        // l'orc attaque
        $damage = $badOrc->attack();

        // le héros est frappé // dégâts absorbés
        $attacked = $heros->attacked($damage);
        $damageAbsorbedByShield = $attacked[0];
        $myFight[] = '<p class="text-center">Dégât de l\'orc: ' . $damage . ' points </p>';

        // echo '<p class="text-center">Dégât absorbé par l\'armure:' . $damageAbsorbedByShield . ' points </p>';

        // dégâts non absorbés
        $damageNotAbsorbedByShield = $attacked[1];
        $myFight[] = '<p class="text-center">Dégât non absorbés par l\'armure: ' . $damageNotAbsorbedByShield . ' points </p>';

        // rage actuelle du Héros
        $myFight[] = '<p class="text-center">Rage actuelle du héros est de : ' . $heros->getRage() . ' points </p>';

        if ($heros->getHealth() > 0 && $heros->getRage() >= 60) {
            $reverts ++ ;
            $attack = $heros->getWeaponDamage();
            // l'orc subit une attaque
            $badOrc->attacked($attack);
            $heros->setRage(0);
        }

        // santé restante du Héros
        if ($heros->getHealth() >= 0) {
            $myFight[] = '<p class="text-center">Santé actuelle du Héros est de : ' . $heros->getHealth() . ' points.</p>';
        } else {
            $result = '<h4 class="main-title text-center">L\'orc a gagné !</h4>';
            $whoHasWon = 'orc';
        }

        if ($badOrc->getHealth() >= 0) {
            $myFight[] = '<p class="text-center">Santé actuelle de l\'orc est de : ' . $badOrc->getHealth() . ' points.</p>';
        } else {
            $result = '<h4 class="main-title text-center">Le héros a gagné !</h4>';
            $whoHasWon = 'heros';
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google font title -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <!-- google font texts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- bootstrap icon file-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- my css file -->
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <title>Duel du héros contre l'orc</title>
</head>

<body>
    <header>
        <div class="pb-2">
            <div class="pb-2">
                <h1 class="main-title text-center">Duel du héros contre l'orc</h1>
            </div>
            <form method="POST">
                <div class="text-center py-3">
                <?php if ($whoHasWon == null) { ?>
                <button id="start-btn" class="btn btn-danger btn-lg" type="submit" name="Commencer">Commencer</button>
                <?php } ?>
                <?php if ($whoHasWon == 'heros' || $whoHasWon == 'orc') { ?>
                    <button id="start-btn" class="btn btn-danger btn-lg " type="submit" name="Rejouer">Rejouer</button>
                <?php } ?>
                    </div>
            </form>
            <h5><?= $result ?? ''?></h5>
        </div>
    </header>

    <main class="container-fluid p-0">
        <section class="row fighting_game justify-content-center align-items-center">
        <?php if ($whoHasWon == 'heros' || $whoHasWon == null) { ?>
            <!-- score héros -->
            <div class="col-12 col-md-6 col-lg-3 justify-content-center align-items-center order-1 order-lg-1">
                <div class="card m-auto bg-danger ">
                    <div class="card-header text-center text-white">Héros</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Santé: <?= $initialHerosHealth ?> Points</li>
                        <li class="list-group-item">Rage: <?= $initialHerosRage ?> Points</li>
                        <li class="list-group-item">Dégât d'arme : <?= $initialHerosWeaponDamage ?> Points</li>
                        <li class="list-group-item">Valeur d'armure : <?= $initialHerosShieldValue ?> Points</li>
                    </ul>
                </div>
            </div>
            </div>
            <?php } ?>
            <?php if ($whoHasWon == 'heros' || $whoHasWon == null) { ?>
            <!-- img héros -->
            <img class="col-12 col-md-6 col-lg-3 img-fluid order-2 order-lg-2" src="./public/assets/img/heros.png" alt="image d'un héro">
            <?php } ?>
            <!-- img orc -->
            <?php if ($whoHasWon == 'orc' || $whoHasWon == null) { ?>
            <img id="orc-img" class="col-12 col-md-6 col-lg-3 img-fluid order-4 order-lg-3" src="./public/assets/img/orc.png" alt="image d'un orc">
            <?php } ?>
            <!-- img score -->
            <?php if ($whoHasWon == 'orc' || $whoHasWon == null) { ?>
            <div class="col-12 col-md-6 col-lg-3 order-3 order-lg-4">
                <div class="card m-auto bg-success">
                    <div class="card-header text-center text-white">Orc</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Santé: <?= $initialOrcHealth ?> Points</li>
                        <li class="list-group-item">Rage: <?= $initialOrcRage ?> Points</li>
                        <li class="list-group-item">Dégât: <?= $initialOrcDamage ?> Points</li>
                    </ul>
                </div>
            </div>
            <?php } ?>
            </div>
        </section>

        <div class="row">
            <div class="text-center">
                <?php
                // rassembler les valeurs dans un tableau en une chaine de caractère
                    echo implode('', $myFight);
                    ?>
            </div>
        </div>

    </main>
    <footer class="container-fluid bg-dark p-0">
        <p class="text-white text-center p-3 m-0">Duel du héros contre l'orc <br>@ 2024 all rights reserved
        </p>
    </footer>
</body>

<!-- fichier js-->
<script>
    let winner  = "<?=$whoHasWon?>"
</script>
<script src="/public/assets/js/script.js">

</script>
</html>