<meta charset="utf-8"/>

		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/tables.css">

	
<section id="index_adm">

	<?php
		$forn_id = filter_input(INPUT_GET,'forn_id',FILTER_SANITIZE_NUMBER_INT);

		if(isset($forn_id))//Se for update
		{

			$consulta_sql = "SELECT forn_id, 
									forn_nome, 
									forn_end,
									forn_resp,
									forn_mail,
									forn_tel,
									forn_cnpj,
									forn_ie
							   FROM tb_forn WHERE forn_id = '$forn_id'";

			require_once("DBConnection.php");

			$result = mysqli_query($conn, $consulta_sql);

			$registro = mysqli_fetch_array($result);

			mysqli_close($conn);
		}
	?>

	  <form method="post" action="forn_crud.php" id="sem_margim_top" enctype="multipart/form-data">
		  <fieldset>
			<?php if(isset($forn_id)) { ?>
				<legend>Atualizar Fornecedor </legend>
				<input type="hidden" name="forn_id" value="<?php echo isset($forn_id)? $forn_id : "";?>">

			<?php }else{ ?>
				<legend>Cadastrar Fornecedor </legend>
				
			<?php }; ?>
			  
			<label>Nome: </label>
			<input type="text" name="forn_nome" value="<?php echo isset($forn_id)? $registro['forn_nome'] : "";?>">
			<label>Endereço: </label>
			<input type="text" name="forn_end" value="<?php echo isset($forn_id)? $registro['forn_end'] : "";?>">
			<label>Responsável: </label>
			<input type="text" name="forn_resp" value="<?php echo isset($forn_id)? $registro['forn_resp'] : "";?>">
			<label>E-mail: </label>
			<input type="text" name="forn_mail" value="<?php echo isset($forn_id)? $registro['forn_mail'] : "";?>">
			<label>Telefone: </label>
			<input type="text" name="forn_tel" placeholder="DDD+Numero" value="<?php echo isset($forn_id)? $registro['forn_tel'] : "";?>">
			<label>CNPJ: </label>
			<input type="text" name="forn_cnpj" placeholder="XX.XXX.XXX/XXXX-XX" value="<?php echo isset($forn_id)? $registro['forn_cnpj'] : "";?>">
			<label>Insc. Estadual: </label>
			<input type="text" name="forn_ie" placeholder="XXX.XXX.XXX.XXX" value="<?php echo isset($forn_id)? $registro['forn_ie'] : "";?>">
			<div id="btns">
				<a href="Administracao.php?pagina=fornecedoresCadastrados.php"><input type="button" value="Voltar"></a>
				<input type="reset" value="Limpar">
				<input type="submit" value="Salvar" name="Salvar"> 
			</div>
		 </fieldset>
	 </form>
</section>
		