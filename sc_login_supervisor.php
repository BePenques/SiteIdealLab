<?php
    //Iniciar a sessao
    if(!isset($_SESSION)){
        session_start();
    }

    //Verificar se nao há a variável da sessao que identifica o usuário e o nível de acesso
    if(!isset($_SESSION['usua_id'])){
        
        //Redireciona o visitante de volta para a pagina anterior
        echo "<script>alert('É preciso entrar para ter acesso a essa página.'); history.go(-1);</script>";
        
        //Finalizar execuçao do script
        exit;
        
    }elseif($_SESSION['usua_tipo'] == "CMU"){       
        
        //Redireciona o visitante de volta para a pagina anterior
        echo "<script>alert('Sem autorização para acessar essa página.'); history.go(-1);</script>";
        
        //Finalizar execuçao do script
        exit;
    }
?>