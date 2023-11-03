
  (function ($) {
  
  "use strict";

    // COUNTER NUMBERS
    jQuery('.counter-thumb').appear(function() {
      jQuery('.counter-number').countTo();
    });
    
    // CUSTOM LINK
    $('.smoothscroll').click(function(){
    var el = $(this).attr('href');
    var elWrapped = $(el);
    var header_height = $('.navbar').height();

    scrollToDiv(elWrapped,header_height);
    return false;

    function scrollToDiv(element,navheight){
      var offset = element.offset();
      var offsetTop = offset.top;
      var totalScroll = offsetTop-navheight;

      $('body,html').animate({
      scrollTop: totalScroll
      }, 300);
    }
});
    
  })(window.jQuery);

  const tomorrow = new Date();
  const oneMonthLater = new Date();
  oneMonthLater.setMonth(oneMonthLater.getMonth() + 1);
  tomorrow.setDate(tomorrow.getDate() + 1);
  flatpickr("#datepicker", {
    dateFormat: "m/d/Y", // Set the desired date format
    altInput: true,     // Show the formatted date in the input field
    altFormat: "m/d/Y", // Use the same date format for displaying
    maxDate: "today",    // Optionally, limit selection to today or earlier
    disableMobile: true
  });

  flatpickr("#datepicker-future", {
    dateFormat: "m/d/Y", // Set the desired date format
    altFormat: "m/d/Y", // Use the same date format for displaying
    minDate: tomorrow, // Disable today and past dates
    maxDate: oneMonthLater,
    disableMobile: true
  });

  flatpickr("#datepicker-regular", {
    dateFormat: "m/d/Y", // Set the desired date format
    altInput: true,     // Show the formatted date in the input field
    altFormat: "m/d/Y", // Use the same date format for displaying
    disableMobile: true
  });


  flatpickr("#timepicker", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "h:i K", // "K" adds AM/PM
    time_24hr: false, // Set to false for 12-hour format
    minuteIncrement: 1, // Set the minute increment to 1
});

$(document).ready(function () {
  $('.datatable').each(function() {
      var dataTable = $(this).DataTable({
          paging: true, // Enable pagination
          pageLength: 10, // Number of rows per page
          lengthMenu: [10, 25, 50, 100], // Dropdown for rows per page
          responsive: true, // Enable responsive behavior
          order: [] // Define the initial column order
      });

      // Add a page change event listener to each DataTable
      dataTable.on('page.dt', function () {
          // Smooth scroll to the top of the page
          $('html, body').animate({
              scrollTop: 0
          }, 500); // 500ms animation duration
      });
  });
});

// Automatically dismiss the alert after 5 seconds (5000 milliseconds)
setTimeout(function () {
  document.getElementById('alert').style.display = 'none';
}, 5000);