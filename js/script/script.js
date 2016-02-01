$(document).ready(function(){
  
  slideShow();
  togglePanel();

  $('#pmenu li ul').css({
	    display: "none",
	    left: "auto"
	  });
  $('#pmenu li').hoverIntent(function() {
    $(this)
      .find('ul')
      .stop(true, true)
      .slideDown('fast');
  }, function() {
    $(this)
      .find('ul')
      .stop(true,true)
      .fadeOut('fast');
  });

//  Accordion
	$('#country ul > li ul')
	  .click(function(e){
	    e.stopPropagation();
	  })
	  .filter(':not(:first)')
	  .hide();
	  
	$('#country ul > li').click(function(){
	  var selfClick = $(this).find('ul:first').is(':visible');
	  if(!selfClick) {
	    $(this)
	      .addClass('active')
	      .parent()
	      .find('> li ul:visible')
	      .slideToggle()
	      .parent()
	      .removeClass('active');
	  }
	  
	  $(this)
	    .find('ul:first')
	    .stop(true, true)
	    .slideToggle();
	});
});

function slideShow() {
  var current = $('#baner_slide .show');
  var next = current.next().length ? current.next() : current.parent().children(':first');
  
  current.hide().removeClass('show');
  next.fadeIn().addClass('show');
  
  setTimeout(slideShow, 5000);
}

function togglePanel() {
	$(".trigger").click(function(){
		$(".panel").toggle("fast");
		$(this).toggleClass("active");
		return false;
	})
}
