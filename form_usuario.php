<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/tables.css">

	
<section id="index_adm">

	<?php

		$usua_id = filter_input(INPUT_GET,'usua_id',FILTER_SANITIZE_NUMBER_INT);

		if(isset($usua_id))//Se for update
		{

			$consulta_sql = "SELECT * FROM tb_usua WHERE usua_id = '". $usua_id ."'";

			require_once("DBConnection.php");

			$result = mysqli_query($conn, $consulta_sql);

			$registro = mysqli_fetch_array($result);

			mysqli_close($conn);
		}
	?>

  <form method="post" action="usua_crud.php" id="sem_margim_top">
	<fieldset>
		<?php if(isset($usua_id)) { ?><!--é atualizar -->
			<legend>Atualizar Usuário </legend>
			<input type="hidden" name="usua_id" value="<?php $registro['usua_id'];?>">
		<?php }else{ ?>
			<legend>Cadastrar Usuário </legend>
		<?php }; ?>


		<label>E-mail: </label>
		<input type="text" name="usua_nome" value="<?php echo isset($usua_id)? $registro['usua_nome'] : "";?>">
		<label>Senha: </label>
		<input type="password" name="usua_senha" value="<?php echo isset($usua_id) ? $registro['usua_senha'] : "";?>">

		<label>Tipo: 

			<select name="usua_tipo" class="cb_tipo margin_top">
				<option value="CMU" selected="selected"
						<?php
						if(isset($usua_id)){
							if('CMU' == $registro['usua_tipo']){
							  echo "selected=\"selected\"";
							}
						}
						?>
					>CMU</option>
				<option value="SUP" 
						<?php
						if(isset($usua_id)){
							if('SUP' == $registro['usua_tipo']){
							  echo "selected=\"selected\"";
							}
						}
						?>	

					>SUP</option>
			</select></label>
		<div id="btns">
			<a href="Administracao.php?pagina=usuariosCadastrados.php"><input type="button" value="Voltar"></a>
			<!--<input type="button" value="Limpar" onclick="msg()"> -->
			<input type="reset" value="Limpar">
			<input type="submit" value="Salvar" name="Salvar"> 
		</div>
	</fieldset>
  </form>	
</section>
		