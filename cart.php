<?php
require_once 'cart_view.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedX Website</title>
    <link rel="stylesheet" type = "text/css" href="styles/styles.css">
    <link rel="stylesheet" type = "text/css" href="styles/about.css">
</head>
<body class="body">
    <?= render_cart($conn, $user_id) ?>
</body>
</html>