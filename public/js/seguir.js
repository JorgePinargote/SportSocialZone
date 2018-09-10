function seguir(idEquipo){
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "POST",
		url: "http://127.0.0.1:8000/auth/follow",
		data:{'idequipo':idEquipo},
		dataType:'json',
	    success: function(data){
	    	alert(data.mensaje);

	    },
	    error:function(data){
	    	console.log(data);

	    }
	  });
	
}

function Noseguir(idEquipo){
	var id =document.getElementById(idEquipo);
	var men="Borrado";
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "DELETE",
		url: "http://127.0.0.1:8000/auth/follow",
		data:{'idequipo':idEquipo},
		dataType:'json',
	    success: function(data){
	    	alert(data.mensaje);

	    },
	    error:function(data){
	    	console.log(data);

	    }
	  });
}