$(document).ready(function(){
    // Hide all tab contents
    $(".tab-content").hide();

    var hash = window.location.hash;
    if (hash) {
      var tabId = hash.substring(1);
      
      $("#" + tabId).show();
    } else {
      $(".tab-content").first().show();
    }
  
    $(".tab").click(function(){
      var tabId = $(this).data("tab");
  
      $(".tab-content").hide();
      
      $("#" + tabId).show();

      window.location.hash = tabId;
    });

    $(".tab").hover(function() {
        $(this).css("cursor", "pointer");
    });

    $(".tab-content img").css("max-width", "200px");
  });
  