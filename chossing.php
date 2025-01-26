<?php
// Configuration de la base de données
$host = 'localhost';
$dbName = 'image_classification';
$username = 'root';
$password = ''; // Mettez ici le mot de passe de votre base de données
$conn = new mysqli($host, $username, $password, $dbName);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Répertoire où les images seront enregistrées
$uploadDir = 'uploads/';

// Création du répertoire si inexistant
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['imageUpload']['name'][0])) {
        $filePaths = [];
        foreach ($_FILES['imageUpload']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['imageUpload']['name'][$key]);
            $targetFilePath = $uploadDir . $fileName;

            // Vérification et déplacement du fichier
            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $filePaths[] = $targetFilePath;

                // Sauvegarder le chemin dans la base de données
                $stmt = $conn->prepare("INSERT INTO images (path) VALUES (?)");
                $stmt->bind_param("s", $targetFilePath);

                if (!$stmt->execute()) {
                    echo "Erreur : Impossible d'enregistrer le fichier $fileName dans la base de données.";
                }
                $stmt->close();
            } else {
                echo "Erreur : Impossible de télécharger le fichier $fileName.";
            }
        }
    } else {
        echo "Aucune image sélectionnée.";
    }

    // Traitement des images dans le répertoire
    $imageFiles = glob($uploadDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    foreach ($imageFiles as $imagePath) {
        // Exécuter le script Python pour chaque image
        $command = escapeshellcmd("python3 process_image.py '$imagePath'");
        $output = shell_exec($command);  // Capturer le résultat du script Python

        // Sauvegarder le résultat de la classification dans la base de données
        $stmt = $conn->prepare("UPDATE images SET classification_result = ? WHERE path = ?");
        $stmt->bind_param("ss", $output, $imagePath);
        $stmt->execute();
        $stmt->close();

        // Afficher le résultat de la classification (peut être sauvegardé ou affiché)
        echo "Image: $imagePath - Résultat de la classification : $output<br>";
    }
} else {
    echo "Requête invalide.";
}

$conn->close();
?>
