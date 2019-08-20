<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>

<body>
	<h3>Cadastrar</h3>
	<form method="post" action="/SiteProteses/Exemplos/script_cadastrar.php">
		<label>Email:</label>
	  <input type="text" name="email"><br><br>
		<label>Senha:</label>
	  <input type="password" name="senha"><br><br>
<label class="margin_top">Tipo: </label>
							<select class="cb_assunto margin_top">
								<option value="CMU"  selected="selected">CMU</option>
								<option value="SUP" >SUP</option>
							</select>
	  <input type="submit" name="cadastrar" value="cadastrar"><br><br>
	</form>
</body>
</html>
