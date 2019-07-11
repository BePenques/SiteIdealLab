<?php
    //Iniciar sessão
    session_start();

    //importar conexão com o banco
    require_once("conexao_banco.php");
    
    //Filtrar dados transmitidos por POST
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);

    //Realizar cadastro no banco     
    $consulta_sql = "INSERT INTO tb_users (email, senha, tipo) VALUES ('". $email ."', '". $senha ."', '". $tipo ."')";

    $resultado_consulta_sql = mysqli_query($conn, $consulta_sql);

    //Verificar se foi cadastrado e criar mensagem utilizando sessão
    if(mysqli_insert_id($conn)){
        $_SESSION['mensagem'] = "<span style='color:green'>Usuário cadastrado com sucesso - ID: ".mysqli_insert_id($conn)."</span>";
        header("Location: listar_users.php");
		
    }else{
        $_SESSION['mensagem'] = "<span style='color:red'>Usuário não foi cadastrado com sucesso</span>";
        header("Location: listar_users.php");
    }

    //Fechar conexão com o banco
    mysqli_close($conn); 
?>