<?php
include('config/db_connect.php');

if (isset($_POST['id_to_delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);
    $sql = "DELETE FROM pizzas WHERE id=$id_to_delete";

    if(mysqli_query($conn, $sql)) {
        header('Location: index.php');
    } else {
        echo 'Erreur de requete sql' . mysqli_error($conn);
    }

}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //requete
    $sql = "SELECT * FROM pizzas WHERE id=$id";

    // GET les resultats

    $result = mysqli_query($conn, $sql);

    // Fetch les resultats en array

    $pizza = mysqli_fetch_assoc($result);


    //liberer
    mysqli_free_result($result);

    //fermer la connexion à la bdd
    mysqli_close($conn);

}





?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<div class="container center">

    <?php if ($pizza) : ?>
        <h4><?php echo htmlspecialchars($pizza['titre']); ?></h4>
        <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
        <p><?php echo date($pizza['created_at']);  ?></p>
        <h5>Ingredients:</h5>
        <p><?php echo htmlspecialchars($pizza['ingredients']);  ?></p>


    <!-- Suppression -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
            <input type="submit" name="delete" value="Supprimer" class="btn brand z-depth-0">
        </form>
    

    <?php else : ?>
        <h4>Cette page n'existe pas</h4>
    <?php endif; ?>
</div>

</div>

<?php include('templates/footer.php') ?>


</html>