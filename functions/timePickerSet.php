<?php //la byn se3at she8l t3ul kl dr
require('../config/dbcon.php');                    
    if (isset($_POST['selectedDay']) && isset($_POST['did'])) {
        $day = $_POST['selectedDay'];
        $did= $_POST['did'];
        $query3 = "SELECT fromHour, toHour, day FROM doctorhours WHERE doctorId=$did AND day='$day';"; //b3ml select from to ...
        $result3 = mysqli_query($con, $query3);
    
        // Check if there's an error in the query
        if (!$result3) {
            die('Error in query: ' . mysqli_error($con));
        }
    
        // Check if there are rows in the result set
        if (mysqli_num_rows($result3) > 0) { //yaane l2ton w mwjude
            // Rewind the result set pointer to the beginning 
            mysqli_data_seek($result3, 0);
    
            while ($row = mysqli_fetch_assoc($result3)) {
                $startTime = new DateTime($row['fromHour']);
                $endTime = new DateTime($row['toHour']);
    
                while ($startTime <= $endTime) {
                    echo '<div>' . $startTime->format('H:i') . '</div>';
                    $startTime->modify('+1 hour');  

                }
            }
        } else {
            echo "No available hours for the selected day.";
        }
    }else{
        die("not setted");
    }

?>