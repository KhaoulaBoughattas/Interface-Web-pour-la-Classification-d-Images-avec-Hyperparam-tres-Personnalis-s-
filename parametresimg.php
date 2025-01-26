<?php
// Enable error management
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection information
$host = 'localhost';
$dbName = 'image_classification';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}

// Initialize messages and results
$messages = [];
$resultContent = null;
$resultGraph = null;

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // File upload handling
    $uploadDirectory = 'uploads/';
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    if (isset($_FILES['directoryUpload'])) {
        foreach ($_FILES['directoryUpload']['name'] as $key => $filename) {
            $tmpFilePath = $_FILES['directoryUpload']['tmp_name'][$key];
            if ($tmpFilePath) {
                $destinationPath = $uploadDirectory . basename($filename);
                if (move_uploaded_file($tmpFilePath, $destinationPath)) {
                    $stmt = $pdo->prepare("INSERT INTO uploaded_files (file_name, upload_path) VALUES (:file_name, :upload_path)");
                    $stmt->execute([
                        ':file_name' => $filename,
                        ':upload_path' => $destinationPath
                    ]);
                    $messages[] = "File '$filename' uploaded successfully.";
                } else {
                    $messages[] = "Error uploading: " . htmlspecialchars($filename);
                }
            }
        }
    } else {
        $messages[] = "No files selected for upload.";
    }

    // Hyperparameter validation
    $learningRate = filter_input(INPUT_POST, 'learningRate', FILTER_VALIDATE_FLOAT);
    $batchSize = filter_input(INPUT_POST, 'batchSize', FILTER_VALIDATE_INT);
    $epochs = filter_input(INPUT_POST, 'epochs', FILTER_VALIDATE_INT);
    $dropoutRate = filter_input(INPUT_POST, 'dropoutRate', FILTER_VALIDATE_FLOAT);
    $optimizer = filter_input(INPUT_POST, 'optimizer', FILTER_SANITIZE_STRING);
    $lossFunction = filter_input(INPUT_POST, 'lossFunction', FILTER_SANITIZE_STRING);

    if ($learningRate && $batchSize && $epochs && $dropoutRate !== false && $optimizer && $lossFunction) {
        $stmt = $pdo->prepare("INSERT INTO hyperparameters (learning_rate, batch_size, epochs, dropout_rate, optimizer, loss_function) VALUES (:learning_rate, :batch_size, :epochs, :dropout_rate, :optimizer, :loss_function)");
        $stmt->execute([
            ':learning_rate' => $learningRate,
            ':batch_size' => $batchSize,
            ':epochs' => $epochs,
            ':dropout_rate' => $dropoutRate,
            ':optimizer' => $optimizer,
            ':loss_function' => $lossFunction
        ]);

        // Call Python script
        $command = escapeshellcmd("python3 process_images.py $learningRate $batchSize $epochs $dropoutRate $optimizer $lossFunction");
        $output = shell_exec($command);

        if ($output) {
            $resultFile = 'results/output.txt';
            $graphFile = 'results/graph.png';
            if (!is_dir('results/')) {
                mkdir('results/', 0777, true);
            }
            file_put_contents($resultFile, $output);
            $resultContent = $output;

            // Check if graph exists
            if (file_exists($graphFile)) {
                $resultGraph = $graphFile;
            }

            $messages[] = "Processing completed successfully.";
        } else {
            $messages[] = "Error executing Python script.";
        }
    } else {
        $messages[] = "Invalid hyperparameters provided.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Classification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Image Classification System</h1>
        
        <?php foreach ($messages as $message): ?>
            <p class="text-success"><?= htmlspecialchars($message) ?></p>
        <?php endforeach; ?>

        <?php if ($resultContent): ?>
            <hr>
            <h2>Results</h2>
            <pre class="bg-light p-3 rounded">Results:
<?= htmlspecialchars($resultContent) ?></pre>
            <?php if ($resultGraph): ?>
                <img src="<?= $resultGraph ?>" alt="Performance Graph" class="img-fluid mt-3">
            <?php endif; ?>
            <a href="results/output.txt" class="btn btn-success mt-3" download="output.txt">Download Results</a>
            <a href="#" class="btn btn-primary mt-3">Save Results</a>
        <?php endif; ?>
    </div>
</body>
</html>