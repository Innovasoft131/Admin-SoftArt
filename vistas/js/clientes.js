

$(document).on("click",".btnEditarClientes",function(){
    var id = $(this).attr("idCliente");
    var datos = new FormData();
	datos.append("idCliente", id);
    datos.append("obtenerCliente", "");

	$.ajax({

		url:"ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){


			$("#editarUsuario").val(respuesta["usuario"]);



            $("#editarCorreo").val(respuesta["correo"]);


			$("#passwordActualCliente").val(respuesta["password"]);



            

		}

	});
});

$(document).on("click", ".btnEliminarClientes", function(){
    var idCliente = $(this).attr("idCliente");
    var cliente = $(this).attr("cliente");
  
    Swal.fire({
      title: '¿Está seguro de borrar el cliente?',
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=clientes&idCliente="+idCliente+"&cliente="+cliente;
  
      }
  
    });
  
});



/*=============================================
REVISAR SI EL CLIENTE YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#nuevoCliente", function(){
	$(".alert").remove();
	
	var cliente = $(this).val();

	var datos = new FormData();
	datos.append("validarCliente", cliente);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoCliente").parent().after('<div class="alert alert-warning">Este cliente ya existe en la base de datos</div>');

	    		$("#nuevoCliente").val("");

	    	}

	    }

	});
});

