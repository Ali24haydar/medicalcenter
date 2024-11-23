
<?php
    session_start();
   /*  include('../functions/selectData.php'); */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Hub</title>
    <link rel="icon" href="images/favicon.PNG" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/errorpage.css">

</head>
<body>

    <section id="error" class="error-section">
        <div class="error-container">
            <div class="column-left">
                <span class="span-text">Success!</span>
                <h3>Password Updated Successfully</h3>
                <p>YOU CAN NOW LOG IN.</p>
                <button type="button" class="btn error" id="succ_btn" name="btn">Login</button>
            </div>
            <div class="column-right">
                <img src="../images/error-removebg-preview.png" class="error-image" alt="Error-Page-Image">
            </div>
        </div>
    </section>
    
    <script>
        var btn_click = document.getElementById("succ_btn");
        btn_click?.addEventListener("click", function() {
            window.location.href = "../sign-in-up.php";
        });
    </script>

</body>
</html>