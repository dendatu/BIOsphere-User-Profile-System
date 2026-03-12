<?php
    session_start();
    include "db.php";

    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }

    $currentPage = "profile";
    $id = $_SESSION['user_id'];
    $message = "";

    /* --- Fetch user data --- */
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if(isset($_POST['update'])){

        $fullname = trim($_POST['fullname']);
        $username = trim($_POST['username']);
        $skills = trim($_POST['skills']);
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        $errors = [];

        if($fullname == "" || $username == "" || $skills == ""){
            $errors[] = "Full Name, Username, and Skills are required.";
        }

        /* Validate email format */
        $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        if(!preg_match($emailPattern, $username)){
            $errors[] = "Please enter a valid email address.";
        }

        /* If password change requested */
        if($new_password != ""){
            if(!password_verify($current_password, $user['password'])){
                $errors[] = "Current password is incorrect.";
            }
            if(!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W]).{8,}$/', $new_password)){
                $errors[] = "New password must be at least 8 characters and include one uppercase letter, one number, and one special character.";
            }
            if($new_password !== $confirm_password){
                $errors[] = "New password and confirm password do not match.";
            }
        }

        /* Check if username/email is taken by another user */
        $checkUser = $conn->query("SELECT id FROM users WHERE username='$username' AND id != $id");
        if($checkUser->num_rows > 0){
            $errors[] = "Username/Email already exists. Please choose another.";
        }

        if(empty($errors)){
            $hashedPassword = $user['password'];
            if($new_password != ""){
                $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            }

            $stmt = $conn->prepare("UPDATE users SET full_name=?, username=?, password=?, skills=? WHERE id=?");
            $stmt->bind_param("ssssi", $fullname, $username, $hashedPassword, $skills, $id);
            if($stmt->execute()){
                $message = "Profile updated successfully!";
                header("Refresh:2; url=profile.php");
            } else {
                $message = "Something went wrong. Please try again.";
            }
        } else {
            $message = implode("<br>", $errors);
        }
    }
?>

<?php include "includes/header.php"; ?>

<div class="profile-page">

    <div class="profile-info">
        <h2>Edit Profile</h2>

        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="fullname" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
            </div>

            <div class="form-group">
                <label>Username / Email</label>
                <input type="email" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>

            <div class="form-group">
                <label>Current Password (required if changing password)</label>
                <input type="password" name="current_password" placeholder="Enter current password">
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" placeholder="Enter new password">
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" placeholder="Re-enter new password">
            </div>

            <div class="form-group">
                <label>Skills</label>
                <textarea name="skills" required><?php echo htmlspecialchars($user['skills']); ?></textarea>
            </div>

            <button name="update">Update Profile</button>
        </form>

        <p class="message"><?php echo $message; ?></p>

        <a href="profile.php">
            <button type="button" class="secondary" style="margin-top:10px;">Back to Profile</button>
        </a>
    </div>

</div>

<?php include "includes/footer.php"; ?>