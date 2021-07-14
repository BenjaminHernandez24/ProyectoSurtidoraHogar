<?php
require_once "../Models/NotificacionModel.php";

//Construyo la lista para que sea desplegable
if (isset($_POST['view'])) {
    $cuerpoLista = '';
    $mensaje = '';

    $productosVacios = NotificacionModel::productosConStockVacio();
    $longitud = sizeof($productosVacios);
    if($longitud == 1){
        $cadenaNotificacion = ' Notificación';
    }else{
        $cadenaNotificacion = ' Notificaciones';
    }

    //Si hay al menos una notificación...
    if(sizeof($productosVacios) > 0){
        //Añadimos el primer item a la lista.
        $cuerpoLista .= '
                <span class="dropdown-item text-center" style="text-align: center;" face="times new roman">
                         <b size=4>Tienes '.
                        $longitud.$cadenaNotificacion.
                      '</b>
                </span>
                <div class="dropdown-divider"></div>';

        //Creamos de manera dinamica el cuerpo de los items siguientes...
        for ($i = 0; $i < sizeof($productosVacios); $i++) {

            //Muestro solo los primeros 4 notificaciones
            if($i < 3){
                $mensaje = 'El stock del producto "'.$productosVacios[$i]["nombre"].'" se encuentra en 0.';

                $cuerpoLista .= '
                    <li id="mensaje'.$i.'">
                        <a class="dropdown list-group-item" type="button" onclick="prueba('.$i.');">
                            <font style="text-align: justify;" face="times new roman" size=4>
                                <i class="nav-icon fas fa-dolly"></i>
                                <font size=4><b>Stock Vacío</b></font><br>  
                                <font size=4>'.$mensaje.'</font>
                            </font>
                        </a>
                    </li>';
            }
        }

         if(sizeof($productosVacios) > 1){
            $cuerpoLista.= '
                <li>
                    <a class="dropdown list-group-item text-muted btnVer" type="button" style="font-size: 22px;">
                        <font style="text-align: justify;" face="times new roman" SIZE=4>
                            <i class="nav-icon fas fa-eye"></i> Ver Todas Las Notificaciones
                        </font>
                    </a>
                </li>';
         }
    }else{
        $cuerpoLista .= '
            <a class="dropdown-item text-center" face="times new roman" SIZE=3>
                <b>Su Inventario Está Lleno</b>
            </a>
        </div>';
    }

    //Preparo mi array con el cuerpo y la longitud del mismo...
    $data = array(
        'lista' => $cuerpoLista,
        'totalNotificacion'    => $longitud,
    );

    echo json_encode($data);
}

//Si hay algun cambio eso me va a servir para mostrar un nuevo notificación
if (isset($_POST['prueba'])) {
    $productosVacios = NotificacionModel::productosConStockVacio();
    $longitud = sizeof($productosVacios);
    $data = array(
        "c" => $longitud,
    );
    echo json_encode($data);
}

//Datos de la notificaciones para la tabla
if (isset($_POST['getNotificacion'])) {
   $productosVacios = NotificacionModel::productosConStockVacio();
    $longitud = sizeof($productosVacios);
    for ($i = 0; $i < sizeof($productosVacios); $i++) {
        $data[$i]["titulo"] = 'Stock Vacío';
        $data[$i]["descripcion"] = 'El stock del producto se encuentra en 0.';
        $data[$i]["producto"] = $productosVacios[$i]["nombre"];
        $data[$i]["recomendacion"] = "Llene el stock de inmediato";
        
    }

    echo json_encode($data,JSON_UNESCAPED_UNICODE);

}

//¿Apretó el boton con anterioridad?
if (isset($_POST['validarBoton'])) {
    $boton = NotificacionModel::validarBoton();
    $data = array(
        "valor" => $boton[0]["boton"],
    );
    echo json_encode($data);
}

//Dame el numero de notificaciones que tenias antes de hacer algo.
if (isset($_POST['validarTotal'])) {
    $boton = NotificacionModel::validarTotal();
    $data = array(
        "total" => $boton[0]["total"],
    );
    echo json_encode($data);
}

//Si tocó el boton mandale 1
if (isset($_POST['cambiarUno'])) {
    $boton = NotificacionModel::cambiarUno();
    echo json_encode($boton);
}

//¿Si tocó el boton mandale el numero de notificacion.
if (isset($_POST['enviar_Total'])) {
    $data = array(
        "total" => $_POST['enviar']
    );
    $boton = NotificacionModel::enviarTotal($data);
    echo json_encode(['respuesta' => $boton]);
}
?>