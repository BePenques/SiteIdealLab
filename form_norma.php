<?php include("sc_login_comum.php"); ?>
<!doctype html>
<meta charset="utf-8"/>

		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/tables.css">
	


<?php

	$norm_id = filter_input(INPUT_GET,'norm_id',FILTER_SANITIZE_NUMBER_INT);

	if(isset($norm_id))//Se for update
	{

		$consulta_sql = "SELECT 
								norm_id,
								norm_tit,
								norm_desc,
								norm_font,
								DATE_FORMAT(norm_data, '%d/%m/%Y') AS norm_data
 						  FROM  tb_norm
						 WHERE norm_id = '$norm_id'";

		require_once("DBConnection.php");

		$result = mysqli_query($conn, $consulta_sql);

		$registro = mysqli_fetch_array($result);

		mysqli_close($conn);
	}
?>
<section id="index_adm">
  <form method="post" action="norm_crud.php" id="sem_margim_top" enctype="multipart/form-data">
		  <fieldset>
			<?php if(isset($norm_id)) { ?>
				<legend>Atualizar Norma </legend>
				<input type="hidden" name="norm_id" value="<?php echo isset($norm_id)? $norm_id : "";?>">

			<?php }else{ ?>
				<legend>Cadastrar Norma </legend>
				
			<?php }; ?>
			  
			 
			  
			<label>Título: </label>
			<input type="text" name="norm_tit" value="<?php echo isset($norm_id)? $registro['norm_tit'] : "";?>">
			<label>Descrição: </label>
			<textarea class="float_right" rows="9" cols="27" name="norm_desc"><?php echo isset($norm_id)? $registro['norm_desc'] : "";?></textarea>
			<label>Fonte: </label>
			<input type="text" name="norm_font" value="<?php echo isset($norm_id)? $registro['norm_font'] : "";?>">
			<label>Data: </label>
			<input type="text" name="norm_data" value="<?php echo isset($norm_id)? $registro['norm_data'] : "";?>">
			  
			<div id="btns">
				<a href="Administracao.php?pagina=normasCadastradas.php"><input type="button" value="Voltar"></a>
				<input type="reset" value="Limpar">
				<input type="submit" value="Salvar" name="Salvar"> 
			</div>
		 </fieldset>
	 </form>
<section>