<?php
require_once 'cart_handler.php';
require_once 'cart.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedX Website</title>
    <link rel="stylesheet" type = "text/css" href="styles/styles.css">
</head>
<body class="body">
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
                    <button class = "cart-btn" onclick="toggleCart()">
                        <svg class="cart-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg>
                    </button>
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
                            <p class="email">Or</p>
                            <div class ="email-bar-break"></div>
                        </div>
                    </div>
                    <form class="account-details-form" onsubmit="event.preventDefault(); goToOrderDetails();">
                        <div class="email">
                            <p>Email</p>
                            <input class ="account-input" placeholder="Required" required>
                        </div>
                        <div class="password">
                            <p>Password</p>
                            <input class ="account-input" placeholder="Required" required>
                        </div>
                        <div class ="forgot-password">
                            <p>Forgot password</p>
                        </div>
                        <button class="Signin-btn">Sign in</button>
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
                    <form class="account-details-form" onsubmit="event.preventDefault(); goToOrderDetails();">
                        <div class="name">
                            <div class="fname">
                                <p>First name</p>
                                <input type="text" class="account-input" placeholder="Required" required>
                            </div>
                            <div class="lname">
                                <p>Last name</p>
                                <input type="text" class ="account-input" placeholder="Required" required>
                            </div>
                        </div>
                        <div class="email">
                            <p>Email</p>
                            <input class ="account-input" placeholder="Required" type="email" required> 
                        </div>
                        <div class="mobile-number">
                            <p>Phone number</p>
                            <div class="number-container">
                                <input class="number-identifer" placeholder="+64" type="tel" required>
                                <input class ="account-input" placeholder="Required" type="tel" required>
                            </div>
                        </div>
                        <div class="password">
                            <p>Password</p>
                            <input class ="account-input" placeholder="Required" type="password" required>
                        </div>
                        
                        <button class="Signin-btn" type="submit">Sign up</button>
                    </form>
                </div>
            </div>
        </div>

        <div class ="account-checkout-section order-checkout">
            <h3>2. Order details</h3>
            <div class = "account-checkout-content order-checkout-content">
                <img src="images/checkout-map.png" alt="Map" class="checkout-map">
                <div class="delivery">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M528 320C528 434.9 434.9 528 320 528C205.1 528 112 434.9 112 320C112 205.1 205.1 112 320 112C434.9 112 528 205.1 528 320zM64 320C64 461.4 178.6 576 320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320zM296 184L296 320C296 328 300 335.5 306.7 340L402.7 404C413.7 411.4 428.6 408.4 436 397.3C443.4 386.2 440.4 371.4 429.3 364L344 307.2L344 184C344 170.7 333.3 160 320 160C306.7 160 296 170.7 296 184z"/></svg>
                    <div class="delivery-time">
                        <p>Delivery Time</p>
                        <p>10-20 mins</p>
                    </div>
                </div>
                <div class="address">
                    <div class="address-text time-option">
                        <input class="select-time" type ="radio" name="time-select" checked></input>
                        <h4>Standard</h4>
                        <p>10-20 minutes</p>
                    </div>
                    <div class="address-text time-option">
                        <input class="select-time" type ="radio" name="time-select"></input>
                        <h4>Schedule for later</h4>
                        <p>Choose a time</p>
                    </div>
                </div>
                <div class="address">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                        <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
                    </svg>
                    <div class="address-text">
                        <h4>101 blah drive</h4>
                        <p>Birkenhead, Auckland, NZ</p>
                    </div>
                </div>
                <div class="bar-break"></div>
            </div>
        </div>

        <div class ="account-checkout-section">
            <h3>3. Payment details</h3>
            <div class = "account-checkout-content order-checkout-content">
                <div class="payment-methods">
                    <div class="payment-method-container">
                        <div class="payment-method" onclick="togglePaymentMethod('credit-card-form')">
                            <div class="payment-method-title">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 192L64 224L576 224L576 192C576 156.7 547.3 128 512 128L128 128C92.7 128 64 156.7 64 192zM64 272L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 272L64 272zM128 424C128 410.7 138.7 400 152 400L200 400C213.3 400 224 410.7 224 424C224 437.3 213.3 448 200 448L152 448C138.7 448 128 437.3 128 424zM272 424C272 410.7 282.7 400 296 400L360 400C373.3 400 384 410.7 384 424C384 437.3 373.3 448 360 448L296 448C282.7 448 272 437.3 272 424z"/></svg>
                                <p>Credit/Debit Card</p>
                            </div>
                            <button class="payment-method-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M471.1 297.4C483.6 309.9 483.6 330.2 471.1 342.7L279.1 534.7C266.6 547.2 246.3 547.2 233.8 534.7C221.3 522.2 221.3 501.9 233.8 489.4L403.2 320L233.9 150.6C221.4 138.1 221.4 117.8 233.9 105.3C246.4 92.8 266.7 92.8 279.2 105.3L471.2 297.3z"/></svg>
                            </button>
                        </div>
                        <div class="bar-break"></div>
                        <form class="payment-expanded credit-card-form">
                            <div class="email">
                                <p>Name on Card</p>
                                <input class ="account-input" placeholder="Required" type="text" required> 
                            </div>
                            <div class="email">
                                <p>Card Number</p>
                                <input class ="account-input" placeholder="Required" type="number" maxlength="19" required> 
                            </div>
                            <div class="expiry-cvc">
                                <div class="fname">
                                    <p>Expiry Date</p>
                                    <input type="month" class="account-input" placeholder="Required" required>
                                </div>
                                <div class="lname">
                                    <p>CVC</p>
                                    <input type="number" class ="account-input" placeholder="Required" required>
                                </div>
                            </div>
                            <div class="payment-button-container">
                                <button class="Signin-btn" type="submit">Pay Now</button>
                            </div>
                        </form>
                    </div>
                    <div class="payment-method-container">
                        <div class="payment-method" onclick="togglePaymentMethod('paypal-form')">
                            <div class="payment-method-title">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M218.3 322.2C218.3 334.4 208.6 343.7 196.3 343.7C187.1 343.7 180.3 338.5 180.3 328.7C180.3 316.5 189.8 306.7 202 306.7C211.3 306.7 218.3 312.4 218.3 322.2zM112.5 273.7L107.8 273.7C106.3 273.7 104.8 274.7 104.6 276.4L100.3 303.1L108.5 302.8C119.5 302.8 128 301.3 130 288.6C132.3 275.2 123.8 273.7 112.5 273.7zM396.5 273.7L392 273.7C390.2 273.7 389 274.7 388.8 276.4L384.6 303.1L392.6 302.8C405.6 302.8 414.6 299.8 414.6 284.8C414.5 274.2 405 273.7 396.5 273.7zM608 144L608 496C608 522.5 586.5 544 560 544L80 544C53.5 544 32 522.5 32 496L32 144C32 117.5 53.5 96 80 96L560 96C586.5 96 608 117.5 608 144zM160.3 279.4C160.3 258.4 144.1 251.4 125.6 251.4L85.6 251.4C83.1 251.4 80.6 253.4 80.4 256.1L64 358.2C63.7 360.2 65.2 362.2 67.2 362.2L86.2 362.2C88.9 362.2 91.4 359.3 91.7 356.5L96.2 329.9C97.2 322.7 109.4 325.2 114.2 325.2C142.8 325.2 160.3 308.2 160.3 279.4zM244.5 288.2L225.5 288.2C221.7 288.2 221.5 293.7 221.3 296.4C215.5 287.9 207.1 286.4 197.6 286.4C173.1 286.4 154.4 307.9 154.4 331.6C154.4 351.1 166.6 363.8 186.1 363.8C195.1 363.8 206.3 358.9 212.6 351.9C212.1 353.4 211.6 356.6 211.6 358.1C211.6 360.4 212.6 362.1 214.8 362.1L232 362.1C234.7 362.1 237 359.2 237.5 356.4L247.7 292.1C248 290.2 246.5 288.2 244.5 288.2zM285 386.1L348.7 293.5C349.2 293 349.2 292.5 349.2 291.8C349.2 290.1 347.7 288.3 346 288.3L326.8 288.3C325.1 288.3 323.3 289.3 322.3 290.8L295.8 329.8L284.8 292.3C284 290.1 281.8 288.3 279.3 288.3L260.6 288.3C258.9 288.3 257.4 290.1 257.4 291.8C257.4 293 276.9 348.6 278.6 353.9C275.9 357.7 258.1 382.5 258.1 385.5C258.1 387.3 259.6 388.7 261.3 388.7L280.5 388.7C282.3 388.6 284 387.6 285 386.1zM444.3 279.4C444.3 258.4 428.1 251.4 409.6 251.4L369.9 251.4C367.2 251.4 364.7 253.4 364.4 256.1L348.2 358.1C348 360.1 349.5 362.1 351.4 362.1L371.9 362.1C373.9 362.1 375.4 360.6 375.9 358.9L380.4 329.9C381.4 322.7 393.6 325.2 398.4 325.2C426.8 325.2 444.3 308.2 444.3 279.4zM528.5 288.2L509.5 288.2C505.7 288.2 505.5 293.7 505.2 296.4C499.7 287.9 491.2 286.4 481.5 286.4C457 286.4 438.3 307.9 438.3 331.6C438.3 351.1 450.5 363.8 470 363.8C479.3 363.8 490.5 358.9 496.5 351.9C496.2 353.4 495.5 356.6 495.5 358.1C495.5 360.4 496.5 362.1 498.7 362.1L516 362.1C518.7 362.1 521 359.2 521.5 356.4L531.7 292.1C532 290.2 530.5 288.2 528.5 288.2zM576 254.9C576 252.9 574.5 251.4 572.8 251.4L554.3 251.4C552.8 251.4 551.3 252.6 551.1 254.1L534.9 358.1L534.6 358.6C534.6 360.4 536.1 362.1 538.1 362.1L554.6 362.1C557.1 362.1 559.6 359.2 559.8 356.4L576 255.2L576 254.9zM486 306.7C473.8 306.7 464.3 316.4 464.3 328.7C464.3 338.4 471.3 343.7 480.5 343.7C492.5 343.7 502.2 334.5 502.2 322.2C502.3 312.4 495.3 306.7 486 306.7z"/></svg>
                                <p>PayPal</p>
                            </div>
                            <button class="payment-method-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M471.1 297.4C483.6 309.9 483.6 330.2 471.1 342.7L279.1 534.7C266.6 547.2 246.3 547.2 233.8 534.7C221.3 522.2 221.3 501.9 233.8 489.4L403.2 320L233.9 150.6C221.4 138.1 221.4 117.8 233.9 105.3C246.4 92.8 266.7 92.8 279.2 105.3L471.2 297.3z"/></svg>
                            </button>
                        </div>
                        <div class="bar-break"></div>
                        <form class="payment-expanded paypal-form">
                            <div class="payment-button-container">
                                <button class="Signin-btn" type="submit">Continue with PayPal</button>
                            </div>
                        </form>
                    </div>
                    <div class="payment-method-container">
                        <div class="payment-method" onclick="togglePaymentMethod('bank-transfer-form')">
                            <div class="payment-method-title">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M31 169C21.6 159.6 21.6 144.4 31 135.1L103 63C112.4 53.6 127.6 53.6 136.9 63C146.2 72.4 146.3 87.6 136.9 96.9L105.9 127.9L173.6 127.9L173.6 127.9L511.9 127.9C547.2 127.9 575.9 156.6 575.9 191.9L575.9 370.1L570.8 365C542.7 336.9 497.1 336.9 469 365C441.8 392.2 440.9 435.6 466.2 463.9L533.9 463.9L502.9 432.9C493.5 423.5 493.5 408.3 502.9 399C512.3 389.7 527.5 389.6 536.8 399L608.8 471C618.2 480.4 618.2 495.6 608.8 504.9L536.8 576.9C527.4 586.3 512.2 586.3 502.9 576.9C493.6 567.5 493.5 552.3 502.9 543L533.9 512L127.8 512C92.5 512 63.8 483.3 63.8 448L63.8 269.8L68.9 274.9C97 303 142.6 303 170.7 274.9C197.9 247.7 198.8 204.3 173.5 176L105.8 176L136.8 207C146.2 216.4 146.2 231.6 136.8 240.9C127.4 250.2 112.2 250.3 102.9 240.9L31 169zM416 320C416 267 373 224 320 224C267 224 224 267 224 320C224 373 267 416 320 416C373 416 416 373 416 320zM504 255.5C508.4 256 512 252.4 512 248L512 200C512 195.6 508.4 192 504 192L456 192C451.6 192 447.9 195.6 448.5 200C452.1 229 475.1 251.9 504 255.5zM136 384.5C131.6 384 128 387.6 128 392L128 440C128 444.4 131.6 448 136 448L184 448C188.4 448 192.1 444.4 191.5 440C187.9 411 164.9 388.1 136 384.5z"/></svg>
                                <p>Bank Transfer</p>
                            </div>
                            <button class="payment-method-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M471.1 297.4C483.6 309.9 483.6 330.2 471.1 342.7L279.1 534.7C266.6 547.2 246.3 547.2 233.8 534.7C221.3 522.2 221.3 501.9 233.8 489.4L403.2 320L233.9 150.6C221.4 138.1 221.4 117.8 233.9 105.3C246.4 92.8 266.7 92.8 279.2 105.3L471.2 297.3z"/></svg>
                            </button>
                        </div>
                        <div class="bar-break"></div>
                        <form class="payment-expanded bank-transfer-form">
                            <p>Please transfer the total amount to the following bank account:</p>
                            <div class="email">
                                <p>Account Name</p>
                                <input class ="account-input" placeholder="Required" value ="MedX Delivery Ltd" type="text" required> 
                            </div>
                            <div class="email">
                                <p>Bank Name</p>
                                <input class ="account-input" placeholder="Required" type="text" maxlength="19" required> 
                            </div>
                            <div class="email">
                                <p>Account Number</p>
                                <input class ="account-input" placeholder="Required" type="number" maxlength="19" required> 
                            </div>
                            <div class="email">
                                <p>SWIFT/BIC</p>
                                <input class ="account-input" placeholder="Required" type="text" maxlength="8" required> 
                            </div>
                            <div class="email">
                                <p>Reference</p>
                                <input class ="account-input" placeholder="Required" type="text" maxlength="8" required> 
                            </div>
                            <p>✔️ Important: Use your Order ID as the payment reference.</p>
                            <p>📧 Once completed, please email proof of payment to:  **payments@medx.co.nz**</p>
                            <div class="understand">
                                <input type="checkbox" id="understand" required>
                                <p>I confirm I have read the instructions.</p>
                            </div>
                            
                            <div class="payment-button-container">
                                <button class="Signin-btn" type="submit">Pay Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <button class="checkout-btn">Place order</button>
    </div>

    <div class="drone-container">
            
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="store.php">Store</a></li>
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
    <script src="drone.js"></script>
</body>
</html>