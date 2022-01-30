/*=============================================
EDITAR TESTIMONIO
=============================================*/
$(document).on("click", ".btnEditarTestimonio", function(){
	
	var idTestimonio = $(this).attr("idTestimonio");
	
	var datos = new FormData();
	datos.append("idTestimonio", idTestimonio);

	$.ajax({

		url:"ajax/testimonios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#idTestimonio").val(respuesta["id"]);
			$("#editarNombreCliente").val(respuesta["nombreCliente"]);
			$("#editarCalificacion").val(respuesta["calificacion"]);
			$("#editarTestimonio").val(respuesta["testimonio"]);
            $("#fotoActual").val(respuesta["foto"]);



			if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}

		}

	});

});


/*=============================================
ACTIVAR TESTIMONIO
=============================================*/
$(document).on("click", ".btnActivarTestimonio", function(){

	var idTestimonio = $(this).attr("idTestimonio");
	var estadoTestimonio = $(this).attr("estadoTestimonio");

	var datos = new FormData();
 	datos.append("activarId", idTestimonio);
  	datos.append("estadoTestimonio", estadoTestimonio);

  	$.ajax({

	  url:"ajax/testimonios.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      	if(window.matchMedia("(max-width:767px)").matches){
		
			Swal.fire({
		      	title: "El testtimonio ha sido actualizado",
		      	icon: "success",
		      	confirmButtonText: "¡Cerrar!"
		    	}).then(function(result) {
		        
		        	if (result.value) {

		        	window.location = "testimonios";

		        }

		      });


		}
      }

  	});

  	if(estadoTestimonio == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoTestimonio',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoTestimonio',0);

  	}

});

/*=============================================
ELIMINAR TESTIMONIO
=============================================*/
$(document).on("click", ".btnEliminarTestimonio", function(){

    var idTestimonio = $(this).attr("idTestimonio");
    var fotoCliente = $(this).attr("fotoCliente");
    var cliente = $(this).attr("cliente");
  
    Swal.fire({
      title: '¿Está seguro de borrar el testimonio?',
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar testimonio!'
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=testimonios&idTestimonio="+idTestimonio+"&cliente="+cliente+"&fotoCliente="+fotoCliente;
  
      }
  
    });
  
  });