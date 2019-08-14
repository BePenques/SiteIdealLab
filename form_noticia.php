
<meta charset="utf-8"/>

		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/menuadm.css">
		<link rel="stylesheet" type="text/css" href="css/form.css">
		<link rel="stylesheet" type="text/css" href="css/buttons.css">
		<link rel="stylesheet" type="text/css" href="css/tables.css">

	
<section id="index_adm">

	<?php

		$noti_id = filter_input(INPUT_GET,'noti_id',FILTER_SANITIZE_NUMBER_INT);

		if(isset($noti_id))//Se for update
		{

			$consulta_sql = "SELECT noti_tit,
									noti_txt,
									noti_img,
									DATE_FORMAT(noti_data, '%d/%m/%Y') as noti_data
							   FROM tb_noti WHERE noti_id = '$noti_id'";

			require_once("DBConnection.php");

			$result = mysqli_query($conn, $consulta_sql);

			$registro = mysqli_fetch_array($result);

			mysqli_close($conn);
		}
	?>

	  <form method="post" action="noti_crud.php" id="sem_margim_top" enctype="multipart/form-data">
		  <fieldset>
			<?php if(isset($noti_id)) { ?>
				<legend>Atualizar Noticia </legend>
				<input type="hidden" name="noti_id" value="<?php echo isset($noti_id)? $noti_id : "";?>">

			<?php }else{ ?>
				<legend>Cadastrar Notícia </legend>
			<?php }; ?>
			<label>Título: </label>
			<input type="text" name="noti_tit" value="<?php echo isset($noti_id)? $registro['noti_tit'] : "";?>">
			<label>Data: </label>
			<input type="text" name="noti_data" value="<?php echo isset($noti_id)? $registro['noti_data'] : "";?>">
			<label>Texto: </label>
			<textarea class="float_right" rows="9" cols="27" name="noti_txt"><?php echo isset($noti_id)? $registro['noti_txt'] : "";?></textarea>

			<label>Atualizar
			<input type="checkbox" name="noti_img" id="noti_img"  onClick="habilitar();" value="<?php echo isset($noti_id)? $registro['noti_img'] : "";?>" <?php echo isset($noti_id)? "" : "checked";?>></label>


			<label>Imagem: </label>
			<input type="file" name="file" id="file" onChange="verImagem();"> 
			  
			<img src="<?php echo isset($noti_id)? $registro['noti_img'] : "/imagens/sem_foto.png";?>" id="imagem">  
			<div>
				<a href="Administracao.php?pagina=noticiasCadastradas.php"><input type="button" value="Voltar"></a>
				<input type="reset" value="Limpar">
				<input type="submit" value="Salvar" name="Salvar"> 
			</div>
		 </fieldset>
	 </form>
	<script type="text/javascript">
		function verImagem()//OnChange
		{
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("file").files[0]);
								   
			oFReader.onload = function (oFREvent)
			{
				document.getElementById("imagem").src = oFREvent.target.result;
			};
								   
								  
		};
		
    	function habilitar()//OnClick
		{
			if( document.getElementById('noti_img').checked )
			{
			   document.getElementById('file').disabled = false; //habilita
			}
			else
			{
				document.getElementById("imagem").src = "<?php echo isset($noti_id) ? $_registro['noti_img'] : '/imagens/sem_foto.png' ?>";
				document.getElementById('file').disabled = true;
				//document.getElementById("name").innerHTML = "";
			}
		}
	</script>	
</section>


		