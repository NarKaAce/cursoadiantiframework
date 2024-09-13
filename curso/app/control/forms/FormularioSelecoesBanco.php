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

class FormularioSelecoesBanco extends TPage
{
    public function __construct()
    {
        parent::__construct();

        $this->form = new BootstrapFormBuilder();
        $this->form->setFormTitle('Campos de Seleção');

        $radio    = new TDBRadioGroup('radio', 'curso', 'Categoria', 'id', 'nome');
        $radio2   = new TDBRadioGroup('radio2', 'curso', 'Categoria', 'id', '{id} - {nome}');
        $check    = new TDBCheckGroup('check', 'curso', 'Categoria', 'id', 'nome');
        $check2   = new TDBCheckGroup('check2', 'curso', 'Categoria', 'id', '{id} - {nome}');
        $combo    = new TDBCombo('combo', 'curso', 'Categoria', 'id', 'nome');
        $combo2   = new TDBCombo('combo2', 'curso', 'Categoria', 'id', 'nome');
        $select   = new TDBSelect('select', 'curso', 'Categoria', 'id', 'nome');
        $search   = new TDBMultiSearch('search', 'curso', 'Categoria', 'id', 'nome');
        $unique   = new TDBUniqueSearch('unique', 'curso', 'Categoria', 'id', 'nome');
        $autocomp = new TDBEntry('autocomplete', 'curso', 'Categoria', 'nome');

        $radio->setLayout('horizontal');
        $radio2->setLayout('horizontal');
        $radio2->setUseButton();
        $check->setLayout('horizontal');
        $check2->setLayout('horizontal');
        $check2->setUseButton();
        $combo2->enableSearch();
        $search->setMinLength(1);
        $unique->setMinLength(1);

        $search->setMask('{nome} ({id})');
        $unique->setMask('{nome} ({id})');

        /*
        $radio->setValue('b');
        $radio2->setValue('b');
        $check->setValue(['a', 'c']);
        $check2->setValue(['a', 'c']);
        */

        $this->form->addFields([new TLabel('Radio 1')], [$radio]);
        $this->form->addFields([new TLabel('Radio 2')], [$radio2]);
        $this->form->addFields([new TLabel('Check 1')], [$check]);
        $this->form->addFields([new TLabel('Check 2')], [$check2]);
        $this->form->addFields([new TLabel('Combo 1')], [$combo]);
        $this->form->addFields([new TLabel('Combo 2')], [$combo2]);
        $this->form->addFields([new TLabel('Select')], [$select]);
        $this->form->addFields([new TLabel('Search')], [$search]);
        $this->form->addFields([new TLabel('Unique')], [$unique]);
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