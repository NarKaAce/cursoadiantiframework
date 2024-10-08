<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Widget\Form\TColor;
use Adianti\Widget\Form\TCombo;
use Adianti\Widget\Form\TDate;
use Adianti\Widget\Form\TDateTime;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TLabel;
use Adianti\Widget\Form\TPassword;
use Adianti\Widget\Form\TSpinner;
use Adianti\Widget\Form\TText;
use Adianti\Wrapper\BootstrapFormBuilder;

class FormularioBootstrap extends TPage
{
    private $form;
    public function __construct()
    {
        parent::__construct();

        $this->form = new BootstrapFormBuilder();
        $this->form->setFormTitle('Formulário bootstrap');

        $id           = new TEntry('id');
        $descricao    = new TEntry('descricao');
        $senha        = new TPassword('senha');
        $dt_criacao   = new TDateTime('dt_criacao');
        $dt_expiracao = new TDate('expires');
        $valor        = new TEntry('valor');
        $cor          = new TColor('cor');
        $peso         = new TSpinner('peso');
        $tipo         = new TCombo('tipo');
        $texto        = new TText('texto');

        $id->setEditable(false);
        $dt_criacao->setMask('dd/mm/yyyy hh:ii');
        $dt_criacao->setDatabaseMask('yyyy-mm-dd hh:ii');

        $dt_expiracao->setMask('dd/mm/yyyy');
        $dt_expiracao->setDatabaseMask('yyyy-mm-dd');
        $valor->setNumericMask(2, ',', '.', true);

        $cor->setSize('100%');
        $valor->setSize('100%');
        $dt_criacao->setSize('100%');
        $dt_expiracao->setSize('100%');
        $peso->setSize('100%');
        $tipo->setSize('100%');

        $tipo->addItems(['a' => 'Opção A', 'b' => 'Opção B', 'c' => 'Opção C']);

        $dt_criacao->setValue( date('Y-m-d H:i'));
        $dt_expiracao->setValue(date('Y-m-d'));
        $valor->setValue(123,45);
        $peso->setValue(30);
        $peso->setRange(1,100,0.1);

        $descricao->placeholder = 'Digite aqui a descrição';
        $descricao->setTip('Digite aqui a descrição');

        $this->form->appendPage('Aba 1');
        $this->form->addFields([new TLabel('ID')], [$id]);
        $this->form->addFields([new TLabel('Descrição')], [$descricao]);
        $this->form->addFields([new TLabel('Senha')], [$senha]);
        $this->form->addFields([new TLabel('Dt. Criação')], [$dt_criacao], [new TLabel('Dt. Expiração')], [$dt_expiracao]);
        $this->form->addFields([new TLabel('Valor')], [$valor], [new TLabel('Cor')], [$cor]);
        $this->form->addFields([new TLabel('Peso')], [$peso], [new TLabel('Tipo')], [$tipo]);

        $this->form->appendPage('Aba 2');
        $this->form->addFields([new TLabel('Texto')], [$texto]);

        $label = new TLabel('Divisória', '#6979BF', 12, 'bi');
        $label->style = 'text-align:left;border-bottom: 1px solid gray; width: 100%';
        $this->form->addContent([$label]);

        $this->form->addHeaderAction('Enviar', new TAction([$this, 'onSend']), 'fa:save');

        parent::add($this->form);
    }

    public function onSend($param)
    {
        $data = $this->form->getData();
        //$this->form->setData($data);

        new TMessage('info', str_replace(',', '<br>', json_encode($data)));
    }
}