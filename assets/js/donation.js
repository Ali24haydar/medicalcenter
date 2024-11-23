/* For donation section */
$(document).ready(function () {
  $(document).on('click','.click-to-donate', function (e) {
      e.preventDefault();
      var id = $(this).val();

      document.getElementById('donatPanel').classList.remove('view');
      document.getElementById('donatPanel').classList.add('hide');
      document.getElementById('donateForm').classList.remove('hide');
      document.getElementById('donateForm').classList.add('view');
 }); 
});
$(document).ready(function () {
  $(document).on('click','.fa-solid.fa-xmark', function (e) {
      e.preventDefault();
      var id = $(this).val();
      document.getElementById('donatPanel').classList.remove('hide');
      document.getElementById('donatPanel').classList.add('view');
      document.getElementById('donateForm').classList.remove('view');
      document.getElementById('donateForm').classList.add('hide');
 }); 
});
