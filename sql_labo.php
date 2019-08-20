<?php

require_once("DBConnection.php");
$consulta_sql = "SELECT labo_tipo, 
						labo_alt,
						labo_lar,
						labo_obs
				   FROM tb_labo";

$result_consulta_sql = mysqli_query($conn, $consulta_sql);

?>