<?php

use Adianti\Control\TPage;
use Adianti\Database\TTransaction;
use Adianti\Widget\Dialog\TMessage;
use http\Client;

class CollectionShortcuts extends TPage
{
    public function __construct()
    {
        parent::__construct();

        try
        {
            TTransaction::open('curso');

            /*      Retorna todos os registros sem filtro
            $cliente = Cliente::all();
            echo '<pre>';
            print_r($cliente);
            echo '</pre>';
            */

            /*      O where é como um filtro que pode ser adicionado ao count ou load
            $count = Cliente::where('situacao', '=', 'Y')
                            ->where('genero', '=', 'F')
                            ->count();
            print_r($count);
            */

            /*          Carregar os registros
            $clientes = Cliente::where('situacao', '=', 'Y')
                                ->where('genero', '=', 'F')
                                ->load();
            echo '<pre>';
            print_r($clientes);
            echo '</pre>';
            */

            /*          OrderBy para ordenar
            $clientes = Cliente::where('situacao', '=', 'Y')
                ->where('genero', '=', 'F')
                ->orderBy('id')
                ->load();
            echo '<pre>';
            print_r($clientes);
            echo '</pre>';
            */

            /*      Carregamento paginado de objetos
            $clientes = Cliente::where('id', '>', '0')
                ->take(10)
                ->skip(20)
                ->load();
            echo '<pre>';
            print_r($clientes);
            echo '</pre>';
            */

            /*      Pega o primeiro registro do WHERE
            $cliente = Cliente::where('situacao', '=', 'Y')
                                ->where('genero', '=', 'F')
                                ->first();
            echo '<pre>';
            print_r($cliente);
            echo '</pre>';
            */

            /*      Atualiza um registro
            Cliente::where('cidade', '=', '3')
                    ->set('telefone', '2222-4444')
                    ->update();
            */

            /*      Deleta um registro
            Cliente::where('categoria_id', '=', '3')
                    ->delete();
            */

            /*
            $clientes = Cliente::getIndexedArray('id', 'nome');
            echo '<pre>';
            print_r($clientes);
            echo '</pre>';
            */

            /*
            $clientes = Cliente::where('situacao', '=', 'Y')
                                ->orderBy('id')
                                ->getIndexedArray('id', 'nome');
            echo '<pre>';
            print_r($clientes);
            echo '</pre>';
            */


            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }


    }
}