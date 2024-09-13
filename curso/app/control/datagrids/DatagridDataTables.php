<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Widget\Container\TPanelGroup;
use Adianti\Widget\Datagrid\TDataGrid;
use Adianti\Widget\Datagrid\TDataGridAction;
use Adianti\Widget\Datagrid\TDataGridColumn;
use Adianti\Widget\Dialog\TMessage;
use Adianti\Wrapper\BootstrapDatagridWrapper;

class DatagridDataTables extends TPage
{
    private $datagrid;
    public function __construct()
    {
        parent::__construct();

        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = '100%';

        //liga a data table
        $this->datagrid->datatable = 'true';

        $this->datagrid->enablePopover('Detalhes', '<b>ID</b> {id} <br> <b>Nome</b> {nome} <br> <b>Cidade</b> {cidade} <br> <b>Estado</b> {estado} <br> <b>País</b> {pais} <br>');

        $col_id     = new TDataGridColumn('id', 'Código', 'center');
        $col_nome   = new TDataGridColumn('nome', 'Nome', 'left');
        $col_cidade = new TDataGridColumn('cidade', 'Cidade', 'left');
        $col_estado = new TDataGridColumn('estado', 'Estado', 'left');
        $col_nascimento = new TDataGridColumn('nascimento', 'Nascimento', 'left');
        $col_telefone = new TDataGridColumn('telefone', 'Telefone', 'left');
        $col_email = new TDataGridColumn('email', 'E-mail', 'left');
        $col_pais = new TDataGridColumn('pais', 'País', 'left');

        $col_id->title = 'Clique nesta coluna para ação';

        $this->datagrid->addColumn($col_id);
        $this->datagrid->addColumn($col_nome);
        $this->datagrid->addColumn($col_cidade);
        $this->datagrid->addColumn($col_estado);
        $this->datagrid->addColumn($col_nascimento);
        $this->datagrid->addColumn($col_telefone);
        $this->datagrid->addColumn($col_email);
        $this->datagrid->addColumn($col_pais);

        $action1 = new TDataGridAction([$this, 'onView'], ['id' => '{id}', 'nome' => '{nome}']);
        $action2 = new TDataGridAction([$this, 'onDelete'], ['id' => '{id}', 'nome' => '{nome}']);

        $this->datagrid->addAction($action1, 'Visualizar', 'fa:search blue');
        $this->datagrid->addAction($action2, 'Excluir', 'fa:trash red');

        // após definir colunas, e ações... criar a estrutura

        $this->datagrid->createModel();

        $panel = new TPanelGroup('Datagrid');
        $panel->add($this->datagrid);

        parent::add($panel);
    }

    public static function onView($param)
    {
        new TMessage('info', 'ID: ' . $param['id'] . ' - Nome: ' . $param['nome']);
    }

    public static function onDelete($param)
    {
        new TMessage('info', 'Registro de ID: ' . $param['id'] . ' - E nome: ' . $param['nome'] . ' foi deletado');
    }

    public function onReload()
    {
        $this->datagrid->clear();

        $item = new stdClass();
        $item->id = 1;
        $item->nome = 'Aretha Franklin';
        $item->cidade = 'Memphis';
        $item->estado = 'Tenessee (US)';
        $item->nascimento = '25/03/1942';
        $item->telefone = '123 123 123 123';
        $item->email = 'aretha@email.com';
        $item->pais = 'Estados Unidos';
        $this->datagrid->addItem($item);

        $item = new stdClass();
        $item->id = 2;
        $item->nome = 'Eric Clapton';
        $item->cidade = 'Ripley';
        $item->estado = 'Surrey (UK)';
        $item->nascimento = '30/03/1945';
        $item->telefone = '234 234 234 234';
        $item->email = 'eric@email.com';
        $item->pais = 'Reino Unido';
        $this->datagrid->addItem($item);

        $item = new stdClass();
        $item->id = 3;
        $item->nome = 'B.B King';
        $item->cidade = 'Itta Bena';
        $item->estado = 'Mississipi (US)';
        $item->nascimento = '16/09/1925';
        $item->telefone = '345 345 345 345';
        $item->email = 'bbking@email.com';
        $item->pais = 'Estados Unidos';
        $this->datagrid->addItem($item);

        $item = new stdClass();
        $item->id = 4;
        $item->nome = 'James Joplin';
        $item->cidade = 'Port Arthur';
        $item->estado = 'Texas (US)';
        $item->nascimento = '19/01/1943';
        $item->telefone = '456 456 456 456';
        $item->email = 'janis@email.com';
        $item->pais = 'Estados Unidos';
        $this->datagrid->addItem($item);
    }

    public function show()
    {
        $this->onReload();
        parent::show();
    }
}