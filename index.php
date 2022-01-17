<?php

header('Content-Type: text/html; charset=utf-8');

// Carrega o Arquivo autoload.php

if (file_exists(__DIR__ . "/System/Autoload.php")) {

    include __DIR__ . "/System/Autoload.php";

} else {

    echo "Não foi possível carregar o arquivo Autoload.";
    exit();
}

// Define variáveis do framework

define('APP_PATH', __DIR__ . '/App');

define('VIEWS_PATH', APP_PATH . '/Views');

// Variável para controle de acesso direto em scripts

define('ALLOW_ACCESS', true);

// Carrega helpers do framework

if (file_exists(__DIR__ . "/System/Helper.php")) {

    include __DIR__ .  "/System/Helper.php";

} else {

    echo "Não foi possível carregar o arquivo Helper.";
    exit();
}

// Carrega arquivo para renderização das views

if (file_exists(__DIR__ . "/System/View.php")) {

    include __DIR__ . "/System/View.php";

}else{

    echo "Não foi possível carregar o arquivo de View.";
    exit();
}

// Carrega arquivo para execução das rotas

if (file_exists(APP_PATH . "/Routes/web.php")) {

    include APP_PATH . "/Routes/web.php";
    
} else {

    echo "Não foi possível carregar o arquivo de rotas.";

    exit();
}
