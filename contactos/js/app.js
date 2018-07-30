var  agregarContacto = document.getElementById("agregar");
var formulario = document.getElementById("formulario_crear_usuario");
var action = formulario.getAttribute('action');
var tablaRegistrados = document.getElementById('registrados');
var xhr = new XMLHttpRequest();

var contacto = document.getElementById('contacto');

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
    var textoBtn = document.createTextNode('Editarr');
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
    trContactos.appendChild(tdNombre);
    trContactos.appendChild(tdTlfn);
    trContactos.appendChild(tdBtnEditar);
    trContactos.appendChild(tdCheckBox);

    tablaRegistrados.childNodes[3].appendChild(trContactos);
}


function agregarUsuario(){
    var form_datos = new FormData(formulario);
    for( [key, value] of form_datos.entries() ){
        console.log(key + " : " + value);
    }
    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            var resultado = xhr.responseText;
            // console.log("Resultado: " + resultado);
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

agregarContacto.addEventListener('click', function(event){
    //evita el action = crear.php
    event.preventDefault();
    agregarUsuario();
});
