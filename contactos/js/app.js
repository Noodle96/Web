var  agregarContacto = document.getElementById("agregar");
var formulario = document.getElementById("formulario_crear_usuario");
var action = formulario.getAttribute('action');
var tablaRegistrados = document.getElementById('registrados');

var contacto = document.getElementById('contacto');

//para iCheckBoxes
var checkboxes = document.getElementsByClassName('borrar_contacto');
//Para el Boton de borrar
var btn_borrar = document.getElementById('btn_borrar');

var tablebody = document.getElementsByTagName('tbody')

var contenedorAgenda = document.getElementById('contenedor');

//para el buscador el tiempo real
var inputBuscador = document.getElementById('buscador');

//para el total de registros
var totalRegistros = document.getElementById('total');

function registroExitoso(nombre){
    var divMensaje = document.createElement('DIV');
    divMensaje.setAttribute('id','mensaje');

    //crear texto
    var  texto = document.createTextNode('Creado ' + nombre);
    divMensaje.appendChild(texto);

    contacto.insertBefore(divMensaje, contacto.childNodes[4]);
    //agregando la clasae mostrar
    divMensaje.classList.add('mostrar');

    //Ocultar mensaje
    setTimeout(function(){
        divMensaje.classList.add('ocultar');
        setTimeout(function(){
            var divPadreMensaje = divMensaje.parentNode;
            divPadreMensaje.removeChild(divMensaje);
        },500);
    },2000);
}


//funcion para contruir un template de td para rellenar la table
function construirTemplateFila_tr(registro_id, nombre, telefono){
    //creando el td para el nombre
    var tdNombre = document.createElement('TD');
    var textoNombre = document.createTextNode(nombre);
    tdNombre.appendChild(textoNombre);

    //creando el td para el Telefono
    var tdTlfn = document.createElement('TD');
    var textoTlfn = document.createTextNode(telefono);
    tdTlfn.appendChild(textoTlfn);

    //creando el boton a de EDITAR  para luego agregarlo al td
    var btn = document.createElement('A');
    var textoBtn = document.createTextNode('Editar');
    btn.appendChild(textoBtn);
    btn.href = 'editar.php?id=' + registro_id;

    //ahora crearemos el padre td para que tenga el hijo a
    var tdBtnEditar = document.createElement('TD');
    tdBtnEditar.appendChild(btn);


    //creando el inpot del checkbox
    var inputCheckBox = document.createElement('INPUT');
    inputCheckBox.type='checkbox';
    inputCheckBox.name = registro_id;
    inputCheckBox.classList.add('borrar_contacto');

    //ahora creando el TD para agregal el checkbox
    var tdCheckBox = document.createElement('TD');
    tdCheckBox.classList.add('borrar');
    tdCheckBox.appendChild(inputCheckBox);

    //CREANDO EL TR PARA AGREGAR LOS TD's
    var trContactos = document.createElement('TR');
    trContactos.id = registro_id;
    trContactos.appendChild(tdNombre);
    trContactos.appendChild(tdTlfn);
    trContactos.appendChild(tdBtnEditar);
    trContactos.appendChild(tdCheckBox);

    // tablaRegistrados.childNodes[3].appendChild(trContactos);
    tablebody[0].appendChild(trContactos);
    // console.log('tablebody[0].appendChild(trContactos);:-)');
    console.log("CONTACTO CREADO EN EL HTML");
}


function agregarUsuario(){
    var form_datos = new FormData(formulario);
    for( [key, value] of form_datos.entries() ){
        console.log(key + " : " + value);
    }
    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            var resultado = xhr.responseText;
            console.log("Resultado: " + resultado);
            var json = JSON.parse(resultado);
            // console.log(json.respuesta);
            // console.log(json.nombre);
            console.log(json);
            if(json.respuesta == true){
                registroExitoso(json.nombre);
                construirTemplateFila_tr(json.id,json.nombre,json.telefono);
            }
        }
    }
    xhr.send(form_datos);
}




//para cambiar de color cuando se actica el iCheckBox
for(var e = 0 ; e < checkboxes.length ; e++){
    checkboxes[e].addEventListener('change',function(){
        if(this.checked){
            this.parentNode.parentNode.classList.add('activo');
        }else{
            this.parentNode.parentNode.classList.remove('activo');
        }
    });
}


agregarContacto.addEventListener('click', function(event){
    //evita el action = crear.php
    event.preventDefault();
    agregarUsuario();
});


//elimina las filas ids_contactos de el html
function destruirTemplateFila_tr_html(ids_contactos){
    for(e = 0 ; e < ids_contactos.length; e++){
        var elementoBorrado = document.getElementById(ids_contactos[e]);
        tablebody[0].removeChild(elementoBorrado);
        console.log("Elementos borrado del html" + ids_contactos);
    }
}

//brota un mensaje de que loks contactos seleccionados fueron eliminados
function brotarMensajeDeEliminado(){
    var divMensaje = document.createElement('DIV');
    divMensaje.setAttribute('id','borrado');
    var textoMensaje = document.createTextNode('Contacto(S) eliminado(S)');
    divMensaje.appendChild(textoMensaje);

    contenedorAgenda.appendChild(divMensaje);
    console.log("Mensaje de confirmacion de eliminacion mostrado");
    divMensaje.classList.add('mostrar');

    //Ocultar mensaje
    setTimeout(function(){
        divMensaje.classList.add('ocultar');
        setTimeout(function(){
            var divPadreMensaje = divMensaje.parentNode;
            divPadreMensaje.removeChild(divMensaje);
        },500);
    },2000);
}




/*
    Borraremos los contactos con los id que se pasara como argumento
    en el array
*/
function borrarContactos(contactos){
    var xhrr = new XMLHttpRequest();
    xhrr.open('GET', 'eliminar.php?id='+contactos, true);
    console.log('eliminar.php?id=' + contactos);
    xhrr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhrr.onreadystatechange = function(){
        if(xhrr.readyState == 4 && xhrr.status == 200){
            var resultadoBorrado = xhrr.responseText;
            var json = JSON.parse(resultadoBorrado);
            // console.log(json.respuesta);
            // console.log(json.nombre);
            console.log(json);
            if(json.respuesta == true){
                console.log("Resultado: " + resultadoBorrado);
                destruirTemplateFila_tr_html(contactos); //borrara del html
                brotarMensajeDeEliminado();
            }
            else{
                alert("Debes de seleccionar un registro para eliminar");
            }
        }
        else{
            console.log("fuera del 1 if");
        }
    }
    xhrr.send();
}



/*
    Funcion para guardar en un array los checkboxes seleccionados
*/
function checkboxSeleccionado(){
    var contactos = [];
    for (var i = 0; i < checkboxes.length; i++) {
        if(checkboxes[i].checked){
            contactos.push(checkboxes[i].name);
        }
    }
    // console.log(contactos);
    borrarContactos(contactos);
}



//para borrar todos los items seleccionados
btn_borrar.addEventListener('click',function(){
    checkboxSeleccionado();
});




function ocultarRegistros(nombre_buscar){
    var cant = 0;
    //todas las filas
    var registros = document.getElementsByTagName('tr');
    // console.log(registros);
    //expresio reguar que buscar el nombre con case insensitive
    var  expression = new RegExp(nombre_buscar,"i");
    for(var e = 1; e < registros.length ; e++){ //empezamos desde el 1 para que no afecte al tr del head
        registros[e].classList.add('ocultar');
        registros[e].style.display = 'none';
        if( registros[e].childNodes[1].textContent.replace(/\s/g, "").search(expression) != -1 || nombre_buscar == "" ){
            registros[e].classList.add('mostrar');
            registros[e].classList.remove('ocultar');
            registros[e].style.display = 'table-row';
            cant++;
        }
    }
    totalRegistros.innerHTML = cant;

}

//Para buscar en tiempo real
inputBuscador.addEventListener('input',function(){
    ocultarRegistros(this.value);
});



















//
