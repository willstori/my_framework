<?php 
namespace App\Models;

defined('ALLOW_ACCESS') or die('Acesso negado ao script.');

use System\Model;

class Noticia extends Model
{

    protected $_id = "id";

    protected $_table = "noticias";

    protected $_fillable = array('titulo', 'data', 'texto', 'foto', 'foto_thumb');
    
    public function __construct()
    {
        parent::__construct();
    }
}
