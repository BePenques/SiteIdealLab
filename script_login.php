<?php

    $logout = filter_input(INPUT_GET, 'logout', FILTER_SANITIZE_STRING);
    $restrito = filter_input(INPUT_GET, 'restrito', FILTER_SANITIZE_STRING);
    $usua_nome = filter_input(INPUT_POST, 'usua_nome', FILTER_SANITIZE_STRING);
    $usua_senha = filter_input(INPUT_POST, 'usua_senha', FILTER_SANITIZE_STRING);

   if($logout == true){  
	   
      //Iniciar a ssessão
      session_start();

      //Limpar as variáveis da sessão
      session_unset();

      //Finalizar a sessão
      session_destroy();

      //Fechar todas as sessoes
      session_write_close();

      //Limpar os cookie da sessão
      setcookie(session_name(),'',0,'/');

      //Exibir mensagem em JavaScript se o processo foi concluido com sucesso
      echo "<script>alert('Você saiu com sucesso.');</script>";
	   
	   if($restrito == false){
		   
			//Redireciona o visitante de volta para a pagina anterior
			echo "<script>history.go(-1);</script>";
		}
		else{         
			//Redirecionar para página inicial
			echo '<meta http-equiv="refresh" content="0;URL=/login.php"/>';
		}

		//Finalizar execução do script
		exit; 
   }
	  //Verificar se o usuário ou a senha estão vazios
	if(empty($usua_nome) OR empty($usua_senha))
	{
		//Mensagem de erro quando os dados não foram digitados pelo usuário e retornar para a pagina anterior
		echo "<script>alert('Os dados para entrar não foram informados.'); history.go(-1);</script>";

		//Finalizar execução do script
		exit;
	}

	if(isset($usua_senha)){ //Criptografar senha
			$usua_senhaa = md5($usua_senha);
			
	}

	var_dump($usua_nome);
    var_dump($usua_senhaa);

	  //Consulta a ser realizada no banco de dados 
    $consulta_sql = "SELECT usua_id, 
							usua_nome, 
							usua_senha, 
							usua_tipo 
        			   FROM tb_usua
					  WHERE usua_nome = '$usua_nome' 
					  	AND usua_senha = '$usua_senhaa'
        					LIMIT 1";

	 //Importar conexao com banco de dados
    require_once('DBConnection.php');
    
    //Realizar operação no banco de dados
    $resultado_consulta_sql = mysqli_query($conn, $consulta_sql);

	 //Validar o usuário e senha digitados
    if (mysqli_num_rows($resultado_consulta_sql) != 1) 
    {
        //Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado e retornar para a pagina anterior
      echo "<script>alert('E-mail e/ou senha inválidos.'); history.go(-1);</script>";
        
        //Finalizar execução do script
        exit;
    } 
    else 
    {  
		//Salva as informações do banco de dados na variável registro
        $registro = mysqli_fetch_array($resultado_consulta_sql);
    
        //Se a sessão não existir, iniciar uma
        if (!isset($_SESSION))
        {   
            //Iniciar a sessão
            session_start();
        }
        
        // Salva as informações do banco de dados na sessão
        $_SESSION['usua_id'] = $registro['usua_id'];
        $_SESSION['usua_nome'] = $registro['usua_nome'];
        $_SESSION['usua_senha'] = $usua_senhaa;
        $_SESSION['usua_tipo'] = $registro['usua_tipo'];
    
        //Redirecionar para outra página
        header("Location: Administracao.php");
        
        //Finalizar execução do script
        exit;
	}























?>