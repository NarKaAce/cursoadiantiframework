<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Widget\Dialog\TMessage;
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

class FormularioBootstrapEstatico extends TPage
{
    private $form;
    public function __construct()
    {
        parent::__construct();

        $this->form = new BootstrapFormBuilder();
        $this->form->setFormTitle('Formulário bootstrap estatico');

        $id           = new TEntry('id');
        $descricao    = new TEntry('descricao');
        $senha        = new TPassword('senha');

        $this->form->appendPage('Aba 1');
        $this->form->addFields([new TLabel('ID')], [$id]);
        $this->form->addFields([new TLabel('Descrição')], [$descricao]);
        $this->form->addFields([new TLabel('Senha')], [$senha]);

        $this->form->addAction('Enviar', new TAction([$this, 'onSend']), 'fa:save');

        parent::add($this->form);
    }

    public function onSend($param)
    {
        echo '<pre>';
        var_dump($param);

        new TMessage('info', str_replace(',', '<br>', json_encode($param)));
    }
}