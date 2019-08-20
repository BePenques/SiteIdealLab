<?php
    //Iniciar a sessão
    require_once('sc_ini_sessao_comum.php');
    
    //Pegar e filtrar valores tranmitidos via POST
    $usuario_id = $_SESSION['usuario_id'];

    isset($_GET['informacao_id']) ? 
		$informacao_id = filter_input(INPUT_GET, 'informacao_id', FILTER_SANITIZE_NUMBER_INT) :
        $informacao_id = filter_input(INPUT_POST, 'informacao_id', FILTER_SANITIZE_NUMBER_INT);

    $informacao_data = filter_input(INPUT_POST, 'informacao_data', FILTER_SANITIZE_SPECIAL_CHARS);
    $informacao_titulo = filter_input(INPUT_POST, 'informacao_titulo', FILTER_SANITIZE_STRING);
    $informacao_texto = filter_input(INPUT_POST, 'informacao_texto', FILTER_SANITIZE_STRING);

    isset($_GET['informacao_imagem']) ? 
		$informacao_imagem = filter_input(INPUT_GET, 'informacao_imagem', FILTER_SANITIZE_STRING) :
        $informacao_imagem = filter_input(INPUT_POST, 'informacao_imagem', FILTER_SANITIZE_STRING);
    
    if($_FILES["file"]["error"] == 0){
        
        //Consulta a ser realizada no banco de dados  
        if(isset($_GET['informacao_id'])){
            unlink($informacao_imagem);
            $consulta_sql = 
                "DELETE FROM 
                    tb_informacoes 
                WHERE 
                    informacao_id = '$informacao_id'";
            
            $mensagem = "Informação apagada com sucesso";
        }elseif($informacao_id != ""){
            if(!isset($_FILES['file'])){
                $consulta_sql =
                    "UPDATE
                        tb_informacoes
                    SET
                        usuario_id = '$usuario_id',
                        informacao_data = STR_TO_DATE('$informacao_data', '%d/%m/%Y'),
                        informacao_titulo = '$informacao_titulo',
                        informacao_texto = '$informacao_texto'
                    WHERE
                        informacao_id = '$informacao_id'";
                
            }else{
                unlink($informacao_imagem);
                require_once('sc_upload.php');
                $consulta_sql = 
                    "UPDATE 
                        tb_informacoes
                    SET
                        usuario_id = '$usuario_id',
                        informacao_data = STR_TO_DATE('$informacao_data', '%d/%m/%Y'),
                        informacao_titulo = '$informacao_titulo',
                        informacao_texto = '$informacao_texto',
                        informacao_imagem = '$arquivo_caminho'
                    WHERE 
                        informacao_id = '$informacao_id'";
            }
            
            $mensagem = "Informação editada com sucesso";
        }else{
            require_once('sc_upload.php');
            $consulta_sql = 
                "INSERT INTO 
                    tb_informacoes 
                    (usuario_id, 
                    informacao_data, 
                    informacao_titulo, 
                    informacao_texto, 
                    informacao_imagem) 
                VALUES 
                    ('$usuario_id', 
                    STR_TO_DATE('$informacao_data', '%d/%m/%Y'), 
                    '$informacao_titulo', 
                    '$informacao_texto', 
                    '$arquivo_caminho')";
            
            $mensagem = "Informação cadastrada com sucesso";
        }

        //Importar conexao com banco de dados
        require_once('sc_conexao_banco.php');
        
        //Realizar operação no banco de dados
        $resultado_consulta_sql = mysqli_query($conexao, $consulta_sql);
        
        //Definir o caminho para salvar a imagem
        $arquivo_caminho = 'imagens/informacoes/' . $arquivo_nome;  
        
        //Coletar erro de SQL Query ou mover o arquivo para o destino
        mysqli_error($conexao) ? $mensagem_erro = mysqli_error($conexao) : move_uploaded_file($arquivo, $arquivo_caminho); 
    }else{
        
        //Coletar erro de upload de arquivo
        $mensagem_erro = "Upload falhou. Código de erro: " . $_FILES["file"]["error"];
    }

    //Verificar se a operação foi realizada e retornar mensagem utilizando sessão
    if(mysqli_affected_rows($conexao) > 0){
        $_SESSION['mensagem'] = "<span class='text-success'>$mensagem_sucesso</span>";
    }elseif($mensagem_erro == ""){
        $_SESSION['mensagem'] = "";
    }else{
        $_SESSION['mensagem'] = "<span class='text-danger'>Algo deu errado! $mensagem_erro</span>";
    }  

    //Fechar conexão com o banco de dados
    mysqli_close($conexao);
    
    //Redirecionar para outra página
    header("Location: if_tb.php");
?>