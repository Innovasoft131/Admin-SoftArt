/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-productos.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })

$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
$("#nuevaCategoria").change(function(){

	var idCategoria = $(this).val();

	var datos = new FormData();
  	datos.append("idCategoria", idCategoria);

  	$.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

      	if(!respuesta){

      		var nuevoCodigo = idCategoria+"01";
      		$("#nuevoCodigo").val(nuevoCodigo);

      	}else{

      		var nuevoCodigo = Number(respuesta["codigo"]) + 1;
          	$("#nuevoCodigo").val(nuevoCodigo);

      	}
                
      }

  	})

})

/*=============================================
AGREGANDO PRECIO DE VENTA
=============================================*/
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){

	if($(".porcentaje").prop("checked")){

		/*
			P= Precio de venta.

			C= Costo de producción.

			R= Rentabilidad o ganancia que se aspira a obtener con la venta del producto en %. 
		*/
		//var valorPorcentaje = $(".nuevoPorcentaje").val();
		var c = $(".nuevoPorcentaje").val();
		const r = $("#nuevoPrecioCompra").val();
		const rentabilidad = Number(100 - c);
		const divi = Number(100/rentabilidad);
		const p = Number( r * divi);

		
		
	//	var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

	//	var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

		const redondear = Math.round( (p + Number.EPSILON) * 100  )/ 100;
		$("#nuevoPrecioVenta").val(redondear);
	//	//$("#nuevoPrecioVenta").prop("readonly",true);

		$("#editarPrecioVenta").val(p);
	//	$("#editarPrecioVenta").prop("readonly",true);

	}

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$(".nuevoPorcentaje").change(function(){

	if($(".porcentaje").prop("checked")){
		/*
		var valorPorcentaje = $(this).val();
		
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

		var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
		*/
				/*
			P= Precio de venta.

			C= Costo de producción.

			R= Rentabilidad o ganancia que se aspira a obtener con la venta del producto en %. 
		*/

		var c = $(this).val();
		const r = $("#nuevoPrecioCompra").val();
		const rentabilidad = Number(100 - c);
		const divi = Number(100/rentabilidad);
		const p = Number( r * divi);

		const redondear = Math.round( (p + Number.EPSILON) * 100  )/ 100;
		$("#nuevoPrecioVenta").val(redondear);


/*
		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly",true);
		*/

	}

})

$(".porcentaje").on("ifUnchecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",false);
	$("#editarPrecioVenta").prop("readonly",false);

})

$(".porcentaje").on("ifChecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",true);
	$("#editarPrecioVenta").prop("readonly",true);

})

/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

$(".nuevaImagen").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
          var datosCategoria = new FormData();
          datosCategoria.append("idCategoria",respuesta["id_categoria"]);

           $.ajax({

              url:"ajax/categorias.ajax.php",
              method: "POST",
              data: datosCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  $("#editarCategoria").val(respuesta["id"]);
                  $("#editarCategoria").html(respuesta["categoria"]);

              }

          })

           $("#editarCodigo").val(respuesta["codigo"]);

           $("#editarDescripcion").val(respuesta["descripcion"]);

           $("#editarStock").val(respuesta["stock"]);

           $("#editarPrecioCompra").val(respuesta["precio_compra"]);

           $("#editarPrecioVenta").val(respuesta["precio_venta"]);

           if(respuesta["imagen"] != ""){

           	$("#imagenActual").val(respuesta["imagen"]);

           	$(".previsualizar").attr("src",  respuesta["imagen"]);

           }

      }

  })

})

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");


	Swal.fire({
		title: '¿Está seguro de borrar el producto?',
		text: "¡Si no lo está puede cancelar la accíón!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: 'Si, borrar producto!'
	  }).then(function(result){
	
		if(result.value){
	
			window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;

		}
	
	  });
	


});


const mostrarColores = () =>{
	const color = document.getElementById("nuevoColor").value;
	
	// se crean elementos para contruir la tabla
	const tbColores = document.getElementById("tbProductoColor");
	const fragmentoColor = document.createDocumentFragment();
	const tr = document.createElement("tr");
	const td = document.createElement("td");
	const input	= document.createElement("input");
	const tdB = document.createElement("td");
	const btnEliminar = document.createElement("input");
	// se insertan atributos a los elementos	

	tr.setAttribute("id", "fila"+color);
	tr.style.background = color;

	tdB.classList.add('text-center');
	
	input.setAttribute("name", "colores[]");
	input.setAttribute("value", color);
	input.setAttribute("readonly", true);
	input.setAttribute("class", "form-control");
	btnEliminar.setAttribute("type", 'button');
	btnEliminar.setAttribute("id", "fila"+color);
	btnEliminar.setAttribute("value", "Eliminar");
	btnEliminar.classList.add('btn', 'btn-danger', 'btnEliminarColor');


	tdB.appendChild(btnEliminar);
	td.appendChild(input);

	tr.appendChild(td);
	tr.appendChild(tdB);

	fragmentoColor.appendChild(tr);

	tbColores.appendChild(fragmentoColor);

}


/* mostrar colores en tabla */
$(document).on("click", "#btnAgregarColor", function(){
	mostrarColores();
});

/* eliminar color desde la tabla */
$(document).on("click", ".btnEliminarColor", function(){

	$(this).closest("tr").remove();
});


const mostrarTalla = () =>{
	const talla = document.getElementById("nuevotalla").value;
	
	// se crean elementos para contruir la tabla
	const tbTalla = document.getElementById("tbProductoTalla");
	const fragmentoTalla = document.createDocumentFragment();
	const tr = document.createElement("tr");
	const td = document.createElement("td");
	const input	= document.createElement("input");
	const tdB = document.createElement("td");
	const btnEliminar = document.createElement("input");
	// se insertan atributos a los elementos
	tr.setAttribute("id", "fila"+talla);
	tdB.classList.add('text-center');
	input.setAttribute("name", "tallas[]");
	input.setAttribute("value", talla);
	input.setAttribute("class", "form-control");
	btnEliminar.setAttribute("type", 'button');
	btnEliminar.setAttribute("id", "fila"+talla);
	btnEliminar.setAttribute("value", "Eliminar");
	btnEliminar.classList.add('btn', 'btn-danger', 'btnEliminarTallas');


	tdB.appendChild(btnEliminar);
	td.appendChild(input);

	tr.appendChild(td);
	tr.appendChild(tdB);

	fragmentoTalla.appendChild(tr);

	tbTalla.appendChild(fragmentoTalla);
	document.getElementById("nuevotalla").value = "";
}


/* mostrar colores en tabla */
$(document).on("click", "#btnagregarTalla", function(){
	mostrarTalla();
});

/* eliminar talla desde la tabla */
$(document).on("click", ".btnEliminarTallas", function(){

	$(this).closest("tr").remove();
});