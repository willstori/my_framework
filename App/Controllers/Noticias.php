<?php

namespace App\Controllers;

defined('ALLOW_ACCESS') or die('Acesso negado ao script.');

use App\Models\Noticia;

class Noticias
{
    public function index()
    {

        $noticia = new Noticia();

        $Dados['noticias'] = $noticia->all();

        $Dados['titulo'] = 'Notícias';

        view('noticias/noticias.php', $Dados);
    }

    public function register()
    {

        $Dados['titulo'] = 'Cadastrar Notícias';

        view('noticias/noticias_editar.php', $Dados);
    }

    public function edit($id)
    {

        $noticia = new Noticia();

        $Dados['noticia'] = $noticia->find($id);

        $Dados['titulo'] = 'Editar Notícias';

        view('noticias/noticias_editar.php', $Dados);
    }

    public function show($id)
    {

        $noticia = new Noticia();

        $Dados['noticia'] = $noticia->find($id);

        $Dados['titulo'] = 'Notícias';

        view('noticias/noticia_detalhes.php', $Dados);
    }

    public function insert()
    {

        $Dados = $_POST;

        $noticia = new Noticia();

        $noticia->save($Dados);

        header("location: ". baseUrl() ."noticias");
    }

    public function update()
    {
        $id = $_POST['id'];

        unset($_POST['id']);

        $Dados = $_POST;

        $noticia = new Noticia();

        $noticia->save($Dados, $id);

        header("location: ". baseUrl() ."noticias/edit/{$id}");
    }

    public function delete($id)
    {

        $noticia = new Noticia();

        $noticia->delete($id);

        header("location: ". baseUrl() ."noticias");
    }
}
