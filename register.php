<?php
    session_start();
    include "db.php";

    $message = "";
    $errors = [];

    $fullname = "";
    $username = "";
    $skills   = "";

    if(isset($_POST['register'])){

        $fullname = trim($_POST['fullname']);
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $skills   = trim($_POST['skills']);

        /* --- CHECK EMPTY FIELDS --- */
        if($fullname == "" || $username == "" || $password == "" || $confirm_password == "" || $skills == ""){
            $errors[] = "All fields are required.";
        }

        /* --- USERNAME / EMAIL VALIDATION --- */
        $usernamePattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        if(!preg_match($usernamePattern, $username)){
            $errors[] = "Username must be a valid email address.";
        }

        /* --- PASSWORD VALIDATION --- */
        $passwordPattern = "/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W]).{8,}$/";
        if(!preg_match($passwordPattern, $password)){
            $errors[] = "Password must be at least 8 characters and include one uppercase letter, one number, and one special character.";
        }

        /* --- CONFIRM PASSWORD VALIDATION --- */
        if($password !== $confirm_password){
            $errors[] = "Password and Confirm Password do not match.";
        }

        /* --- CHECK IF USERNAME EXISTS --- */
        $checkUser = $conn->query("SELECT id FROM users WHERE username='$username'");
        if($checkUser && $checkUser->num_rows > 0){
            $errors[] = "Username/Email already exists. Please choose another.";
        }

        /* --- HANDLE ERRORS OR INSERT USER --- */
        if(!empty($errors)){
            $message = implode("<br>", $errors);
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users(username,password,full_name,skills)
                    VALUES('$username','$hashedPassword','$fullname','$skills')";

            if($conn->query($sql)){
                $message = "Registration successful! You may now login.";
                // Clear input fields after successful registration
                $fullname = $username = $skills = "";
            } else {
                $message = "Something went wrong. Please try again.";
            }
        }
    }
?>

<?php $currentPage="register"; include "includes/header.php"; ?>

<div class="card">

    <h2>Create your account</h2>

    <form method="POST">

        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input 
                type="text" 
                id="fullname"
                name="fullname" 
                placeholder="(e.g., Juan Dela Cruz)" 
                value="<?php echo htmlspecialchars($fullname); ?>" 
                required>
        </div>

        <div class="form-group">
            <label for="username">Username / Email</label>
            <input 
                type="text" 
                id="username"
                name="username" 
                placeholder="(e.g., juan@email.com)" 
                value="<?php echo htmlspecialchars($username); ?>" 
                required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password"
                name="password" 
                placeholder="(e.g., StrongPass1!)" 
                required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input 
                type="password" 
                id="confirm_password"
                name="confirm_password" 
                placeholder="Re-enter your password" 
                required>
        </div>

        <div class="form-group">
            <label for="skills">Your Skills</label>
            <textarea 
                id="skills"
                name="skills" 
                placeholder="(e.g., Java, Web Design, Graphic Design)" 
                required><?php echo htmlspecialchars($skills); ?></textarea>
        </div>

        <button name="register">Register</button>

    </form>

    <p class="message"><?php echo $message; ?></p>

    <a class="link" href="login.php">Already have an account? Log in here.</a>

    <!-- Back to Home Button -->
         <br>
    <a href="index.php" style="display:inline-block; margin-top:12px;">
        <button type="button" class="secondary">Back to Home</button>
    </a>

</div>

<?php include "includes/footer.php"; ?>