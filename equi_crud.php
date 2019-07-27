	
<?php
session_start();

if(isset($_POST['equi_id'])/*update */ || isset($_GET['equi_id']) /* delete*/ ||  isset($_POST['equi_nome']) /* insert */ )

{
	$equi_id_get = filter_input(INPUT_GET,'equi_id',FILTER_SANITIZE_NUMBER_INT);//delete
	
	$equi_id = filter_input(INPUT_POST, 'equi_id', FILTER_SANITIZE_NUMBER_INT);//update
	
	
	$equi_nome =   filter_input(INPUT_POST, 'equi_nome', FILTER_SANITIZE_STRING);
	$equi_fabr =   filter_input(INPUT_POST, 'equi_fabr', FILTER_SANITIZE_STRING);
	$equi_forn =   filter_input(INPUT_POST, 'equi_forn', FILTER_SANITIZE_STRING);
	$equi_mod =   filter_input(INPUT_POST, 'equi_mod', FILTER_SANITIZE_STRING);
	$equi_marc =   filter_input(INPUT_POST, 'equi_marc', FILTER_SANITIZE_STRING);
	$equi_img =   filter_input(INPUT_POST, 'equi_img', FILTER_SANITIZE_STRING);
	$equi_desc =   filter_input(INPUT_POST, 'equi_desc', FILTER_SANITIZE_STRING);
	$equi_val =   filter_input(INPUT_POST, 'equi_val', FILTER_SANITIZE_STRING);
	$equi_cara =   filter_input(INPUT_POST, 'equi_cara', FILTER_SANITIZE_STRING);
	$equi_tipo_basi =   filter_input(INPUT_POST, 'equi_tipo_basi', FILTER_SANITIZE_STRING);
	$equi_tipo_inter =  filter_input(INPUT_POST, 'equi_tipo_inter', FILTER_SANITIZE_STRING);
	$equi_tipo_avan =  filter_input(INPUT_POST, 'equi_tipo_avan', FILTER_SANITIZE_STRING);
	

	
	if(isset($equi_id_get))//é Delete
		{
			
		    $consulta_sql = "DELETE FROM tb_equi WHERE equi_id = '". $equi_id_get ."'";
			$_msg = "Equipamento deletado com sucesso";
			$_msg_error = "Não foi possivel deletar o equipamento";
		}

	else if(isset($equi_id)) //É Update
		{
	
		
			$consulta_sql = "UPDATE tb_equi SET equi_nome = '". $equi_nome ."', 
												equi_fabr = '". $equi_fabr ."', 
												equi_forn = '". $equi_forn ."' , 
												equi_mod = '". $equi_mod ."', 
												equi_marc = '". $equi_marc ."', 
												equi_img = '". $equi_img ."', 
												equi_desc = '". $equi_desc ."', 
												equi_val = '". $equi_val ."',
												equi_cara = '". $equi_cara ."',
												equi_tipo_basi = '". $equi_tipo_basi ."',
												equi_tipo_inter = '". $equi_tipo_inter ."',
												equi_tipo_avan = '". $equi_tipo_avan ."'
										  WHERE equi_id = '". $equi_id ."'";
			$_msg = "Equipamento alterado com sucesso";
			$_msg_error = "Não foi possivel alterar o equipamento";
		}
	else 
		{
			$consulta_sql = "INSERT INTO tb_equi (equi_nome, equi_fabr, equi_forn, equi_mod, equi_marc, equi_img, equi_desc, equi_val, equi_cara, equi_tipo_basi, equi_tipo_inter, equi_tipo_avan) 
			VALUES ('". $equi_nome ."',
					'". $equi_fabr ."',
					'". $equi_forn ."', 
					'". $equi_mod  ."',
				    '". $equi_marc ."',
					'". $equi_img  ."',
					'". $equi_desc ."',
					'". $equi_val ."',
					'". $equi_cara ."',
					'". $equi_tipo_basi  ."',
					'". $equi_tipo_inter ."',
					'". $equi_tipo_avan  ."'
				   )";
			$_msg = "Equipamento cadastrado com sucesso";
			$_msg_error = "Não foi possivel cadastrar o equipamento";

		}
	
	require_once("DBConnection.php");

	$result = mysqli_query($conn, $consulta_sql);

	if(mysqli_insert_id($conn) || mysqli_affected_rows($conn) ){
		 $_SESSION['mensagem'] = "<span style='color:green'>".$_msg."</span>";
			header("Location: equipamentosCadastrados.php");
	}else{
		 $_SESSION['mensagem'] = "<span style='color:red'>".$_msg_error."</span>";
			header("Location: equipamentosCadastrados.php");
	}

	mysqli_close($conn);

	
}else{echo("nao deu");}