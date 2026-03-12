<?php
    session_start();
    include "db.php";

    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }

    $currentPage = "profile";
    $id = $_SESSION['user_id'];

    /* --- Handle Profile Picture Upload --- */
    if(isset($_POST["submit"])){

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check === false){ $uploadOk = 0; }

        if($_FILES["fileToUpload"]["size"] > 10000000){ $uploadOk = 0; }

        if(!in_array($imageFileType, ['jpg','jpeg','png','gif'])){ $uploadOk = 0; }

        if($uploadOk == 1){
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                $filename = basename($_FILES["fileToUpload"]["name"]);
                $conn->query("UPDATE users SET profile_pic='$filename' WHERE id='$id'");
                header("Location: profile.php");
                exit();
            }
        }

    }

    /* --- Fetch User Info --- */
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
?>

<?php include "includes/header.php"; ?>

<div class="profile-page">

    <!-- Profile Cover and Avatar -->
    <div class="profile-cover">
        <?php
        if($user['profile_pic']){
            echo "<img class='profile-avatar' src='uploads/".$user['profile_pic']."'>";
        } else {
            echo "<img class='profile-avatar' src='https://via.placeholder.com/160'>";
        }
        ?>
    </div>

    <!-- Profile Info Section -->
    <div class="profile-info">
        <h1><?php echo htmlspecialchars($user['full_name']); ?></h1>

        <div class="skills">
            <b>Skills:</b><br>
            <?php echo htmlspecialchars($user['skills']); ?>
        </div>

        <!-- Upload Profile Picture -->
        <h3 style="margin-top:20px;">Update Profile Picture</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileUpload" required>
            <img id="preview" class="preview-img">
            <button name="submit">Upload</button>
        </form>

        <!-- Edit Profile Button -->
        <h3 style="margin-top:20px;">Edit Profile Information</h3>
        <a href="edit_profile.php">
            <button type="button" class="secondary">Edit Profile</button>
        </a>
    </div>

</div>

<script>
/* --- Preview Uploaded Image --- */
const fileUpload = document.getElementById("fileUpload");
if(fileUpload){
    fileUpload.addEventListener("change", function(){
        const file = this.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(e){
                const preview = document.getElementById("preview");
                preview.src = e.target.result;
                preview.style.display="block";
            };
            reader.readAsDataURL(file);
        }
    });
}
</script>

<?php include "includes/footer.php"; ?>