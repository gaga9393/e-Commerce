<?php

    require_once "inc/header.php";
    require_once "app/classes/User.php";

    if($user->is_logged()){
        header("Location: index.php");
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        //user smo napravili u header-u
        $created = $user->create($name,$username,$email,$password);

        if($created){
            $_SESSION['message']['type'] = "success"; //success ili danger
            $_SESSION['message']['text'] = "Uspesno registrovan nalog";
            header("Location: index.php");
            exit();
        }else{
            $_SESSION['message']['type'] = "danger";
            $_SESSION['message']['text'] = "Greska";
            header("Location: register.php");
            exit();
        }
    }

?>


    <h1 class="mt-5 mb-3">Registracija</h1>
    <form method="POST" action="">
        <div class="form-group mb-3">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group mb-3">
            <label for="name">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group mb-3">
            <label for="name">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group mb-3">
            <label for="name">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>

<?php require_once 'inc/footer.php'; ?>    


