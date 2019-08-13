<?php
    require_once("bootstrap.php");
// check if all fields have input
if(!empty($_POST)) {
    // mysql_real_escape_string() against MySQL Injection
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $c_password = htmlspecialchars($_POST['password_confirmation']);


    if ( !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) ) {

        if ( !empty($_POST['password']) && !empty($_POST['password_confirmation']) ) {

            if ( $password == $c_password ) {
                
                $user = new User();
                $u = $user->isAccountAvailable($email);
                
                if ($u == 0) {
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPassword($password);

                    if ( $user->register() ) {
                        $userId = $user->getUserID();
                        Session::create($userId);
                        header("Location: index.php");
                    } else {
                        $errLogin = "Sign up failed.";
                    }
                } else {
                $feedback = "You already have an account.";
                }
            } else {
                $feedback = "Password is incorrect.";
            }
        } else {
            $feedback = "Password cannot be empty.";
        }
    } else {
        $feedback = "Personal details cannot be empty.";
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

    <title>TodoApp - register</title>

</head>
<body>
    <header>
        <?php require_once("nav.inc.php"); ?>
        <h1>Register now</h1>
    </header>
    <main>
    <form action="" method="post" class="register">
        <?php if(isset($feedback)): ?>
            <div>
                <p><?php echo $feedback; ?></p>
            </div>
        <?php endif; ?>
        <?php if(isset($feedbackS)): ?>
            <div>
                <p><?php echo $feedbackS; ?></p>
                <a href="login.php">Click here to log in.</a>
            </div>
        <?php endif; ?>
        <?php if(isset($errLogin)): ?>
            <div>
                <p><?php echo $errLogin; ?></p>
            </div>
        <?php endif; ?>
                <input type="text" id="firstname" name="firstname" placeholder="Firstname"><br>

                <input type="text" id="lastname" name="lastname" placeholder="Lastname"><br>

                <input type="text" id="username" name="username" placeholder="Username"><br>

                <input type="text" id="email" name="email" placeholder="Email"><br>
         
                <input type="password" id="password" name="password" placeholder="Password"><br>
         
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Password confirmation"><br>
          
                <input type="submit" value="Register"><br>
                <a href="login.php" class="link_register">Already have an account?</a>
    </form>
    </main>
    <footer>

    </footer>

</body>
</html>