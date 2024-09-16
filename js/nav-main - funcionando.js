// JavaScript Document
$(function () {
    var load = function (url) {
        $.get(url).done(function (cont) {
			cambio(url,'cont');
			//console.log('load '+url);
        })
    };
    
	$(document).on('click', 'a.btn-cambio', function (e) {
		$('#page-loader').fadeIn(100);
        
		e.preventDefault();
        var $this = $(this),
            url = $this.attr("href"),
            //title = $this.attr("title");
			title = $this.text();
		
		//history.pushState({url: url, title: title}, 'New Page');
		
		ruta="#!"+url;
		//alert('la ruta es con btn cambio: '+ruta);
		window.history.pushState({url: url, title: title},title, ruta);
        
		document.title = title;
        load(url);
    });

	window.addEventListener('popstate', function (e) {
		var state = e.state;
        if (state !== null) {
			document.title = 'ByDigitalV2';
            //document.title = state.title;
			//alert(state.title);
            load(state.url);
			$('#page-loader').fadeIn(100);
        } else {
            document.title = 'ByDigitalV2';
			load('../fichas/inicio.php');
        }
    });
});
function cambio(ruta,contenedor) {
		$( "#cont" ).load( ruta, function() {
			$('#page-loader').fadeOut(500);
		});
		ruta2="#!"+ruta;
		console.log(ruta2);
		console.log(btoa(ruta2));
		window.history.replaceState({url: ruta}, ruta, ruta2);
		//alert('cambio '+ruta);
};
$(document).ready(function() {
	url_hash=window.location.hash;
	url_hash = url_hash.replace("#!#!","#!");
	url_hash = url_hash.replace("#!","");
	//alert(url_hash);
	if(url_hash!=""){
		cambio(url_hash,'cont');
	}else{
		cambio("../fichas/inicio.php",'cont');
	}
} );


//alert(btoa("category=textile&user=user1")); // ==> Y2F0ZWdvcnk9dGV4dGlsZSZ1c2VyPXVzZXIx
//alert(atob("Y2F0ZWdvcnk9dGV4dGlsZSZ1c2VyPXVzZXIx")); // ==> category=textile&user=user1