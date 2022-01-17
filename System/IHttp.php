<?php 

interface IHttp{
        
    /**
     * Método responsavel por tratar as requisições do tipo GET
     *
     * @param  string $url Url que será tratada
     * @param  string $controller Nome completo com namespace da classe do controlador
     * @param  string $method Nome do método do controlador que será executado
     * @return void
     */
    public static function get($url, $controller, $method);

    /**
     * Método responsavel por tratar as requisições do tipo POST
     *
     * @param  string $url Url que será tratada
     * @param  string $controller Nome completo com namespace da classe do controlador
     * @param  string $method Nome do método do controlador que será executado
     * @return void
     */
    public static function post($url, $controller, $method);

    /**
     * Método responsavel por tratar as requisições do tipo PUT
     *
     * @param  string $url Url que será tratada
     * @param  string $controller Nome completo com namespace da classe do controlador
     * @param  string $method Nome do método do controlador que será executado
     * @return void
     */
    public static function put($url, $controller, $method);

    /**
     * Método responsavel por tratar as requisições do tipo DELETE
     *
     * @param  string $url Url que será tratada
     * @param  string $controller Nome completo com namespace da classe do controlador
     * @param  string $method Nome do método do controlador que será executado
     * @return void
     */
    public static function delete($url, $controller, $method);
    
}