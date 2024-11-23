var time;
var day;
var month;
var year;
var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var center;
var dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];


// remove border if the selected date is today's date
function todayEqualActive(){
  setTimeout(function(){
    if($(".ui-datepicker-current-day").hasClass("ui-datepicker-today")){ //b roznema nhar le ana fi bdl thto 5at bs b book app
      $(".ui-datepicker-today")
        .children(".ui-state-default")
        .css("border-bottom", "0");
    }
    else{
      $(".ui-datepicker-today")
        .children(".ui-state-default")
        .css("border-bottom", "2px solid rgba(53,60,66,0.5)");
    }
  }, 20);
}

// call the above function on document ready
todayEqualActive();
/***************Hon sheghle**************** */
$('#calendar').datepicker({
  inline: true,
  firstDay: 1,
  showOtherMonths: true, //la 22dr shuf be2e ashhor
  onChangeMonthYear: function(){ 
    todayEqualActive();
  },
  
  beforeShowDay: function (date) {
    var currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0);

    var day = date.getDay();
    var isEnabled = enabledDays.includes(dayNames[day]);
    var isBeforeToday = date.getTime() < currentDate.getTime();

    return [
      isEnabled && !isBeforeToday,
      isEnabled ? '' : 'disabled-day'
    ];
  },
  onSelect: function(dateText, inst){
    var date = $(this).datepicker('getDate'),
    day  = date.getDate(),
    month = date.getMonth() + 1,
    year =  date.getFullYear();
  
    var dayOfWeek = $.datepicker.formatDate('DD', $(this).datepicker('getDate'));

  let doctorId= document.getElementById("docId_Get").value;
  $.ajax({
    method: "POST",
    url: "functions/timePickerSet.php", // Update this with the actual path to your PHP script
    data: { selectedDay: dayOfWeek, did: doctorId },
    success: function(response) {
        // Assuming your PHP script returns only the working hours HTML

      if (owlInstance) {
        owlInstance.trigger('destroy.owl.carousel');
    }

    // Append the response to the desired container
    $('#owl1').empty().append(response);

    // Reinitialize Owl Carousel after content is added
    initOwlCarousel();
        
    },
    error: function(xhr, status, error) {
        console.error("AJAX Request Failed. Status:", status, "Error:", error);
    }
});
   
    /************Hon bde eshteghel*********/
    // display day and month on submit button
    var monthName = months[month - 1];
    var fullDate = monthName + " " + day + ", " + year; 
$(".request .day").text(fullDate);
    
    todayEqualActive();    

    $(".request").removeClass("disabled");
    
    var index;
    
    setTimeout(function(){
       $(".ui-datepicker-calendar tbody tr").each(function(){
        if($(this).find(".ui-datepicker-current-day").length){
          index = $(this).index() + 1;
        }
      });
      
      // insert timepiker placeholder after selected row
      $("<tr class='timepicker-cf'></tr>")
          .insertAfter($(".ui-datepicker-calendar tr")
          .eq(index));
      
      var top = $(".timepicker-cf").offset().top - 2;
      
      if($(".timepicker").css('height') == '60px'){
        $(".timepicker-cf").animate({
          'height': '0px'
        }, { duration: 200, queue: false });
        $(".timepicker").animate({
          'top':top
        }, 200);
        $(".timepicker-cf").animate({
          'height': '60px'
        }, 200);
      }
      else{
        $(".timepicker").css('top',top);
        $(".timepicker, .timepicker-cf").animate({
          'height': '60px'
        }, 200);
      }
    }, 0);
    
    // display time on submit button
    time = $(".owl-stage .center").text();
    $(".request .time").text(time);
    
    $(".owl-item").removeClass("center-n");
    center = $(".owl-stage").find(".center");
    center.prev("div").addClass("center-n");
    center.next("div").addClass("center-n");
  }
  
});
/******************************/ 

// if the inputs arent empty force ":focus state"
$(".form-name input").each(function(){
  $(this).keyup(function() {
    if (this.value) {
      $(this).siblings("label").css({
        'font-size': '0.8em',
        'left': '.15rem',
        'top': '0%'
      });
    }
    // remove force if they're empty
    else{
      $(this).siblings("label").removeAttr("style");
    }
  });
});

 $(".timepicker").on('click', '.owl-next', function(){
  time = $(".owl-stage .center").text();
  $(".request .time").text(time);
  
  $(".owl-item").removeClass("center-n");
  center = $(".owl-stage").find(".center");
  center.prev("div").addClass("center-n");
  center.next("div").addClass("center-n");
}); 

$(".timepicker").on('click', '.owl-prev', function(){
  time = $(".owl-stage .center").text();
  $(".request .time").text(time);
  
  $(".owl-item").removeClass("center-n");
  center = $(".owl-stage").find(".center");
  center.prev("div").addClass("center-n");
  center.next("div").addClass("center-n");
});


var owlInstance; // Declare a variable to store the Owl Carousel instance

    function initOwlCarousel() {
        // Initialize Owl Carousel
        owlInstance = $('.owl').owlCarousel({
            // Your Owl Carousel options here
            center: true,
            loop: true,
            items: 5,
            dots: false,
            nav: true,
            navText: " ",
            mouseDrag: false,
            touchDrag: true,
            responsive: {
                0:{
                    items:3
                },
                700:{
                    items:5
                },
                1200:{
                    items:7
                }
            }
        });
    }

    initOwlCarousel();


$(document).on('click', '.ui-datepicker-next', function(e){
  $(".timepicker-cf").hide(0);
  $(".timepicker").css({
    'height': '0'
  });
  e.preventDefault();
  $(".ui-datepicker").animate({
    "-webkit-transform":"translate(100%,0)"
  }, 200);
});

$(document).on('click', '.ui-datepicker-prev', function(){
  $(".timepicker-cf").hide(0);
  $(".timepicker").css({
    'height': '0'
  });
  $(".ui-datepicker").animate({
    'transform': 'translateX(-100%)'
  }, 200);
});



//hide timepicker when clicking outside
$(document).on('click', function(event) {
  // Check if the click target is not within the timepicker
  if (!$(event.target).closest('.timepicker, .timepicker-cf').length) {
      // Remove or hide the timepicker
      $(".timepicker, .timepicker-cf").animate({
          'height': '0px'
      });
  }
});

// Prevent the click event from propagating within the timepicker element
$('.timepicker, .timepicker-cf').on('click', function(event) {
  event.stopPropagation();
});