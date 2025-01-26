<?php
// Récupérer les hyperparamètres envoyés par l'utilisateur via un formulaire
$learning_rate = isset($_POST['learning_rate']) ? $_POST['learning_rate'] : 0.001;
$batch_size = isset($_POST['batch_size']) ? $_POST['batch_size'] : 32;
$epochs = isset($_POST['epochs']) ? $_POST['epochs'] : 10;

// Commande pour exécuter le script Python
$python_script = "process_images.py";
$command = escapeshellcmd("python $python_script $learning_rate $batch_size $epochs");

// Exécuter le script et capturer la sortie
$output = shell_exec($command);

// Vérifier si le fichier JSON des résultats est créé
$results_file = "results.json";
if (file_exists($results_file)) {
    $results = json_decode(file_get_contents($results_file), true);
} else {
    $results = null;
}

// Afficher l'état et les résultats
?>
<!DOCTYPE html>
<html>
<head>
    <title>Image Processing Results</title>
</head>
<body>
    <h1>Image Classification Results</h1>
    <?php if ($results): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Predicted Class</th>
                    <th>Confidence</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $image => $data): ?>
                    <tr>
                        <td><?= htmlspecialchars($image) ?></td>
                        <td><?= htmlspecialchars($data['Predicted Class']) ?></td>
                        <td><?= number_format($data['Confidence'] * 100, 2) ?>%</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="download_results.php">Download Results</a>
    <?php else: ?>
        <p>Processing failed or no results found.</p>
    <?php endif; ?>
</body>
</html>
