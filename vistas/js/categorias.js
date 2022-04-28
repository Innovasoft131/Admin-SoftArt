$(document).on("change", "#nuevoNombre", function () {
  var usuario = $(this).val();
  $(".alert").remove();
  var datos = new FormData();
  datos.append("validarCategoria", usuario);
  try {
    const validarCategoria = async () => {
      const enviarValidacion = await fetch(
        'ajax/categorias.ajax.php',
        {
          method: 'POST',
          body: datos
        }
      );
      const respuesta = await enviarValidacion.json();
      if (respuesta) {

        $("#nuevoNombre").parent().after('<div class="alert alert-warning">Esta categoria ya existe en la base de datos</div>');

        $("#nuevoNombre").val("");
      }
    }
    validarCategoria();
  } catch (error) {
    console.log(error);
  }
});

$(document).on("click", ".guardarCategorias", function () {
  $(this).attr("disabled", true);
  var categoria = localStorage.getItem("subCategorias");


  var datos = new FormData();
  datos.append("guardarCategorias", "");
  datos.append("categoria", categoria);



  $.ajax({

    url: "ajax/categorias.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta == "ok") {
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
        }).then(function (result) {
          if (result.value) {
            window.location = "categorias";
          }
        });
      } else if (respuesta == "encontrada") {
        Swal.fire('Categoría ya se encuentra registrada', '', 'success');
        $("#nuevoNombre").val();
      } else if (respuesta == "datosIncorrectos") {
        Swal.fire('La Categoría no puede ir vacía o llevar caracteres especiales');
      }
    }

  });
});


$(document).on("click", ".btnEliminarCategoria", function () {

  var idCategoria = $(this).attr("idCategoria");


  Swal.fire({
    title: '¿Está seguro de borrar la Categoría?',
    text: "¡Si no lo está puede cancelar la accíón!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar Categoría!'
  }).then(function (result) {

    if (result.value) {
      var datos = new FormData();
      datos.append("eliminarCategoria", "");
      datos.append("idCategoria", idCategoria);

      $.ajax({

        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

          if (respuesta == "ok") {
            Swal.fire({
              title: '¡La Categoría ha sido eliminada correctamente!',
              text: "",
              icon: 'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              //  cancelButtonColor: '#d33',
              //  cancelButtonText: 'Cancelar',
              //  confirmButtonText: 'Si, borrar Categoría!'
            }).then(function (result) {
              if (result.value) {
                window.location = "categorias";
              }
            });



          } else if (respuesta == "error") {
            Swal.fire('Error interno al eliminar categoría');
          }
        },
        error: function (res) {
          if (res.responseText.substring(1, 3) == "ok") {
            Swal.fire({
              title: '¡La Categoría ha sido eliminada correctamente!',
              text: "",
              icon: 'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              //  cancelButtonColor: '#d33',
              //  cancelButtonText: 'Cancelar',
              //  confirmButtonText: 'Si, borrar Categoría!'
            }).then(function (result) {
              if (result.value) {
                window.location = "categorias";
              }
            });



          } else {
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
$(document).on("click", ".btnEditarCategoria", function () {

  var idCategoria = $(this).attr("idCategoria");
  document.getElementById("btnEditartbsubCategoria").style.display = 'none';
  mostrarSubCategoriasEditar(idCategoria);
  var datos = new FormData();
  datos.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarCategoria").val(respuesta["nombre"]);
      $("#idCategoria").val(respuesta["id"]);


    }

  });


});

const mostrarSubCategoriasEditar = async (id) => {
  try {
    const datosSubCategoria = new FormData();
    datosSubCategoria.append("idCategorias", id);
    datosSubCategoria.append("mostrarSubCategorias", '');

    const enviarSubCategoria = await fetch(
      'ajax/categorias.ajax.php',
      {
        method: 'POST',
        body: datosSubCategoria
      }
    );

    const resultadoSubCategoria = await enviarSubCategoria.json();

    mostrarSubCategoriasEditarTb(resultadoSubCategoria);
  } catch (error) {
    console.error(error);
  }
}

const mostrarSubCategoriasEditarTb = (datos) => {
  // se obtiene la tabla 
  const tbSubCateforias = document.getElementById('tbSubCategoriasEditar');
  tbSubCateforias.innerHTML = "";
  for (let i = 0; i < datos.length; i++) {
    let idSubCategoria = Date.now();


    // se crean elementos para contruir la tabla
    const fragmentoSubCategoria = document.createDocumentFragment();
    const tr = document.createElement('tr');
    const td = document.createElement('td');
    const tdB = document.createElement('td');
    const h3 = document.createElement('h3');
    const iconoEditar = document.createElement('i');
    const iconoEliminar = document.createElement('i');
    const btnEliminarSubCategoria = document.createElement('button');
    const btnEditarSubCategoria = document.createElement('button');

    // Se proporcionan atributos a los elementos creados
    tr.setAttribute('id', 'fila-' + datos[0]["nombre"]);
    tdB.classList.add('text-center');
    h3.classList.add('card-title');
    const nodo = document.createTextNode(datos[i]["nombre"]);

    iconoEditar.classList.add('fas', 'fa-pen');
    btnEditarSubCategoria.classList.add('btn', 'btn-warning', 'btnEditSubCategoriaEditar');
    btnEditarSubCategoria.setAttribute('type', 'button');
    btnEditarSubCategoria.setAttribute('id', idSubCategoria);
    btnEditarSubCategoria.setAttribute('idSub', datos[i]["id"]);
    btnEditarSubCategoria.setAttribute('sub', datos[i]["nombre"]);
    // btnEditarSubCategoria.setAttribute('value', 'Editar');



    iconoEliminar.classList.add('fas', 'fa-trash');
    btnEliminarSubCategoria.classList.add('btn', 'btn-danger', 'btnEliminarSubCategoriaEditar');
    btnEliminarSubCategoria.setAttribute('type', 'button');
    btnEliminarSubCategoria.setAttribute('id', idSubCategoria);
    btnEliminarSubCategoria.setAttribute('idSub', datos[i]["id"]);
    // btnEliminarSubCategoria.setAttribute('value', 'Eliminar');



    btnEliminarSubCategoria.appendChild(iconoEliminar);
    btnEditarSubCategoria.appendChild(iconoEditar);
    tdB.appendChild(btnEliminarSubCategoria);
    tdB.appendChild(btnEditarSubCategoria);
    h3.appendChild(nodo);
    td.appendChild(h3);
    tr.appendChild(td);
    tr.appendChild(tdB);
    fragmentoSubCategoria.appendChild(tr);
    tbSubCateforias.appendChild(fragmentoSubCategoria);



  }
}


/* AGREGAR A TABLA DE SUBCATEGORIAS */

$(document).on("click", "#btnAgregarsubCategoria", function () {

  var listaSubCategorias = JSON.parse(localStorage.getItem("subCategorias"));
  const subCategoria = document.getElementById("nuevosubCategoria").value;
  const categoria = document.getElementById("nuevoNombre").value;
  var agregarSubCategoria = false;
  var idSubCategoria = Date.now();
  // validar si la lista de subCategorias ya tiene datos
  if (listaSubCategorias != null) {
    const subCategoriaDuplicada = listaSubCategorias.find(subCategorias => subCategorias["subCategoria"] == subCategoria);

    if (subCategoriaDuplicada != undefined) {
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'La Subcategoría ya está agregada',
        showConfirmButton: false,
        timer: 1500
      });
      agregarSubCategoria = false;

    } else {
      agregarSubCategoria = true;

    }
  } else {
    agregarSubCategoria = true;
  }
  if (subCategoria == '') {
    Swal.fire({
      icon: 'error',
      title: 'Error...',
      text: 'Ingresar subcategoría'
    });
    agregarSubCategoria = false;
    document.getElementById('nuevosubCategoria').value = '';
  }

  if (agregarSubCategoria == true) {
    // se recuperan los datos del localStorage
    if (localStorage.getItem("subCategorias") == null) {
      listaSubCategorias = [];
    } else {
      listaSubCategorias.concat(localStorage.getItem("subCategorias"));
    }

    listaSubCategorias.push({
      "id": idSubCategoria,
      "categoria": categoria,
      "subCategoria": subCategoria
    });

    localStorage.setItem('subCategorias', JSON.stringify(listaSubCategorias));

    mostrarSubCategorias(idSubCategoria);
  }

});

const mostrarSubCategorias = (id) => {

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
  tr.setAttribute('id', 'fila-' + subCategoria);
  tdB.classList.add('text-center');
  h3.classList.add('card-title');
  const nodo = document.createTextNode(subCategoria);
  btnEliminarSubCategoria.classList.add('btn', 'btn-danger', 'btnEliminarSubCategoria');
  btnEliminarSubCategoria.setAttribute('type', 'button');
  btnEliminarSubCategoria.setAttribute('id', id);
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
$(document).on("click", ".btnEliminarSubCategoria", function () {
  var a = $(this).attr('id');

  var listaSubCategorias = JSON.parse(localStorage.getItem('subCategorias'));

  var nuevaSubCategoria = listaSubCategorias.filter((subcategoria) => subcategoria['id'] != a);

  localStorage.setItem('subCategorias', JSON.stringify(nuevaSubCategoria));
  $(this).closest("tr").remove();

});


$(document).on("click", "#btnGuardarsubCategoria", function () {
  const subCategoria = document.getElementById("editarsubCategoria").value;

  if (subCategoria == '') {
    Swal.fire({
      icon: 'error',
      title: 'Error...',
      text: 'Ingresar subcategoría'
    });
  }

  const validarDuplicados = async (subCategoria) => {
    var datos = new FormData();
    datos.append("subCategoria", subCategoria);
    datos.append("validarDuplicados", "");

    const enviarDatos = await fetch(
      'ajax/categorias.ajax.php',
      {
        method: 'POST',
        body: datos
      }
    );

    const respuesta = await enviarDatos.json();
    if (respuesta.length != 0) {
      Swal.fire({
        icon: 'error',
        title: 'Error...',
        text: 'Subcategoría ya se encuentra registrada'
      });

      document.getElementById("editarsubCategoria").value = "";
    } else {
      guardarsubCategoria();
    }

  }
  validarDuplicados(subCategoria);



  const guardarsubCategoria = async () => {
    const idCategoria = document.getElementById("idCategoria").value;

    var datos = new FormData();
    datos.append("subCateg", subCategoria);
    datos.append("idCateg", idCategoria);
    datos.append("guardarSub", '');

    const enviarDatosGuardar = await fetch(
      'ajax/categorias.ajax.php',
      {
        method: 'POST',
        body: datos
      }
    );

    const respuesta = await enviarDatosGuardar.json();

    if (respuesta == 'ok') {
      Swal.fire({
        icon: "success",
        title: "Registrar...",
        text: "¡La subcategoría ha sido guardada correctamente!"
      });
      mostrarSubCategoriasEditar(idCategoria);
      document.getElementById("editarsubCategoria").value = '';
    } else {
      Swal.fire({
        icon: "error",
        title: "Error...",
        text: "¡Error interno!"
      });
    }
  }


});



// Eliminar subcategoria en la edicion
$(document).on("click", ".btnEliminarSubCategoriaEditar", function () {
  const idSubCategoria = $(this).attr("idsub");
  const idCategoria = document.getElementById("idCategoria").value;
  const eliminarSubCategoria = async () => {

    const datos = new FormData();
    datos.append("idSubCat", idSubCategoria);
    datos.append("eliminarSubC", "");
    const enviarDatos = await fetch(
      'ajax/categorias.ajax.php',
      {
        method: 'POST',
        body: datos
      }
    );

    const respuesta = await enviarDatos.json();

    if (respuesta == "ok") {
      Swal.fire({
        icon: "success",
        title: "Registrar...",
        text: "¡La subcategoría ha sido borrada correctamente!"
      });
      mostrarSubCategoriasEditar(idCategoria);
    }

  }

  eliminarSubCategoria();
});

$(document).on("click", ".btnEditSubCategoriaEditar", function () {
  const subCategoria = $(this).attr("sub");
  const idSubCategoria = $(this).attr("idsub");
  document.getElementById("btnEditartbsubCategoria").style.display = '';
  document.getElementById("btnGuardarsubCategoria").style.display = 'none';

  document.getElementById("editarsubCategoria").value = subCategoria;
  $("#btnEditartbsubCategoria").attr("idSubCa", idSubCategoria);
});

$(document).on("click", "#btnEditartbsubCategoria", function () {
  const idSubCategoria = $(this).attr("idsubca");
  const subCategoria = document.getElementById("editarsubCategoria").value;
  const idCategoria = document.getElementById("idCategoria").value;



  if (subCategoria == '') {
    Swal.fire({
      icon: 'error',
      title: 'Error...',
      text: 'Ingresar subcategoría'
    });
  }

  const editarsubCategoria = async () => {
    const datos = new FormData();
    datos.append("idSub", idSubCategoria);
    datos.append("Sub", subCategoria);
    datos.append("editarSub", '');

    const enviarDatos = await fetch(
      'ajax/categorias.ajax.php',
      {
        method: 'POST',
        body: datos
      }
    );

    const result = await enviarDatos.json();

    if (result == 'ok') {
      Swal.fire({
        icon: "success",
        title: "Actualizar...",
        text: "!La subcategoría ha sido cambiada correctamente!"
      });
      document.getElementById("btnEditartbsubCategoria").style.display = 'none';
      document.getElementById("editarsubCategoria").value = '';
      document.getElementById("btnGuardarsubCategoria").style.display = '';
      mostrarSubCategoriasEditar(idCategoria);
    } else {
      Swal.fire({
        icon: "error",
        title: "Error...",
        text: "!Error interno!"
      });
    }
  }
  editarsubCategoria();
});