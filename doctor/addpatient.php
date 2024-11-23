<?php 
session_start();
require('../config/dbcon.php');
require('middleware/doctorMiddleware.php');
$did=$_SESSION['doctorId'];
$query="SELECT app.appId, app.date AS date, app.time AS time, app.status AS status, user.email , user.Fname , user.Lname FROM user, appointment AS app, patient, doctor WHERE app.patientId = patient.patientId AND app.doctorId = doctor.doctorId AND patient.userId = user.userId AND doctor.doctorId=$did AND app.status='accepted';";
$res=mysqli_query($con,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Doctor Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="icon" href="/images/favicon.PNG" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/addpatientcss.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- Sidebar -->
    <?php
        include('./includes/sidebar.php');
    ?>
    <!-- End of Sidebar -->

     <!-------section jdide-->
     <div class="main-content">
        <div class="leftright">
            <div class="right">
                <div class="titlesearch">
                    <div>
                        <h2>Appointments</h2>
                    </div>
                    <div class="searchbox">
                        <input type="text" name="search" id="search" placeholder="Search...">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
              <div class="tablediv">
                <table class="table" id="stable">
                    <thead>
                    <tr>
                        <th class="appId">AppId</th>
                        <th>Name</th>
                        <th>Email of Patient</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Actions</th>
                        <th>Completed</th>
                       
                    </tr>
                    </thead>
                    <?php
                    while($row=mysqli_fetch_assoc($res))
                    {
                        echo '
                        <tr>
                        <td class="appId">'.$row['appId'].'</td>
                        <td>'.$row['Fname'].' '.$row['Lname'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['date'].'</td>
                        <td>'.$row['time'].'</td>
                        <td><a href="" class="foredit">Edit</a>  <a href="" class="fordelete">Delete</a></td>
                        <td><a href="" class="forcomplete"><i class="fa-regular fa-circle-check"></i></a></td>
                         </tr>
                        ';
                    }
                    ?>
                    
                  
                    
                </table>

              </div>

            </div>
            <div class="left">
                <div class="title">
                    <h2>Add Appointment</h2>
                </div>

                <form action="" id="form">
                    <div class="txt" id="forpatient">
                       <label for="pname">Patient Email</label>
                       <input type="text" name="pname" id="pname"  onkeyup="showHint(this.value)">
                       <input type="hidden" name="eid" id="eid">
                       <div id="suggestions-container" class="suggestions-container"></div>
                    </div>
                     <div class="txt" id="fornewapp">
                        <label for="nappdate">New appointment date</label>
                        <input type="date" name="nappdate" id="nappdate">
                     </div>
                     <div class="txt" id="fortime">
                        <label for="tapp">Time appointment</label>
                        <input type="time" name="tapp" id="tapp">
                     </div>
                     <div class="btn">
                        <input type="submit" value="Add" name="submit" id="add" class="add">
                        <input type="submit" value="Edit" name="submit" id="edit" class="edit">
                     </div>
                     <input type="hidden" name="did" id="did" value="<?=$did?>">
                </form>

            </div>
        </div>
     </div>
     <!-------end l section l jdide---------->
     <script>

        var filterInput = document.getElementById('search');
        var dataTable = document.getElementById('stable');
        var rows = dataTable.getElementsByTagName('tr');

        filterInput.addEventListener('input', function() {
        var filterValue = filterInput.value.toLowerCase();
        for (var i = 1; i < rows.length; i++) {
            var row = rows[i];
            var cells = row.getElementsByTagName('td');
            var shouldShow = false;
            for (var j = 0; j < cells.length; j++) {
            var cellText = cells[j].textContent.toLowerCase();
            if (cellText.includes(filterValue)) {
                shouldShow = true;
                break;
            }
            }
            row.style.display = shouldShow ? 'table-row' : 'none';
        }
        });
        
     </script>
     <script>
    $(document).ready(function () {
       
        $(".foredit").click(function (e) {
            e.preventDefault(); 

            var eid  =$(this).closest("tr").find("td:eq(0)").text();
            var name = $(this).closest("tr").find("td:eq(1)").text();
            var date = $(this).closest("tr").find("td:eq(2)").text();
            var time = $(this).closest("tr").find("td:eq(3)").text();
            console.log(time);

            document.getElementById('eid').value=eid;
            document.getElementById('pname').value=name;
            document.getElementById('nappdate').value=date;
            document.getElementById('tapp').value=time;

            document.getElementById('edit').style.display="block";
            document.getElementById('add').style.display="none";
            document.getElementById('eid').style.display="block";
        
        });
        $(".forcomplete").click(function (e) {
        e.preventDefault(); 
        completeAction($(this).closest("tr").find("td:eq(0)").text());
    });
        $(".fordelete").click(function (e) {
        e.preventDefault(); 
        deleteAction($(this).closest("tr").find("td:eq(0)").text());
    });
    });
    
    function completeAction(r) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to cancel the action!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'queryFunctions/completeApp.php',
                type: 'get',
                data: { id: r },
                success: function (data) {
                    location.reload();
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    });
}

function deleteAction(r) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../deleteApp.php',
                type: 'get',
                data: { id: r },
                success: function (data) {
                    location.reload();
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    });
}

    
    function showHint(str) {
    if (str == "") {
        document.getElementById("suggestions-container").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    try {
                        var myArr = JSON.parse(this.responseText);
                        insertIntoList(myArr);
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                    }
                } else {
                    console.error("HTTP error:", this.status);
                }
            }
        };
        xmlhttp.open("GET", "./queryFunctions/getPatientsName.php?keyword=" + str, true);
        xmlhttp.send();
    }
}

function insertIntoList(array) {
    var out = "<ul id=\"suggestions-list\" style=''>";

    for (var i = 0; i < array.length; i++) {
        var email = array[i].email;
        out += "<li><a href='#' onclick='fillInput(\"" + email + "\")'>" + email + "</a></li>";
    }
    out += "</ul>";
    document.getElementById("suggestions-container").innerHTML = out;
    
}
function fillInput(value) {
    console.log("Clicked: " + value); // Debugging statement
    document.getElementById("pname").value = value;
    document.getElementById("suggestions-container").innerHTML = ""; // Clear suggestions
}
</script>


    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/addpatient.js"></script>

</body>
</html>