<?php
require_once "Conexion.php";

class VentasModelo
{
    private static $INSERTAR_CLIENTE = "INSERT INTO clientes(nombre_cli, tipo, telefono, Estatus) VALUES(?,?,?,1)";
    private static $INSERTAR_DETALLE_SALIDA_VENTA = "INSERT INTO detalle_salida_venta(cliente,metodo_pago,total,pago,cambio,impresiones,fecha,hora,folio) values(?,?,?,?,?,?,(SELECT CURRENT_DATE),(SELECT CURRENT_TIME),?);";
    private static $INSERTAR_SALIDA_VENTA = "INSERT INTO salida_venta(id_inventario,num_piezas,precio_a_vender,subtotal,id_detalle_salida_venta) VALUES(?,?,?,?,?)";
    private static $SELECT_ALL = "SELECT p.nombre_producto FROM inventario i INNER JOIN productos p ON i.id_producto=p.id_producto AND i.stock > 0";
    private static $SELECT_DATE_PRODUCTOS = "SELECT i.id_inventario, p.nombre_producto,i.stock,p.precio_publico FROM productos p INNER JOIN inventario i ON p.nombre_producto=? AND i.id_producto=p.id_producto ORDER BY (i.id_inventario) DESC LIMIT 1";
    private static $CLIENTES = "SELECT id_cli,nombre_cli,tipo,telefono FROM `clientes` WHERE Estatus = 1";
    private static $RESTA_STOCK = "UPDATE inventario SET stock= (stock-?) WHERE id_inventario = ?";
    private static $SUMA_STOCK = "UPDATE inventario SET stock= (stock+?) WHERE id_inventario = ?";
    private static $STOCK = "SELECT STOCK FROM inventario WHERE id_inventario = ?";

    private static $EsPaquete = "SELECT p.estatus_paquete FROM inventario i INNER JOIN productos p ON i.id_inventario = ? AND i.id_producto = p.id_producto";
    private static $ProductosPaquete = "SELECT id_inventario FROM inventario WHERE id_producto IN (SELECT pa.id_prod_asociado FROM inventario i INNER JOIN productos p ON i.id_inventario = ? AND p.id_producto=i.id_producto INNER JOIN paquetes pa ON pa.id_prod_generado = p.id_producto) ORDER BY id_inventario ASC";
    private static $ObtenerPiezas = "SELECT pa.piezas FROM inventario i INNER JOIN productos p ON i.id_inventario = ? AND p.id_producto=i.id_producto INNER JOIN paquetes pa ON pa.id_prod_generado = p.id_producto ORDER BY i.id_inventario ASC";
    /* ===========================
        FUNCION PARA AGREGAR DETALLE SALIDA VENTA
     =============================*/
    public static function AgregarDetalleSalidaVenta($venta, $datos, $posicion)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            //Abro la transacción.
            $conn->beginTransaction();

            $pst       = $conn->prepare(self::$INSERTAR_DETALLE_SALIDA_VENTA);
            $resultado = $pst->execute([$venta['cliente'], $venta['pago'], $venta['total'], $venta['cobro'], $venta['cambio'], $venta['impresion'], $venta['folio']]);

            $pst       = $conn->prepare("SELECT LAST_INSERT_ID();");
            $pst->execute();
            $id = $pst->fetch();

            if ($resultado == 1) {
                $pst       = $conn->prepare(self::$INSERTAR_SALIDA_VENTA);

                for ($i = 0; $i < $posicion; $i++) {
                    $resultado = $pst->execute([$datos[$i]['Inventario'], $datos[$i]['Cantidad'], $datos[$i]['Precio'], $datos[$i]['Total'], $id[0]]);
                }

                if ($resultado == 1) {
                    $msg = "OK";
                    //Si todo esta correcto insertamos.
                    $conn->commit();
                } else {
                    $msg = "Fallo al insertar";
                    //Si algo falla, reestablece la bd a como estaba en un inicio.
                    $conn->rollBack();
                }
            } else {
                $msg = "Fallo al insertar";
                //Si algo falla, reestablece la bd a como estaba en un inicio.
                $conn->rollBack();
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA AGREGAR CLIENTES
     =============================*/
    public static function AgregarCliente($cliente)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            //Abro la transacción.
            $conn->beginTransaction();

            $pst       = $conn->prepare(self::$INSERTAR_CLIENTE);
            $resultado = $pst->execute([$cliente['nombre_cli'], $cliente['tipo'], $cliente['telefono']]);

            if ($resultado == 1) {
                $msg = "OK";
                //Si todo esta correcto insertamos.
                $conn->commit();
            } else {
                $msg = "Fallo al insertar";
                //Si algo falla, reestablece la bd a como estaba en un inicio.
                $conn->rollBack();
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA OBTENER TODO LOS CLIENTES
     =============================*/
    public static function getClientes()
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$CLIENTES);
            $pst->execute();

            $clientes = $pst->fetchAll();

            $conn = null;
            $conexion->closeConexion();

            return $clientes;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA OBTENER TODO LOS PRODUCTOS
     =============================*/
    public static function obtenerProductos()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$SELECT_ALL);
            $pst->execute();

            $productos = $pst->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            $conexion->closeConexion();

            return $productos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA OBTENER STOCK DEL PRODUCTO
     =============================*/
    public static function obtenerStock($ID)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$STOCK);
            $pst->execute([$ID]);

            $productos = $pst->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            $conexion->closeConexion();

            return $productos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA OBTENER LOS DATOS DEL PRODUCTO
     =============================*/
    public static function obtenerDatosProductos($nombre)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$SELECT_DATE_PRODUCTOS);
            $pst->execute([$nombre]);

            $datosProductos = $pst->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            $conexion->closeConexion();

            return $datosProductos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA RESTAR STOCK
     =============================*/
    public static function restarInventario($id, $cantidad)
    {
        $Romper = 0;
        try {

            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            //Abro la transacción.
            $conn->beginTransaction();
            //Es un paquete o producto lo que estoy recibiendo.
            $pst = $conn->prepare(self::$EsPaquete); 
            $pst->execute([$id]); 
            $resultado = $pst->fetchAll(PDO::FETCH_ASSOC); 
            $verificar_paquete = $resultado[0]["estatus_paquete"];
            //Es un producto o paquete
            if($verificar_paquete == 0){//Es producto...

                $pst = $conn->prepare(self::$RESTA_STOCK);

                $resultado = $pst->execute([$cantidad, $id]);

                if ($resultado == 1) {
                    //Si todo esta correcto insertamos.

                    $pst = $conn->prepare(self::$STOCK);
                    $pst->execute([$id]);

                    $stock_verificar = $pst->fetchAll(PDO::FETCH_ASSOC);

                    if ($stock_verificar[0]["STOCK"] < 0) {
                        $msg = "ERROR";
                        $conn->rollBack();
                    } else {
                        $msg = "OK";
                        $conn->commit();
                    }
                } else {
                    //Si algo falla, reestablece la bd a como estaba en un inicio.
                    $msg = "ERROR";
                    $conn->rollBack();
                }
            }else{
                //Restamos primero al paquete.
                $pst = $conn->prepare(self::$RESTA_STOCK);
                $resultado = $pst->execute([$cantidad, $id]);
                if($resultado == 1){
                    $pst = $conn->prepare(self::$STOCK);
                    $resultado = $pst->execute([$id]);
                    if($resultado == 1){
                        $stock_verificar = $pst->fetchAll(PDO::FETCH_ASSOC);
                        if ($stock_verificar[0]["STOCK"] < 0) {
                            $msg = "ERROR";
                            $conn->rollBack();
                        } else {
                            //Extraigo los productos asociados al paquete
                            $pst = $conn->prepare(self::$ProductosPaquete); 
                            $resultado = $pst->execute([$id]);
                            if($resultado == 1){
                                $resultadoInventario = $pst->fetchAll(PDO::FETCH_ASSOC);
                                //Extraigo las piezas
                                $pst = $conn->prepare(self::$ObtenerPiezas); 
                                $resultado = $pst->execute([$id]); 
                                if($resultado == 1){
                                    $resultadoPiezas = $pst->fetchAll(PDO::FETCH_ASSOC);
                                    $Arreglo_Id = [];
                                    //Asocio y guardo productos con piezas
                                    for($i = 0; $i < sizeof($resultadoInventario); $i++){
                                        $Arreglo_Id[] = [
                                            "inventario" => $resultadoInventario[$i]["id_inventario"],
                                            "piezas" => $resultadoPiezas[$i]["piezas"]
                                        ]; 
                                    }

                                    //Comenzamos a restar dinamicamente.
                                    for($i = 0; $i < sizeof($Arreglo_Id); $i++){
                                        $cantidad_enviar = $cantidad * $Arreglo_Id[$i]["piezas"];
                                        $pst = $conn->prepare(self::$RESTA_STOCK);
                                        $resultado = $pst->execute([$cantidad_enviar, $Arreglo_Id[$i]["inventario"]]);
                                        if($resultado == 1){
                                            $pst = $conn->prepare(self::$STOCK);
                                            $resultado = $pst->execute([$Arreglo_Id[$i]["inventario"]]);
                                            if($resultado == 1){
                                                $stock_verificar = $pst->fetchAll(PDO::FETCH_ASSOC);
                                                if ($stock_verificar[0]["STOCK"] < 0) {
                                                    $Romper = 2;
                                                    break;
                                                }
                                            $cantidad_enviar = 0;
                                            }else{
                                                $Romper = 1;
                                                break;
                                            }
                                        }else{
                                            $Romper = 1;
                                            break;
                                        }
                                    }
                                    //Si Romper = 1, quiere decir que uno de ellos tuvo error
                                    if($Romper == 1){
                                        $msg = "ERROR";
                                        $conn->rollBack();
                                    }else if($Romper == 2){
                                        $msg = "INSUFICIENTE";
                                        $conn->rollBack();
                                    }else{
                                        $msg = "OK";
                                        $conn->commit();
                                    }
                                }else{
                                    $msg = "ERROR";
                                    $conn->rollBack();
                                }
                            }else{
                                $msg = "ERROR";
                                $conn->rollBack(); 
                            }
                        }
                    }else{
                        $msg = "ERROR";
                        $conn->rollBack();
                    }
                }else{
                    $msg = "ERROR";
                    $conn->rollBack();
                }
            }
            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /* ===========================
        FUNCION PARA SUMAR STOCK
     =============================*/
    public static function sumarInventario($id, $cantidad)
    {
        $Romper = 0;
        try {

            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            //Abro la transacción.
            $conn->beginTransaction();

            //Identificamos si lo que se ha seleccionado es un paquete o producto.
            $pst = $conn->prepare(self::$EsPaquete); 
            $pst->execute([$id]); 
            $resultado = $pst->fetchAll(PDO::FETCH_ASSOC); 
            $verificar_paquete = $resultado[0]["estatus_paquete"];

            if($verificar_paquete == 0){ //Si es un producto...
                $pst = $conn->prepare(self::$SUMA_STOCK);

                $resultado = $pst->execute([$cantidad, $id]);

                if ($resultado == 1) {
                    //Si todo esta correcto insertamos.
                    $conn->commit();
                } else {
                    //Si algo falla, reestablece la bd a como estaba en un inicio.
                    $conn->rollBack();
                }
            }else{ //Si es un paquete...
                //Primero sumamos el stock del paquete.
                $pst = $conn->prepare(self::$SUMA_STOCK);
                $resultado = $pst->execute([$cantidad, $id]);
                if($resultado == 1){
                    //Comienzo a extraer a los productos asociados al paquete.
                    $pst = $conn->prepare(self::$ProductosPaquete); 
                    $resultado = $pst->execute([$id]);
                    if($resultado == 1){
                        $resultadoInventario = $pst->fetchAll(PDO::FETCH_ASSOC);//Productos
                        $pst = $conn->prepare(self::$ObtenerPiezas); 
                        $resultado = $pst->execute([$id]); 
                        if($resultado == 1){
                            $resultadoPiezas = $pst->fetchAll(PDO::FETCH_ASSOC);//Piezas

                            $Arreglo_Id = [];
                            //Asocio y guardo mis datos en un array.
                            for($i = 0; $i < sizeof($resultadoInventario); $i++){
                                $Arreglo_Id[] = [
                                    "inventario" => $resultadoInventario[$i]["id_inventario"],
                                    "piezas" => $resultadoPiezas[$i]["piezas"]
                                ]; 
                            }
                            //Sumamos stock de productos de manera dinamica
                            for($i = 0; $i < sizeof($Arreglo_Id); $i++){
                                //Preparamos la consulta para sumar
                                $pst = $conn->prepare(self::$SUMA_STOCK);
                                $cantidad_enviar = $cantidad * $Arreglo_Id[$i]["piezas"];
                                
                                $resultado = $pst->execute([$cantidad_enviar, $Arreglo_Id[$i]["inventario"]]);
                                if ($resultado != 1) {
                                    //Si algo falla, reestablece la bd a como estaba en un inicio.
                                    $Romper = 1;
                                    break;
                                }
                                $cantidad_enviar = 0;
                            }

                            //Si Romper = 1, quiere decir que uno de ellos tuvo error
                            if($Romper == 1){
                                $msg = "ERROR";
                                $conn->rollBack();
                            }else{
                                $msg = "OK";
                                $conn->commit();
                            }
                        }else{
                            $msg = "ERROR";
                            $conn->rollBack();
                        }
                    }else{
                        $msg = "ERROR";
                        $conn->rollBack();
                    }
                }else{
                    $msg = "ERROR";
                    $conn->rollBack();
                }
            }
            $conn = null;
            $conexion->closeConexion();

            return "OK";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function ContarVentas()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare("SELECT COUNT(*) AS total FROM detalle_salida_venta");
            $pst->execute();
            $ventas = $pst->fetch();

            $pst = $conn->prepare("SELECT MAX(folio) FROM detalle_salida_venta WHERE impresiones = 'Ticket' or impresiones= 'Ambos'");
            $pst->execute();
            $maximo = $pst->fetch();

            $pst = $conn->prepare("SELECT COUNT(impresiones) FROM detalle_salida_venta WHERE impresiones = 'Ticket' or impresiones= 'Ambos'");
            $pst->execute();
            $contador = $pst->fetch();

            $resultado_consultas = [
                "ventas" => $ventas['total'],
                "maximo"       => $maximo['MAX(folio)'],
                "contador"       => $contador['COUNT(impresiones)'],
            ];

            return $resultado_consultas;

            $conexion->closeConexion();
            $conn = null;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function SumaProductosCambio($datos, $posicion)
    {
        $Romper = 0;
        $cantidad = 0;
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            //Abro la transacción.
            $conn->beginTransaction();

            $pst = $conn->prepare(self::$SUMA_STOCK);

            for ($i = 0; $i < $posicion; $i++) {
                $resultado = $pst->execute([$datos[$i]['Cantidad'], $datos[$i]['Inventario']]);
                if($resultado != 1){ //Si no truena en las inserciones Romper = 0
                    $Romper = 1;
                    break;
                }
            }

            if($Romper == 0){
                //Vamos a Sumar solo el stock de Paquetes 
                for($i=0; $i < $posicion; $i++){
                    $pst = $conn->prepare(self::$EsPaquete); 
                    $pst->execute([$datos[$i]['Inventario']]); 
                    $resultado = $pst->fetchAll(PDO::FETCH_ASSOC); 
                    $verificar_paquete = $resultado[0]["estatus_paquete"];
                    if($verificar_paquete == 1){
                        //Extraigo productos asociados al paquete
                        $pst = $conn->prepare(self::$ProductosPaquete); 
                        $resultado = $pst->execute([$datos[$i]['Inventario']]);
                        if($resultado == 1){
                            $resultadoInventario = $pst->fetchAll(PDO::FETCH_ASSOC);
                            $pst = $conn->prepare(self::$ObtenerPiezas); 
                            $resultado = $pst->execute([$datos[$i]['Inventario']]);
                            if($resultado == 1){
                                $resultadoPiezas = $pst->fetchAll(PDO::FETCH_ASSOC);
                                $Arreglo_Id = [];
                                //Guardo id inventario de los productos en array independiente
                                for($j = 0; $j < sizeof($resultadoInventario); $j++){
                                    $Arreglo_Id[$j] = [
                                        "inventario" => $resultadoInventario[$j]["id_inventario"],
                                        "piezas" => $resultadoPiezas[$j]["piezas"]
                                    ]; 
                                }

                                for($j = 0; $j < sizeof($Arreglo_Id); $j++){
                                    //Preparamos la consulta para sumar
                                    $pst = $conn->prepare(self::$SUMA_STOCK);
                                    $cantidad_enviar = $datos[$i]['Cantidad'] * $Arreglo_Id[$j]["piezas"];
                                    $resultado = $pst->execute([$cantidad_enviar, $Arreglo_Id[$j]["inventario"]]);
                                    if($resultado == 1){
                                        $Romper = 0;
                                    }else{
                                        $Romper = 1;
                                        break;
                                    }
                                    $cantidad_enviar = 0;
                                }
                            }else{
                                $msg = "ERROR";
                                $conn->rollBack();
                                break;
                            }
                        }else{
                            $msg = "ERROR";
                            $conn->rollBack();
                            break;
                        }
                    }
                }

                //Si Romper = 1, quiere decir que uno de ellos tuvo error
                if($Romper == 1){
                    $msg = "ERROR";
                    $conn->rollBack();
                }else{
                    $msg = "OK";
                    $conn->commit();
                }
            }else{
                $msg = "ERROR";
                $conn->rollBack();
            }
            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function RestaProductosCambio($datos, $posicion)
    {
        $Romper = 0;
        $cantidad = 0;
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            //Abro la transacción.
            $conn->beginTransaction();

            $pst = $conn->prepare(self::$RESTA_STOCK);

            for ($i = 0; $i < $posicion; $i++) {
                $resultado = $pst->execute([$datos[$i]['Cantidad'], $datos[$i]['Inventario']]);
                if($resultado != 1){ //Si no truena en las inserciones Romper = 0
                    $Romper = 1;
                    break;
                }
            }

            if($Romper == 0){
                for($i=0; $i < $posicion; $i++){
                    $pst = $conn->prepare(self::$EsPaquete); 
                    $pst->execute([$datos[$i]['Inventario']]); 
                    $resultado = $pst->fetchAll(PDO::FETCH_ASSOC); 
                    $verificar_paquete = $resultado[0]["estatus_paquete"];

                    //Si es un producto...
                    if($verificar_paquete == 1){
                        $pst = $conn->prepare(self::$ProductosPaquete); 
                        $resultado = $pst->execute([$datos[$i]['Inventario']]);
                        
                        if($resultado == 1){
                            $resultadoInventario = $pst->fetchAll(PDO::FETCH_ASSOC);

                            $pst = $conn->prepare(self::$ObtenerPiezas); 
                            $resultado = $pst->execute([$datos[$i]['Inventario']]); 
                            if($resultado == 1){
                                $resultadoPiezas = $pst->fetchAll(PDO::FETCH_ASSOC);

                                $Arreglo_Id = [];
                                //Guardo id inventario de los productos en array independiente
                                for($j = 0; $j < sizeof($resultadoInventario); $j++){
                                    $Arreglo_Id[] = [
                                        "inventario" => $resultadoInventario[$j]["id_inventario"],
                                        "piezas" => $resultadoPiezas[$j]["piezas"]
                                    ]; 
                                }
                                //Disponemos a descontar dinamicamente...
                                for($j = 0; $j < sizeof($Arreglo_Id); $j++){
                                    $cantidad = 0;
                                    $pst = $conn->prepare(self::$RESTA_STOCK);
                                    $cantidad_enviar = $datos[$i]['Cantidad'] * $Arreglo_Id[$j]["piezas"];
                                    
                                    $resultado = $pst->execute([$cantidad_enviar, $Arreglo_Id[$j]["inventario"]]);
                                    if ($resultado == 1) {
                                        $pst = $conn->prepare(self::$STOCK);
                                        $resultado = $pst->execute([$Arreglo_Id[$j]["inventario"]]);

                                        if($resultado == 1){
                                            $stock_verificar = $pst->fetchAll(PDO::FETCH_ASSOC);

                                            if ($stock_verificar[0]["STOCK"] < 0) {
                                                $Romper = 2;
                                                break;
                                            }
                                            $cantidad_enviar = 0;
                                        }else{
                                            $Romper = 1;
                                            break;
                                        }
                                    }else{
                                        $Romper = 1;
                                        break;
                                    }
                                }
                            }else{
                                $msg = "ERROR";
                                $conn->rollBack();
                                break;
                            }
                        }else{
                            $msg = "ERROR";
                            $conn->rollBack();
                            break;
                        }
                    }
                }

                if($Romper == 1){
                    //Si algo falla, reestablece la bd a como estaba en un inicio.
                    $msg = "ERROR";
                    $conn->rollBack();
                }else if($Romper == 2){
                    //Si algo falla, reestablece la bd a como estaba en un inicio.
                    $msg = "INSUFICIENTE";
                    $conn->rollBack();
                }else{
                    $msg = "OK";
                    $conn->commit();
                }
            }else{
                $msg = "ERROR";
                $conn->rollBack();
            }
            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
