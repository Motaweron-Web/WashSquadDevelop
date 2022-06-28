$(document).ready(function() {
    $('select').niceSelect();

    $(function () {
      $(document).scroll(function () {
        var $nav = $(".fixed-top");
        $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
      });
    });
  }); 