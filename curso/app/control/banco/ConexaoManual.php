<?php

use Adianti\Control\TPage;
use Adianti\Database\TTransaction;
use Adianti\Widget\Dialog\TMessage;

class ConexaoManual extends TPage
{
    public function __construct()
    {
        parent::__construct();

        try
        {
            TTransaction::open('curso');

            //var_dump(TTransaction::getDatabase());
            //var_dump(TTransaction::getDatabaseInfo());

            $conn = TTransaction::get();

            $result = $conn->query('SELECT id, nome FROM cliente ORDER BY id');

            foreach($result as $row)
            {
                print $row['id'] . '-'.
                      $row['nome'] . "<br>\n";
            }

            //$conn->query("INSERT INTO estado (id, nome) VALUES (4,'BA')");

            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}