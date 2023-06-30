$(".dropdown-menu a").click(function(){
    var selText = $(this).text();
    $(this).parents('.dropdown').find('.dropdown-toggle').html('Order by: ' + selText);
  });


$('.sidebar-item').click(function() {
// Remove "active" class from all list items
    $('.sidebar-item').removeClass('active');
// Add "active" class to the clicked list item
    $(this).addClass('active');
});

$("textarea").each(function () {
    this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
  }).on("input", function () {
    this.style.height = 0;
    this.style.height = (this.scrollHeight) + "px";
  });


$('a, button').on('click', function() {
  var sidebarScrollPos = $('#sidebar').scrollTop();
  var mainScrollPos = $(window).scrollTop();
  localStorage.setItem('sidebarScrollPos', sidebarScrollPos);
  localStorage.setItem('mainScrollPos', mainScrollPos);
  });

$('#sidebar').scrollTop(localStorage.getItem('sidebarScrollPos'));
$(window).scrollTop(localStorage.getItem('mainScrollPos'));



$('.user-unassign').on('click', function() {
  $('#form_toDelete').val($(this).attr("data"));
});