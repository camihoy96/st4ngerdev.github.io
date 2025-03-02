<?php
require('dbconn.php');

if (isset($_POST['signin'])) {
  $u = $_POST['RollNo'];
  $p = $_POST['Password'];

  $sql = "SELECT * FROM LMSC.user WHERE RollNo = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $u);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $hashedPassword = $row['Password']; // Hashed password from database
      $user_type = $row['Type'];
      

      if (password_verify($p, $hashedPassword)) { // Check password
          $_SESSION['RollNo'] = $u;
          

          // Redirect based on user type
          if ($user_type == 'User') {
            echo "<script>alert('Welcome, " . htmlspecialchars($u) . "!'); window.location.href=' manage/home.php';</script>";
          } 
          exit;
      } else {
          echo "<script>alert('Incorrect RollNo or Password');</script>";
      }
  } else {
      echo "<script>alert('User not found');</script>";
  }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDC Library</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .header-top { background:rgb(15, 120, 218); color: white; padding: 10px 0; font-size: 14px;}
        .header-top .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .header-top .contact-info span, .header-top .auth-links a { color: white; margin: 0 10px; }
        .navbar { background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 10px 0; position: justify; }
        .navbar .container { display: flex; align-items: center; justify-content: space-between; }
        .navbar-brand { display: flex; align-items: center; text-decoration: none; color: #333; font-size: 20px; font-weight: bold; }
        .navbar-brand img { height: 50px; margin-right: 10px; }
        .navbar-nav { list-style: none; position: justify; display: flex; padding: 0; margin: 0; }
        .navbar-nav li { margin: 0 15px; }
        .navbar-nav a { text-decoration: none; color: #333; font-weight: bold; padding: 8px 12px; }
        .navbar-nav a:hover {background-color: #007bff; border-radius:5px; color: #f8f9fa;}
        .social-icons {
    display: flex;
    gap: 10px;
    margin-right: 15px;
}

.social-icons a {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px; /* Adjust the size as needed */
    height: 40px;
    border-radius: 50%;
    background-color: white; /* Background color for the circular icons */
    text-decoration: none;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2); /* Soft shadow effect */
}

.social-icons a i {
    font-size: 20px;
}

.social-icons a:nth-child(1) i {
    color: #1877F2; /* Facebook blue */
}

.social-icons a:nth-child(2) i {
    color: #E1306C; /* Instagram gradient effect (pick one dominant color) */
}

    </style>
</head>
<body>
    <div class="header-top">
        <div class="container">
            <div class="contact-info">
                <span><i class="fas fa-phone"></i> (035) 420-9801 - 09177017104</span>
                <span><i class="fas fa-envelope"></i> info@mdci.edu.ph</span>
                <span><i class="fas fa-map-marker-alt"></i> E.J. Blanco Extension, Daro, Dumaguete City, Negros Oriental, Philippines 6200</span>
            </div>
            <div class="social-icons">
                <a href="https://www.facebook.com/mdceduph"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/mdceduph"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    
    <nav class="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="images/mdc.logo.png" style="margin-left:5px;" alt="MDC Logo"> METRO DUMAGUETE COLLEGE
            </a>
            <ul class="navbar-nav">
                <li><a href="home.php" style="background-color:rgba(30, 0, 255, 0.2); border-radius: 5px;">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="https://mdci.edu.ph/">Academics</a></li>
                
                <li><a href="#" onclick="openModal(event)">Log/Sign Up</a></li>
            </ul>
        </div>
    </nav>
    <style>
        /* Keyframes for Slideshow */
        @keyframes slideshow {
            0%, 33.33% {
                background-image: url('images/model_1.jfif'); /* First image visible */
            }
            33.34%, 66.66% {
                background-image: url('images/model_2.jfif'); /* Second image visible */
            }
            66.67%, 100% {
                background-image: url('images/model_3.jfif'); /* Third image visible */
            }
        }

        /* Hero Section Styling */
        .hero {
            position: relative;
            height: 100vh; /* Full viewport height */
            padding: 80px 50px;
            background: url('images/model_1.jfif') center center/cover no-repeat;
            animation: slideshow 15s infinite; /* 15s duration, infinite loop */
        }
    </style>
        <section class="hero">
  </div>

  <div style="position: relative; 
              max-width: 1200px; 
              margin: 0 auto; 
              padding: 0 20px; 
              color: #fff;">
    <!-- Heading and Button Row -->
    <div style="display: flex; 
                align-items: center; 
                justify-content: space-between;">
      <style>
    /* Keyframes for fade/slide in from left */
    @keyframes fadeInLeft {
      0% {
        opacity: 0;
        transform: translateX(-30px);
      }
      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Base animation class */
    .fadeInLeft {
      animation: fadeInLeft 1s ease-in forwards;
      opacity: 0; /* hidden initially */
    }

    /* Staggered delays */
    .fade-delay1 {
      animation-delay: 0.2s;  /* Heading appears first */
    }
    .fade-delay2 {
      animation-delay: 1s;    /* Descriptive text appears second */
    }
    .fade-delay3 {
      animation-delay: 2s;    /* Search link appears last */
    }

  </style>
  <script>
    function openModal(event) {
      event.preventDefault();
      alert("Search modal or page would open here!");
    }
  </script>
</head>
<body style="background-color: #f8f9fa; color: #000; font-family: sans-serif;">
  <div style="text-align: center; margin-top: 10px;">
    <!-- Heading (fade in from left) -->
    <h1 class="fadeInLeft fade-delay1"
        style="font-size: 48px; margin-top: 150px; font-weight: bold; text-shadow:  0 0 3px #000000; border: #000000;">
      WELCOME to MDC Library Management System
    </h1>

    <!-- Divider -->
    <hr style="border: 1px solid #fff; margin-top: -30px;">

    <!-- Short Descriptive Text (fade in from left) -->
    <p class="fadeInLeft fade-delay2" style="font-size: 40px; margin: 10px 0;  text-shadow:  0 0 3px #000000; border: #000000;">
      Your gateway to a world of knowledge.
    </p>

    <!-- Search Link (fade in from left) -->
    <a href="#" class="fadeInLeft fade-delay3"
   onclick="openModal(event)"
   style="background-color: #b10000; /* Red background color */
          color: #fff; /* White text color */
          padding: 15px 30px; /* Padding for button size */
          text-decoration: none; /* Remove underline */
          font-weight: bold; /* Bold text */
          font-family: Arial, sans-serif; /* Modern font */
          border-radius: 25px; /* Rounded corners */
          display: inline-block; /* Ensure proper button sizing */
          margin-top: 20px; /* Margin from the top */
          transition: background-color 0.3s ease; /* Smooth hover effect */
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
          border: 2px solid #fff; /* White border */
          text-transform: uppercase; /* Uppercase text */
          font-size: 16px;">
          
    SEARCH DDC's &rarr;
</a>
  </div>
</section>
<div style="padding: 50px; 
            background: linear-gradient(to right, #fff, #ededed); 
            text-align: center;">
  <h2 style="color: #b10000; font-size: 24px; margin-bottom: 40px;">
  Explore our vast collection of books, journals, and resources to enrich your learning journey.
  </h2>

  <div style="display: flex; 
            justify-content: center; 
            flex-wrap: wrap; 
            gap: 40px;">

  <!-- Guide 1 -->
  <div style="display: flex; 
            justify-content: center; 
            flex-wrap: wrap; 
            gap: 40px;">

  <!-- Guide 1 -->
  <div style="max-width: 200px; text-align: center;">
    <!-- Use a button or <a> with onclick -->
    <a href="#" 
       onclick="openModal(event)" 
       style="text-decoration: none; color: inherit;">
      <img src="manage/image/dictionary.jpg" 
           alt="Dictionary" 
           style="width: 100px; 
                  height: 100px; 
                  border-radius: 50%; 
                  object-fit: cover; 
                  margin-bottom: 15px;">
      <p style="font-weight: bold; margin-bottom: 5px;">Dictionary</p>
    </a>
  </div>

  <!-- Guide 2 -->
  <div style="max-width: 200px; text-align: center;">
    <a href="#" 
       onclick="openModal(event)" 
       style="text-decoration: none; color: inherit;">
      <img src="manage/image/fiction nook.png" 
           alt="Fiction Nook" 
           style="width: 100px; 
                  height: 100px; 
                  border-radius: 50%; 
                  object-fit: cover; 
                  margin-bottom: 15px;">
      <p style="font-weight: bold; margin-bottom: 5px;">Fiction Nook</p>
    </a>
  </div>

   <!-- Guide 3 -->
   <div style="max-width: 200px; text-align: center;">
    <a href="#" 
       onclick="openModal(event)" 
       style="text-decoration: none; color: inherit;">
      <img src="manage/image/fiction.novel.png" 
           alt="Fiction Nook" 
           style="width: 100px; 
                  height: 100px; 
                  border-radius: 50%; 
                  object-fit: cover; 
                  margin-bottom: 15px;">
      <p style="font-weight: bold; margin-bottom: 5px;">Fiction and Novel</p>
    </a>
  </div>
     <!-- Guide 4 -->
  <div style="max-width: 200px; text-align: center;">
    <a href="#" 
       onclick="openModal(event)" 
       style="text-decoration: none; color: inherit;">
      <img src="manage/image/filipiniana.jpg" 
           alt="Fiction Nook" 
           style="width: 100px; 
                  height: 100px; 
                  border-radius: 50%; 
                  object-fit: cover; 
                  margin-bottom: 15px;">
      <p style="font-weight: bold; margin-bottom: 5px;">Filipiniana</p>
    </a>
  </div>
   <!-- Guide 5 -->
   <div style="max-width: 200px; text-align: center;">
    <a href="#" 
       onclick="openModal(event)" 
       style="text-decoration: none; color: inherit;">
      <img src="manage/image/circulation.jpg" 
           alt="Fiction Nook" 
           style="width: 100px; 
                  height: 100px; 
                  border-radius: 50%; 
                  object-fit: cover; 
                  margin-bottom: 15px;">
      <p style="font-weight: bold; margin-bottom: 5px;">Circulation</p>
    </a>
  </div>
     <!-- Guide 6 -->
  <div style="max-width: 200px; text-align: center;">
    <a href="#" 
       onclick="openModal(event)" 
       style="text-decoration: none; color: inherit;">
      <img src="manage/image/Dissertation_and_Thesis.jpg" 
           alt="Fiction Nook" 
           style="width: 100px; 
                  height: 100px; 
                  border-radius: 50%; 
                  object-fit: cover; 
                  margin-bottom: 15px;">
      <p style="font-weight: bold; margin-bottom: 5px;">Thesis and Dissertations</p>
    </a>
  </div>
     <!-- Guide 7 -->
  <div style="max-width: 200px; text-align: center;">
    <a href="#" 
       onclick="openModal(event)" 
       style="text-decoration: none; color: inherit;">
      <img src="manage/image/reference.jpg" 
           alt="Fiction Nook" 
           style="width: 100px; 
                  height: 100px; 
                  border-radius: 50%; 
                  object-fit: cover; 
                  margin-bottom: 15px;">
      <p style="font-weight: bold; margin-bottom: 5px;">Reference</p>
    </a>
  </div>
   <!-- Guide 8 -->
   <div style="max-width: 200px; text-align: center;">
    <a href="#" 
       onclick="openModal(event)" 
       style="text-decoration: none; color: inherit;">
      <img src="manage/image/btvted.jpg" 
           alt="Fiction Nook" 
           style="width: 100px; 
                  height: 100px; 
                  border-radius: 50%; 
                  object-fit: cover; 
                  margin-bottom: 15px;">
      <p style="font-weight: bold; margin-bottom: 5px;">BTVTED Collection</p>
    </a>
  </div>
   <!-- Guide 9 -->
   <div style="max-width: 200px; text-align: center;">
    <a href="#" 
       onclick="openModal(event)" 
       style="text-decoration: none; color: inherit;">
      <img src="manage/image/periodical.png" 
           alt="Fiction Nook" 
           style="width: 100px; 
                  height: 100px; 
                  border-radius: 50%; 
                  object-fit: cover; 
                  margin-bottom: 15px;">
      <p style="font-weight: bold; margin-bottom: 5px;">Periodical</p>
    </a>
  </div>
   <!-- Guide 10 -->
   <div style="max-width: 200px; text-align: center;">
    <a href="#" 
       onclick="openModal(event)" 
       style="text-decoration: none; color: inherit;">
      <img src="manage/image/history.jpg" 
           alt="Fiction Nook" 
           style="width: 100px; 
                  height: 100px; 
                  border-radius: 50%; 
                  object-fit: cover; 
                  margin-bottom: 15px;">
      <p style="font-weight: bold; margin-bottom: 5px;">History & Geography</p>
    </a>
  </div>
  <div>
  <meta charset="UTF-8" />
  <title>Our Gallery</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }
    .gallery-section {
  width: 100%;
  margin: 40px 0;
  padding: 0 20px;
  text-align: left;
}

    .gallery-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
      text-transform: uppercase;
    }
    .gallery-filter {
      margin-bottom: 20px;
    }
    .gallery-filter button {
      background: #fff;
      color: #000;
      padding: 8px 16px;
      border: 1px solid #ccc;
      font-weight: bold;
      cursor: pointer;
      text-transform: uppercase;
    }
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 20px;
    }
    .gallery-grid img {
      width: 100%;
      height: auto;
      display: block;
      object-fit: cover;
    }
  </style>
</div>

<!-- Gallery Section -->
<section class="gallery-section" style="margin: 40px auto; text-align: left !important;">
  <!-- Heading -->
  <h2 class="gallery-title" style="
    font-size: 24px;
    font-weight: bold;
    text-transform: uppercase;
    margin: 0;
    text-align: left !important;
  ">
    Previous Event
  </h2>

  <!-- Horizontal Line -->
  <hr style="
    width: 60px; 
    border: 1px solid #000; 
    margin: 10px 0 20px 0;
    text-align: left !important;
  ">

  <!-- Filter Buttons (Currently just "All") -->
  <div class="gallery-filter" style="margin-bottom: 20px; text-align: left !important;">
    <button style="
      background: #fff; 
      color: #000; 
      padding: 8px 16px; 
      border: 1px solid #ccc; 
      font-weight: bold; 
      cursor: pointer; 
      text-transform: uppercase;
    ">
      All
    </button>
  </div>
</section>


  <div class="gallery-grid">
    <!-- Replace with your actual image paths -->
    <img src="images/1.jpg" alt="Event 1">
    <img src="images/2.jpg" alt="Event 2">
    <img src="images/3.jpg" alt="Event 3">
    <img src="images/4.jpg" alt="Event 4">
    <img src="images/5.jpg" alt="Event 5">
    <img src="images/6.jpg" alt="Event 6">
    <img src="images/87.jpg" alt="Event 7">
    <img src="images/8.jpg" alt="Event 8">
    <img src="images/9.jpg" alt="Event 9">
    <img src="images/10.jpg" alt="Event 10">
  </div>
</section>

</div>
<!-- Modal Background -->
<div id="loginSignUpModal"
     style="position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            display: none; 
            align-items: center; 
            justify-content: center; 
            z-index: 9999;">
   
  <!-- Modal Content Box -->
  <div style="background: rgba(14, 12, 18, 0.27); 
              backdrop-filter: blur(8px); 
              border-radius: 10px; 
              max-height: 90%;
              overflow-y: auto; 
              max-width: 100%; 
              padding: 30px; 
              color: #fff; 
              position: relative;">

    <!-- Close Button -->
    <button onclick="closeModal()"
            style="position: absolute; 
                   top: 10px; 
                   right: 20px; 
                   background: transparent; 
                   border: none; 
                   font-size: 24px; 
                   color: #fff; 
                   cursor: pointer;">
      &times;
    </button>

    <div style="display: flex;
                flex-wrap: wrap; 
                align-items: flex-start; 
                justify-content: space-between;">
      
      <!-- Sign In Section -->
      <div style="flex: 1; min-width: 250px; margin-right: 20px;">
        <h2 style="margin-bottom: 20px;">Sign In</h2>
        <form action="" method="post">
    <div style="margin-bottom: 15px;">
        <label for="signin-id">ID Number</label>
        <input type="text" name="RollNo" placeholder="ID number" required
               style="width: 80%; padding: 8px; border-radius: 6px; border: none;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="signin-password">Password</label>
        <input type="password" name="Password" placeholder="Password" required
               style="width: 80%; padding: 8px; border-radius: 6px; border: none;">
    </div>
    <input type="submit" name="signin" value="Sign In"
           style="background: #9d79fe; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
</form>

      </div>

      <!-- Vertical Line -->
      <div style="width: 3px; background-color: white; height: 500px;; opacity: 0.9;"></div>
      
     <!-- Sign Up Section -->
     <div style="flex: 1; min-width: 250px; margin-left: 20px;">
        <h2 style="margin-bottom: 20px;">Sign Up</h2>
        <form method="POST" action="home.php">
          <div style="margin-bottom: 15px;">
            <label for="signup-name" style="display: block; margin-bottom: 5px;">Name</label>
            <input type="text" name="Name" placeholder="Name" id="signup-name" required

                   style="width: 80%; padding: 8px; border-radius: 6px; border: none;">
          </div>
          <div style="margin-bottom: 15px;">
            <label for="signup-email" style="display: block; margin-bottom: 5px;">Email</label>
            <input type="email" name="EmailId" placeholder="Email" id="signup-email" required


                   style="width: 80%; padding: 8px; border-radius: 6px; border: none;">
          </div>
          <div style="margin-bottom: 15px;">
            <label for="signup-password" style="display: block; margin-bottom: 5px;">Password</label>
            <input type="password" name="Password" placeholder="Password" required
                   style="width: 80%; padding: 8px; border-radius: 6px; border: none;">
          </div>
          <div style="margin-bottom: 15px;">
            <label for="signup-confirm" style="display: block; margin-bottom: 5px;">Confirm Password</label>
            <input type="password" name="ConfirmPassword" placeholder="Confirm Password" required
                   style="width: 80%; padding: 8px; border-radius: 6px; border: none;">
          </div>
          <div style="margin-bottom: 15px;">
            <label for="signup-phone" style="display: block; margin-bottom: 5px;">Phone Number</label>
            <input type="text" name="MobNo" placeholder="Phone Number" required
                   pattern="\d{1,11}" title="Phone number must be a valid number up to 11 digits."

                   pattern="\d{1,11}" title="Phone number must be a valid number up to 11 digits."


                   style="width: 80%; padding: 8px; border-radius: 6px; border: none;">
          </div>
          <div style="margin-bottom: 15px;">
            <label for="signup-id" style="display: block; margin-bottom: 5px;">ID Number</label>
            <input type="text" name="RollNo" placeholder="ID Number" id="ID_Number" required=""
                   pattern=".{1,50}" title="ID number must be 1 to 50 characters long."



                   style="width: 80%; padding: 8px; border-radius: 6px; border: none;">
          </div>
          <div style="margin-bottom: 15px;">
            <label for="signup-role" style="display: block; margin-bottom: 5px;">Role</label>
            <select name="Category"
                    style="width: 30%; padding: 8px; border-radius: 6px; border: none;">
                    <option value="Students">Student</option>
					<option value="Teacher">Teacher</option>
					<option value="MDC Personel">MDC Personel</option>
            </select>
            <label for="Department" style="display: block; margin-bottom: 5px;">Department</label>
            <select name="Department" 
            style="width: 30%; padding: 8px; border-radius: 6px; border: none;">
					<option value="CCSIT">CCSIT</option>
					<option value="CAED">CAED</option>
					<option value="CTM">CTM</option>
					<option value="CBA">CBA</option>
           			<option value="CCJE">CCJE</option>
					<option value="MDC_STAFF">MDC STAFF</option>
				</select>
          </div>
           <input type="checkbox" id="termsCheckbox" onclick="toggleSignupButton()" disabled>
				I have read and agree to the 
				<a class="underline" style="color:rgb(0, 0, 255); hover: yellow; text-shadow: white; cursor: pointer; href="#" onclick="openPopup()" >Terms and Conditions</a>.
			</p>
			<div class="send-button">
            <input type="submit" id="signupButton" name="signup"  value="Sign Up" style="background: #9d79fe; color:white; 
                   disabled>

                   disabled>


                         color: #fff; 
                         padding: 10px 20px; 
                         border: none; 
                         border-radius: 4px; 
                         cursor: pointer;" disabled>
			</div>
        </form> 

<script>
    function toggleSignupButton() {
        document.getElementById('signupButton').disabled = !document.getElementById('termsCheckbox').checked;
    }
</script>

  </div>       <!-- Pop-up Modal -->
	<div id="termsPopup" class="popup-overlay">
		<div class="popup-content">
			<span class="close-button" onclick="closePopup()">&times;</span>
			<h2>Terms and Conditions</h2>
			<p>Welcome to our platform. By using this service, you agree to abide by all our rules and policies...</p>
			<!-- Confirm Button -->
			<div class="confirmButton">
				<input type="button" id="confirmButton" value="Confirm">
			</div>
		</div>
	</div>
    
	<!-- CSS -->
	<style>
		.popup-overlay {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(255, 255, 255, 0.6);
			z-index: 1000;
		}
		.popup-content {
			background: rgba(48, 41, 41, 0.81);
			max-width: 500px;
			padding: 20px;
			border-radius: 10px;
			text-align: left;
			margin: 10% auto;
			position: relative;
			color: white;
		}
		.close-button {
			position: absolute;
			top: 10px;
			right: 15px;
			font-size: 24px;
			cursor: pointer;
		}
		.confirmButton {
			text-align: center;
			margin-top: 15px;
		}
		#confirmButton {
			background-color: #4CAF50;
			color: white;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			cursor: pointer;
		}
		#confirmButton:hover {
			background-color: #45a049;
		}
	</style>
      </div>
    </div>

  </div>
</div>
<!-- JavaScript -->
<script>
		function openPopup() {
			document.getElementById("termsPopup").style.display = "block";
		}
		
		function closePopup() {
			document.getElementById("termsPopup").style.display = "none";
		}
		
		document.getElementById("confirmButton").onclick = function () {
			closePopup();
			document.getElementById("termsCheckbox").disabled = false;
			document.getElementById("termsCheckbox").checked = true;
			toggleSignupButton();
		}
		document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector("h1");
    header.classList.add("visited");
});

		function toggleSignupButton() {
			const checkbox = document.getElementById('termsCheckbox');
			const button = document.getElementById('signupButton');
			button.disabled = !checkbox.checked;
		}
	</script>

<script>
  function openModal(event) {
    event.preventDefault(); // Prevent the default anchor click
    document.getElementById('loginSignUpModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('loginSignUpModal').style.display = 'none';
  }
</script>

<?php
require('dbconn.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['signup'])) 
    $name = $_POST['Name'];
    $email = $_POST['EmailId']; // Corrected field name
    $password = $_POST['Password'];
    $confirmPassword = $_POST['Password'];
    $mobno = trim($_POST['MobNo']); // Keep as a string 
    $rollno = $_POST['RollNo'];
    $category = $_POST['Category'];
    $department = $_POST['Department'];
    $type = 'User'; // Default user type

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the user already exists
    $checkQuery = "SELECT * FROM user WHERE RollNo = ?"; // Removed 'LMSC.' if unnecessary
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $rollno);
    $stmt->execute();
    $checkResult = $stmt->get_result();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, '@gmail.com')) {
        echo "<script>alert('Please enter a valid Gmail address.');</script>";
    } elseif ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!');</script>";
    } elseif ($checkResult->num_rows > 0) {
        echo "<script>alert('User already exists. Please use a unique ID Number.');</script>";
    } else {
        // Insert new user
        $sql = "INSERT INTO user (Name, Type, Category, Department, RollNo, EmailId, MobNo, Password)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssis", $name, $type, $category, $department, $rollno, $email, $mobno, $hashedPassword);

        if ($stmt->execute()) {
          echo "<script>alert('Registration Successful! Redirecting to login...'); window.location.href='home.php';</script>";
      } else {
          die("SQL Error: " . $stmt->error); // Show exact MySQL error
      }   
    }   
?>

        
   </div>     
<footer style="width: 100%; background-color: #1b1b1b; color: #ccc; font-family: sans-serif; padding-left;">
  <!-- Top Footer Section -->
  <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; padding: 40px 20px;">
    
    <!-- Mission Statement -->
    <div style="flex: 1 1 300px; margin-bottom: 20px;">
      <p style="line-height: 1.6;">
        We are dedicated to offering quality collections, outstanding customer-centered services, 
        and excellent user education for learners, teachers, employees, and community in support 
        of the college's mission.
      </p>
    </div>
    
    <!-- Quick Links -->
    <div style="flex: 1 1 150px; margin-bottom: 20px;">
      <h3 style="color: #fff; margin-bottom: 10px;">Quick Links</h3>
      <ul style="list-style: none; padding: 0; margin: 0; line-height: 1.8;">
        <li><a href="#" style="color: #ccc; text-decoration: none;">Dictionary</a></li>
        <li><a href="#" style="color: #ccc; text-decoration: none;">Fiction Nook</a></li>
        <li><a href="#" style="color: #ccc; text-decoration: none;">Fiction and Novel</a></li>
        <li><a href="#" style="color: #ccc; text-decoration: none;">Filipiniana</a></li>
        <li><a href="#" style="color: #ccc; text-decoration: none;">Circulation</a></li>
        <li><a href="#" style="color: #ccc; text-decoration: none;">Reference</a></li>
      </ul>
    </div>
    
    <!-- Hours -->
    <div style="flex: 1 1 120px; margin-bottom: 20px;">
      <h3 style="color: #fff; margin-bottom: 10px;">Hours</h3>
      <p style="margin: 0;">Mon - Fri: 8am - 5pm</p>
    </div>
    
    <!-- Contact Info -->
    <div style="flex: 1 1 220px; margin-bottom: 20px;">
      <h3 style="color: #fff; margin-bottom: 10px;">Contact Info</h3>
      <p style="margin: 0;"><i class="fas fa-map-marker-alt"></i> E.J. Blanco Extension, Daro,<br>
         Dumaguete City, Negros Oriental,<br>
         Philippines 6200
      </p>
      <p style="margin: 5px 0;"><i class="fas fa-envelope"></i> mdclibrary@gmail.com</p>
      <p style="margin: 5px 0;"><i class="fas fa-phone"></i> +639056152262</p>
    </div>
    
  </div>
  
  <!-- Bottom Footer Section -->
  <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: center; align-items: center; border-top: 1px solid #444; padding: 20px;">
    <p style="margin: 0; color: #ccc;">
      &copy; St4nger's Group 2024-2025. All rights reserved.
    </p>
  </div>
  
  <!-- Floating 'Back to Top' Button -->
  <a href="#top" 
     style="position: fixed; 
            bottom: 20px; 
            right: 20px; 
            width: 40px; 
            height: 40px; 
            background-color:rgb(115, 0, 255); 
            color: #fff; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            border-radius: 50%; 
            text-decoration: none; 
            font-size: 20px;">
    <i class="fas fa-chevron-up"></i>
  </a>
</footer>

<?php 
ob_end_flush(); // End output buffering