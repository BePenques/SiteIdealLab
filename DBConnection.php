<?php
header('Content-Type: text/html; charset=utf-8');
	$servidor = "localhost";//endereço do servidor
	$usuario = "root";
	$senha = "";
	$banco = "db_ideallab";

	$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

	if(!$conn)
	{
		die("falha na conexão". mysqli_connect_error());
	}

  //Alterar charset da conexão
    if (!mysqli_set_charset($conn, "utf8mb4")){
        printf("Erro ao carregar o charset escolhido: %s\n", mysqli_error($conexao));
        exit();
    }
?>