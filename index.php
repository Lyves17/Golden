<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclure le fichier de connexion
require_once 'conn.php';

// Initialiser les variables de session pour les messages
if (!isset($_SESSION['status'])) {
    $_SESSION['status'] = '';
    $_SESSION['code'] = '';
}

// Vérifier si le formulaire a été soumis
if(isset($_POST['log'])) {
    // Nettoyer et valider les entrées
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $pass = $_POST["pass"] ?? '';

    // Validation des données
    if(empty($email) || empty($pass)) {
        $_SESSION["status"] = "Veuillez remplir tous les champs";
        $_SESSION["code"] = "error";
        header("Location: index.php");
        exit();
    }

    // Vérifier si la connexion est établie
    if (!isset($con)) {
        die("Erreur de connexion à la base de données");
    }

    // Échapper les données d'entrée pour la sécurité
    $email = mysqli_real_escape_string($con, $email);

    // Préparer et exécuter la requête
    $sql = "SELECT u.*, e.* FROM users u JOIN emp_details e ON e.id = u.id WHERE u.username = '$email' LIMIT 1";
    $result = db_query($sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Vérification du mot de passe (non haché pour compatibilité)
        if($row["password"] === $pass) {
            if($row["status"] === "Active") {
                // Initialiser la session
                $_SESSION["loggedin"] = true;
                $_SESSION["id"]       = $row['id'];
                $_SESSION["type"]     = $row['role'];
                $_SESSION["pass"]     = $row['password'];
                $_SESSION["name"]     = $row['name'];
                $_SESSION['img']      = $row['image'];
                $_SESSION["email"]    = $email;
                $_SESSION["status"]   = "Bienvenue ".htmlspecialchars($row['name']);
                $_SESSION["code"]     = "success";

                // Définir le fuseau horaire
                date_default_timezone_set('Europe/Paris');
                $tms1 = date("Y-m-d H:i:s");
                $_SESSION["time"] = $tms1;

                // Historique de connexion avec mysqli
                $action = 'logged still';
                $sql_history = "INSERT INTO emp_history (id, timestamp, action) VALUES ('".$row['id']."', '".$tms1."', '".$action."')";
                db_query($sql_history);

                header("Location: dashboard.php");
                exit();
            } else {
                $_SESSION["status"] = "This user account is blocked";
                $_SESSION["code"]   = "error";
                header("Location: index.php");
                exit();
            }
        } else {
            // Identifiants invalides
            $_SESSION["status"] = "Nom d'utilisateur ou mot de passe incorrect";
            $_SESSION["code"]   = "error";
            sleep(1); // Délai pour éviter les attaques par force brute
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION["status"] = "Nom d'utilisateur ou mot de passe incorrect";
        $_SESSION["code"]   = "error";
        sleep(1);
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SKY BANK | LOGIN</title>
    <link rel="icon" href="images/icc.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/native-toast.css">
    <meta charset="utf-8">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700&display=swap');
        body {
            background: url('images/ub.jpg') center center / cover no-repeat fixed #464646;
            margin: 15px;
            margin-top: 80px;
        }
        .login-form, .login-form * { box-sizing: border-box; font-family: 'Source Sans Pro'; }
        .login-form { max-width: 350px; margin: 0 auto; border-radius: 5px; overflow: hidden; box-shadow: 0 0 15px rgba(0,0,0,0.15);}
        .login-form__logo-container { padding: 30px; background: rgba(0,0,0,0.25); }
        .login-form__logo { display: block; max-width: 125px; margin: 0 auto; }
        .login-form__content { padding: 30px; background: #eeeeee; }
        .login-form__header { margin-bottom: 15px; text-align: center; color: #333; }
        .login-form__input { width: 100%; margin-bottom: 10px; padding: 10px; border-radius: 5px; border: 2px solid #ddd; background: #fff; outline: none; transition: border-color 0.5s; }
        .login-form__input:focus { border-color: #009578; }
        .login-form__input::placeholder { color: #aaa; }
        .login-form__button { padding: 10px; color: #fff; font-weight: bold; background: #009578; width: 100%; border: none; outline: none; border-radius: 5px; cursor: pointer; }
        .login-form__button:active { background: #008067; }
        .login-form__links { margin-top: 15px; text-align: center; }
        .login-form__link { font-size: 0.9em; color: #008067; text-decoration: none; }
    </style>
</head>
<body>
<form class="login-form" method="POST">
    <div class="login-form__logo-container">
        <h3 style="color: white; text-align: center;">SKY BANK LIMITED PAKISTAN</h3>
    </div>
    <div class="login-form__content">
        <div class="login-form__header">Welcome on Page</div>
        <input class="login-form__input" type="email" name="email" placeholder="Username" required autofocus>
        <input class="login-form__input" type="password" name="pass" placeholder="Password" required>
        <button class="login-form__button" type="submit" name="log">Login</button>
        <div class="login-form__links">
            <a class="login-form__link" href="forget.php">Forgot Password?</a>
        </div>
    </div>
</form>
<script src="js/native-toast.min.js"></script>
<?php if(isset($_SESSION['status']) && $_SESSION['status']!=''){ ?>
<script type="text/javascript">
    nativeToast({
        message: '<?php echo $_SESSION['status']?>',
        position: 'center',
        timeout: 4000,
        type: '<?php echo $_SESSION['code']?>',
        closeOnClick:true
    });
</script>
<?php unset($_SESSION['status']); } ?>
</body>
</html>
