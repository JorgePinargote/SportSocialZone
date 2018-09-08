function seguir(idEquipo){
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "POST",
		url: "http://127.0.0.1:8000/auth/follow",
		data:{'idequipo':idEquipo},
		dataType:'json',
	    success: function(data){
	    	console.log(data);

	    },
	    error:function(data){
	    	console.log(data);

	    }
	  });
	
}

function llenar(){
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: "POST",
		url: "http://127.0.0.1:8000/auth/follow",
		data:{'idequipo':idEquipo},
		dataType:'json',
	    success: function(data){
	    	console.log(data);

	    },
	    error:function(data){
	    	console.log(data);

	    }
	  });
}