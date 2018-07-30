<?php
function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0){
    $dia = array(0 => 'un_dia', 1 => 'pase_completo', 2 => 'dos_dias');
    $total_boletos = array_combine($dia, $boletos);
    $json = array();

    foreach($total_boletos as $key => $boletos):
        if( (int)$boletos > 0 ):
            $json[$key] = (int)$boletos;
        endif;
    endforeach;

    $camisas = (int)$camisas;
    if($camisas > 0):
        $json['camisas'] = $camisas;
    endif;

    $etiquetas = (int)$etiquetas;
    if($etiquetas > 0):
        $json['etiquetas'] = $etiquetas;
    endif;

    return json_encode($json);
}

 function eventos_json(&$evento){
     $eventos_json = array();
     foreach($evento as $evento):
        $eventos_json['eventos'][] = $evento;
     endforeach;

     return json_encode($eventos_json);

 }


?>
