<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FCT Tutor</title>
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>

  <!-- Navbar -->
  <header class="navbar">
   <a href="login.php"><div class="logo"><img src="images/logo.png" alt="Logo"></div></a>
    <nav class="nav-links">
      <a href="index.php" class="active">Home</a>
      <a href="about.html">About</a>
      <a href="find_tutor.html">Find Tutors</a>
      <a href="sessions.html">Sessions</a>
      <a href="contact.html">Contact</a>
    </nav>
    <?php if (isset($_SESSION['username'])): ?>
      <div style="display:flex;align-items:center;gap:12px;">
        <div class="welcome-banner"><h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1></div>
        <a href="logout.php"><button class="register-btn">Logout</button></a>
      </div>
    <?php else: ?>
      <a href="user_role.html"><button class="register-btn">Register</button></a>
    <?php endif; ?>
  </header>


  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1>Empower Your Learning.<br>Share Your Skills.</h1>
      <p>Connect with fellow university students to learn, teach, and grow — all in one platform.</p>

      <div class="hero-buttons">
        <a href="user_role.html"><button class="primary-btn">Get Started</button></a>
        <a href="find_tutor.html"><button class="secondary-btn">Explore Tutors</button></a>
      </div>
    </div>

    <div class="hero-image">
      <img src="images/illustrator.png" alt="Learning Illustration">
    </div>
  </section>



  <!-- Mission & Vision Section -->
  <section class="section mission-vision">
    <h2><img src="images/target.png" class="icon"> Our Mission & Vision</h2>

    <div class="mission-container">

      <div class="mission-card">
        <h3><img src="images/tocket.png" class="icon-small"> Mission</h3>
        <p>To empower every student with personalized and effective learning experiences.</p>
      </div>

      <div class="vision-card">
        <h3><img src="images/star.png" class="icon-small"> Vision</h3>
        <p>To be the leading platform for interactive and high-quality tutoring.</p>
      </div>

    </div>
  </section>




  <!-- Call-to-Action Section -->
  <section class="cta">
    <h2>Start Learning with Tutor Today!</h2>
    <p>Join our community and access top-quality courses from expert tutors.</p>
    <img src="images/w_logo.png" alt="Logo" class="cta-logo">

  <div class="footer-bottom">
    <p>© 2025 FCT Tutor. All Rights Reserved.</p>
  </div>
  </section>


  <script src="js/script.js"></script>
</body>

</html>
