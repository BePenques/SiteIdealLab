	
<?php
session_start();

if(isset($_POST['Salvar']))
{
	unset($_POST['Salvar']);
	
	 isset($_GET['norm_id']) ? 
		$norm_id = filter_input(INPUT_GET, 'norm_id', FILTER_SANITIZE_NUMBER_INT) :
        $norm_id = filter_input(INPUT_POST, 'norm_id', FILTER_SANITIZE_NUMBER_INT);
	
	$norm_tit =   filter_input(INPUT_POST, 'norm_tit', FILTER_SANITIZE_STRING);
	$norm_desc =   filter_input(INPUT_POST, 'norm_desc', FILTER_SANITIZE_STRING);
	$norm_font =   filter_input(INPUT_POST, 'norm_font', FILTER_SANITIZE_STRING);
	$norm_data =   filter_input(INPUT_POST, 'norm_data', FILTER_SANITIZE_STRING);

	
	
	if(isset($_GET['norm_id'])){
		$consulta_sql = "DELETE FROM tb_norm
						  WHERE norm_id = '$norm_id'";

		$_msg = "Norma deletada com sucesso";
		$_msg_error = "Não foi possivel deletar a norma";	
	}
	elseif($norm_id != ""){ 
		$consulta_sql = "UPDATE tb_norm 
							SET  norm_tit = '$norm_tit',
								 norm_desc = '$norm_desc',
								 norm_font = '$norm_font',
								 norm_data = STR_TO_DATE('$norm_data', '%d/%m/%Y')
						  WHERE norm_id = '$norm_id'";

		$_msg = "Norma alterada com sucesso";
		$_msg_error = "Não foi possivel alterar a norma";	
		
	}else{
		 
		 $consulta_sql = "INSERT INTO tb_norm
		 							( norm_tit,
									  norm_desc,
									  norm_font,
								      norm_data) 
						  	   VALUES ('$norm_tit', 
										'$norm_desc', 
										'$norm_font',
										STR_TO_DATE('$norm_data', '%d/%m/%Y')
									  )";
			
		 $_msg = "Norma cadastrada com sucesso";
		 $_msg_error = "Não foi possivel cadastrar a norma";	

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

header("Location: Administracao.php?pagina=normasCadastradas.php");


}
?>