$(function() { 
    $('#sidebarCollapse').on('click', function() {
        console.log("milan");
      $('#sidebar, #content').toggleClass('active');
    });
  });