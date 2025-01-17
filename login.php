<?php
    if (isset($_SESSION["login"])) {
        header("Location:index.php");
        exit();
    }

    $username_cookie = '';
    $password_cookie = '';
    $set_remember = '';

    if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
        $username_cookie = $_COOKIE['username'];
        $password_cookie = $_COOKIE['password'];
        $set_remember = "checked = 'checked'";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login_regis.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src = "./js/login_regis.js"></script>
    <title>Login</title>
</head>

<body>
    <section class="container">
        <h1>Login <span><span style="background: url(https://cdn.textures4photoshop.com/tex/thumbs/seamless-galaxy-with-stars-texture-for-photoshop-thumb48.jpg) no-repeat center center;-webkit-background-clip: text; -webkit-text-stroke: 0.5px #fff; color: transparent; background-size: cover;">KOM</span>Space</span></h1>
        <form action="process_login.php" method="POST">
            <div class="txt_field password-field">
                <input type="text" name="username" id="user" placeholder="Username" value="<?php echo $username_cookie?>"required>
                <ion-icon name="person-circle-sharp" style="height: 30px;"></ion-icon>
            </div>

            <div class="txt_field">
                <input type="password" name="password" placeholder="Password" id="password" value="<?php echo $password_cookie?>" required>
                <img src="./img-2/eye_close.png" id="eyeicon" onclick="myFunction()">
            </div>

            <div class="pass">
                <div class="remember-me">
                    <input type="checkbox" name="remember_me" id="me"<?php echo $set_remember?>>
                    <label for="remember_me">Remember me</label>
                </div>
            </div>
            <div class="txt_field button">
                <input type="submit" name="login" value="Login">
            </div>

            <div class="link">
                <h3>Belum punya akun? &nbsp; <a href="register.php">Sign up</a> </h3>
            </div>
        </form>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        function myFunction(){
            var eyeicon = document.getElementById ("eyeicon");
            var password = document.getElementById ("password");
        
            if (password.type === "password"){
                password.type = "text";
                eyeicon.src = "./img-2/eye_open.png";
            }
            else{
                password.type = "password";
                eyeicon.src = "./img-2/eye_close.png";
            }
        }
    </script>
</body>

</html>


