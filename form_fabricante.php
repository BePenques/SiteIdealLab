<meta charset="utf-8"/>

		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/tables.css">

	
<section id="index_adm">

	<?php

		$fabr_id = filter_input(INPUT_GET,'fabr_id',FILTER_SANITIZE_NUMBER_INT);

		if(isset($fabr_id))//Se for update
		{

			$consulta_sql = "SELECT fabr_id, 
									fabr_nome, 
									fabr_end,
									fabr_resp,
									fabr_mail,
									fabr_tel,
									fabr_cnpj,
									fabr_ie
							   FROM tb_fabr WHERE fabr_id = '$fabr_id'";

			require_once("DBConnection.php");

			$result = mysqli_query($conn, $consulta_sql);

			$registro = mysqli_fetch_array($result);

			mysqli_close($conn);
		}
	?>

	  <form method="post" action="fabr_crud.php" id="sem_margim_top" enctype="multipart/form-data">
		  <fieldset>
			<?php if(isset($fabr_id)) { ?>
				<legend>Atualizar Fabricante </legend>
				<input type="hidden" name="fabr_id" value="<?php echo isset($fabr_id)? $fabr_id : "";?>">

			<?php }else{ ?>
				<legend>Cadastrar Fabricante </legend>
				
			<?php }; ?>
			  
			 
			  
			<label>Nome: </label>
			<input type="text" name="fabr_nome" value="<?php echo isset($fabr_id)? $registro['fabr_nome'] : "";?>">
			<label>Endereço: </label>
			<input type="text" name="fabr_end" value="<?php echo isset($fabr_id)? $registro['fabr_end'] : "";?>">
			<label>Responsável: </label>
			<input type="text" name="fabr_resp" value="<?php echo isset($fabr_id)? $registro['fabr_resp'] : "";?>">
			<label>E-mail: </label>
			<input type="text" name="fabr_mail" value="<?php echo isset($fabr_id)? $registro['fabr_mail'] : "";?>">
			<label>Telefone: </label>
			<input type="text" name="fabr_tel" placeholder="DDD+Numero" value="<?php echo isset($fabr_id)? $registro['fabr_tel'] : "";?>">
			<label>CNPJ: </label>
			<input type="text" name="fabr_cnpj" placeholder="XX.XXX.XXX/XXXX-XX" value="<?php echo isset($fabr_id)? $registro['fabr_cnpj'] : "";?>">
			<label>Insc. Estadual: </label>
			<input type="text" name="fabr_ie" placeholder="XXX.XXX.XXX.XXX" value="<?php echo isset($fabr_id)? $registro['fabr_ie'] : "";?>">
			<div id="btns">
				<a href="fabricantesCadastrados.php"><input type="button" value="Voltar"></a>
				<input type="reset" value="Limpar">
				<input type="submit" value="Salvar" name="Salvar"> 
			</div>
		 </fieldset>
	 </form>
</section>
		