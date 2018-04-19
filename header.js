$(function () {
	var width = $(document).width();
	width = width*10/12
	$('#car').animate({
		marginLeft: "+="+width+"px",
	}, 10000);
});