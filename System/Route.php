<?php

namespace System;

use IHttp;

/**
 * Classe responsável por instanciar um objeto utilizado na manipulação de Rotas 
 * @param array $_params Lista de parametros existentes na Url
 */
class Route implements IHttp
{

    private static $_params;

    public static function get($url, $controller, $method = "index")
    {
        if ($_SERVER['REQUEST_METHOD'] != "GET") {

            return;
        }

        if (!self::routeAnalyzer($url)) {

            return;
        }

        self::initController($controller, $method);
    }

    public static function post($url, $controller, $method = "index")
    {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {

            return;
        }

        if (!self::routeAnalyzer($url)) {

            return;
        }

        self::initController($controller, $method);
    }

    public static function put($url, $controller, $method = "index")
    {
        if ($_SERVER['REQUEST_METHOD'] != "PUT") {
            return;
        }

        if (!self::routeAnalyzer($url)) {

            return;
        }

        self::initController($controller, $method);
    }

    public static function delete($url, $controller, $method = "index")
    {
        if ($_SERVER['REQUEST_METHOD'] != "DELETE") {

            return;
        }

        if (!self::routeAnalyzer($url)) {

            return;
        }

        self::initController($controller, $method);
    }

    public static function error($code, $controller, $method)
    {
        if ($code == 404) {
            self::$_params = array();
            self::initController($controller, $method);
        }
    }

    /**
     * Identifica os parametros existentes na Requisição
     *
     * @param  string $segmentoUrl Segmento da url da Rota da Aplicação
     * @param  string $segmentoQueryString Segmento da Url do Browser
     * @return void
     */
    private static function parameterExtractor($segmentoUrl, $segmentoQueryString)
    {
        // Aplica expressão regular para extrair um parametro -> {parametro_exemplo}
        preg_match("/{([^}]*)}/", $segmentoUrl, $result);
        //Caso exista é retonado true e este parametro é armazenando em $_params
        if (isset($result[1]) && $result[1] != null) {

            self::$_params[$result[1]] = $segmentoQueryString;

            return true;
        } else {

            return false;
        }
    }

    /**
     * Método responsável por verificar se a requisição corresponde alguma rota da aplicação
     * 
     * @param  string $url Url da rota a ser verificada com a requisição
     * @return bool
     */
    private static function routeAnalyzer($url)
    {
        // Array Url da rota
        $arrayUrl = explode('/', rtrim($url, '/'));
        // Array Url do Browser       
        $arrayQueryString = explode('/', rtrim($_SERVER['QUERY_STRING'], '/'));

        $numSegmentosUrl = count($arrayUrl);
        $numSegmentosQueryString = count($arrayQueryString);

        // Urls com quantidades de segmentos diferentes não são iguais
        if ($numSegmentosUrl != $numSegmentosQueryString) {

            return false;
        }

        self::$_params = array();

        //Compara individualmente segmento por segmento
        for ($i = 0; $i < $numSegmentosUrl; $i++) {

            // Caso algum segmento seja diferente há um parametro em potencial que pode ser identificado
            if ($arrayUrl[$i] == $arrayQueryString[$i]) {

                continue;
            } else {

                // Adiciona os parametros identificados ao array de parametros
                if (!self::parameterExtractor($arrayUrl[$i], $arrayQueryString[$i])) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Método responsável por instanciar o Controlador e executar o método
     *
     * @param  string $url Rota que será tratada
     * @param  string $controller Nome completo com namespace da classe do controlador
     * @param  string $method Nome do método do controlador que será executado
     * @return void
     */
    private static function initController($controller, $method)
    {
        $objController = new $controller;

        call_user_func_array(array($objController, $method), self::$_params);

        exit;
    }
}
