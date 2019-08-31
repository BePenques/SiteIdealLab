	
<?php
session_start();

if(isset($_POST['Salvar']))
{
	unset($_POST['Salvar']);
	
	 isset($_GET['fabr_id']) ? 
		$fabr_id = filter_input(INPUT_GET, 'fabr_id', FILTER_SANITIZE_NUMBER_INT) :
        $fabr_id = filter_input(INPUT_POST, 'fabr_id', FILTER_SANITIZE_NUMBER_INT);
	
	$fabr_nome =   filter_input(INPUT_POST, 'fabr_nome', FILTER_SANITIZE_STRING);
	$fabr_end =   filter_input(INPUT_POST, 'fabr_end', FILTER_SANITIZE_STRING);
	$fabr_resp =   filter_input(INPUT_POST, 'fabr_resp', FILTER_SANITIZE_STRING);
	$fabr_mail =   filter_input(INPUT_POST, 'fabr_mail', FILTER_SANITIZE_STRING);
	$fabr_tel =   filter_input(INPUT_POST, 'fabr_tel', FILTER_SANITIZE_STRING);
	$fabr_cnpj =   filter_input(INPUT_POST, 'fabr_cnpj', FILTER_SANITIZE_STRING);
	$fabr_ie =   filter_input(INPUT_POST, 'fabr_ie', FILTER_SANITIZE_STRING);

		
	
		if(isset($_GET['fabr_id'])){
			$consulta_sql = "DELETE FROM tb_fabr 
			                  WHERE fabr_id = '$fabr_id'";
		 
			$_msg = "Fabricante deletada com sucesso";
			$_msg_error = "Não foi possivel deletar o fabricante";	
		}
		elseif($fabr_id != ""){ 
			$consulta_sql = "UPDATE tb_fabr 
								SET  fabr_nome = '$fabr_nome',
									 fabr_end = '$fabr_end',
								     fabr_resp = '$fabr_resp',
									 fabr_mail = '$fabr_mail',
									 fabr_tel = '$fabr_tel',
									 fabr_cnpj = '$fabr_cnpj',
									 fabr_ie = '$fabr_ie'
							  WHERE fabr_id = '$fabr_id'";
			
			$_msg = "Fabricante alterado com sucesso";
			$_msg_error = "Não foi possivel alterar o fabricante";	

		}
		else
		{
		 
		 $consulta_sql = "INSERT INTO tb_fabr
		 							   (fabr_id, 
										fabr_nome, 
										fabr_end,
										fabr_resp,
										fabr_mail,
										fabr_tel,
										fabr_cnpj,
										fabr_ie) 
						  	   VALUES ('$fabr_id', 
									'$fabr_nome', 
									'$fabr_end',
									'$fabr_resp',
									'$fabr_mail',
									'$fabr_tel',
									'$fabr_cnpj',
									'$fabr_ie')";
			
		 $_msg = "Fabricante cadastrado com sucesso";
		 $_msg_error = "Não foi possivel cadastrar o fabricante";	

		 }

	require_once("DBConnection.php");

	$result = mysqli_query($conn, $consulta_sql); 
	

	
	 //Verificar se a operação foi realizada e retornar mensagem utilizando sessão
	if(mysqli_insert_id($conn) || mysqli_affected_rows($conn) ){
		 $_SESSION['mensagem'] = "<span style='color:green'>".$_msg."</span>";
			
	}else{
		 $_SESSION['mensagem'] = "<span style='color:red'>".$_msg_error."</span>";
			
	}
	
	mysqli_close($conn);
	
	header("Location: Administracao.php?pagina=fabricantesCadastrados.php");

}

?>