	
<?php
session_start();

if(isset($_POST['Salvar']))
{
	unset($_POST['Salvar']);
	
	 isset($_GET['forn_id']) ? 
		$forn_id = filter_input(INPUT_GET, 'forn_id', FILTER_SANITIZE_NUMBER_INT) :
        $forn_id = filter_input(INPUT_POST, 'forn_id', FILTER_SANITIZE_NUMBER_INT);
	
	$forn_nome =   filter_input(INPUT_POST, 'forn_nome', FILTER_SANITIZE_STRING);
	$forn_end =   filter_input(INPUT_POST, 'forn_end', FILTER_SANITIZE_STRING);
	$forn_resp =   filter_input(INPUT_POST, 'forn_resp', FILTER_SANITIZE_STRING);
	$forn_mail =   filter_input(INPUT_POST, 'forn_mail', FILTER_SANITIZE_STRING);
	$forn_tel =   filter_input(INPUT_POST, 'forn_tel', FILTER_SANITIZE_STRING);
	$forn_cnpj =   filter_input(INPUT_POST, 'forn_cnpj', FILTER_SANITIZE_STRING);
	$forn_ie =   filter_input(INPUT_POST, 'forn_ie', FILTER_SANITIZE_STRING);

		
	
		if(isset($_GET['forn_id'])){
			$consulta_sql = "DELETE FROM tb_forn 
			                  WHERE forn_id = '$forn_id'";
		 
			$_msg = "Fornecedor deletado com sucesso";
			$_msg_error = "Não foi possivel deletar o fornecedor";	
		}
		elseif($forn_id != ""){ 
			$consulta_sql = "UPDATE tb_forn 
								SET  forn_nome = '$forn_nome',
									 forn_end = '$forn_end',
								     forn_resp = '$forn_resp',
									 forn_mail = '$forn_mail',
									 forn_tel = '$forn_tel',
									 forn_cnpj = '$forn_cnpj',
									 forn_ie = '$forn_ie'
							  WHERE forn_id = '$forn_id'";
			
			$_msg = "Fornecedor alterado com sucesso";
			$_msg_error = "Não foi possivel alterar o fornecedor";	

		}
		else
		{
		 
		 $consulta_sql = "INSERT INTO tb_forn
		 							   (forn_id, 
										forn_nome, 
										forn_end,
										forn_resp,
										forn_mail,
										forn_tel,
										forn_cnpj,
										forn_ie) 
						  	   VALUES ('$forn_id', 
									'$forn_nome', 
									'$forn_end',
									'$forn_resp',
									'$forn_mail',
									'$forn_tel',
									'$forn_cnpj',
									'$forn_ie')";
			
		 $_msg = "Fornecedor cadastrado com sucesso";
		 $_msg_error = "Não foi possivel cadastrar o fornecedor";	

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
	
	header("Location: Administracao.php?pagina=fornecedoresCadastrados.php");

}

?>