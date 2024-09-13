<?php

use Adianti\Database\TTransaction;
use Adianti\Widget\Dialog\TMessage;

class ObjectStamp extends TPage
{
    public function __construct()
    {
        parent::__construct();

        try
        {
            TTransaction::open('curso');

            TTransaction::dump();

            /*
            $cliente = new Cliente();
            $cliente->nome = 'Registro Teste222';
            $cliente->endereco = 'Rua teste2';
            $cliente->telefone  = '123123123';
            $cliente->categoria_id = 1;
            $cliente->cidade_id = 1;
            $cliente->store();
            */


            $cliente = Cliente::find(41);
            $cliente->nome = 'Registro teste alterado';
            $cliente->store();

            new TMessage('info','Cliente gravado com sucesso');

            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}