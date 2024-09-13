<?php

use Adianti\Control\TPage;
use Adianti\Database\TCriteria;
use Adianti\Database\TFilter;
use Adianti\Database\TRepository;
use Adianti\Database\TTransaction;
use Adianti\Widget\Dialog\TMessage;

class CollectionBatchUpdate extends TPage
{
    public function __construct()
    {
        parent::__construct();

        try
        {
            TTransaction::open('curso');

            TTransaction::dump();

            $criteria = new TCriteria();
            $criteria->add(new TFilter('situacao', '=', 'Y') );
            $criteria->add(new TFilter('genero', '=', 'F') );

            $valores = [];
            $valores['telefone'] = '1111-4444';

            $repository = new TRepository('Cliente');
            $repository->update($valores,$criteria);

            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}