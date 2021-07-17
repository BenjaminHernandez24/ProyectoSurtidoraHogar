
#--> Consultas usadas por Noe Tapia Mazariegos.

	##--> Mostrar los primeros 4 clientes con mas compras durante el mes actual
	SELECT dsv.cliente as clientes, COUNT(*) as frecuencia FROM detalle_salida_venta dsv 
    INNER JOIN clientes c ON c.nombre_cli=dsv.cliente 
    AND YEAR(dsv.fecha)=(SELECT YEAR(current_date)) 
    AND MONTH(dsv.fecha)=(SELECT MONTH(current_date)) 
    GROUP BY (dsv.cliente) ORDER BY (COUNT(*)) 
    DESC LIMIT 4;

	##--> Total de ventas que se ha tenido en cada mes (Ganancias totales).
	SELECT UPPER(MONTHNAME(dsv.fecha)) as mes, SUM(dsv.total) as ventasTotales 
	FROM detalle_salida_venta dsv 
	WHERE YEAR(dsv.fecha)=(SELECT YEAR(current_date)) 
	GROUP BY(UPPER(MONTHNAME(dsv.fecha))) 
	ORDER BY dsv.fecha;

	##--> Los primeros 5 productos mas vendidos durante el mes (por piezas).
	SELECT p.nombre_producto as mes, SUM(sv.num_piezas) as ventasTotales 
	FROM detalle_salida_venta dsv 
	INNER JOIN salida_venta sv ON sv.id_detalle_salida_venta = dsv.id_detalle_salida_venta
	INNER JOIN inventario i ON i.id_inventario = sv.id_inventario
	INNER JOIN productos p ON p.id_producto = i.id_producto
	AND MONTH(dsv.fecha)= (SELECT MONTH(CURRENT_DATE))
	AND YEAR(dsv.fecha) = (SELECT YEAR(CURRENT_DATE)) GROUP BY(sv.id_inventario)
	ORDER BY (SUM(sv.num_piezas)) DESC LIMIT 5; 

	##--> ¿Que proveedor me vendió mas barato el producto en la ultima compra?

	SELECT prov.nom_prov as proveedor, ec.precio_unitario as precio,ec.fecha as fecha 
	FROM entrada_compra ec INNER JOIN proveedores prov ON prov.id_prov=ec.id_prov 
	AND ec.id_entrada_compra IN
	(SELECT MAX(ec.id_entrada_compra) FROM entrada_compra ec
	INNER JOIN productos p ON p.nombre_producto="salchicha"
	INNER JOIN inventario i ON i.id_producto = p.id_producto AND ec.id_inventario = i.id_inventario
	GROUP BY ec.id_prov) ORDER BY ec.precio_unitario ASC LIMIT 1 ;

	#CONSULTAS DE REPORTES COMPRAS DE TODOS LOS PROVEEDORES----> 
	SELECT ec.id_entrada_compra as id_entrada_compra, prov.nom_prov as proveedor, p.nombre_producto producto, 
	ec.num_piezas as piezas, ec.precio_unitario as precio_unitario, ec.subtotal as subtotal, ec.fecha as fecha, ec.hora as hora 
	FROM entrada_compra ec
	INNER JOIN proveedores prov ON prov.id_prov= ec.id_prov
	INNER JOIN inventario i ON i.id_inventario = ec.id_inventario
	INNER JOIN productos p ON p.id_producto = i.id_producto
	AND ec.fecha >= "2021-03-20" AND ec.fecha<= "2021-07-12"
	ORDER BY ec.fecha, ec.hora ASC;

	#CONSULTAS DE REPORTES COMPRAS DE UN SOLO PROVEEDOR---->
	SELECT ec.id_entrada_compra as id_entrada_compra, prov.nom_prov as proveedor, p.nombre_producto producto, 
	ec.num_piezas as piezas, ec.precio_unitario as precio_unitario, ec.subtotal as subtotal, ec.fecha as fecha, ec.hora as hora 
	FROM entrada_compra ec
	INNER JOIN proveedores prov ON prov.id_prov= ec.id_prov
	INNER JOIN inventario i ON i.id_inventario = ec.id_inventario
	INNER JOIN productos p ON p.id_producto = i.id_producto
	AND ec.fecha >= "2021-03-20" AND ec.fecha<= "2021-07-12" AND prov.nom_prov="Tacua"
	ORDER BY ec.fecha, ec.hora ASC;

	SELECT dsv.cliente,p.nombre_producto,sv.num_piezas,sv.precio_a_vender,sv.subtotal,dsv.fecha,dsv.hora FROM salida_venta sv 
	INNER JOIN detalle_salida_venta dsv ON dsv.fecha >= '2021-07-16' AND sv.id_detalle_salida_venta=dsv.id_detalle_salida_venta
	INNER JOIN inventario i ON i.id_inventario=sv.id_inventario
	INNER JOIN productos p ON p.id_producto = i.id_producto;
	#====================================================================================#