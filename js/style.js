$(function() {
  function slideMenu() {
    var activeState = $("#menu-container .menu-list").hasClass("active");
    $("#menu-container .menu-list").animate({left: activeState ? "0%" : "-100%"}, 400);
  }
  $("#menu-wrapper").click(function(event) {
    event.stopPropagation();
    $("#hamburger-menu").toggleClass("open");
    $("#menu-container .menu-list").toggleClass("active");
    slideMenu();

    $("body").toggleClass("overflow-hidden");
  });

  $(".menu-list").find(".accordion-toggle").click(function() {
    $(this).next().toggleClass("open").slideToggle("fast");
    $(this).toggleClass("active-tab").find(".menu-link").toggleClass("active");

    $(".menu-list .accordion-content").not($(this).next()).slideUp("fast").removeClass("open");
    $(".menu-list .accordion-toggle").not(jQuery(this)).removeClass("active-tab").find(".menu-link").removeClass("active");
  });
  function timer(){
    var setTime = 20;
    var second = 0;
    $('.circle').addClass('pie');
    $('.circle').css({'animation': 'pie '+ setTime*2 +'s linear'})
        var timerId = setInterval(function() {
            second += 1;
            if(second >= setTime){
                clearInterval(timerId);
            }
            countTime = setTime - second;
            $('.minute').text(countTime % 3600 / 60 | 0);
            $('.second').text(countTime % 60);
        }, 1000);
}
timer();
}); // jQuery load
