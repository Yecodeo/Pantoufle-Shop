$(document).ready(function () {
  $(".mdl").click(function () {
    $('.modal').addClass('is-active', 500, "easeOutBounce");
  });

  $('.delete').click(function () {
    $('.modal').removeClass('is-active');

  });
});