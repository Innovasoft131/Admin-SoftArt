$(document).on("click", ".guardarCategorias", function(){
    var categoria = $("#nuevoNombre").val();
    const img = document.querySelector("#nuevaFotoCategoria");
	
	var datos = new FormData();
  datos.append("guardarCategorias", "");
	datos.append("categoria", categoria);
  datos.append("img", img.files[0]);


	$.ajax({

		url:"ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            if(respuesta == "ok"){
                Swal.fire({
                    title: '¡La Categoría ha sido guardada correctamente!',
                    text: "",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    //  cancelButtonColor: '#d33',
                    //  cancelButtonText: 'Cancelar',
                    //  confirmButtonText: 'Si, borrar Categoría!'
                  }).then(function(result){
                    if(result.value){
                        window.location = "categorias";
                    }
                  });
            }else if(respuesta == "encontrada"){
                Swal.fire('Categoría ya se encuentra registrada','', 'success');
                $("#nuevoNombre").val();
            }else if(respuesta == "datosIncorrectos"){
                Swal.fire('La Categoría no puede ir vacía o llevar caracteres especiales');
            }
		}

	});
});


$(document).on("click", ".btnEliminarCategoria", function(){

    var idCategoria = $(this).attr("idCategoria");
    var foto = $(this).attr("foto");
  
    Swal.fire({
      title: '¿Está seguro de borrar la Categoría?',
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Categoría!'
    }).then(function(result){
  
      if(result.value){
        var datos = new FormData();
        datos.append("eliminarCategoria", "");
        datos.append("idCategoria", idCategoria);
        datos.append("foto", foto);
    
        $.ajax({
    
            url:"ajax/categorias.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
              
                if(respuesta == "ok"){
                    Swal.fire({
                        title: '¡La Categoría ha sido eliminada correctamente!',
                        text: "",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        //  cancelButtonColor: '#d33',
                        //  cancelButtonText: 'Cancelar',
                        //  confirmButtonText: 'Si, borrar Categoría!'
                      }).then(function(result){
                        if(result.value){
                            window.location = "categorias";
                        }
                      });
   

                    
                }else if(respuesta == "error"){
                    Swal.fire('Error interno al eliminar categoría');
                }
            },
            error: function( res ) {
              if(res.responseText.substring(1,3) == "ok"){
                Swal.fire({
                    title: '¡La Categoría ha sido eliminada correctamente!',
                    text: "",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    //  cancelButtonColor: '#d33',
                    //  cancelButtonText: 'Cancelar',
                    //  confirmButtonText: 'Si, borrar Categoría!'
                  }).then(function(result){
                    if(result.value){
                        window.location = "categorias";
                    }
                  });


                
            }else{
                Swal.fire('Error interno al eliminar categoría');
            }
          }
    
        });
        
  
      }
  
    });
  
  });


/*=============================================
EDITAR CATEGORIA
=============================================*/
$(document).on("click", ".btnEditarCategoria", function(){
  
	var idCategoria = $(this).attr("idCategoria");

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({
		url: "ajax/categorias.ajax.php",
		method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success: function(respuesta){
    	$("#editarCategoria").val(respuesta["nombre"]);
    	$("#idCategoria").val(respuesta["id"]);

      $("#fotoActualCategoria").val(respuesta["foto"]);

			if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}



    }

	});


});