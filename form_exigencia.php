<!doctype html>
<meta charset="utf-8"/>

		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/tables.css">
	


<?php

	$exij_id = filter_input(INPUT_GET,'exij_id',FILTER_SANITIZE_NUMBER_INT);

	if(isset($exij_id))//Se for update
	{

		$consulta_sql = "SELECT 
								exij_id,
								exij_tit,
								exij_desc,
								exij_font,
								DATE_FORMAT(exij_data, '%d/%m/%Y') AS exij_data
 						  FROM  tb_exij
						 WHERE exij_id = '$exij_id'";

		require_once("DBConnection.php");

		$result = mysqli_query($conn, $consulta_sql);

		$registro = mysqli_fetch_array($result);

		mysqli_close($conn);
	}
?>
<section id="index_adm">
  <form method="post" action="exij_crud.php" id="sem_margim_top" enctype="multipart/form-data">
		  <fieldset>
			<?php if(isset($exij_id)) { ?>
				<legend>Atualizar exigência </legend>
				<input type="hidden" name="exij_id" value="<?php echo isset($exij_id)? $exij_id : "";?>">

			<?php }else{ ?>
				<legend>Cadastrar exigência </legend>
				
			<?php }; ?>
			  
			 
			  
			<label>Título: </label>
			<input type="text" name="exij_tit" value="<?php echo isset($exij_id)? $registro['exij_tit'] : "";?>">
			<label>Descrição: </label>
			<textarea class="float_right" rows="9" cols="27" name="exij_desc"><?php echo isset($exij_id)? $registro['exij_desc'] : "";?></textarea>
			<label>Fonte: </label>
			<input type="text" name="exij_font" value="<?php echo isset($exij_id)? $registro['exij_font'] : "";?>">
			<label>Data: </label>
			<input type="text" name="exij_data" value="<?php echo isset($exij_id)? $registro['exij_data'] : "";?>">
			  
			<div id="btns">
				<a href="Administracao.php?pagina=exigenciasCadastradas.php"><input type="button" value="Voltar"></a>
				<input type="reset" value="Limpar">
				<input type="submit" value="Salvar" name="Salvar"> 
			</div>
		 </fieldset>
	 </form>
<section>