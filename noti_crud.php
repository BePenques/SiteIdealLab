	
<?php
session_start();

if(isset($_POST['noti_id'])/*update */ || isset($_GET['noti_id']) /* delete*/ ||  isset($_POST['noti_tit']) /* insert */ )

{
	$noti_id_get = filter_input(INPUT_GET,'noti_id',FILTER_SANITIZE_NUMBER_INT);//delete
	
	$noti_id = filter_input(INPUT_POST, 'noti_id', FILTER_SANITIZE_NUMBER_INT);//update
	$noti_tit =   filter_input(INPUT_POST, 'noti_tit', FILTER_SANITIZE_STRING);
	$noti_data =   filter_input(INPUT_POST, 'noti_data', FILTER_SANITIZE_STRING );
	$noti_txt =   filter_input(INPUT_POST, 'noti_txt', FILTER_SANITIZE_STRING);
	$noti_img =   filter_input(INPUT_POST, 'noti_img', FILTER_SANITIZE_STRING);
	
	$imagem = $_FILES['imagem']['tmp_name'];
	$tamanho = $_FILES['imagem']['size'];

	
	if ( $imagem != "" )
	{
			$fp = fopen($imagem, "rb");
			$conteudo = fread($fp, $tamanho);
			$conteudo = addslashes($conteudo);
			fclose($fp);
		
	}
    else{
    	echo("Não foi possível carregar a imagem.");
	}
	
	
	if(isset($noti_id_get))//é Delete
		{
			
		    $consulta_sql = "DELETE FROM tb_noti WHERE noti_id = '". $noti_id_get ."'";
			$_msg = "Notícia deletada com sucesso";
			$_msg_error = "Não foi possivel deletar a notícia";
		}

	else if(isset($noti_id)) //É Update
		{
			$consulta_sql = "UPDATE tb_noti SET  noti_tit = '". $noti_tit ."', noti_data = '". $noti_data ."', noti_txt = '". $noti_txt ."' , noti_img = '". $noti_img ."' WHERE noti_id = '". $noti_id ."'";
			$_msg = "Notícia alterada com sucesso";
			$_msg_error = "Não foi possivel alterar a notícia";
		}
	else 
		{
			$consulta_sql = "INSERT INTO tb_noti (noti_tit, noti_data, noti_txt, noti_img ) VALUES ('". $noti_tit ."', '". $noti_data ."', '". $noti_txt ."', '". $conteudo."')";
			$_msg = "Notícia cadastrada com sucesso";
			$_msg_error = "Não foi possivel cadastrar a notícia";

		}
	
	require_once("DBConnection.php");

	$result = mysqli_query($conn, $consulta_sql);

	if(mysqli_insert_id($conn) || mysqli_affected_rows($conn) ){
		 $_SESSION['mensagem'] = "<span style='color:green'>".$_msg."</span>";
			header("Location: noticiasCadastradas.php");
	}else{
		 $_SESSION['mensagem'] = "<span style='color:red'>".$_msg_error."</span>";
			header("Location: noticiasCadastradas.php");
	}

	mysqli_close($conn);

	
}else{echo("nao deu");}