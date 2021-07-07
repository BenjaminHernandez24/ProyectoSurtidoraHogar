
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
	INNER JOIN tickets t ON YEAR(dsv.fecha)=(SELECT YEAR(current_date)) 
	AND MONTH(dsv.fecha)=(SELECT MONTH(current_date))
	AND t.id_detalle_salida_venta = dsv.id_detalle_salida_venta
	INNER JOIN salida_venta sv ON sv.id_salida_venta = t.id_salida_venta
	INNER JOIN inventario i ON i.id_inventario = sv.id_inventario
	INNER JOIN productos p ON p.id_producto = i.id_producto
	GROUP BY(p.id_producto) 
	ORDER BY SUM(sv.num_piezas) DESC LIMIT 5;

	##--> ¿Que proveedor me vendió mas barato el producto en la ultima compra?
	SELECT  prov.nom_prov, ec.precio_unitario, ec.fecha FROM 
	entrada_compra ec
	INNER JOIN proveedores prov ON prov.id_prov = ec.id_prov
	AND ec.id_inventario IN
	(
	SELECT MAX(ec.id_inventario) 
	FROM inventario i
	INNER JOIN productos p ON p.nombre_producto = 'Parrilla' 
	AND i.id_producto = p.id_producto
	INNER JOIN entrada_compra ec ON ec.id_inventario = i.id_inventario
	GROUP BY ec.id_prov
	) 
	ORDER BY ec.precio_unitario ASC LIMIT 1;

	#====================================================================================#