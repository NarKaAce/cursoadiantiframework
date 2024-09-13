<?php

use Adianti\Control\TPage;
use Adianti\Database\TTransaction;
use Adianti\Widget\Dialog\TMessage;

class ObjetoRelacionado extends TPage
{
    public function __construct()
    {
        parent::__construct();

        try
        {
            TTransaction::open('curso');

            TTransaction::dump();

            // $contatos = Cliente::find(1)->hasMany('Contato');
    //                  ('Tabela', 'Campo de Ligação', 'Chave primária', 'OrderBy')
            // $contatos = Cliente::find(1)->hasMany('Contato', 'cliente_id', 'id', 'tipo');
            // $contatos = Cliente::find(1)->filterMany('Contato')->where('tipo','=', 'face')->load();
            // $contatos = Cliente::find(1)->filterMany('Contato','cliente_id', 'id', 'tipo')->where('tipo','=', 'face')->load();

            // $habilidade = Cliente::find(1)->belongsToMany('Habilidade');
// ('Classe da Ponta', 'Classe do Meio', 'Campo de ligação da tabela do meio', 'Campo de ligação da tabela do meio para a ponta')
            $habilidade = Cliente::find(1)->belongsToMany('Habilidade', 'ClienteHabilidade', 'cliente_id', 'habilidade_id');


            echo '<pre>';
            var_dump($habilidade);
            echo '</pre>';

            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}