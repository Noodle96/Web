//google maps API

var api = ' AIzaSyATBPYVEvafX41E8RFrRzynKGI7E6_DqsU ';
function initMap() {
    var latLng = {
        lat: -16.3828006,
        lng: -71.5270265
    };
    var map = new google.maps.Map(document.getElementById('mapa'), {
    'center': latLng,
    'zoom': 16,
    'mapTypeId': google.maps.MapTypeId.TERRAIN // ROADMAP, TERRAIN,SATELLITE,HIBRID
    // 'draggable': false // no se mueve el mapa,
    // 'scrollwheel' : false // no zoom
    });
    var contenido = '<h2>GDLWEBCAMP</h2>'+
                    '<p>del 25 al 28 de Julio</p>' +
                    '<p>Visitanos!!</p>';
    var informacion = new google.maps.InfoWindow({
        content: contenido
    });

    var marker = new google.maps.Marker({
        position : latLng,
        map : map,
        title: 'GdlWebCam Teams'
    });
    marker.addListener('click',function(){
        informacion.open(map,marker);
    });
}


(function(){
    'use strict';
    var regalo = document.getElementById('regalo');


    //UBICACION ACTUAL DE EL usuarios
    $('body.conferencias .navegacion-principal a:contains("Conferencia")').addClass('activo');
    $('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
    $('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');
    $('body.reservaciones .navegacion-principal a:contains("Reservaciones")').addClass('activo');



        document.addEventListener('DOMContentLoaded', function(){
        //CAMPO DATOS usuarios
        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');

        $('a.color_box_plugin').colorbox();

        //CAMPO DATOS PAQUETES
        var pase_dia = document.getElementById('pase_dia');
        var pase_dosdias = document.getElementById('pase_dosdias');
        var pase_completo = document.getElementById('pase_completo');

        //BUTTON Y div
        var calcular = document.getElementById('calcular');
        var errorDiv = document.getElementById('error');
        var botonRegistro = document.getElementById('btnRegistro'); // pagar
        var lista_productos = document.getElementById('lista_productos');
        var suma_total = document.getElementById('suma_total');

        botonRegistro.disabled = true;

        //PAGO Y Extras
        var camiseta_evento = document.getElementById('camiseta_evento');
        var etiquetas = document.getElementById('etiquetas');


        //EVENTOS
        calcular.addEventListener('click',calcularMontos);
        pase_dia.addEventListener('blur',mostrarDias); //blur pone como valor a un id cuando el cursor sale afuera
        pase_dosdias.addEventListener('blur',mostrarDias);
        pase_completo.addEventListener('blur',mostrarDias);
        nombre.addEventListener('blur',validarCampos);
        apellido.addEventListener('blur',validarCampos);
        email.addEventListener('blur',validarCampos);
        email.addEventListener('blur',validarMail);







        //FUNCIONES
        //FUNCION CALCULAR MONTO TOTAL
        function calcularMontos(event){
            event.preventDefault();
            if(regalo.value === ''){
                alert("Debes de elegir un regalo");
            }
            else{
                //!areglar la cantidad maxima y minima antes de calcular el pago
                var valorBoleto1dia = parseInt(pase_dia.value,10) || 0,
                    valorBoleto2dias = parseInt(pase_dosdias.value,10) || 0,
                    valorBoletocompleto = parseInt(pase_completo.value,10) || 0,
                    valorCamisetaEvento = parseInt(camiseta_evento.value,10) || 0,
                    valorEtiquetas = parseInt(etiquetas.value,10) || 0;

                var total_pagar = (valorBoleto1dia*40) + (valorBoleto2dias*45) + (valorBoletocompleto*50)+
                                    ((valorCamisetaEvento*10)*0.93) + (valorEtiquetas*2);


                var listadoProductos = [];

                if(valorBoleto1dia > 0){
                    listadoProductos.push(valorBoleto1dia +" Boletos por dia");
                }
                if(valorBoleto2dias > 0){
                    listadoProductos.push(valorBoleto2dias + " Boletos por 2 dias");
                }
                if (valorBoletocompleto > 0) {
                    listadoProductos.push(valorBoletocompleto + " Boletos completos");
                }
                if(valorCamisetaEvento > 0){
                    listadoProductos.push(valorCamisetaEvento + " Camisetas");
                }
                if(valorEtiquetas > 0){
                    listadoProductos.push(valorEtiquetas + " Paquetes de 10 etiquetas");
                }
                console.log(listadoProductos);

                //imprimiendo en pantalla el listado y numero de productos
                lista_productos.style.display = "block";
                lista_productos.innerHTML = '';
                for(var e = 0 ; e < listadoProductos.length; e++){
                    lista_productos.innerHTML += listadoProductos[e] + '<br/>';
                }
                suma_total.innerHTML = "$ "+ total_pagar.toFixed(2);
            }

            botonRegistro.disabled = false;
            document.getElementById('total_pedido').value = total_pagar;

        }//end_function calcular montos

        //funcion mostrar dias segun los boletos diariosque quiera
        function mostrarDias(){
            var valorBoleto1dia = parseInt(pase_dia.value,10) || 0,
                valorBoleto2dias = parseInt(pase_dosdias.value,10) || 0,
                valorBoletocompleto = parseInt(pase_completo.value,10) || 0;

            var diaElegidos = [];


            if(valorBoleto1dia > 0){
                diaElegidos.push('viernes');
            }
            if(valorBoleto2dias > 0){
                diaElegidos.push('viernes','sabado');
            }
            if(valorBoletocompleto > 0){
                diaElegidos.push('viernes','sabado','domingo');
            }
            console.log(diaElegidos);
            //solo no se vera cuando todo esta vacio
            if(diaElegidos.length == 0){
                document.getElementById('viernes').style.display = 'none';
                document.getElementById('sabado').style.display = 'none';
                document.getElementById('domingo').style.display = 'none';
            }
            else{
                for(var e =  0 ; e < diaElegidos.length; e++){
                    document.getElementById(diaElegidos[e]).style.display = 'block';
                }
            }


        }//end_mostrarDias

        //valida datos si estan vacios
        function validarCampos(){
            if(this.value == ''){
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = "El campo marcado es obligatorio";
                this.style.border = '1px solid red';
                errorDiv.style.border = "1px solid red";
            }
            else{
                errorDiv.style.display = 'none';
                this.style.border = '1px solid #cccccc';
            }
        }//end_validarCampos

        function validarMail(){
            if(this.value.indexOf("@") > -1 ){
                errorDiv.style.display = 'none';
                this.style.border = '1px solid #cccccc';
            }
            else{
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = "Debe de contener al menos una @";
                this.style.border = '1px solid red';
                errorDiv.style.border = "1px solid red";
            }
        }




    }); // DOM CONTENT LOADER
})();


$(function(){




    // NAVEGACION FIJA

    var windowHeight = $(window).height();//altura de la ventana actual
    var barraAltura = $('.barra').innerHeight();

    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if(scroll > windowHeight){
            $('.barra').addClass('fixed');
            $('body').css({'margin-top': barraAltura+'px'});
        }else{
            $('.barra').removeClass('fixed');
            $('body').css({'margin-top': '0px'});
        }
    });




    //MENU RESPONSIVO
    $('.menu-movil').on('click',function(){
        $('.navegacion-principal').slideDown();
    });



    //MODIFICAR NOMBRE DEL SITIO :lettering
    $('.nombre-sitio').lettering();



    //plugin para imagenes:
    //lightbox
    //colorbox
    //fancybox




    //MOSTRANDO LOS TABS SEGUN EL 'A' => TALLERES, CONFERENCIAS SEMINAARIOS
    //mostrando un solo info-curso= TALLERES
    $('.programa-evento .info-curso:first').show();
    $('.menu-programa a:first').addClass('activo');

    $('.menu-programa a').on('click',function(){

        //para el triamgulo e n la linea
        $('.menu-programa a').removeClass('activo');
        $(this).addClass('activo');


        $('.ocultar').hide();
        var enlace = $(this).attr('href');
        $(enlace).fadeIn(1000);
        return false;
    });



    //DANDOLE ANIMACION A LOS NUMEROS con @plugin animateNumber
    $('.resumen_evento li:nth-child(1) p').animateNumber({number:6},1200);
    $('.resumen_evento li:nth-child(2) p').animateNumber({number:15},1200);
    $('.resumen_evento li:nth-child(3) p').animateNumber({number:3},1200);
    $('.resumen_evento li:nth-child(4) p').animateNumber({number:9},1200);



    //PLUGIN PARA CUENTA REGRESIVA the ---- final coutdown -----
    $('.cuenta_regresiva').countdown('2018/12/25 00:00:00',function(event){
        $('#dias').html(event.strftime('%D'));
        $('#horas').html(event.strftime('%H'));
        $('#minutos').html(event.strftime('%M'));
        $('#segundos').html(event.strftime('%S'));

    });


    // COLORBOX
    $('.invitado_info').colorbox({inline:true,width:"50%"});
    $('.boton_newletter').colorbox({inline:true,width:"50%"});


});






























//
