<?php include("sc_login_comum.php"); ?>
<!doctype html>
<meta charset="utf-8"/>

		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/tables.css">

	<?php

		$labo_id = filter_input(INPUT_GET,'labo_id',FILTER_SANITIZE_NUMBER_INT);

		if(isset($labo_id))//Se for update
		{

			$consulta_sql = "SELECT labo_id, 
									labo_tipo, 
									labo_alt,
									labo_lar,
									labo_obs
							   FROM tb_labo WHERE labo_id = '$labo_id'";

			require_once("DBConnection.php");

			$result = mysqli_query($conn, $consulta_sql);

			$registro = mysqli_fetch_array($result);

			mysqli_close($conn);
		}
	?>
<section id="index_adm">
	  <form method="POST" action="labo_crud.php" id="sem_margim_top" enctype="multipart/form-data">
		  <fieldset>
			<?php if(isset($labo_id)) { ?>
				<legend>Atualizar laboratório </legend>
				<input type="hidden" name="labo_id" value="<?php echo isset($labo_id)? $labo_id : "";?>">

			<?php }else{ ?>
				<legend>Cadastrar laboratório </legend>
				
			<?php }; ?>
			  
			 
			  
			<label>Tipo: </label>
			<input type="text" name="labo_tipo" value="<?php echo isset($labo_id)? $registro['labo_tipo'] : "";?>">
			<label>Altura: </label>
			<input type="text" name="labo_alt" value="<?php echo isset($labo_id)? $registro['labo_alt'] : "";?>">
			<label>Largura: </label>
			<input type="text" name="labo_lar" value="<?php echo isset($labo_id)? $registro['labo_lar'] : "";?>">
			<label>Observações: </label>
			<textarea class="float_right" rows="9" cols="27" name="labo_obs"><?php echo isset($labo_id)? $registro['labo_obs'] : "";?></textarea>
			<div id="btns">
				<a href="Administracao.php?pagina=laboratoriosCadastrados.php"><input type="button" value="Voltar"></a>
				<input type="reset" value="Limpar">
				<input type="submit" value="Salvar" name="Salvar"> 
			</div>
		 </fieldset>
	 </form>
</section>
		