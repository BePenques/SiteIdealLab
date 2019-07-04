<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Cadastrar Usuário</title>
    </head>
    <body>
        <p><a href="listar_users.php">Listar Usuários</a></p>
        <h3>Cadastrar Usuário<h3>      
        <form method="post" action="script_cadastrar.php">
            <label>E-mail: </label>
            <input type="email" name="email"><br><br>
            
            <label>Senha: </label>
            <input type="password" name="senha"><br><br>
            
            <label>Tipo: </label>
            <select name="tipo">
                <option value="Comum" selected="selected">Comum</option>
                <option value="Supervisor">Supervisor</option>
            </select><br><br>
            
            <input type="submit" name="salvar" value="Salvar">
            <input type="reset" name="limpar" value="Limpar">
        </form>
    </body>
</html>
