<?php
// Definir los precios
$precio_original = 78;
$precio_rebajado = 73;

// Calcular el porcentaje de descuento
$porcentaje_descuento = (($precio_original - $precio_rebajado) / $precio_original) * 100;

// Mostrar el porcentaje de descuento
echo "El porcentaje de descuento es: " . $porcentaje_descuento . "%";
?>
