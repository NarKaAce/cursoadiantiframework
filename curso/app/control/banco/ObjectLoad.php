<?php

use Adianti\Database\TTransaction;
use Adianti\Widget\Dialog\TMessage;

class ObjectLoad extends TPage
{
    public function __construct()
    {
        parent::__construct();

        try
        {
            TTransaction::open('curso');

            TTransaction::dump();

            $produto = new Produto(8);

            echo 'Descrição: ' . $produto->descricao;
            echo '<br>';
            echo 'Estoque: ' . $produto->estoque;

            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}