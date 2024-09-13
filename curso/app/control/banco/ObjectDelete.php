<?php


use Adianti\Database\TTransaction;
use Adianti\Widget\Dialog\TMessage;

class ObjectDelete extends TPage
{
    public function __construct()
    {
        parent::__construct();

        try {
            TTransaction::open('curso');

            TTransaction::dump();

            $produto = Produto::find(29);

            if ($produto instanceof Produto)
            {
                $produto->delete();
            }

            //$produto = new Produto;
            //$produto->delete(29);

            TTransaction::close();
        } catch (Exception $e) {
            new TMessage('error', $e->getMessage());
        }
    }
}