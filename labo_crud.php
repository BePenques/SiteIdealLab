	
<?php
session_start();

if(isset($_POST['Salvar']))
{

	unset($_POST['Salvar']);
	
	 isset($_GET['labo_id']) ? 
		$labo_id = filter_input(INPUT_GET, 'labo_id', FILTER_SANITIZE_NUMBER_INT) :
        $labo_id = filter_input(INPUT_POST, 'labo_id', FILTER_SANITIZE_NUMBER_INT);
	
	
	
	$labo_tipo =   filter_input(INPUT_POST, 'labo_tipo', FILTER_SANITIZE_STRING);
	$labo_alt =   filter_input(INPUT_POST, 'labo_alt', FILTER_SANITIZE_STRING);
	$labo_lar =   filter_input(INPUT_POST, 'labo_lar', FILTER_SANITIZE_STRING);
	$labo_obs =   filter_input(INPUT_POST, 'labo_obs', FILTER_SANITIZE_STRING);

		
	
		if(isset($_GET['labo_id'])){
			$consulta_sql = "DELETE FROM tb_labo 
			                  WHERE labo_id = '$labo_id'";
		 
			$_msg = "Laboratório deletado com sucesso";
			$_msg_error = "Não foi possivel deletar o laboratório";	
		}
		elseif($labo_id != ""){ 
			$consulta_sql = "UPDATE tb_labo 
								SET  labo_tipo = '$labo_tipo',
									 labo_alt = '$labo_alt',
								     labo_lar = '$labo_lar',
									 labo_obs = '$labo_obs'
								
							  WHERE labo_id = '$labo_id'";
										
			$_msg = "Laboratório alterado com sucesso";
			$_msg_error = "Não foi possivel alterar o laboratório";	

		}
		else
		{
		
		 
		 $consulta_sql = "INSERT INTO tb_labo
		 							   (labo_tipo, 
										labo_alt,
										labo_lar,
										labo_obs) 
						  	   VALUES ('$labo_tipo', 
									'$labo_alt', 
									'$labo_lar',
									'$labo_obs'
									)";
			
		 $_msg = "Laboratório cadastrado com sucesso";
		 $_msg_error = "Não foi possivel cadastrar o laboratório";	

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
	
	header("Location: Administracao.php?pagina=laboratoriosCadastrados.php");

}
