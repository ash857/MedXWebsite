<?php
session_start();
include"conn.php";
?>

<?php
    if (isset($_POST['Register'])) {

        $FName = trim($_POST['FirstName']);
        $LName = trim($_POST['LastName']);
        $Email = trim($_POST['Email']);
        $Phone = trim($_POST['Phone']);
        $Password = password_hash(trim($_POST['Password']), PASSWORD_DEFAULT); // Secure hashing

        $stmt = $conn->prepare("INSERT INTO members (first_name, last_name, email, phone_number, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $FName, $LName, $Email, $Phone, $Password);
        $stmt->execute();

        $_SESSION['FirstName'] = $FName;
        $_SESSION['LastName'] = $LName;
        $_SESSION['Email'] = $Email;
        $_SESSION['Phone'] = $Phone;

        echo "Registration successful!";
    }

    if (isset($_POST['Login'])) {
        $LoginEmail = trim($_POST['Email']);
        $LoginPassword = trim($_POST['Password']);
        
        // Prepare SQL to only fetch user by email
        $stmt = $conn->prepare("SELECT * FROM members WHERE email = ?");
        $stmt->bind_param("s", $LoginEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            // Verify password
            echo "User found in database.<br>";
            if (password_verify($LoginPassword, $row['password'])) {
                // Store session variables (DON'T store password!)
                $_SESSION['FirstName'] = $row['first_name'];
                $_SESSION['LastName']  = $row['last_name'];
                $_SESSION['Email']     = $row['email'];
                $_SESSION['Phone']     = $row['phone_number'];
                $_SESSION['UserId']    = $row['user_id'];

                header("Location: store.html"); 
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid email or password.";
        }

        $stmt->close();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedX Website</title>
    <link rel="stylesheet" type = "text/css" href="styles/styles.css">
</head>
<body>
    <header id = "top-nav-container">
        <div id = "logo-container">
            <img src="images/logo.png" alt="MedX Logo" id = "logo">
        </div>
        <div id = "desktop-nav">
            <ul>
                <li><a href = "store.html" class="nav-text">Store</a></li>
                <li>
                    <div class = "account-btn">
                        <a>A</a>
                    </div>
                </li>
                <li>
                    <div class = "cart-btn">
                        <svg class="cart-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg>
                    </div>
                </li>
                <li>
                    <div class = "settings-btn">
                        <img src="images/Settings.png" alt="Settings" class = "settings-icon">
                    </div>
                </li>
            </ul>
        </div>
        <div id = "mobile-nav" onclick="toggleMobileMenu(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
            <ul class="mobile-menu">
                <li class="mobile-close-nav" onclick="toggleMobileMenu(this)">
                  <div class="bar1"></div>
                  <div class="bar2"></div>
                  <div class="bar3"></div>
                </li>
                <li><a href = "store.html">Store</a></li>
                <li>
                    <div class = "mobile-account-btn">
                        <a>A</a>
                    </div>
                </li>
                <li>
                    <div class = "mobile-cart-btn">
                        <svg class="cart-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg>
                    </div>
                </li>
                <li>
                    <div class = "settings-btn">
                        <img src="images/Settings.png" alt="Settings" class = "settings-icon">
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <div class ="checkout-page-container">
        <div class ="account-checkout-section">
            <h3>1. Sign in or Sign up</h3>
            <div class = account-checkout-content>
                <div class="login-signup-button">
                    <button class="login-btn active" onclick="loginPressed()">Sign in</button>
                    <button class="signup-btn" onclick="signupPressed()">Sign up</button>
                </div>
                <div class="login-container">
                    <div class="continue-with-buttons">
                        <button class="google-btn">
                            <img src ="images/google 1.png" alt="google logo">
                            <p>Continue with Google</p>
                        </button>   
                        <button class="facebook-btn">
                            <img src="images/facebook 1.png" alt="facebook logo">
                            <p>Continue with Facebook</p>
                        </button>
                        <button class="apple-btn">
                            <img src="images/apple 1.png" alt="apple logo">
                            <p>Continue with Apple</p>
                        </button>
                        <div class="contiune-with-email">
                            <div class ="email-bar-break"></div>
                            <p class="email">Or continue with email</p>
                            <div class ="email-bar-break"></div>
                        </div>
                    </div>
                    <form class="account-details-form" method="POST" action="">
                        <div class="email">
                            <p>Email</p>
                            <input class ="account-input" name ="Email" placeholder="Required" required>
                        </div>
                        <div class="password">
                            <p>Password</p>
                            <input class ="account-input" type="password" name = "Password" placeholder="Required" required>
                        </div>
                        <div class ="forgot-password">
                            <p>Forgot password</p>
                        </div>
                        <button class="Signin-btn" type="submit" name="Login">Sign in</button>
                    </form>
                </div>

                <div class="signup-container">
                    <div class="continue-with-buttons">
                        <button class="google-btn">
                            <img src ="images/google 1.png" alt="google logo">
                            <p>Continue with Google</p>
                        </button>   
                        <button class="facebook-btn">
                            <img src="images/facebook 1.png" alt="facebook logo">
                            <p>Continue with Facebook</p>
                        </button>
                        <button class="apple-btn">
                            <img src="images/apple 1.png" alt="apple logo">
                            <p>Continue with Apple</p>
                        </button>
                        <div class="contiune-with-email">
                            <div class ="email-bar-break"></div>
                            <p>Or</p>
                            <div class ="email-bar-break"></div>
                        </div>
                    </div>
                    <form class="account-details-form" method="POST" action="">
                        <div class="name">
                            <div class="fname">
                                <p>First name</p>
                                <input type="text" class="account-input" name="FirstName" placeholder="Required" required>
                            </div>
                            <div class="lname">
                                <p>Last name</p>
                                <input type="text" class="account-input" name="LastName" placeholder="Required" required>
                            </div>
                        </div>
                        <div class="email">
                            <p>Email</p>
                            <input class="account-input" name="Email" placeholder="Required" type="email" required> 
                        </div>
                        <div class="mobile-number">
                            <p>Phone number</p>
                            <div class="number-container">
                                <!-- Optional: Remove name from country code if not needed -->
                                <input class="number-identifer" name="CountryCode" placeholder="+64" type="tel">
                                <input class="account-input" name="Phone" placeholder="Required" type="tel" required>
                            </div>
                        </div>
                        <div class="password">
                            <p>Password</p>
                            <input class="account-input" name="Password" placeholder="Required" type="password" required>
                        </div>
                        <button class="Signin-btn" type="submit" name="Register">Sign up</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <footer id = "footer">
        <div class="footer-content">
            <div class="footer-top">
                <div class="footer-logo">
                    <img src="images/footer-logo.png" alt="logo">
                </div>
                <div class="email-subscription">
                    <input type="email" placeholder="Subscribe to our notifications" class="email-input">
                    <div class="subscribe-button" onclick="subscribe(self)">
                        <svg class="subscribe-icon"xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480l0-83.6c0-4 1.5-7.8 4.2-10.8L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>
                    </div>
                </div>
                <div class="footer-socials">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M282 256.2l-95.2-54.1V310.3L282 256.2zM384 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64zm14.4 136.1c7.6 28.6 7.6 88.2 7.6 88.2s0 59.6-7.6 88.1c-4.2 15.8-16.5 27.7-32.2 31.9C337.9 384 224 384 224 384s-113.9 0-142.2-7.6c-15.7-4.2-28-16.1-32.2-31.9C42 315.9 42 256.3 42 256.3s0-59.7 7.6-88.2c4.2-15.8 16.5-28.2 32.2-32.4C110.1 128 224 128 224 128s113.9 0 142.2 7.7c15.7 4.2 28 16.6 32.2 32.4z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64h98.2V334.2H109.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H255V480H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm297.1 84L257.3 234.6 379.4 396H283.8L209 298.1 123.3 396H75.8l111-126.9L69.7 116h98l67.7 89.5L313.6 116h47.5zM323.3 367.6L153.4 142.9H125.1L296.9 367.6h26.3z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M194.4 211.7a53.3 53.3 0 1 0 59.3 88.7 53.3 53.3 0 1 0 -59.3-88.7zm142.3-68.4c-5.2-5.2-11.5-9.3-18.4-12c-18.1-7.1-57.6-6.8-83.1-6.5c-4.1 0-7.9 .1-11.2 .1c-3.3 0-7.2 0-11.4-.1c-25.5-.3-64.8-.7-82.9 6.5c-6.9 2.7-13.1 6.8-18.4 12s-9.3 11.5-12 18.4c-7.1 18.1-6.7 57.7-6.5 83.2c0 4.1 .1 7.9 .1 11.1s0 7-.1 11.1c-.2 25.5-.6 65.1 6.5 83.2c2.7 6.9 6.8 13.1 12 18.4s11.5 9.3 18.4 12c18.1 7.1 57.6 6.8 83.1 6.5c4.1 0 7.9-.1 11.2-.1c3.3 0 7.2 0 11.4 .1c25.5 .3 64.8 .7 82.9-6.5c6.9-2.7 13.1-6.8 18.4-12s9.3-11.5 12-18.4c7.2-18 6.8-57.4 6.5-83c0-4.2-.1-8.1-.1-11.4s0-7.1 .1-11.4c.3-25.5 .7-64.9-6.5-83l0 0c-2.7-6.9-6.8-13.1-12-18.4zm-67.1 44.5A82 82 0 1 1 178.4 324.2a82 82 0 1 1 91.1-136.4zm29.2-1.3c-3.1-2.1-5.6-5.1-7.1-8.6s-1.8-7.3-1.1-11.1s2.6-7.1 5.2-9.8s6.1-4.5 9.8-5.2s7.6-.4 11.1 1.1s6.5 3.9 8.6 7s3.2 6.8 3.2 10.6c0 2.5-.5 5-1.4 7.3s-2.4 4.4-4.1 6.2s-3.9 3.2-6.2 4.2s-4.8 1.5-7.3 1.5l0 0c-3.8 0-7.5-1.1-10.6-3.2zM448 96c0-35.3-28.7-64-64-64H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96zM357 389c-18.7 18.7-41.4 24.6-67 25.9c-26.4 1.5-105.6 1.5-132 0c-25.6-1.3-48.3-7.2-67-25.9s-24.6-41.4-25.8-67c-1.5-26.4-1.5-105.6 0-132c1.3-25.6 7.1-48.3 25.8-67s41.5-24.6 67-25.8c26.4-1.5 105.6-1.5 132 0c25.6 1.3 48.3 7.1 67 25.8s24.6 41.4 25.8 67c1.5 26.3 1.5 105.4 0 131.9c-1.3 25.6-7.1 48.3-25.8 67z"/></svg>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; MedX 2025</p>
                <div class="footer-links">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="store.html">Store</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="order-tracking.html">My Orders</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Prescriptions</a></li>
                    </ul>
                </div>
                <p>Made with Meth</p>
            </div>
        </div>
    </footer>
    <script src="main.js"></script>
</body>
</html>