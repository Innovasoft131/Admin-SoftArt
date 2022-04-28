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
			['style', ['style']],
			['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
			['fontname', ['fontname']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ol', 'ul', 'paragraph', 'height']],
			['table', ['table']],
			['insert', ['link']],
			['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
		]
	});
	$('#summernoteEditar').summernote({
		height: 300,
		toolbar: [
			['style', ['style']],
			['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
			['fontname', ['fontname']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ol', 'ul', 'paragraph', 'height']],
			['table', ['table']],
			['insert', ['link']],
			['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
		]
	});
});
$('.tablaProductos').DataTable({
	"ajax": "ajax/datatable-productos.ajax.php",
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {

		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"sUrl": "",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

});








/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

$(".nuevaImagen").change(function () {

	var imagen = this.files[0];

	/*=============================================
		VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
		=============================================*/

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".nuevaImagen").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else if (imagen["size"] > 2000000) {

		$(".nuevaImagen").val("");

		Swal.fire({
			title: "Error al subir la imagen",
			text: "¡La imagen no debe pesar más de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function (event) {

			var rutaImagen = event.target.result;

			$(".previsualizar").attr("src", rutaImagen);

		})

	}
})


/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function () {

	var idProducto = $(this).attr("idProducto");
	const slCategoria = document.getElementById("editarCategoria");
	const slSubCategoria = document.getElementById("editSubCategoriaP");
	slCategoria.innerHTML = '';
	slSubCategoria.innerHTML = '';
	//	document.getElementById("btnEditarDetalleProducto").style.display = 'none';
	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({

		url: "ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			document.getElementById("txtproducto").value = respuesta["id"];
			document.getElementById("editarNombreProductoDetalle").value = respuesta["nombre"];
			$('#summernoteEditar').summernote('code', respuesta["descripcion"]);
			document.getElementById("editarPrecio").value = respuesta["precio_venta"];
			document.getElementById("editarOferta").value = respuesta["oferta_venta"];

			// Se crean los elementos para mostrar las categorías en el select
			const mostrarCategoriasEdit = async () => {
				const categorias = await mostrarCategorias(respuesta["idCategoria"]);


				const optionsCategoria = document.createElement('option');
				const nodosCategoria = document.createTextNode("Selecciona subcategoría");
				optionsCategoria.appendChild(nodosCategoria);
				slCategoria.appendChild(optionsCategoria);


				for (let i = 0; i < categorias.length; i++) {

					const option = document.createElement('option');
					option.setAttribute('value', categorias[i]["id"]);
					const nodo = document.createTextNode(categorias[i]["nombre"]);
					if (categorias[i]["id"] == respuesta["idCategoria"]) {
						option.setAttribute('selected', true);
					}

					option.appendChild(nodo);

					slCategoria.appendChild(option);

				}


			}

			const mostrarSubCategoriasEdit = async () => {
				const subCategorias = await mostrarSubCategoriasProductos(respuesta["idSubCategoria"]);


				const optionSubCategoria = document.createElement('option');
				const nodosSubCategoria = document.createTextNode("Selecciona subcategoría");
				optionSubCategoria.appendChild(nodosSubCategoria);
				slSubCategoria.appendChild(optionSubCategoria);



				for (let i = 0; i < subCategorias.length; i++) {

					const option = document.createElement('option');
					option.setAttribute('value', subCategorias[i]["id"]);
					if (subCategorias[i]["id"] == respuesta["idSubCategoria"]) {
						option.setAttribute('selected', true);
					}
					const nodo = document.createTextNode(subCategorias[i]["nombre"]);

					option.appendChild(nodo);

					slSubCategoria.appendChild(option);

				}

			}

			mostrarCategoriasEdit();
			mostrarSubCategoriasEdit();
			//  mostrarDetalleProductosEditar(respuesta["id"]);


			if (respuesta["foto"] != "") {

				$("#fotoActualProducto").val(respuesta["foto"]);

				$(".previsualizar").attr("src", respuesta["foto"]);

			}


		}

	})

});

// mostrar categorias en editar

const mostrarCategorias = async (idCategoria) => {

	var datos = new FormData();
	datos.append('MostrarCategoriasEditar', '');
	datos.append('idCategoria', idCategoria);
	const enviarDatos = await fetch(
		'ajax/productos.ajax.php',
		{
			method: 'POST',
			body: datos
		}
	);
	const respuesta = await enviarDatos.json();

	return respuesta;
}

// mostrar subcategorias en editar

const mostrarSubCategoriasProductos = async (idSubCategoria) => {

	var datos = new FormData();
	datos.append('MostrarSubCategoriasEditar', '');
	datos.append('idSubCategoria', idSubCategoria);
	const enviarDatos = await fetch(
		'ajax/productos.ajax.php',
		{
			method: 'POST',
			body: datos
		}
	);
	const respuesta = await enviarDatos.json();

	return respuesta;
}

const mostrarDetalleProductosEditar = (idProducto) => {

	var datos = new FormData();
	datos.append("mostrarDetalleProducto", '');
	datos.append('idProductos', idProducto);

	try {
		const traerDatos = async () => {
			const datosDetalleProductos = await fetch(
				'ajax/productos.ajax.php',
				{
					method: 'POST',
					body: datos
				}
			);

			const respuesta = await datosDetalleProductos.json();
			const tabla = document.getElementById("tbProductoDetalleEditar");
			$("#tbProductoDetalleEditar tbody").remove();
			const fragmentoListaDetalleProductos = document.createDocumentFragment();

			var nodoId = "";
			var nodoTamanio = "";
			var nodoMaterial = "";
			var nodoMedida = "";
			var nodoPrecio = "";
			var nodoCantidad = "";
			var nodoColor = "";




			for (let i = 0; i < respuesta.length; i++) {

				// se crean los elementos para la tabla 
				const body = document.createElement("tbody");
				const tr = document.createElement("tr");
				//	const th = document.createElement("th");
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
				//	th.setAttribute("scope", "row");
				divAccion.classList.add("btn-group");

				btnEditar.classList.add("btn", "btn-warning", "editarProductoDetalle");
				btnEditar.setAttribute("type", "button");
				btnEditar.setAttribute("idProducto", respuesta[i]["id"]);
				btnEditar.setAttribute("tamanio", respuesta[i]["tamanio"]);
				btnEditar.setAttribute("material", respuesta[i]["material"]);
				btnEditar.setAttribute("color", respuesta[i]["color"]);
				btnEditar.setAttribute("medidas", respuesta[i]["medidas"]);
				btnEditar.setAttribute("precio_venta", respuesta[i]["precio_venta"]);
				btnEditar.setAttribute("cantidad", respuesta[i]["cantidad"]);
				btnEditar.setAttribute("idProductos", respuesta[i]["idProducto"]);


				btnEliminar.classList.add("btn", "btn-danger", "eliminarEditarProductosDetalle");
				btnEliminar.setAttribute("id_detalle", respuesta[i]["id"]);
				btnEliminar.setAttribute("type", "button");
				iEditar.classList.add("fas", "fa-pen");
				iEliminar.classList.add("fas", "fa-trash");
				// se crean los nodos para mostrar la info en tabla
				//	nodoId = document.createTextNode(respuesta[i]["id"]);
				nodoTamanio = document.createTextNode(respuesta[i]["tamanio"]);
				nodoMaterial = document.createTextNode(respuesta[i]["material"]);
				nodoMedida = document.createTextNode(respuesta[i]["medidas"]);
				nodoPrecio = document.createTextNode(respuesta[i]["precio_venta"]);
				nodoCantidad = document.createTextNode(respuesta[i]["cantidad"]);
				nodoColor = document.createTextNode(respuesta[i]["color"]);
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

		traerDatos();
	} catch (error) {
		console.log(error);
	}
}

$(document).on("click", ".editarProductoDetalle", function () {
	document.getElementById("btnEditarDetalleProducto").style.display = '';
	document.getElementById("btnGuardarDetalleProducto").style.display = 'none';
	const id = $(this).attr("idProducto");
	const idProducto = $(this).attr("idProductos");
	const tamanio = $(this).attr("tamanio");
	const medidas = $(this).attr("medidas");
	const material = $(this).attr("material");
	const color = $(this).attr("color");
	const cantidad = $(this).attr("cantidad");
	const precio_venta = $(this).attr("precio_venta");

	document.getElementById('btnEditarDetalleProducto').setAttribute("id_detalle", id);
	document.getElementById('btnEditarDetalleProducto').setAttribute("id_producto", idProducto);

	document.getElementById('editartamanio').value = tamanio;
	document.getElementById('editarmedidas').value = medidas;
	document.getElementById('editarMaterial').value = material;
	if (color != '') {
		document.getElementById('editarColorProducto').value = color;
		$('#editarColor').bootstrapSwitch('state', true);
		var inputColor = document.getElementById("editarColorProducto");
		inputColor.removeAttribute("hidden");
	} else {
		$('#editarColor').bootstrapSwitch('state', false);
		var inputColor = document.getElementById("editarColorProducto");
		inputColor.setAttribute("hidden", true);
		inputColor.value = '#000';
	}

	document.getElementById('editarCantidad').value = cantidad;
	document.getElementById('editarPrecio').value = precio_venta;



});

/*=============================================
INICIO SECCION DE QUE ACTUALIZA EL DETALLE DEL PRODUCTO
=============================================*/

const editarDetallesProducto = async (id) => {
	const pruguntaColor = $("#editarColor").bootstrapSwitch('state');
	var color = '';
	const idProducto = document.getElementById('txtproducto').value;
	const tamanio = document.getElementById('editartamanio').value;
	const medidas = document.getElementById('editarmedidas').value;
	const material = document.getElementById('editarMaterial').value;
	if (pruguntaColor == true) {
		color = document.getElementById('editarColorProducto').value;
	}

	const cantidad = document.getElementById('editarCantidad').value;
	const precio_venta = document.getElementById('editarPrecio').value;

	var datos = new FormData();
	datos.append('editarDetalles', '');
	datos.append('id', id);
	datos.append('idProductoDetalle', idProducto);
	datos.append('tamanio', tamanio);
	datos.append('medidas', medidas);
	datos.append('material', material);
	datos.append('color', color);
	datos.append('cantidad', cantidad);
	datos.append('precio_venta', precio_venta);

	try {
		const enviar = await fetch(
			'ajax/productos.ajax.php',
			{
				method: 'POST',
				body: datos
			}
		);

		const resultados = await enviar.json();
		return resultados;
	} catch (error) {
		console.log(error);
	}

}

$(document).on("click", "#btnEditarDetalleProducto", function () {
	const id_detalle = $(this).attr('id_detalle');

	const editarDetalleProducto = async () => {
		const respuesta = await editarDetallesProducto(id_detalle);

		if (respuesta == 'ok') {
			Swal.fire({
				position: 'center',
				icon: 'success',
				title: 'Se actualizaron correctamente los datos',
				showConfirmButton: false,
				timer: 2500
			});
			document.getElementById('editartamanio').value = '';
			document.getElementById('editarmedidas').value = '';
			document.getElementById('editarMaterial').value = '';
			document.getElementById('editarColorProducto').value = '#000';
			document.getElementById('editarCantidad').value = '';
			document.getElementById('editarPrecio').value = '';
			$('#editarColor').bootstrapSwitch('state', false);
			document.getElementById("btnEditarDetalleProducto").style.display = 'none';
			document.getElementById("btnGuardarDetalleProducto").style.display = '';
			mostrarDetalleProductosEditar(document.getElementById("txtproducto").value);

		} else if (respuesta == 'error_sintaxis') {
			Swal.fire({
				position: 'center',
				icon: 'error',
				title: 'Datos ingresados incorrectamente',
				showConfirmButton: false,
				timer: 2500
			});
		} else if (respuesta == 'error') {
			Swal.fire({
				position: 'center',
				icon: 'error',
				title: 'Error interno, intente más tarde',
				showConfirmButton: false,
				timer: 2500
			});
		}
	}

	editarDetalleProducto();
});
/*=============================================
FIN SECCION DE QUE ACTUALIZA EL DETALLE DEL PRODUCTO
=============================================*/

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function () {

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
	}).then(function (result) {

		if (result.value) {

			window.location = "index.php?ruta=productos&idProducto=" + idProducto + "&imagen=" + imagen;

		}

	});



});












$(document).on("change", "#nuevaCategoria", function () {

	const idCategoria = $(this).val();

	const cmbSubCategoria = document.getElementById("nuevaSubCategoriaP");

	document.getElementById("nuevaSubCategoriaP").innerHTML = "";
	const datos = new FormData();
	datos.append("mostrarSubCategorias", '');
	datos.append("idCategorias", idCategoria);

	const enviarDatos = async () => {
		const enviarDatosMostrar = await fetch(
			'ajax/categorias.ajax.php',
			{
				method: 'POST',
				body: datos
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

	if (state == true) {
		inputColor.removeAttribute("hidden");
	} else {

		inputColor.setAttribute("hidden", true);
	}
});


$("[name='editarColor']").bootstrapSwitch();

$('input[name="editarColor"]').on('switchChange.bootstrapSwitch', function (event, state) {
	//console.log(this); // DOM element
	//console.log(event); // jQuery event
	//console.log(state); // true | false
	var inputColor = document.getElementById("editarColorProducto");

	if (state == true) {
		inputColor.removeAttribute("hidden");
	} else {

		inputColor.setAttribute("hidden", true);
	}
});
/*
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
*/
/*
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
	//	const th = document.createElement("th");
		const tdId = document.createElement("td");
		const tdtamanio = document.createElement("td");
		const tdmedida = document.createElement("td");
		const tdmaterial = document.createElement("td");
		const tdprecio = document.createElement("td");
		const tdcantidad = document.createElement("td");
		const tdcolor = document.createElement("td");
		const tdAccion = document.createElement("td");
		const divAccion = document.createElement("div");
	//	const btnEditar = document.createElement("button");
		const btnEliminar = document.createElement("button");
		const iEditar = document.createElement("i");
		const iEliminar = document.createElement("i");

		// se insertan atributos y clases a los elementos creados 
	//	th.setAttribute("scope", "row");
		divAccion.classList.add("btn-group");
		/*
		btnEditar.classList.add("btn", "btn-warning");
		btnEditar.setAttribute("type", "button");
		*/
/*
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
//	btnEditar.appendChild(iEditar);
btnEliminar.appendChild(iEliminar);
//	divAccion.appendChild(btnEditar);
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
*/
$(document).on("click", "#btnagregarDetalleProducto", function () {
	mostrarDetalleProducto();
});

// Eliminar detalle del producto en tabla de la modal de insertar
/*
$(document).on("click", ".eliminarTablaProductos", function(){
	const id = $(this).attr('id');
	var listaDetalleProductos = JSON.parse(localStorage.getItem('listProductos'));
  
		var nuevoDetalleProducto = listaDetalleProductos.filter((detalleProductos) => detalleProductos['id'] != id);

		localStorage.setItem('listProductos', JSON.stringify(nuevoDetalleProducto));

	mostrarDetalleProductos();
});
*/
$(document).on("change", "#nuevaNombre", function () {
	var usuario = $(this).val();
	$(".alert").remove();
	var datos = new FormData();
	datos.append("validarProducto", usuario);
	try {
		const validarProducto = async () => {
			const enviarValidacion = await fetch(
				'ajax/productos.ajax.php',
				{
					method: 'POST',
					body: datos
				}
			);
			const respuesta = await enviarValidacion.json();
			if (respuesta) {

				$("#nuevaNombre").parent().after('<div class="alert alert-warning">Este producto ya existe en la base de datos</div>');

				$("#nuevaNombre").val("");
			}
		}
		validarProducto();
	} catch (error) {
		console.log(error);
	}
});

$(document).on("click", ".btnGuardarProducto", function () {
	$(this).attr("disabled", true);
	const nombreProducto = document.getElementById("nuevaNombre").value;
	const idCategoria = document.getElementById("nuevaCategoria").value;
	const idSubCategoria = document.getElementById("nuevaSubCategoriaP").value;
	const precio = document.getElementById("nuevoPrecio").value;
	const oferta = document.getElementById("nuevoOferta").value;
	const descripcion = String($('#summernote').summernote('code')); //document.getElementById("summernote").value;

	const img = document.getElementById("nuevaImagenI").files[0];

	if (idSubCategoria == '') {
		Swal.fire({
			position: 'center',
			icon: 'error',
			title: 'Seleccione una subcategoría',
			showConfirmButton: false,
			timer: 2000
		});
	} else if (nombreProducto == '') {
		Swal.fire({
			position: 'center',
			icon: 'error',
			title: 'Ingrese nombre del producto',
			showConfirmButton: false,
			timer: 2000
		});
	} else if (img == undefined) {
		Swal.fire({
			position: 'center',
			icon: 'error',
			title: 'Ingrese imagen del producto',
			showConfirmButton: false,
			timer: 2000
		});
	} else if (descripcion.slice(22, 33) == 'Descripción' || descripcion.slice(0, descripcion.length) == '&nbsp;') {
		Swal.fire({
			position: 'center',
			icon: 'error',
			title: 'Ingrese descripción del producto',
			showConfirmButton: false,
			timer: 2000
		});
	} else {
		var datosInsert = new FormData();
		datosInsert.append("guardarProducto", '');
		datosInsert.append("nombreProducto", nombreProducto);
		datosInsert.append("idCategoria", idCategoria);
		datosInsert.append("idSubCategoria", idSubCategoria);
		datosInsert.append("descripcion", descripcion);
		datosInsert.append("img", img);
		datosInsert.append("precio", precio);
		datosInsert.append("oferta", oferta);

		try {
			const enviarDatos = async () => {
				const enviar = await fetch(
					'ajax/productos.ajax.php',
					{
						method: 'POST',
						body: datosInsert
					}
				);

				const respuesta = await enviar.json();

				if (respuesta == 'ok') {
					localStorage.removeItem("listProductos");

					Swal.fire({
						title: '¡El producto ha sido guardado correctamente!',
						text: "",
						icon: 'success',
						showCancelButton: false,
						confirmButtonColor: '#3085d6',
					}).then(function (result) {
						if (result.value) {
							window.location = "productos";
						}
					});

				}
			}
			enviarDatos();
		} catch (error) {
			console.log(error);
		}


	}

});

// inicio de seccion para guardar detalle del producto en la edicion
const guardarDetalleProducto = async () => {
	const pruguntaColor = $("#editarColor").bootstrapSwitch('state');
	var color = '';
	const id = document.getElementById("txtproducto").value;
	const tamanio = document.getElementById('editartamanio').value;
	const medidas = document.getElementById('editarmedidas').value;
	const material = document.getElementById('editarMaterial').value;
	if (pruguntaColor == true) {
		color = document.getElementById('editarColorProducto').value;
	}
	const cantidad = document.getElementById('editarCantidad').value;
	const precio_venta = document.getElementById('editarPrecio').value;

	var datos = new FormData();
	datos.append('guardarDetalles', '');
	datos.append('idProductoInsert', id);
	datos.append('tamanio', tamanio);
	datos.append('medidas', medidas);
	datos.append('material', material);
	datos.append('color', color);
	datos.append('cantidad', cantidad);
	datos.append('precio_venta', precio_venta);

	try {
		const enviar = await fetch(
			'ajax/productos.ajax.php',
			{
				method: 'POST',
				body: datos
			}
		);

		const resultados = await enviar.json();
		return resultados;
	} catch (error) {
		console.log(error);
	}
}

$(document).on("click", "#btnGuardarDetalleProducto", function () {

	const guardarDetalleProductos = async () => {
		const respuesta = await guardarDetalleProducto();
		if (respuesta == "ok") {
			Swal.fire({
				position: 'center',
				icon: 'success',
				title: 'Se guardaron correctamente los datos',
				showConfirmButton: false,
				timer: 2500
			});
			document.getElementById('editartamanio').value = '';
			document.getElementById('editarmedidas').value = '';
			document.getElementById('editarMaterial').value = '';
			document.getElementById('editarColorProducto').value = '#000';
			document.getElementById('editarCantidad').value = '';
			document.getElementById('editarPrecio').value = '';
			$('#editarColor').bootstrapSwitch('state', false);
			mostrarDetalleProductosEditar(document.getElementById("txtproducto").value);
		} else if (respuesta == 'error_sintaxis') {
			Swal.fire({
				position: 'center',
				icon: 'error',
				title: 'Datos ingresados incorrectamente',
				showConfirmButton: false,
				timer: 2500
			});
		} else if (respuesta == 'error') {
			Swal.fire({
				position: 'center',
				icon: 'error',
				title: 'Error interno, intente más tarde',
				showConfirmButton: false,
				timer: 2500
			});
		}
	}

	guardarDetalleProductos();

});
// fin de seccion para guardar detalle del producto en la edicion
// inicio de seccion para eliminar detalle de producto en la edicion
const eliminarDatosDetalle = async (id) => {

	try {
		var datos = new FormData();
		datos.append("eliminarDetalleProductos", "");
		datos.append("idEliminar", id);
		const enviarDatos = await fetch(
			'ajax/productos.ajax.php',
			{
				method: 'POST',
				body: datos
			}
		);

		const respuesta = enviarDatos.json();

		return respuesta;
	} catch (error) {
		console.log(error);
	}
}
$(document).on("click", ".eliminarEditarProductosDetalle", function () {
	const id = $(this).attr("id_detalle");

	Swal.fire({
		title: '¿Está seguro de borrar los datos?',
		text: "¡Si no lo está puede cancelar la accíón!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar datos!'
	}).then(function (result) {

		if (result.value == true) {

			const eliminar = async () => {
				const respuesta = await eliminarDatosDetalle(id);
				if (respuesta == 'ok') {
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'Los datos han sido borrados correctamente',
						showConfirmButton: false,
						timer: 2500
					});

					mostrarDetalleProductosEditar(document.getElementById("txtproducto").value);
				} else {
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Error interno, intente más tarde',
						showConfirmButton: false,
						timer: 2500
					});
				}
			}
			eliminar();
		}
	});
});
// fin de seccion para eliminar detalle de producto en la edicion