<?php
session_start();

	$usua_id = filter_input(INPUT_POST, 'usua_id', FILTER_SANITIZE_NUMBER_INT);
	$usua_id_get = filter_input(INPUT_GET,'usua_id',FILTER_SANITIZE_NUMBER_INT);

	$usua_nome =   filter_input(INPUT_POST, 'usua_nome', FILTER_SANITIZE_STRING);
	$usua_senha =   filter_input(INPUT_POST, 'usua_senha', FILTER_SANITIZE_STRING);
	$usua_tipo =   filter_input(INPUT_POST, 'usua_tipo', FILTER_SANITIZE_STRING);

	if(isset($usua_id_get))//é Delete
		{
			$consulta_sql = "DELETE FROM tb_usua WHERE usua_id = '". $usua_id_get ."'";
			$_msg = "Usuário deletado com sucesso";
			$_msg_error = "Não foi possivel deletar o usuário";
		}

	if(isset($usua_id)) //É Update
		{
			$consulta_sql = "UPDATE tb_usua SET  usua_nome = '". $usua_nome ."', usua_senha = '". $usua_senha ."', usua_tipo = '". $usua_tipo ."' WHERE usua_id = '". $usua_id ."'";
			$_msg = "Usuário alterado com sucesso";
			$_msg_error = "Não foi possivel alterar o usuário";
		}
	else if(!isset($usua_id))
		{
			$consulta_sql = "INSERT INTO tb_usua (usua_nome, usua_senha, usua_tipo) VALUES ('". $usua_nome ."', '". $usua_senha ."', '". $usua_tipo ."')";
			$_msg = "Usuário cadastrado com sucesso";
			$_msg_error = "Não foi possivel cadastrar o usuário";

		}


	require_once("DBConnection.php");

	$result = mysqli_query($conn, $consulta_sql);

	if(mysqli_insert_id($conn) || mysqli_affected_rows($conn) ){
		 $_SESSION['mensagem'] = "<span style='color:green'>".$_msg."</span>";
			header("Location: usuariosCadastrados.php");
	}else{
		 $_SESSION['mensagem'] = "<span style='color:red'>".$_msg_error."</span>";
			header("Location: usuariosCadastrados.php");
	}

	mysqli_close($conn);


?>