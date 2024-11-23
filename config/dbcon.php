<?php
    $server='localhost';
    $user='root';
    $pass='';
    $mydb='healthhubdb';

    $con=mysqli_connect($server, $user, $pass, $mydb);

    if(!$con){
        die("Connection failed:" .mysqli_connect_error());
    }else{

        $createTableUserQuery= "CREATE TABLE IF NOT EXISTS user (
            userId INT PRIMARY KEY AUTO_INCREMENT,
            Fname VARCHAR(200) NOT NULL,
            Lname VARCHAR(200) NOT NULL,
            email VARCHAR(200) UNIQUE NOT NULL,
            password longtext NOT NULL,
            role int NOT NULL,
            registrationDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            restricted int NOT NULL DEFAULT 0,
            auth_token VARCHAR(255) UNIQUE NULL,
            account_activation_hash VARCHAR(64) UNIQUE NULL,
            reset_token_hash VARCHAR(64) UNIQUE NULL,
            reset_token_expires_at DATETIME NULL
        );";
        $createTableUserQuery_run = mysqli_query($con,$createTableUserQuery);

        $role_admin = 0;

       
        $checkExistingQuery = "SELECT * FROM user WHERE role = ?";
        $checkExistingResult = mysqli_prepare($con, $checkExistingQuery);
        mysqli_stmt_bind_param($checkExistingResult, "i", $role_admin);
        mysqli_stmt_execute($checkExistingResult);
        mysqli_stmt_store_result($checkExistingResult); 
        
        if (mysqli_stmt_num_rows($checkExistingResult) == 0) {
          
            $pass = 'Admin123';
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        
            $addAdminQuery = "INSERT INTO user (Fname, Lname, email, password, role) 
                            VALUES ('admin', 'root', 'healthHubAdmin@gmail.com', ?, ?)";
            $addAdminQuery_run = mysqli_prepare($con, $addAdminQuery);
            mysqli_stmt_bind_param($addAdminQuery_run, "si", $hashed_password, $role_admin);
            mysqli_stmt_execute($addAdminQuery_run);
            mysqli_stmt_close($addAdminQuery_run);
            mysqli_stmt_close($checkExistingResult);
        }

        $createTableClinicQuery= "CREATE TABLE IF NOT EXISTS clinic (
            clinicId INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(200) NOT NULL UNIQUE,
            description VARCHAR(200) NOT NULL,
            photo VARCHAR(200) NOT NULL,
            icon VARCHAR(200) NOT NULL

        );";
        $createTableClinicQuery_run = mysqli_query($con,$createTableClinicQuery);

        $createTablePatientQuery= "CREATE TABLE IF NOT EXISTS patient (
            patientId INT PRIMARY KEY AUTO_INCREMENT,
            userId INT NOT NULL,
            gender VARCHAR(100) NOT NULL,
            bloodType VARCHAR(10) NULL,
            dateOfBirth date NOT NULL,
            phoneNumber int UNIQUE NULL,
            FOREIGN KEY (userId) REFERENCES user(userId)

        );";
        $createTablePatientQuery_run = mysqli_query($con,$createTablePatientQuery);

        $createTableDoctorQuery= "CREATE TABLE IF NOT EXISTS doctor (
            doctorId INT PRIMARY KEY AUTO_INCREMENT,
            userId INT NOT NULL,
            clinicId INT NULL,
            phoneNumber int UNIQUE NOT NULL,
            profilePic varchar(200) NULL,
            deleted tinyint NOT NULL DEFAULT 0,
            FOREIGN KEY (userId) REFERENCES user(userId),
            FOREIGN KEY (clinicId) REFERENCES clinic(clinicId) ON DELETE SET NULL

        );";
        $createTableDoctorQuery_run = mysqli_query($con,$createTableDoctorQuery);
    
        $createTableAppointmentQuery= "CREATE TABLE IF NOT EXISTS appointment (
            appId INT PRIMARY KEY AUTO_INCREMENT,
            doctorId INT NOT NULL,
            patientId INT NOT NULL,
            date date NOT NULL,
            time time NOT NULL,
            status varchar(200) NOT NULL,
            FOREIGN KEY (doctorId) REFERENCES doctor(doctorId),
            FOREIGN KEY (patientId) REFERENCES patient(patientId)

        );";
        $createTableAppointmentQuery_run = mysqli_query($con,$createTableAppointmentQuery);
    
        $createTableDoctorHoursQuery= "CREATE TABLE IF NOT EXISTS doctorHours (
            doctorId INT NOT NULL,
            day VARCHAR(200) NOT NULL,
            fromHour TIME NULL,
            toHour TIME NULL,
            available INT NOT NULL,
            PRIMARY KEY (doctorId, day),
            FOREIGN KEY (doctorId) REFERENCES doctor(doctorId)
        );";
        $createTableDoctorHoursQuery_run = mysqli_query($con,$createTableDoctorHoursQuery);

        $createTableDonorQuery= "CREATE TABLE IF NOT EXISTS donor (
            donorId INT PRIMARY KEY AUTO_INCREMENT,
            email varchar(200) UNIQUE NULL,
            bloodType varchar(10) NOT NULL,
            phoneNumber int UNIQUE NULL

        );";
        $createTableDonorQuery_run = mysqli_query($con,$createTableDonorQuery);
    
        $createTableFeedbackQuery= "CREATE TABLE IF NOT EXISTS feedback (
            feedbackId INT PRIMARY KEY AUTO_INCREMENT,
            doctorId INT NOT NULL,
            patientId INT NOT NULL,
            message mediumtext NOT NULL,
            date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            published int NOT NULL DEFAULT 0,
            FOREIGN KEY (doctorId) REFERENCES doctor(doctorId),
            FOREIGN KEY (patientId) REFERENCES patient(patientId)

        );";
        $createTableFeedbackQuery_run = mysqli_query($con,$createTableFeedbackQuery);
    
        $createTableMediaQuery= "CREATE TABLE IF NOT EXISTS media (
            mediaId INT PRIMARY KEY AUTO_INCREMENT,
            doctorId INT NOT NULL,
            facebook varchar(200) NULL,
            instagram varchar(200) NULL,
            linkedin varchar(200) NULL,
            FOREIGN KEY (doctorId) REFERENCES doctor(doctorId)

        );";
        $createTableMediaQuery_run = mysqli_query($con,$createTableMediaQuery);
    
        $createTableMedicalHoursQuery= "CREATE TABLE IF NOT EXISTS medicalHours (
            day varchar(200) PRIMARY KEY,
            fromHour time NULL,
            toHour time NULL,
            closed int NOT NULL

        );";
        $createTableMedicalHoursQuery_run = mysqli_query($con,$createTableMedicalHoursQuery);

        $createTableRemindersQuery= "CREATE TABLE IF NOT EXISTS reminders (
            reminderId INT PRIMARY KEY AUTO_INCREMENT,
            reminder varchar(200) NOT NULL,
            date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP

        );";
        $createTableRemindersQuery_run = mysqli_query($con,$createTableRemindersQuery);
    
        $createTableUrgentBTQuery= "CREATE TABLE IF NOT EXISTS urgentBT (
            urgentBTId INT PRIMARY KEY AUTO_INCREMENT,
            bloodType varchar(10) NOT NULL,
            number int NOT NULL

        );";
        $createTableUrgentBTQuery_run = mysqli_query($con,$createTableUrgentBTQuery);
    
        $createTableWorkingExceptionQuery= "CREATE TABLE IF NOT EXISTS workingException (
            doctorId INT NOT NULL,
            date date NOT NULL,
            fromHour time NULL,
            toHour time NULL,
            available int NOT NULL,
            PRIMARY KEY (doctorId, date),
            FOREIGN KEY (doctorId) REFERENCES doctor(doctorId)

        );";
        $createTableWorkingExceptionQuery_run = mysqli_query($con,$createTableWorkingExceptionQuery);

        
        $checkProcedureQuery = "SHOW PROCEDURE STATUS LIKE 'delete_doctor_children'";
        $checkProcedureResult = mysqli_query($con, $checkProcedureQuery);

        if (mysqli_num_rows($checkProcedureResult) == 0) {
         
            $deleteDocChildrenQuery = "
                CREATE PROCEDURE delete_doctor_children(IN doctorId INT)
                BEGIN
                    -- Delete child records based on the doctorId
                    DELETE FROM media WHERE doctorId = doctorId;
                    DELETE FROM feedback WHERE doctorId = doctorId;
                    DELETE FROM workingException WHERE doctorId = doctorId;
                    DELETE FROM doctorHours WHERE doctorId = doctorId;
                END";
            $deleteDocChildrenQuery_run = mysqli_query($con, $deleteDocChildrenQuery);
        }

    }
    
?>