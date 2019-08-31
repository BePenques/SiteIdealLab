	
<?php
session_start();

if(isset($_POST['Salvar']) )
{
	unset($_POST['Salvar']);
	
	 isset($_GET['exij_id']) ? 
		$exij_id = filter_input(INPUT_GET, 'exij_id', FILTER_SANITIZE_NUMBER_INT) :
        $exij_id = filter_input(INPUT_POST, 'exij_id', FILTER_SANITIZE_NUMBER_INT);
	
	$exij_tit =   filter_input(INPUT_POST, 'exij_tit', FILTER_SANITIZE_STRING);
	$exij_desc =   filter_input(INPUT_POST, 'exij_desc', FILTER_SANITIZE_STRING);
	$exij_font =   filter_input(INPUT_POST, 'exij_font', FILTER_SANITIZE_STRING);
	$exij_data =   filter_input(INPUT_POST, 'exij_data', FILTER_SANITIZE_STRING);

	
	
	if(isset($_GET['exij_id'])){
		$consulta_sql = "DELETE FROM tb_exij
						  WHERE exij_id = '$exij_id'";

		$_msg = "Exigência deletada com sucesso";
		$_msg_error = "Não foi possivel deletar a exigência";	
	}
	elseif($exij_id != ""){ 
		$consulta_sql = "UPDATE tb_exij 
							SET  exij_tit = '$exij_tit',
								 exij_desc = '$exij_desc',
								 exij_data = STR_TO_DATE('$exij_data', '%d/%m/%Y')
						  WHERE exij_id = '$exij_id'";

		$_msg = "Exigência alterada com sucesso";
		$_msg_error = "Não foi possivel alterar a exigência";	
		
	}else{
		 
		 $consulta_sql = "INSERT INTO tb_exij
		 							( exij_tit,
									  exij_desc,
									  exij_font,
								      exij_data) 
						  	   VALUES ('$exij_tit', 
										'$exij_desc', 
										'$exij_font',
										STR_TO_DATE('$exij_data', '%d/%m/%Y')
									  )";
			
		 $_msg = "Exigência cadastrada com sucesso";
		 $_msg_error = "Não foi possivel cadastrar a exigência";	

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

header("Location: Administracao.php?pagina=exigenciasCadastradas.php");


}
?>