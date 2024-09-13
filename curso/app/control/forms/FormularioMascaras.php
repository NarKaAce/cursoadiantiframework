<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Widget\Dialog\TMessage;
use Adianti\Widget\Form\TEntry;
use Adianti\Widget\Form\TLabel;
use Adianti\Wrapper\BootstrapFormBuilder;

class FormularioMascaras extends TPage
{
    private $form;
    public function __construct()
    {
        parent::__construct();

        $this->form = new BootstrapFormBuilder();
        $this->form->setFormTitle('Mascaras de digitação');

        $element1 = new TEntry('element1');
        $element2 = new TEntry('element2');
        $element3 = new TEntry('element3');
        $element4 = new TEntry('element4');
        $element5 = new TEntry('element5');
        $element6 = new TEntry('element6');
        $element7 = new TEntry('element7');
        $element8 = new TEntry('element8');
        $element9 = new TEntry('element9');
        $element10 = new TEntry('element10');
        $element11 = new TEntry('element11');
        $element12 = new TEntry('element12');
        $element13 = new TEntry('element13');
        $element14 = new TEntry('element14');

        $element1->setMask('99.999-999');
        $element2->setMask('99,999-999', true);
        $element3->setMask('99.999.999/9999-99');
        $element4->setMask('99.999.999/9999-99', true);
        $element5->setMask('A!');
        $element6->setMask('AAA');
        $element7->setMask('S!');
        $element8->setMask('SSS');
        $element9->setMask('9!');
        $element10->setMask('999');
        $element11->setMask('SSS-9A99');
        $element12->forceUpperCase();
        $element13->forceLowerCase();
        $element14->setNumericMask(2, ',', '.', true);

        $this->form->addFields([new TLabel('CEP')], [$element1]);
        $this->form->addFields([new TLabel('CEP (sem mascara no post)')], [$element2]);
        $this->form->addFields([new TLabel('CNPJ')], [$element3]);
        $this->form->addFields([new TLabel('CNPJ (sem mascara no post)')], [$element4]);
        $this->form->addFields([new TLabel('Alpha-Numericos Ilimitado')], [$element5]);
        $this->form->addFields([new TLabel('Alpha-Numericos Limitado')], [$element6]);
        $this->form->addFields([new TLabel('Apenas Letras Ilimitada')], [$element7]);
        $this->form->addFields([new TLabel('Apenas Letras Limitado')], [$element8]);
        $this->form->addFields([new TLabel('Apenas Numeros Ilimitado')], [$element9]);
        $this->form->addFields([new TLabel('Apenas Numeros Limitado')], [$element10]);
        $this->form->addFields([new TLabel('Customizada')], [$element11]);
        $this->form->addFields([new TLabel('Forçar UpperCase')], [$element12]);
        $this->form->addFields([new TLabel('Forçar LowerCase')], [$element13]);
        $this->form->addFields([new TLabel('Mascara Numerica')], [$element14]);

        $this->form->addAction('Enviar', new TAction([$this, 'onSend']), 'fa:save');

        parent::add($this->form);
    }

    public function onSend($param)
    {
        $data = this->form->getData();
        //$this->form->setData($data);

        new TMessage('info', str_replace(',', '<br>', json_encode($data)));
    }
}