<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Database\TTransaction;
use Adianti\Validator\TRequiredValidator;
use Adianti\Widget\Dialog\TMessage;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TLabel;
use Adianti\Widget\Wrapper\TDBCombo;
use Adianti\Wrapper\BootstrapFormBuilder;

class CidadeForm extends TPage
{
    private $form;

    public function __construct()
    {
        parent::__construct();

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

        parent::add($this->form);
    }

    public function onClear($param)
    {
        $this->form->clear(true);
    }

    public function onSave($param)
    {
        try
        {
            TTransaction::open('curso');

            $this->form->validate();

            $data = $this->form->getData();

            $cidade = new Cidade;
            $cidade->fromArray((array)$data);
            $cidade->store();

            $this->form->setData($cidade);

            new TMessage('info', 'Registro salvo com sucesso');

            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('info', $e->getMessage());
            TTransaction::rollback();
        }
    }

    public function onEdit($param)
    {
        try
        {
            TTransaction::open('curso');

            if(isset($param['id']))
            {
                $key = $param['id'];
                $cidade = new Cidade($key);
                $this->form->setData($cidade);
            }
            else
            {
                $this->form->clear(true);
            }

            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('info', $e->getMessage());
            TTransaction::rollback();
        }
    }
}