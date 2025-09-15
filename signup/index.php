<?php
require_once '../conn.php';

// Rediriger si l'utilisateur est déjà connecté
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../dashboard.php");
    exit;
}

$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validation du nom d'utilisateur
    if(empty(trim($_POST["username"]))){
        $username_err = "Veuillez entrer un nom d'utilisateur.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Ce nom d'utilisateur est déjà pris.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oups! Une erreur est survenue. Veuillez réessayer plus tard.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validation de l'email
    if(empty(trim($_POST["email"]))){
        $email_err = "Veuillez entrer une adresse email.";
    } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
        $email_err = "Format d'email invalide.";
    } else{
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST["email"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Cet email est déjà utilisé.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oups! Une erreur est survenue. Veuillez réessayer plus tard.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validation du mot de passe
    if(empty(trim($_POST["password"]))){
        $password_err = "Veuillez entrer un mot de passe.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Le mot de passe doit contenir au moins 6 caractères.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validation de la confirmation du mot de passe
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Veuillez confirmer le mot de passe.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Les mots de passe ne correspondent pas.";
        }
    }
    
    // Vérification des erreurs avant insertion en base de données
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'Client')";
         
        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
            
            // Définition des paramètres
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Création d'un hash du mot de passe
            
            if(mysqli_stmt_execute($stmt)){
                // Redirection vers la page de connexion
                header("location: success.php");
            } else{
                echo "Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - GoldenAxe</title>
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
        }
        .wrapper { 
            width: 350px; 
            padding: 20px; 
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group { margin-bottom: 15px; }
        .help-block { color: #a94442; }
        .page-header { margin-top: 0; }
        .login-link { text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2 class="page-header">Créer un compte</h2>
        <p>Veuillez remplir ce formulaire pour créer un compte.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmer le mot de passe</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="S'inscrire">
                <input type="reset" class="btn btn-default" value="Réinitialiser">
            </div>
            <p>Vous avez déjà un compte? <a href="../index.php">Connectez-vous ici</a>.</p>
        </form>
    </div>    
</body>
</html>
