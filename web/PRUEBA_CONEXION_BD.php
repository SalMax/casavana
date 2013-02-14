
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
// index.php
$link = mysql_connect('localhost', 'root', '');
$status = mysql_select_db('casavana_co', $link);

if($status){
	print("Conexión BD realizada con éxito<br />");
}
else{
	print("Error de conexión con BD<br />");
}

$result = mysql_query('SELECT * FROM usuario', $link);

$row = mysql_fetch_assoc($result);


print("Nombre: " . $row['Nombre']);
mysql_close($link);
?>
