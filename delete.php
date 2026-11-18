<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Veilige delete query met prepared statement om SQL-injectie te voorkomen
    $sql = "DELETE FROM games WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

// Stuur de gebruiker direct terug naar het overzichtsscherm
header("Location: index.php");
exit;
?>