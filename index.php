<?php
require_once 'db.php';

// Haal alle games op uit de database
$stmt = $pdo->query("SELECT * FROM games ORDER BY id DESC");
$games = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>GameSpark Overzicht</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f9; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; vertical-align: middle; }
        th { background: #007bff; color: white; }
        img.game-cover { width: 60px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; }
        a.btn { background: #28a745; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 15px; }
        a.btn-edit { background: #ffc107; color: black; padding: 5px 8px; text-decoration: none; border-radius: 4px; margin-right: 5px; font-weight: bold; }
        a.btn-del { background: #dc3545; color: white; padding: 5px 8px; text-decoration: none; border-radius: 4px; }
        a.btn-del:hover { background: #c82333; }
    </style>
</head>
<body>

    <h2>GameSpark - Game Overzicht (Read)</h2>
    <a href="create.php" class="btn">+ Nieuwe Game Toevoegen</a>

    <table>
        <tr>
            <th>Afbeelding</th>
            <th>Naam</th>
            <th>Platform</th>
            <th>Genre</th>
            <th>Jaar</th>
            <th>Status</th>
            <th>Rating</th>
            <th>Acties</th>
        </tr>
        <?php foreach ($games as $game): ?>
        <tr>
            <td>
                <?php if (!empty($game['afbeelding_url'])): ?>
                    <img src="<?= htmlspecialchars($game['afbeelding_url']) ?>" alt="Cover" class="game-cover">
                <?php else: ?>
                    <span>Geen afbeelding</span>
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($game['naam']) ?></td>
            <td><?= htmlspecialchars($game['platform']) ?></td>
            <td><?= htmlspecialchars($game['genre']) ?></td>
            <td><?= htmlspecialchars($game['releasejaar']) ?></td>
            <td><?= htmlspecialchars($game['status']) ?></td>
            <td><?= htmlspecialchars($game['rating']) ?>/10</td>
            <td>
                <a href="update.php?id=<?= $game['id'] ?>" class="btn-edit">Bewerken</a>
                <a href="delete.php?id=<?= $game['id'] ?>" class="btn-del" onclick="return confirm('Weet je zeker dat je deze game wilt verwijderen?');">Verwijderen</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>