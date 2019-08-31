	
<?php
session_start();

if(isset($_POST['Salvar']) )

{
	unset($_POST['Salvar']);
	
	 isset($_GET['equi_id']) ? 
		$equi_id = filter_input(INPUT_GET, 'equi_id', FILTER_SANITIZE_NUMBER_INT) :
        $equi_id = filter_input(INPUT_POST, 'equi_id', FILTER_SANITIZE_NUMBER_INT);
	
	
	$equi_nome =   filter_input(INPUT_POST, 'equi_nome', FILTER_SANITIZE_STRING);
	$fabr_id =   filter_input(INPUT_POST, 'fabr_id', FILTER_SANITIZE_STRING);
	$forn_id =   filter_input(INPUT_POST, 'forn_id', FILTER_SANITIZE_STRING);
	$equi_mod =   filter_input(INPUT_POST, 'equi_mod', FILTER_SANITIZE_STRING);
	$equi_marc =   filter_input(INPUT_POST, 'equi_marc', FILTER_SANITIZE_STRING);
	
		
	isset($_GET['equi_img']) ? 
		$equi_img = filter_input(INPUT_GET, 'equi_img', FILTER_SANITIZE_STRING) :
        $equi_img = filter_input(INPUT_POST, 'equi_img', FILTER_SANITIZE_STRING);
	
	
	$equi_desc =   filter_input(INPUT_POST, 'equi_desc', FILTER_SANITIZE_STRING);
	$equi_val =   filter_input(INPUT_POST, 'equi_val', FILTER_SANITIZE_STRING);
	$equi_cara =   filter_input(INPUT_POST, 'equi_cara', FILTER_SANITIZE_STRING);
	$equi_tipo_basi =   filter_input(INPUT_POST, 'equi_tipo_basi', FILTER_SANITIZE_STRING);
	$equi_tipo_inter =  filter_input(INPUT_POST, 'equi_tipo_inter', FILTER_SANITIZE_STRING);
	$equi_tipo_avan =  filter_input(INPUT_POST, 'equi_tipo_avan', FILTER_SANITIZE_STRING);
	

	
	if(isset($_GET['equi_id'])){
			//var_dump($noti_img);
			unlink($equi_img);
			$consulta_sql = "DELETE FROM tb_equi 
			                  WHERE equi_id = '$equi_id'";
		 
			$_msg = "Equipamento deletado com sucesso";
		}
		elseif($equi_id != ""){ 
			if($_FILES['file']['size'] > 0){
				
				unlink($equi_img);			 
			   	require_once("Upload_img.php");
				
			   	$equi_imgg = ", equi_img = '$imagem_caminho'";	
				
				
			}
			
			var_dump($equi_imgg);
			
			$consulta_sql = "UPDATE tb_equi SET fabr_id = '". $fabr_id ."', 
												forn_id = '". $forn_id ."',
												equi_nome = '". $equi_nome ."',  
												equi_mod = '". $equi_mod ."', 
												equi_marc = '". $equi_marc ."' 
												$equi_imgg,
												equi_desc = '". $equi_desc ."', 
												equi_val = '". $equi_val ."',
												equi_cara = '". $equi_cara ."',
												equi_tipo_basi = '". $equi_tipo_basi ."',
												equi_tipo_inter = '". $equi_tipo_inter ."',
												equi_tipo_avan = '". $equi_tipo_avan ."'
										  WHERE equi_id = '". $equi_id ."'";
			
			$_msg = "Equipamento alterado com sucesso";

		}
		else
		{
		 require_once('Upload_img.php');
			 $consulta_sql = "INSERT INTO tb_equi (
			 					 fabr_id,
								 forn_id,
								 equi_nome, 
								 equi_mod,
								 equi_marc,
								 equi_img,
								 equi_desc,
								 equi_val,
								 equi_cara,
								 equi_tipo_basi, 
								 equi_tipo_inter,
								 equi_tipo_avan
			 					) 
						VALUES ('". $fabr_id ."',
								'". $forn_id ."',
								'". $equi_nome ."',
								'". $equi_mod  ."',
								'". $equi_marc ."',
								'". $imagem_caminho  ."',
								'". $equi_desc ."',
								'". $equi_val ."',
								'". $equi_cara ."',
								'". $equi_tipo_basi  ."',
								'". $equi_tipo_inter ."',
								'". $equi_tipo_avan  ."'
							   )";
			
		 $_msg = "Equipamento cadastrado com sucesso";

		 }
	
	require_once("DBConnection.php");

	$result = mysqli_query($conn, $consulta_sql);
	
	//Coletar erro de SQL Query ou mover o arquivo para o destino
    mysqli_error($conn) ? $mensagem_erro = mysqli_error($conn) : move_uploaded_file($imagem_arquivo, $imagem_caminho); 
 //Verificar se a operação foi realizada e retornar mensagem utilizando sessão
    if(mysqli_affected_rows($conn) > 0){
        $_SESSION['mensagem'] = "<span style='color:green'class='text-success'>$_msg</span>";
	
    }elseif($mensagem_erro == ""){
        $_SESSION['mensagem'] = "";
    }else{
        $_SESSION['mensagem'] = "<span style='color:red'class='text-danger'>Algo deu errado! $mensagem_erro</span>";
    }  
	
	mysqli_close($conn);
	
	header("Location: Administracao.php?pagina=equipamentosCadastrados.php");

	
}