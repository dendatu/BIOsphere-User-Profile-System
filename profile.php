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

    /* -------- HANDLE IMAGE UPLOAD -------- */

    if(isset($_POST["submit"])){

        if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0){

            $allowedTypes = ["jpg","jpeg","png","gif"];
            $target_dir = "uploads/";
            $fileName = basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            /* Validate file type */
            if(!in_array($imageFileType,$allowedTypes)){
                $message = "Only image files (JPG, JPEG, PNG, GIF) can be uploaded.";
            }

            else{

                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

                if($check === false){
                    $message = "The selected file is not a valid image.";
                }

                else if($_FILES["fileToUpload"]["size"] > 10000000){
                    $message = "File is too large. Maximum size is 10MB.";
                }

                else{

                    $target_file = $target_dir.$fileName;

                    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)){

                        $conn->query("UPDATE users SET profile_pic='$fileName' WHERE id='$id'");
                        header("Location: profile.php");
                        exit();

                    }else{
                        $message = "Upload failed. Please try again.";
                    }

                }

            }

        }

    }

    /* -------- FETCH USER -------- */

    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
?>

<?php include "includes/header.php"; ?>

<div class="profile-page">

<div class="profile-cover">

<?php
    if($user['profile_pic']){
        echo "<img class='profile-avatar' src='uploads/".$user['profile_pic']."'>";
    }else{
        echo "<img class='profile-avatar' src='https://via.placeholder.com/160'>";
    }
?>

</div>

<div class="profile-info">

<h1><?php echo htmlspecialchars($user['full_name']); ?></h1>

<div class="skills">
<b>Skills:</b><br>
<?php echo htmlspecialchars($user['skills']); ?>
</div>

<h3 style="margin-top:20px;">Update Profile Picture</h3>

<form method="POST" enctype="multipart/form-data">

<input type="file" name="fileToUpload" id="fileUpload" required>

<img id="preview" class="preview-img">

<p id="fileMessage" class="message"></p>

<button name="submit">Upload</button>

</form>

<?php if($message!=""){ ?>
<p class="message"><?php echo $message; ?></p>
<?php } ?>

<h3 style="margin-top:20px;">Edit Profile Information</h3>

<a href="edit_profile.php">
<button type="button" class="secondary">Edit Profile</button>
</a>

</div>

</div>

<script>

/* -------- IMAGE PREVIEW VALIDATION -------- */

const fileUpload = document.getElementById("fileUpload");
const preview = document.getElementById("preview");
const message = document.getElementById("fileMessage");

if(fileUpload){

fileUpload.addEventListener("change",function(){

const file = this.files[0];

if(!file) return;

const allowedTypes = ["image/jpeg","image/png","image/gif","image/jpg"];

if(!allowedTypes.includes(file.type)){

preview.style.display="none";
preview.src="";
message.innerText = "This file cannot be previewed or uploaded because it is not a photo.";

this.value="";

return;

}

message.innerText = "";

const reader = new FileReader();

reader.onload = function(e){

preview.src = e.target.result;
preview.style.display="block";

};

reader.readAsDataURL(file);

});

}

</script>

<?php include "includes/footer.php"; ?>