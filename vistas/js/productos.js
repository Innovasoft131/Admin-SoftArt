/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-productos.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })

$(function () {
	$('#summernote').summernote({
        height: 300,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'insert', [ 'link'] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    });
});
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

		  Swal.fire({
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
/*
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

*/

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




$(document).on("change", "#nuevaCategoria", function(){

	const idCategoria = $(this).val();

	const cmbSubCategoria = document.getElementById("nuevaSubCategoriaP");

	document.getElementById("nuevaSubCategoriaP").innerHTML = "";
	const datos = new FormData();
	datos.append("mostrarSubCategorias", '');
	datos.append("idCategorias", idCategoria);

	const enviarDatos = async() =>{
		const enviarDatosMostrar = await fetch(
			'ajax/categorias.ajax.php',
			{
				method : 'POST',
				body : datos
			}
		);
		const respuesta = await enviarDatosMostrar.json();
		
		const options = document.createElement('option');
		const nodos = document.createTextNode("Selecciona subcategoría");
		options.appendChild(nodos);
		cmbSubCategoria.appendChild(options);
		
		for (let i = 0; i < respuesta.length; i++) {

			const option = document.createElement('option');
			option.setAttribute('value', respuesta[i]["id"]);
			const nodo = document.createTextNode(respuesta[i]["nombre"]);

			option.appendChild(nodo);

			cmbSubCategoria.appendChild(option);
			
		}
		
	}

	enviarDatos();

	

});

$("[name='nuevoColor']").bootstrapSwitch();

$('input[name="nuevoColor"]').on('switchChange.bootstrapSwitch', function (event, state) {
//console.log(this); // DOM element
//console.log(event); // jQuery event
//console.log(state); // true | false
var inputColor = document.getElementById("colorProducto");

if (state == true){
  inputColor.removeAttribute("hidden"  );
  } else {
      
    inputColor.setAttribute("hidden", true);
  }
});

const mostrarDetalleProducto = () =>{
	
	var listaProductos = JSON.parse(localStorage.getItem("listProductos"));
	var agregarProducto = false;
	var id = Date.now();
	
	const pruguntaColor = $("#nuevoColor").bootstrapSwitch('state');
	const tamanio = document.getElementById("nuevotamanio").value;
	const medida = document.getElementById("nuevomedidas").value;
	const material = document.getElementById("nuevoMaterial").value;
	const precio = document.getElementById("nuevoPrecio").value;
	const cantidad = document.getElementById("nuevoCantidad").value;
	const color = document.getElementById("colorProducto").value;



	// se valida si la lista de detalle de productos tiene datos 
	if(listaProductos != null){
		const detalleProductoDuplicado = listaProductos.find(detalleProducto => (detalleProducto["tamanio"] == tamanio && 
																detalleProducto["medida"] == medida && detalleProducto["material"] == material) 
																&& detalleProducto["precio"] == precio && detalleProducto["cantidad"] == cantidad &&
																detalleProducto["color"] == color);
		if(detalleProductoDuplicado != undefined){
			Swal.fire({
				position: 'center',
				icon: 'error',
				title: 'La combinación de detalle del producto ya fue agregada anteriormente',
				showConfirmButton: false,
				timer: 1500
			  });
			  agregarProducto = false;
			  document.getElementById("nuevotamanio").value = '';
			  document.getElementById("nuevomedidas").value = '';
			  document.getElementById("nuevoMaterial").value = '';
			  document.getElementById("nuevoPrecio").value = '';
			  document.getElementById("nuevoCantidad").value = '';
			  document.getElementById("colorProducto").value = '#000';
		}else{
			agregarProducto = true;
		}

	}else{
		agregarProducto = true;
	}  
	
	if(agregarProducto == true){
		// se recuperan los datos 
		if(localStorage.getItem("listProductos") == null){
			listaProductos = [];
		}else{
			listaProductos.concat(localStorage.getItem("listProductos"));
		}
		

		if(pruguntaColor == false){
			listaProductos.push({
				"id" : id,
				"tamanio" : tamanio,
				"medida" : medida,
				"material" : material,
				"precio" : precio,
				"cantidad" : cantidad,
				"color" : ''
			});
		}else{
			listaProductos.push({
				"id" : id,
				"tamanio" : tamanio,
				"medida" : medida,
				"material" : material,
				"precio" : precio,
				"cantidad" : cantidad,
				"color" : color
			});

		}

		localStorage.setItem("listProductos", JSON.stringify(listaProductos));
		document.getElementById("nuevotamanio").value = '';
		document.getElementById("nuevomedidas").value = '';
		document.getElementById("nuevoMaterial").value = '';
		document.getElementById("nuevoPrecio").value = '';
		document.getElementById("nuevoCantidad").value = '';
		document.getElementById("colorProducto").value = '#000';

		mostrarDetalleProductos();
	}

}

const mostrarDetalleProductos = () =>{
	const listaProductos = JSON.parse(localStorage.getItem("listProductos"));
	const tabla = document.getElementById("tbProductoTalla");
	$("#tbProductoTalla tbody").remove(); 
	const fragmentoListaDetalleProductos = document.createDocumentFragment();

	var nodoId = "";
	var nodoTamanio = "";
	var nodoMaterial = "";
	var nodoMedida = "";
	var nodoPrecio = "";
	var nodoCantidad = "";
	var nodoColor = "";
	



	for (let i = 0; i < listaProductos.length; i++) {
		
		// se crean los elementos para la tabla 
		const body = document.createElement("tbody");
		const tr = document.createElement("tr");
		const th = document.createElement("th");
		const tdId = document.createElement("td");
		const tdtamanio = document.createElement("td");
		const tdmedida = document.createElement("td");
		const tdmaterial = document.createElement("td");
		const tdprecio = document.createElement("td");
		const tdcantidad = document.createElement("td");
		const tdcolor = document.createElement("td");
		const tdAccion = document.createElement("td");
		const divAccion = document.createElement("div");
		const btnEditar = document.createElement("button");
		const btnEliminar = document.createElement("button");
		const iEditar = document.createElement("i");
		const iEliminar = document.createElement("i");

		// se insertan atributos y clases a los elementos creados 
		th.setAttribute("scope", "row");
		divAccion.classList.add("btn-group");
		btnEditar.classList.add("btn", "btn-warning");
		btnEditar.setAttribute("type", "button");
		btnEliminar.classList.add("btn", "btn-danger", "eliminarTablaProductos");
		btnEliminar.setAttribute("id", listaProductos[i]["id"]);
		btnEliminar.setAttribute("type", "button");
		iEditar.classList.add("fas", "fa-pen");
		iEliminar.classList.add("fas", "fa-trash");
		// se crean los nodos para mostrar la info en tabla
		nodoId = document.createTextNode(listaProductos[i]["id"]);
		nodoTamanio = document.createTextNode(listaProductos[i]["tamanio"]);
		nodoMaterial = document.createTextNode(listaProductos[i]["material"]);
		nodoMedida = document.createTextNode(listaProductos[i]["medida"]);
		nodoPrecio = document.createTextNode(listaProductos[i]["precio"]);
		nodoCantidad = document.createTextNode(listaProductos[i]["cantidad"]);
		nodoColor = document.createTextNode(listaProductos[i]["color"]);
	//	th.appendChild(nodoId);
		tdtamanio.appendChild(nodoTamanio);
		tdmedida.appendChild(nodoMedida);
		tdmaterial.appendChild(nodoMaterial);
		tdcantidad.appendChild(nodoCantidad);
		tdcolor.appendChild(nodoColor);
		tdprecio.appendChild(nodoPrecio);
		btnEditar.appendChild(iEditar);
		btnEliminar.appendChild(iEliminar);
		divAccion.appendChild(btnEditar);
		divAccion.appendChild(btnEliminar);
		tdAccion.appendChild(divAccion);
	//	tr.appendChild(th);
		tr.appendChild(tdtamanio);
		tr.appendChild(tdmedida);
		tr.appendChild(tdmaterial);
		tr.appendChild(tdcantidad);
		tr.appendChild(tdcolor);
		tr.appendChild(tdprecio);
		tr.appendChild(tdAccion);
		body.appendChild(tr);
		fragmentoListaDetalleProductos.appendChild(body);
		tabla.appendChild(fragmentoListaDetalleProductos);

		nodoId = "";
		nodoTamanio = "";
		nodoMaterial = "";
		nodoMedida = "";
		nodoPrecio = "";
		nodoCantidad = "";
		nodoColor = "";
	}

	
	
}

$(document).on("click", "#btnagregarDetalleProducto", function(){
	mostrarDetalleProducto();
});

// Eliminar detalle del producto en tabla de la modal de insertar
$(document).on("click", ".eliminarTablaProductos", function(){
	const id = $(this).attr('id');
	var listaDetalleProductos = JSON.parse(localStorage.getItem('listProductos'));
  
  	var nuevoDetalleProducto = listaDetalleProductos.filter((detalleProductos) => detalleProductos['id'] != id);

  	localStorage.setItem('listProductos', JSON.stringify(nuevoDetalleProducto));

	mostrarDetalleProductos();
});