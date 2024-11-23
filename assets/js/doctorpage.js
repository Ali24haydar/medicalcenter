var form= document.getElementById('yourFB');
var errmsg=document.getElementById('errmsg');
var description=document.getElementById('description');
var did=document.getElementById('did').value;
var feedbacks=document.getElementById('feedback_list');
var did=document.getElementById('did').value;
var pid=document.getElementById('pid');
var form = document.getElementById('yourFB');


form.addEventListener('submit', async (e) => {
    e.preventDefault(); 

    if (description.value === "") {
        errmsg.innerHTML = "<i class='fa-solid fa-triangle-exclamation'></i> This field is required";
        errmsg.style.color = "red";
        errmsg.style.display = "block";
    } else {
        var formdata = new FormData(form);
        try {
            const response = await fetch('functions/addfeedback.php', {
                method: 'POST',
                body: formdata,
            });

            const data = await response.json(); 
            console.log(response);

            if (data && data.response === 200) {
                description.value = "";
                Swal.fire({
                    title: "Your feedback has been sent succefully!",
                    icon: "success",
                    text: data.message,
                    confirmButtonText: "OK"
                });
                displayFeedbacks();
            } else {
                errmsg.innerHTML = `<i class='fa-solid fa-triangle-exclamation'></i> ${data.message}`;
                errmsg.style.color = "red";
                errmsg.style.display = "block";
                console.error('Error:', data);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
});

description.addEventListener('input',(e)=>{
    errmsg.style.display="none";
});

const displayFeedbacks=async()=>{
    var did=document.getElementById('did').value;
    const response= await fetch(`functions/displayFeedback.php?did=${did}`);
    const data=await response.json();
    if(data && data.length>0)
    {
        feedbacks.innerHTML="";
        data.forEach(feedback => {
          if(feedback.pid===pid)
          {
            feedbacks.innerHTML+=`
            <li class="completed">
            <div class="task-title">
                <i class="bx bx-group"></i>
                <p>${feedback.message}</p>
            </div>
            <button class="delete_feedback" value="1" onclick="deleteFeedback(${feedback.fid})"><i class="bx bx-trash-alt"></i></button>
        </li>
            `;
          }
          else{
            feedbacks.innerHTML+=`
            <li class="completed">
            <div class="task-title">
                <i class="bx bx-group"></i>
                <p>${feedback.message}</p>
            </div>
        </li>
            `;

          }
        });
    }
}

displayFeedbacks();

function deleteFeedback(fid)
{
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
                url: 'functions/deleteFeedback.php',
                type: 'get',
                data: { id: fid },
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
