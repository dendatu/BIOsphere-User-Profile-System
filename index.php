<?php
  $currentPage="home";
  include "includes/header.php";
?>

<div class="landing">

  <!-- HERO SECTION -->

<section class="hero">

  <div class="hero-text">

    <h1>Your Digital Space<br>for Identity and Skills</h1>

    <p>
      BioSphere allows users to create a personal profile 
      where they can display their basic information, skills, 
      and profile picture in one simple online space.
    </p>

  <div class="hero-buttons">

    <a href="register.php">
    <button class="primary-btn">Create Your Profile</button>
    </a>

    <a href="login.php">
    <button class="secondary-btn">Login</button>
    </a>

  </div>

</div>



</section>


<!-- FEATURES -->

<section class="features">

  <h2>Why Use <span class="highlight-blue">BIOsphere</span>?</h2>

  <div class="feature-grid">

  <div class="feature">
  <h3>Personal Profile</h3>
  <p>Create your own profile with your basic information.</p>
  </div>

  <div class="feature">
  <h3>Show Your Skills</h3>
  <p>Add and display the skills you want others to see.</p>
  </div>

  <div class="feature">
  <h3>Profile Picture</h3>
  <p>Upload a profile picture to personalize your account.</p>
  </div>

  <div class="feature">
  <h3>Secure Login</h3>
  <p>User accounts are protected with password authentication.</p>
  </div>

  <div class="feature">
  <h3>Edit Your Profile</h3>
  <p>Update your personal information and skills anytime.</p>
  </div>

  <div class="feature">
  <h3>Email-Based Account</h3>
  <p>Users register and log in using a valid email address.</p>
  </div>

  </div>

</section>


<!-- CALL TO ACTION -->

<section class="cta">
  <div class="cta-content">
    <h2>Start building your professional presence today.</h2>
    <a href="register.php" class="cta-btn">Get Started</a>
  </div>
</section>

</div>

<?php include "includes/footer.php"; ?>