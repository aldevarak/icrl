$("#productos").on('mouseover touchstart',function() {
	if ( !$(this).parent().hasClass("open") ) {
		$(this).trigger( "click" );
	}
});
function close_menu() {
	$("#productos").trigger( "click" );
}
