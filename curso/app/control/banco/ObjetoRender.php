<?php

use Adianti\Control\TPage;
use Adianti\Database\TTransaction;
use Adianti\Widget\Dialog\TMessage;

class ObjetoRender extends TPage
{
    public function __construct()
    {
        parent::__construct();

        try
        {
            TTransaction::open('curso');

            $produto = new Produto(3);

            print $produto->render('O produto (<b>{id}</b>) - Nome: <b>{descricao}</b> - Preço: <b>R${preco_venda},00</b>');
            echo '<br>';
            echo 'Resultado: ';
            print $produto->evaluate('= {preco_venda} * {estoque}');

            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}