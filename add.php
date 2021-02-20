<?php

include('config/db_connect.php');

$titre = $email = $ingredients = "";
$erreurs = array('email'=>'','titre' => '','ingredients' => '');
if (isset($_POST['submit'])) {

    //check email
    if (empty($_POST['email'])) {
        $erreurs['email'] = 'Un email est necessaire';
    } else {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs['email'] =  'le mail doit être valide';
        }
    }

    //check titre
    if (empty($_POST['titre'])) {
        $erreurs['titre'] = 'Un titre est necessaire';
    } else {
        $titre = $_POST['titre'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $titre)) {
            $erreurs['titre'] = 'le titre doit être écris en lettre et avec des espaces(facultatifs) seulement';
        }
    }

    //check ingredients
    if (empty($_POST['ingredients'])) {
        $erreurs['ingredients'] = 'Un ingrédient au moins est necessaire';
    } else {
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $erreurs['ingredients'] = 'les ingrédients doivent être séparés par des virgules';
        }
    }

    if(array_filter($erreurs)) {

    } else {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $titre = mysqli_real_escape_string($conn, $_POST['titre']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //requete insert

        $sql= "INSERT INTO pizzas(titre,email,ingredients) VALUES('$titre', '$email', '$ingredients')";

        // inserer dans la db

        if(mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'query error: ' . mysqli_error($sonn);
        }

        //redirection vers index.php
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<section class="container grey-text">
    <h4 class="center">Ajouter une pizza</h4>
    <form action="add.php" method="POST" class="white">
        <label for="">Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="red-text"><?php echo $erreurs['email']; ?></div>
        <label for="">Nom du Pizza:</label>
        <input type="text" name="titre" value="<?php echo htmlspecialchars($titre); ?>">
        <div class="red-text"><?php echo $erreurs['titre']; ?></div>
        <label for="">Ingrédients (séparé par des virgules):</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
        <div class="red-text"><?php echo $erreurs['ingredients']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="Ajouter" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php') ?>

</html>