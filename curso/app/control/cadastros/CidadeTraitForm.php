<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Database\TTransaction;
use Adianti\Validator\TRequiredValidator;
use Adianti\Widget\Dialog\TMessage;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TLabel;
use Adianti\Widget\Wrapper\TDBCombo;
use Adianti\Widget\Wrapper\TDBSeekButton;
use Adianti\Wrapper\BootstrapFormBuilder;

class CidadeTraitForm extends TPage
{
    private $form;

    use Adianti\Base\AdiantiStandardFormTrait;

    public function __construct()
    {
        parent::__construct();

        $this->setDatabase('curso'); // Dizer qual o banco para o trait
        $this->setActiveRecord('Cidade'); // Dizer qual a classe para o trait

        $this->form = new BootstrapFormBuilder();
        $this->form->setFormTitle('Cidade');

        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $estado = new TDBCombo('estado_id', 'curso', 'Estado', 'id', 'nome');

        $id->setEditable(false);

        $this->form->addFields([new TLabel('ID')], [$id]);
        $this->form->addFields([new TLabel('Nome', 'red')], [$nome]);
        $this->form->addFields([new TLabel('Estado', 'red')], [$estado]);

        $nome->addValidation('Nome', new TRequiredValidator());
        $estado->addValidation('Estado', new TRequiredValidator());

        $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:save green');
        $this->form->addActionLink('Limpar', new TAction([$this, 'onClear']), 'fa:eraser red');

        new TDBSeekButton();

        parent::add($this->form);
    }
}