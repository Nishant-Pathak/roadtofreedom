function set_body_height()
{
	var wh = $(window).height();
  $('#content').attr('style', 'height:' + wh + 'px;');
}

$(document).ready(function() {
	set_body_height();
  $(window).bind('resize', function() { set_body_height(); });
});

