
    <?php
        session_start();
        include('includes/header.php');
        include('functions/selectData.php');

    ?>

    <section id="error" class="error-section">
        <div class="error-container">
            <div class="column-left">
                <span class="span-text"><?php echo $error['404']; ?> </span>
                <h3><?php echo $error['title']; ?></h3>
                <p><?php echo $error['subtitle']; ?></p>
                <button type="button" class="btn error" id="error_btn" name="btn"><?php echo $error['btn']; ?></button>
            </div>
            <div class="column-right">
                <img src="images/error-removebg-preview.png" class="error-image" alt="Error-Page-Image">
            </div>
        </div>
    </section>

    <?php 
        include('includes/footer.php');
    ?>