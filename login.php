<?php
    require_once("bootstrap.php");

if(!empty($_POST)){
    //htmlspecialchars against MySQL Injection
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    //Both email and are password empty.
    if(empty($email) && empty($password)){
        $errEmail = true;
        $errPassword = true;
    }
    //Only email is empty.
    else if(empty($email)){
        $errEmail = true;
    }
    //Only password is empty.
    else if(empty($password)){
        $errPassword = true;
    }
    //Everything is filled in.
    else{
        $u = new User();
        $isLogged = $u->login($email, $password);
        $u->setEmail($email);
        $id = $u->getUserID();

        //Check if user can log in.
        if($isLogged){
            $u->setEmail($email);
            $userId = $u->getUserId();
            Session::create($userId);
            header("Location: index.php");
        }
        //Unable to log in.
        else{
            $err = true;
        }
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type = "text/css" href = "css/reset.css"/>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css"/>

    <title>TodoApp - login</title>

</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
        <h1>Log in</h1>
    </header>
    <main>
    <form action="" method="post" class="login">
        <?php if(isset($errEmail) && isset($errPassword)): ?>
            <div>
                <p>Both fields can not be empty.</p>
            </div>
        <?php endif; ?>
        <?php if(isset($errEmail) && !isset($errPassword)): ?>
            <div>
                <p>The email address you gave can not be empty.</p>
            </div>
        <?php endif; ?>
        <?php if(isset($errPassword) && !isset($errEmail)): ?>
            <div>
                <p>The password you gave can not be empty.</p>
            </div>
        <?php endif; ?>
        <?php if(isset($err)): ?>
            <div>
                <p>The email address and/or password you entered is invalid.</p>
            </div>
        <?php endif; ?>
        <input type="text" name="email" id="email" placeholder="Email"><br>

        <input type="password" name="password" id="password" placeholder="password"><br>

        <input type="submit" value="Sign in"><br>

        <a href="register.php" class="link_register">No account yet? Register now!</a>
    </form>
    </main>
    <footer>

    </footer>

</body>
</html>