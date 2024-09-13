<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Widget\Form\TCheckGroup;
use Adianti\Widget\Form\TCombo;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TLabel;
use Adianti\Widget\Form\TMultiEntry;
use Adianti\Widget\Form\TMultiSearch;
use Adianti\Widget\Form\TRadioGroup;
use Adianti\Widget\Form\TSelect;
use Adianti\Widget\Form\TUniqueSearch;
use Adianti\Wrapper\BootstrapFormBuilder;

class FormularioSelecoes extends TPage
{
    public function __construct()
    {
        parent::__construct();

        $this->form = new BootstrapFormBuilder();
        $this->form->setFormTitle('Campos de Seleção');

        $opcoes = ['a' => 'Opção A', 'b' => 'Opção B', 'c' => 'Opção C'];

        $radio = new TRadioGroup('radio');
        $radio2 = new TRadioGroup('radio2');
        $check = new TCheckGroup('check');
        $check2 = new TCheckGroup('check2');
        $combo = new TCombo('combo');
        $combo2 = new TCombo('combo2');
        $select = new TSelect('select');
        $search = new TMultiSearch('search');
        $unique = new TUniqueSearch('unique');
        $multi = new TMultiEntry('multi');
        $autocomp = new TEntry('autocomplete');

        $radio->addItems($opcoes);
        $radio2->addItems($opcoes);
        $check->addItems($opcoes);
        $check2->addItems($opcoes);
        $combo->addItems($opcoes);
        $combo2->addItems($opcoes);
        $select->addItems($opcoes);
        $search->addItems($opcoes);
        $unique->addItems($opcoes);

        $radio->setLayout('horizontal');
        $radio2->setLayout('horizontal');
        $radio2->setUseButton();
        $check->setLayout('horizontal');
        $check2->setLayout('horizontal');
        $check2->setUseButton();
        $combo2->enableSearch();
        $search->setMinLength(1);
        $unique->setMinLength(1);
        $autocomp->setCompletion(['Maria', 'Pedro', 'João']);

        $radio->setValue('b');
        $radio2->setValue('b');
        $check->setValue(['a', 'c']);
        $check2->setValue(['a', 'c']);

        $this->form->addFields([new TLabel('Radio 1')], [$radio]);
        $this->form->addFields([new TLabel('Radio 2')], [$radio2]);
        $this->form->addFields([new TLabel('Check 1')], [$check]);
        $this->form->addFields([new TLabel('Check 2')], [$check2]);
        $this->form->addFields([new TLabel('Combo 1')], [$combo]);
        $this->form->addFields([new TLabel('Combo 2')], [$combo2]);
        $this->form->addFields([new TLabel('Select')], [$select]);
        $this->form->addFields([new TLabel('Search')], [$search]);
        $this->form->addFields([new TLabel('Unique')], [$unique]);
        $this->form->addFields([new TLabel('Multi')], [$multi]);
        $this->form->addFields([new TLabel('Autocomplete')], [$autocomp]);

        $this->form->addAction('Enviar', new TAction([$this, 'onSend']), 'fa:save');

        parent::add($this->form);
    }

    public function onSend($param)
    {
        $data = $this->form->getData();
        //$this->form->setData($data);

        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}