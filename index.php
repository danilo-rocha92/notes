<?php
require_once __DIR__.'/model/User.php';
require_once __DIR__.'/controller/ControllerUsers.php';

date_default_timezone_set('America/Fortaleza');

if (!isset($_SESSION)) {
    session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if(isset($_POST['usuario'])) {
    $controllerUsers = new ControllerUsers();

    $loginUsername = $_POST['usuario'];
    $password = sha1($_POST['senha']);

    $MM_redirectLoginSuccess = "view/open_notes_list.php";
    $MM_redirectLoginFailed = "?error_login=true";

    $loginValidation = $controllerUsers->authenticationUser($loginUsername, $password);

    if($loginValidation != NULL){
        // BUSCAR DADOS DO USUARIO COM BASE NO LOGIN
        $userData = $controllerUsers->getUserData($loginValidation);

        if($userData != NULL){
            // CRIAR SESSÃO COM OS DADOS DO USUÁRIO
            $_SESSION['SS_UserLogin'] = $loginUsername;
            $_SESSION['SS_UserID'] = $userData['intUserID'];
            $_SESSION['SS_UserGroupID'] = $userData['intGroupID'];
            $_SESSION['SS_UserName'] = $userData['strUserName'];

            //header("Location: ". $MM_redirectLoginSuccess);
        }else{
            $MM_redirectLoginFailed = "?restricted_access=true";
            header("Location: ". $MM_redirectLoginFailed);
        }

    }else{
        header("Location: ". $MM_redirectLoginFailed);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Sistema de Lembretes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="D. S. Rocha">
    <link rel="icon" href="images/favicon.png">
    <link href="css/css.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>

<div id="container-login">
    <div id="box-login">
        <h1>Sistema de Lembretes</h1>
        <?php if(isset($_GET["error_login"])) { ?>
            <span class="alerta falha">O usuário e/ou senha incorreto(s).</span>
        <?php } ?>
        <?php if(isset($_GET["restricted_access"])) { ?>
            <span class="alerta falha">Área restrita, informe seu nome de usuario e senha.</span>
        <?php } ?>
        <form name="form-login" id="form-login" method="POST" action="<?php echo $loginFormAction; ?>">
            <fieldset>
                <legend>Login</legend>

                <div>
                    <label for="usuario">Usuário</label>
                    <input type="text" name="usuario" id="usuario" required>
                </div>

                <div>
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" required>
                </div>

                <input type="submit" name="entrar" id="entrar" class="but" value="Entrar">
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>