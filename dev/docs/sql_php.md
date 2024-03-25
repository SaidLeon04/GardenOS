# Esquema de las consultas SQL 

| PHP | Uso | SQL |
|--------------|--------------|--------------|
| $stmt -> affected_rows | Ver celdas afectadas | INSERT, UPDATE, DELETE  |
| $result = $stmt->get_result();  | Obtiene el resultado de una consulta  | SELECT |
| $row = $result->fetch_assoc() | envia el resultado a un array asociativo | SELECT |
|$result->free();|Libera un resultado, uso en caso de solo necesitar una fila|SELECT|
|if ($stmt->error)|Verifica errores despues de la consulta|TODOS|
