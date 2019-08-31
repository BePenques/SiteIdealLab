	
<?php
session_start();

if(isset($_POST['Salvar']))
{
	unset($_POST['Salvar']);
	
	isset($_GET['usua_id']) ? 
		$usua_id = filter_input(INPUT_GET, 'usua_id', FILTER_SANITIZE_NUMBER_INT) :
        $usua_id = filter_input(INPUT_POST, 'usua_id', FILTER_SANITIZE_NUMBER_INT);
	
	
	
	$usua_nome =   filter_input(INPUT_POST, 'usua_nome', FILTER_SANITIZE_STRING);
	$usua_senha =   filter_input(INPUT_POST, 'usua_senha', FILTER_SANITIZE_STRING);
	$usua_tipo =   filter_input(INPUT_POST, 'usua_tipo', FILTER_SANITIZE_STRING);

	if(isset($_GET['usua_id']))//é Delete
		{
			
		    $consulta_sql = "DELETE FROM tb_usua WHERE usua_id = '". $usua_id ."'";
			$_msg = "Usuário deletado com sucesso";
			$_msg_error = "Não foi possivel deletar o usuário";
		}

	elseif(isset($usua_id))  //É Update
		{
		
		if(isset($usua_senha)){ //Criptografar senha
			
			$usua_senhaa = md5($usua_senha);
			
		}else{
			
			echo "<script>alert('Informe a senha!'); history.go(-1);</script>";
		}

			$consulta_sql = "UPDATE tb_usua SET  
									usua_nome = '". $usua_nome ."',
									usua_senha = '". $usua_senhaa ."',
									usua_tipo = '". $usua_tipo ."' 
							  WHERE usua_id = '". $usua_id ."'";
		
		   
		
			$_msg = "Usuário alterado com sucesso";
			$_msg_error = "Não foi possivel alterar o usuário"; 
		}
	else 
		{
		
		if(isset($usua_senha)){ //Criptografar senha
			$usua_senhaa = md5($usua_senha);
			
		}else{
			
			echo "<script>alert('Informe a senha!'); history.go(-1);</script>";
		}
		
			$consulta_sql = "INSERT INTO tb_usua (usua_nome, usua_senha, usua_tipo) VALUES 
			('". $usua_nome ."',
			'". $usua_senhaa ."',
			'". $usua_tipo ."')";
		
			$_msg = "Usuário cadastrado com sucesso";
			$_msg_error = "Não foi possivel cadastrar o usuário";

		}


	require_once("DBConnection.php");

	$result = mysqli_query($conn, $consulta_sql);

	if(mysqli_insert_id($conn) || mysqli_affected_rows($conn) ){
		 $_SESSION['mensagem'] = "<span style='color:green'>".$_msg."</span>";
			header("Location: Administracao.php?pagina=usuariosCadastrados.php");
	}else{
		 $_SESSION['mensagem'] = "<span style='color:red'>".$_msg_error."</span>";
			header("Location: Administracao.php?pagina=usuariosCadastrados.php");
	}

	mysqli_close($conn);
}

?>