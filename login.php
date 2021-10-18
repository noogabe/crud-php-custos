<?php
/*Criação dos objetos pro banco de dados e para as funções da classe Menu*/
include_once('menu.php');
$menu = new Menu();

?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>

    <title>Custo - Login</title>
    <?php $menu->getHead(); ?>
    <link rel='stylesheet' type='text/css' href='css/style-login.css' media='screen' />

</head>

<body>

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <span class="material-icons"  style="font-size: 80px;" id="icon" alt="User Icon">
                    account_circle
                </span>
                <legend>
                    <h3>Entre com seus dados:</h3>
                </legend>
            </div>

            <!-- Login Form -->
            <form method="post" action="confirma.php">
                <input type="text" id="login" class="fadeIn second" name="usuario" id="usuario" placeholder="Digite seu usuário" required>
                <input type="password" id="password" class="fadeIn third" name="senha" id="senha" placeholder="Digite sua senha" required>
                <input type="submit" class="fadeIn fourth" id="btn_entrar" name="btn_entrar" value="Entrar">
            </form>

        </div>
    </div>



    <?php $menu->getFooter(); ?>

</body>

</html>