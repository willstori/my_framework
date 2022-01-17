<?php 

/**
 * Função responsavel por carregar uma View e transmitir os dados.
 *
 * @param  string $file_name Nome do arquivo da View (Pode conter diretório). 
 * @param  array $data Dados que serão enviados para View.
 * @return void
 */
function view($file_name, $data = array())
{
    if(file_exists(VIEWS_PATH . '/' .  $file_name))
    {
        
        if($data != null && is_array($data)){

            extract($data);

        }

        include VIEWS_PATH . '/' . $file_name;

    }else{

        echo "Não possível encontrar a View: " . $file_name;
        
    }
}