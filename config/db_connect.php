<?php

//Connection a la database

$conn = mysqli_connect('localhost', 'souley', 'sousou', 'souley-pizza');

//verification de la connection
if (!$conn) {
    echo 'Echec de la connexion' . mysqli_connect_error();
}

?>