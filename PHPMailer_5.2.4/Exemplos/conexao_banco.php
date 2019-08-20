
<?php
	$servidor = "localhost";//endereço do servidor
	$usuario = "root";
	$senha = "";
	$banco = "db_ideallab";

	$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

	if(!$conn)
	{
		die("falha na conexão". mysqli_connect_error());
	}

?>