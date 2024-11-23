$(document).on('click', '.del-btn, .acc-btn', function (e) {
    e.preventDefault();
    var id = $(this).val(); // Get the ID
    var action = $(this).hasClass('del-btn') ? 'del-btn' : 'acc-btn';

    swal({
        title: action === 'del-btn' ? "Cancel Appointment?" : "Confirm Appointment?",
        text: action === 'del-btn' 
            ? "Once the appointment is canceled, it cannot be recovered." 
            : "Do you want to confirm this appointment?",
        icon: "warning",
        buttons: true,
        dangerMode: action === 'del-btn',
    }).then((willProceed) => {
        if (willProceed) {
            $.ajax({
                method: 'POST',
                url: 'queryFunctions/buttonActions.php',
                data: {
                    'id': id,
                    [action]: 1 // Dynamically pass del-btn or acc-btn
                },
                success: function (response) {
                    console.log("Server Response:", response);
                    const res = JSON.parse(response);

                    if (res.response === 200) {
                        swal("Success!", res.message, "success").then(() => {
                            location.reload();
                        });
                    } else {
                        swal("Error!", res.message, "error");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    swal("Error!", "An unexpected error occurred.", "error");
                }
            });
        }
    });
});
