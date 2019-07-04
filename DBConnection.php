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
	/*{
		echo "conexão realizada com sucesso!";
	}*/

/*	$result_consulta_sql =  mysqli_query($conn, "SELECT * FROM tb_users"); */
	
	

	/*while($registro = mysqli_fetch_array($result_consulta_sql)){//enqto houver registro, a cada linha: leia oque esta dentro e jogue dentro de registro
		
		echo $registro['email']."<br>";
	} */
?>