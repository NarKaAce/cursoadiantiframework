<?php

use Adianti\Database\TTransaction;
use Adianti\Widget\Dialog\TMessage;

class ObjectStore extends TPage
{
    public function __construct()
    {
        parent::__construct();

        try
        {
            TTransaction::open('curso');

            $produto = new Produto;
            $produto->descricao = 'SSD Mega Plus';
            $produto->estoque = 4;
            $produto->preco_venda = 600;
            $produto->unidade = 'PC';
            $produto->local_foto = '';
            $produto->store();

            new TMessage('info','Produto gravado com sucesso');

            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
 }