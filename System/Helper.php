<?php 
/**
 * Retorna uma variável do arquivo .env
 *
 * @param  string $variavel Nome da váriavel do arquivo .env
 * @return mixed 
 */
function env($variavel)
{

    static $ini_array;

    if (!$ini_array) {

        $ini_array = parse_ini_file(".env");
    }

    return isset($ini_array[$variavel]) ? $ini_array[$variavel] : null;
}

/**
 * Retorna a url padrão da Aplicação
 *
 * @return string
 */
function baseUrl()
{
    return rtrim(env('BASE_URL'), '/') . '/';
}