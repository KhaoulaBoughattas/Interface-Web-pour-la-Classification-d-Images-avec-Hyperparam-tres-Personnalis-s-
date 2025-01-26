<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$dbname = 'image_classification';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérification des données POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validation des entrées
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Requête pour vérifier si l'utilisateur existe
        $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Connexion réussie, stockage dans la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Redirection vers la page des services
            header("Location: services.php");
            exit();
        } else {
            // Échec de connexion : email ou mot de passe incorrect
            echo "<script>alert('Email ou mot de passe incorrect.'); window.location.href='index.html';</script>";
            exit();
        }
    } else {
        // Échec : champs vides
        echo "<script>alert('Veuillez remplir tous les champs.'); window.location.href='index.html';</script>";
        exit();
    }
} else {
    // Si accès direct au fichier login.php, rediriger vers l'accueil
    header("Location: index.html");
    exit();
}
?>
