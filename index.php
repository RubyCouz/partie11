<?php
//defintion de la regex qui va controler que les saisies ne comportent que des caractères décimaux
$numberPattern = '#^(\d+\.\d+)|(\d+)$#';
//définition de la variable affichant le résutat
$result = 0;
// conditions pour la réinitialisation du formulaire
if (!empty($_POST['reset'])) {
    $reset = $_POST['reset'];

    if (($reset == true)) {
        $_POST['number1'] = ' ';
        $_POST['number2'] = ' ';
        $result = 0;
    }
}

//association des variables number aux 2 chiffres saisis si le formulaire à bien été envoyé et si les valeurs sont présentes
    if (!empty($_POST['number1'])) {
        $number1 = $_POST['number1'];
    } else { //si valeur 1 est absente
        ?>
        <?php $result = 'Veuillez saisir un premier nombre'; ?>
        <?php
    }
    if (!empty($_POST['number2'])) {
        $number2 = $_POST['number2'];
    } else { // si valeur 2 est absente 
        ?>
        <?php $result = 'veuillez saisir le deuxième nombre'; ?>
        <?php
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Calculatrice</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css" />   
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"  />
        <link rel="stylesheet" href="assets/css/style.css" />
    </head>
    <body>
        <div class="container" id="#">
            <h1>Une calculatrice en PHP</h1>
            <form action="index.php" method="POST">
                <div class="row" id="#">
                    <div class="col s12 m12 l6" id="#">
                        <label for="number1">Premier chiffre</label>
                        <input type="text" name="number1" id="number1" value="<?= (empty($_POST['number1'])) ? '' : $number1 ?>"placeholder="Chiffre 1" />
                    </div>
                    <div class="col s12 m12 l6" id="#">
                        <label for="number2">Deuxième chiffre</label>
                        <input type="text" name="number2" id="number2" value="<?= (empty($_POST['number2'])) ? '' : $number2 ?>"placeholder="Chiffre 2" />                    
                    </div>
                </div>
                <div class="row" id="#">
                    <div class="col s3 m3 l3 center-align" id="#">
                        <input class="btn waves-effect waves-light" type="submit" name="sum" value="+" />
                    </div>
                    <div class="col s3 m3 l3 center-align" id="#">
                        <input class="btn waves-effect waves-light" type="submit" name="substraction" value="-" />
                    </div>
                    <div class="col s3 m3 l3 center-align" id="#">
                        <input class="btn waves-effect waves-light" type="submit" name="multiplication" value="*" />
                    </div>
                    <div class="col s3 m3 l3 center-align" id="#">
                        <input class="btn waves-effect waves-light" type="submit" name="division" value="/" />
                    </div>
                </div>
                <div class="row" id="#">
                    <div class="col s12 m12 l12 center-align" id="button">
                        <input class="btn red darken-4 waves-effect waves-light" type="submit" name="reset" value="Reset" />
                    </div>                    
                </div>
            </form>
            <?php
            if ((!empty($_POST['number1'])) && (!empty($_POST['number2']))) {
                if ((preg_match($numberPattern, $number1)) && (preg_match($numberPattern, $number2))) {
                    // conditions pour la division vérifiant la présence du signe en récupérant sa valeur dans l'input
                    if (!empty($_POST['division'])) {
                        //définition de la variable d'opération en fonction de la valeur récupérée
                        $division = $_POST['division'];
                        // condition si le 2eme chiffre est égale à 0 => division impossible par 0
                        if (($division == '/') && ($number2 == 0)) {
                            $result = 'division impossible';
                            //sinon opération possible
                        } else {
                            $result = $number1 / $number2;
                        }
                        // conditions pour la somme vérifiant la présence du signe en récupérant sa valeur dans l'input
                    } elseif (!empty($_POST['sum'])) {
                        //définition de la variable d'opération en fonction de la valeur récupérée
                        $sum = $_POST['sum'];
                        if ($sum == '+') {
                            $result = $number1 + $number2;
                        }
                        // conditions pour la soustraction vérifiant la présence du signe en récupérant sa valeur dans l'input
                    } elseif (!empty($_POST['substraction'])) {
                        //définition de la variable d'opération en fonction de la valeur récupérée
                        $substraction = $_POST['substraction'];
                        if ($substraction == '-') {
                            $result = $number1 - $number2;
                        }
                        // conditions pour la multiplication vérifiant la présence du signe en récupérant sa valeur dans l'input
                    } elseif (!empty($_POST['multiplication'])) {
                        //définition de la variable d'opération en fonction de la valeur récupérée
                        $multiplication = $_POST['multiplication'];
                        if ($multiplication == '*') {
                            $result = $number1 * $number2;
                        }
                    }
                } elseif ($reset == true) {
                    $resultat = ' ';
                } else {
                
                    ?>
                    <span class="error"><?php $result = 'Veuillez utiliser des valeurs décimales'; ?></span>
                    <?php
                }
            }
            ?>
            <p>Résultat : <?= (empty($_POST['number1']) && empty($_POST['number2'])) ? '' : $result // affichage du résultat après opération    ?> </p>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
        <script src="assets/js/script.js"></script>
    </body>
</html>