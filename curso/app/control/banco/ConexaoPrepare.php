<?php

use Adianti\Control\TPage;
use Adianti\Database\TTransaction;
use Adianti\Widget\Dialog\TMessage;

class ConexaoPrepare extends TPage
{
    public function __construct()
    {
        parent::__construct();

        try
        {
            TTransaction::open('curso');

            $conn = TTransaction::get();

            $statement = $conn->prepare('SELECT id, nome FROM cliente WHERE id >= ? AND id <= ?');
            $statement->execute( [3,12] );
            $result = $statement->fetchAll();

            foreach($result as $row)
            {
                print $row['id'] . '-'.
                      $row['nome'] . "<br>\n";
            }

            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}