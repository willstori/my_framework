<?php 
namespace App\Controllers;

defined('ALLOW_ACCESS') or die('Acesso negado ao script.');

class Home
{
    
    public function index()
    {

        view('home.php', array('titulo' => "Home", 'mensagem' => "Bem vindo ao Framework!"));

    }

    
}
