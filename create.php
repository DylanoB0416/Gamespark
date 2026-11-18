<?php
require_once 'db.php';

$bericht = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'] ?? '';
    $platform = $_POST['platform'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $releasejaar = $_POST['releasejaar'] ?? '';
    $status = $_POST['status'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $afbeelding_url = $_POST['afbeelding_url'] ?? '';

    if (!empty($naam) && !empty($platform) && !empty($genre)) {
        // Prepared statement om veilig op te slaan
        $sql = "INSERT INTO games (naam, platform, genre, releasejaar, status, rating, afbeelding_url) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$naam, $platform, $genre, $releasejaar, $status, $rating, $afbeelding_url]);

        $bericht = "Game succesvol toegevoegd!";
    } else {
        $bericht = "Vul in ieder geval naam, platform en genre in.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Game Toevoegen - GameSpark</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f9; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 500px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #28a745; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        button:hover { background: #218838; }
        .melding { margin-bottom: 15px; color: green; font-weight: bold; }
        a.terug { display: inline-block; margin-top: 15px; color: #007bff; text-decoration: none; }
        a.terug:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <form action="create.php" method="POST">
        <h2>Game toevoegen (GameSpark)</h2>

        <?php if (!empty($bericht)): ?>
            <div class="melding"><?= htmlspecialchars($bericht) ?></div>
        <?php endif; ?>

        <div>
            <label>Naam game:</label>
            <input type="text" name="naam" required>
        </div>

        <div>
            <label>Platform:</label>
            <input type="text" name="platform" required>
        </div>

        <div>
            <label>Genre:</label>
            <input type="text" name="genre" required>
        </div>

        <div>
            <label>Releasejaar:</label>
            <input type="number" name="releasejaar">
        </div>

        <div>
            <label>Status:</label>
            <select name="status">
                <option value="Nog spelen">Nog spelen</option>
                <option value="Bezig">Bezig</option>
                <option value="Uitgespeeld">Uitgespeeld</option>
            </select>
        </div>

        <div>
            <label>Rating (1-10):</label>
            <input type="number" name="rating" min="1" max="10">
        </div>

        <div>
            <label>Afbeelding URL:</label>
            <input type="text" name="afbeelding_url">
        </div>

        <button type="submit">Opslaan</button>
        <br>
        <a href="index.php" class="terug">← Terug naar overzicht</a>
    </form>

</body>
</html>