<?php
//else some, so vai ter if

}else if($informacao_id != ""){
	if(isset($_FILES['files']))
	{
	   unlink($informacao_imagem);
	   require_once("Upload_img.php");
	   $informacao_imagem = ", informacao_imagem = '$arquivo_caminho'";	
	}
	
	$consulta_sql =
		"UPDATE
			tb_informacao
		 SET
		    usuario_id = '$usuario_id',
			$informacao_imagem
		WHERE 
		 	informacao_id='$informacao_id'"
		$mensagem = "informacao editada com sucesso";
}else{
?>


INSERT INTO tb_equi (equi_nome, equi_fabr, equi_forn, equi_mod, equi_marc, equi_img, equi_desc, equi_val, equi_cara, equi_tipo_basi, equi_tipo_inter, equi_tipo_avan) 
			VALUES ("nome2",
					"fabr2",
					"forn2", 
					"mode2",
				    "marc2",
					'". $equi_img  ."',
					'". $equi_desc ."',
					'". $equi_val ."',
					'". $equi_cara ."',
					'". $equi_tipo_basi  ."',
					'". $equi_tipo_inter ."',
					'". $equi_tipo_avan  ."',
				   )";