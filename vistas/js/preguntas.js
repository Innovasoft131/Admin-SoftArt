$(document).on("click",".btnEditarPregunta",function(){
    var id = $(this).attr("idPregunta");
    var datos = new FormData();
	datos.append("idPregunta", id);
    datos.append("obtenerPregunta", "");

	$.ajax({

		url:"ajax/preguntas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){


			$("#editarPregunta").val(respuesta["pregunta"]);



            $("#editarRespuesta").val(respuesta["respuesta"]);


			$("#editarId").val(respuesta["id"]);



            

		}

	});
});


$(document).on("click", ".btnEliminarPregunta", function(){
    var idPregunta = $(this).attr("idPregunta");

    Swal.fire({
      title: '¿Está seguro de borrar la pregunta?',
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar pregunta!'
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=preguntas&idPregunta="+idPregunta;
  
      }
  
    });
  
});