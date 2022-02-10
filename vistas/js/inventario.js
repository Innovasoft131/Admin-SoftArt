/*=============================================
SUBIENDO LA FOTO DEL USUARIO
=============================================*/

$(".foto").change(function(){
	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".foto").val("");

  		 Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      icon: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".foto").val("");

  		 Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      icon: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		});

  	}
});



$("[name='ofertaEditar']").bootstrapSwitch();

$('input[name="ofertaEditar"]').on('switchChange.bootstrapSwitch', function (event, state) {
//console.log(this); // DOM element
//console.log(event); // jQuery event
//console.log(state); // true | false
var divOfertaEditar = document.getElementById("divOfertaEditar");

if (state == true){
  divOfertaEditar.removeAttribute("hidden"  );
  } else {
      
    divOfertaEditar.setAttribute("hidden", true);
  }
});
var arrayTalla = [];
$(document).on("click", "#btnAgregarTabla", function(){

  var talla = $("#nuevoTalla").val();
  var buscar = arrayTalla.includes(talla);
  if(buscar == true){
    $("#nuevoTalla").val('');
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Ya existe una talla registrada en la tabla de registro',
      footer: ''
  });
  }else{
    if(talla == ""){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'El campo no puede ir vacío',
        footer: ''
    });
  
      $("#nuevoTalla").val("");
    }else{

      arrayTalla.push(talla);
      var input = ' <input type="text" class="form-control" name="tallas[]"  placeholder="Talla" value="'+talla+'" readonly>';
  
      var boton = '<button type="button" class="btn btn-danger btnEliminarTalla" talla="'+talla+'"><i class="fas fa-trash"></i></button>';
    
      var fila = '';
    
      fila += '<tr>';
      fila += '<td>';
      fila += input;
      fila += '</td>';
      fila += '<td>';
      fila += '<div class="btn-group col-2">'
      fila += boton;
      fila += '</div>';
      fila += '</td>';
      fila += '</tr>';
    
      $("#tbInventario tbody").append(fila);
      $("#nuevoTalla").val('');
    }

  }


});



/*=============================================
ELIMINAR PRODUCTO
=============================================*/
$(document).on("click", ".btnEliminarProducto", function(){

  var idProducto = $(this).attr("idProducto");
  var fotoProducto = $(this).attr("imagen");
  var nombreProducto = $(this).attr("nombreProducto");

  Swal.fire({
    title: '¿Está seguro de borrar el jersey?',
    text: "¡Si no lo está puede cancelar la accíón!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar jersey!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=productos&idProducto="+idProducto+"&nombreProducto="+nombreProducto+"&fotoProducto="+fotoProducto;

    }

  });

});


$(document).on("click", ".btnEliminarTalla", function(){
  var tabla = $(this).closest("tr");
  var talla = $(this).attr("talla");
  Swal.fire({
      title: '¿Está seguro de borrar la talla?',
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar talla!'
    }).then(function(result){
  
      if(result.value){
          tabla.remove();
          eliminarArray(arrayTalla, talla);
      }
  
    });
});


function eliminarArray(array, buscar) {
  
  for (let i = 0; i < array.length; i++) {
      if(array[i].toUpperCase() == buscar.toUpperCase() ){
          array.splice(i, 1);
      }
      
  }

}

$(document).on("click", ".btnEditarProducto", function(){

  var idProducto = $(this).attr("idProducto");
  var datos = new FormData();
  datos.append("buscarProducto", "");
  datos.append("idProducto", idProducto);

  
  $.ajax({

      url:"ajax/inventario.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta){

        $("#idProducto").val(respuesta["id"]);
        $("#EditarCodigo").val(respuesta["codigo"]);
        $("#editarNommbreP").val(respuesta["nombre"]);
        $("#slcCategoriaEditar").append('<option value="'+respuesta["idCategoria"]+'" selected>'+respuesta["categoria"]+'</option>');
        $("#slcGeneroEditar").append('<option value="'+respuesta["genero"]+'" selected>'+respuesta["genero"]+'</option>');
        $("#editarPrecio").val(respuesta["precio"]);

        if(respuesta["precioOferta"] !== null){
        //  document.getElementById("ofertaEditar").checked = true;
        $("[name='ofertaEditar']").bootstrapSwitch('state', true);
          var divOfertaEditar = document.getElementById("divOfertaEditar");
          divOfertaEditar.removeAttribute("hidden"  );
          $("#editarOfertaEditar").val(respuesta["precioOferta"]);
        }
        $("#editarOfertaEditar").val(respuesta["precioOferta"]);
        $("#editarCantidad").val(respuesta["cantidad"]);
        $("#slcEstadoEditar").append('<option value="'+respuesta["estado"]+'" selected>'+respuesta["estado"]+'</option>');
        $("#editarDescripcion").val(respuesta["descripcion"]);
        $("#fotoActual").val(respuesta["foto"]);
        if(respuesta["foto"] != ""){

          $("#previsualizarEditar").attr("src", respuesta["foto"]);
                  
  
        }

        mostrarTallas(respuesta["id"]);

      }
  });
});


function mostrarTallas(idProducto) {
  var datos = new FormData();
  datos.append("buscarTallas", "");
  datos.append("idProducto", idProducto);



	$.ajax({

		url:"ajax/inventario.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
      $("#tbInventarioEditar tbody").html("");
      for (let i = 0; i < respuesta.length; i++) {
        
        var input = ' <input type="text" class="form-control" name="tallasEditar[]"  placeholder="Talla" value="'+respuesta[i]["talla"]+'" readonly>';

        var boton = '<button type="button" class="btn btn-danger btnEliminarTallaEditar" talla="'+respuesta[i]["talla"]+'" id="'+respuesta[i]["id"]+'" idProducto="'+respuesta[i]["idProducto"]+'"><i class="fas fa-trash"></i></button>';
      
        var fila = '';
      
        fila += '<tr>';
        fila += '<td>';
        fila += input;
        fila += '</td>';
        fila += '<td>';
        fila += '<div class="btn-group col-2">'
        fila += boton;
        fila += '</div>';
        fila += '</td>';
        fila += '</tr>';
        $("#tbInventarioEditar tbody").append(fila);
        
      }



    
      
		}

	});
}

$(document).on("click", ".btnEliminarTallaEditar", function(){
  var id = $(this).attr("id");
  var idProducto = $(this).attr("idProducto");
  Swal.fire({
    title: '¿Está seguro de borrar la talla?',
    text: "¡Si no lo está puede cancelar la accíón!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar talla!'
  }).then(function(result){

    if(result.value){
      var datos = new FormData();
      datos.append("eliminarTalla", "");
        datos.append("idTalla", id);
    
    
    
      $.ajax({
    
        url:"ajax/inventario.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
          if(respuesta == "ok"){
            Swal.fire({
              title: '¡La Talla ha sido eliminada correctamente!',
              text: "",
              icon: 'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              //  cancelButtonColor: '#d33',
              //  cancelButtonText: 'Cancelar',
              //  confirmButtonText: 'Si, borrar Talla!'
            }).then(function(result){
              if(result.value){
                mostrarTallas(idProducto);
              }
            });
          }
        }
    
      });
    }

  });
});


$(document).on("click", "#btnAgregarTablaEditar", function(){

  var talla = $("#editarTalla").val();
  var idProducto = $("#idProducto").val();
  
  if(talla == ""){
    $("#editarTalla").parent().after('<div class="alert alert-warning">El campo no puede ir vacío</div>');
  
    $("#editarTalla").val("");
  }else{
    $(".alert").remove();
	
    var talla = $("#editarTalla").val();
    var idProducto = $("#idProducto").val();
  
    var datos = new FormData();
    datos.append("validarTalla", talla);
    datos.append("idProducto", idProducto);
  
     $.ajax({
        url:"ajax/inventario.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
          
          if(respuesta){
            
            $("#editarTalla").parent().after('<div class="alert alert-warning">Esta talla ya existe en la base de datos con este jersey</div>');
  
            $("#editarTalla").val("");
  
          }else{
            var datos = new FormData();
            datos.append("insertarTalla", "");
            datos.append("talla", talla);
            datos.append("idProducto", idProducto);
          
          
          
            $.ajax({
          
              url:"ajax/inventario.ajax.php",
              method: "POST",
              data: datos,
              cache: false,
              contentType: false,
              processData: false,
              dataType: "json",
              success: function(respuesta){
                if(respuesta == "ok"){
                  $("#editarTalla").val('');
                  Swal.fire({
                    title: '¡La Talla ha sido Registrada correctamente!',
                    text: "",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    //  cancelButtonColor: '#d33',
                    //  cancelButtonText: 'Cancelar',
                    //  confirmButtonText: 'Si, borrar Talla!'
                  }).then(function(result){
                    if(result.value){
                      mostrarTallas(idProducto);
                    }
                  });
                }
              }
          
            });
          }
  
        }
  
    });
  }




});

/*=============================================
REVISAR SI EL PRODUCTO YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#nuevoNommbreP", function(){
	$(".alert").remove();
	
	var producto = $(this).val();

	var datos = new FormData();
	datos.append("validarProducto", producto);

	 $.ajax({
	    url:"ajax/inventario.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoNommbreP").parent().after('<div class="alert alert-warning">Este jersey ya existe en la base de datos</div>');

	    		$("#nuevoNommbreP").val("");

	    	}

	    }

	});
});


/*=============================================
REVISAR SI LA TALLA YA ESTÁ REGISTRADA
=============================================*/

function validarTallaEditar(){
	$(".alert").remove();
	
	var talla = $("#editarTalla").val();
  var idProducto = $("#idProducto").val();

	var datos = new FormData();
	datos.append("validarTalla", talla);
  datos.append("idProducto", idProducto);

	 $.ajax({
	    url:"ajax/inventario.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){
          
	    		$("#editarTalla").parent().after('<div class="alert alert-warning">Esta talla ya existe en la base de datos con este jersey</div>');

	    		$("#editarTalla").val("");

	    	}

	    }

	});
}
