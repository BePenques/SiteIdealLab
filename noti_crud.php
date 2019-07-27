	
<?php
session_start();

if(isset($_GET['noti_img']) || isset($_POST['noti_img']) || isset($_POST['noti_tit'])){
	//$noti_id = $_SESSION['noti_id'];
	
    isset($_GET['noti_id']) ? 
		$noti_id = filter_input(INPUT_GET, 'noti_id', FILTER_SANITIZE_NUMBER_INT) :
        $noti_id = filter_input(INPUT_POST, 'noti_id', FILTER_SANITIZE_NUMBER_INT);
	
	
	$noti_tit =   filter_input(INPUT_POST, 'noti_tit', FILTER_SANITIZE_STRING);
	$noti_data =   filter_input(INPUT_POST, 'noti_data', FILTER_SANITIZE_STRING);
	$noti_txt =   filter_input(INPUT_POST, 'noti_txt', FILTER_SANITIZE_STRING);
	
	isset($_GET['noti_img']) ? 
		$noti_img = filter_input(INPUT_GET, 'noti_img', FILTER_SANITIZE_STRING) :
        $noti_img = filter_input(INPUT_POST, 'noti_img', FILTER_SANITIZE_STRING);
	
	
	if($_FILES["file"]["error"] == 0)
	{
		if(isset($_GET['noti_id']))
		{	unlink($noti_img);
			$consulta_sql = "DELETE FROM tb_noti 
			                  WHERE noti_id = '$noti_id'";
			$_msg = "Notícia deletada com sucesso";
		}
		else if($noti_id != "")
		{
			if(isset($_FILES['file']))
			{
			   unlink($noti_img);
			   require_once("Upload_img.php");
			   $noti_img = ", noti_img = '$imagem_caminho'";	
			}
			
			$consulta_sql = "UPDATE tb_noti 
								SET  usua_id = 1,
									 noti_tit = '$noti_tit',
								     noti_data = STR_TO_DATE('$noti_data', '%d/%m/%y'),
									 noti_txt = '$noti_txt' 
									 $noti_img
							  WHERE noti_id = '$noti_id'";
			$_msg = "Notícia alterada com sucesso";

		}
		else
		{
		 require_once('Upload_img.php');
		 $consulta_sql = "INSERT INTO tb_noti 
		 							 (usua_id,
									  noti_tit, 
									  noti_data,
									  noti_txt,
									  noti_img) 
						  	   VALUES (1, 
							   		  '$noti_tit',
						              STR_TO_DATE('$noti_data', '%d/%m/%Y'), 
							          '$noti_txt', 
							          '$imagem_caminho')";
			
		 $_msg = "Notícia cadastrada com sucesso";
		
		 }

	require_once("DBConnection.php");

	$result = mysqli_query($conn, $consulta_sql); 
	var_dump($result);
	 //Coletar erro de SQL Query ou mover o arquivo para o destino
     mysqli_error($conn) ? $mensagem_erro = mysqli_error($conn) : move_uploaded_file($imagem_arquivo, $imagem_caminho); 
	
	}else{
	
		//Coletar erro de upload de arquivo
        $mensagem_erro = "Upload falhou. Código de erro: " . $_FILES["file"]["error"];
	}
	
	 //Verificar se a operação foi realizada e retornar mensagem utilizando sessão
    if(mysqli_affected_rows($conn) > 0){
        $_SESSION['mensagem'] = "<span class='text-success'>$_msg</span>";
	
    }elseif($mensagem_erro == ""){
        $_SESSION['mensagem'] = "";
    }else{
        $_SESSION['mensagem'] = "<span class='text-danger'>Algo deu errado! $mensagem_erro</span>";
    }  
	
	mysqli_close($conn);
	
	//header("Location: noticiasCadastradas.php");
}
?>