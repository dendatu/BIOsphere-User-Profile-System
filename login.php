<?php
    session_start();
    include "db.php";

    $message="";

    if(isset($_POST['login'])){

    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="SELECT * FROM users WHERE username='$username'";
    $result=$conn->query($sql);

    if($result->num_rows>0){

    $user=$result->fetch_assoc();

    if(password_verify($password,$user['password'])){

        $_SESSION['user_id']=$user['id'];

        header("Location: profile.php");
        exit();

    }else{
        $message="Incorrect password.";
    }

    }else{
        $message="User not found.";
    }

    }
?>

<?php 
    $currentPage="login";
    include "includes/header.php";
?>

    <div class="card">

        <h2>Login to your account</h2>

        <form method="POST">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button name="login">Login</button>

        </form>

        <p class="message"><?php echo $message; ?></p>

        <a class="link" href="register.php">
        Create a new account. Register here.
        </a>

        <!-- Back to Home Button -->
         <br>
    <a href="index.php" style="display:inline-block; margin-top:12px;">
        <button type="button" class="secondary">Back to Home</button>
    </a>

    </div>

<?php include "includes/footer.php"; ?>