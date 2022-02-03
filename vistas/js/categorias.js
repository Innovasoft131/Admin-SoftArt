$(document).on("click", ".guardarCategorias", function(){
    var categoria = localStorage.getItem("subCategorias"); 

	
	var datos = new FormData();
  datos.append("guardarCategorias", "");
	datos.append("categoria", categoria);



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
              localStorage.removeItem("subCategorias");
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


/* AGREGAR A TABLA DE SUBCATEGORIAS */

$(document).on("click", "#btnAgregarsubCategoria", function(){
 
  var listaSubCategorias = JSON.parse(localStorage.getItem("subCategorias"));
  const subCategoria = document.getElementById("nuevosubCategoria").value;
  const categoria = document.getElementById("nuevoNombre").value;
  var agregarSubCategoria = false;
  var idSubCategoria = Date.now();
  // validar si la lista de subCategorias ya tiene datos
  if(listaSubCategorias != null){
    const subCategoriaDuplicada = listaSubCategorias.find(subCategorias => subCategorias["subCategoria"] == subCategoria);

    if(subCategoriaDuplicada != undefined){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'La Subcategoría ya está agregada',
        showConfirmButton: false,
        timer: 1500
      });
      agregarSubCategoria = false;

    }else{
      agregarSubCategoria = true;
   
    }
  }else{
    agregarSubCategoria = true;
  }
  if(subCategoria == ''){
    Swal.fire({
      icon: 'error',
      title: 'Error...',
      text: 'Ingresar subcategoría'
    });
    agregarSubCategoria = false;
    document.getElementById('nuevosubCategoria').value = '';
  }

  if(agregarSubCategoria == true){
    // se recuperan los datos del localStorage
    if(localStorage.getItem("subCategorias") == null){
      listaSubCategorias = [];
    }else{
      listaSubCategorias.concat(localStorage.getItem("subCategorias"));
    }

    listaSubCategorias.push({
      "id": idSubCategoria,
      "categoria" : categoria,
      "subCategoria" : subCategoria
    });

    localStorage.setItem('subCategorias', JSON.stringify(listaSubCategorias));
    
    mostrarSubCategorias(idSubCategoria);
  }
  
});

const mostrarSubCategorias = (id) =>{

  const subCategoria = document.getElementById("nuevosubCategoria").value;
  // se obtiene la tabla 
  const tbSubCateforias = document.getElementById('tbSubCategorias');
  // se crean elementos para contruir la tabla
  const fragmentoSubCategoria = document.createDocumentFragment();
  const tr = document.createElement('tr');
  const td = document.createElement('td');
  const tdB = document.createElement('td');
  const h3 = document.createElement('h3');
  const btnEliminarSubCategoria = document.createElement('input');

  // Se proporcionan atributos a los elementos creados
  tr.setAttribute('id','fila-'+ subCategoria);
  tdB.classList.add('text-center');
  h3.classList.add('card-title');
  const nodo = document.createTextNode(subCategoria);
  btnEliminarSubCategoria.classList.add('btn', 'btn-danger', 'btnEliminarSubCategoria');
  btnEliminarSubCategoria.setAttribute('type', 'button');
  btnEliminarSubCategoria.setAttribute('id',  id);
  btnEliminarSubCategoria.setAttribute('value', 'Eliminar');


  tdB.appendChild(btnEliminarSubCategoria);
  h3.appendChild(nodo);
  td.appendChild(h3);
  tr.appendChild(td);
  tr.appendChild(tdB);
  fragmentoSubCategoria.appendChild(tr);
  tbSubCateforias.appendChild(fragmentoSubCategoria);
  document.getElementById('nuevosubCategoria').value = '';
}


/* eliminar subCategoria desde la tabla */
$(document).on("click", ".btnEliminarSubCategoria", function(){
  var a = $(this).attr('id');

  var listaSubCategorias = JSON.parse(localStorage.getItem('subCategorias'));
  
  var nuevaSubCategoria = listaSubCategorias.filter((subcategoria) => subcategoria['id'] != a);

  localStorage.setItem('subCategorias', JSON.stringify(nuevaSubCategoria));
	$(this).closest("tr").remove();

});