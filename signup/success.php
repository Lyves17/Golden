<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est déjà connecté, si oui, le rediriger vers la page d'accueil
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription réussie - GoldenAxe</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body { 
            font: 14px sans-serif; 
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }
        .wrapper { 
            width: 350px; 
            padding: 20px; 
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .success-icon {
            color: #28a745;
            font-size: 72px;
            margin-bottom: 20px;
        }
        .btn-success {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="success-icon">
            <i class="glyphicon glyphicon-ok-circle"></i>
        </div>
        <h2>Inscription réussie !</h2>
        <p>Votre compte a été créé avec succès.</p>
        <p>Vous pouvez maintenant vous connecter avec vos identifiants.</p>
        <a href="../index.php" class="btn btn-success">Se connecter</a>
    </div>
</body>
</html>
