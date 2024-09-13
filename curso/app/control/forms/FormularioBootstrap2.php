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

class FormularioBootstrap2 extends TPage
{
    use lib\traits\UtilArray;
    private $form;
    public function __construct()
    {
        parent::__construct();

        $arquivo = dirname(__FILE__).DIRECTORY_SEPARATOR.__CLASS__.".json";
        $json = file_get_contents($arquivo);
        $aJson = json_decode($json,true);

        foreach ($aJson['objetos'] as $item) {
            $itemId = $item['id'];
            switch ($item['tipo']){
                case 'entry':
                    $$itemId = new TEntry($item['id']);
                    if (isset($item['props'])) {
                        $props = $item['props'];
                        if(isset($props['editavel'])){
                            $$itemId->setEditable($props['editavel']);
                        }
                        if(isset($props['placeholder'])){
                            $$itemId->placeholder = $props['placeholder'];
                        }
                        if(isset($props['dica'])){
                            $$itemId->setTip($props['dica']);
                        }
                        if(isset($props['mascara_numerica'])){
                            $propCorrente = $props['mascara_numerica'];
                            /*$$itemId->setNumericMask($propCorrente['casas_decimais'],
                                                     $propCorrente['separador_decimal'],
                                                     $propCorrente['separador_milhar'],
                                                     $propCorrente['replaceOnPost'],
                                                     $propCorrente['reverter'],
                                                     $propCorrente['aceita_negativo']
                                                     );*/
                            //var_dump($$itemId);
                            $cmd = $$itemId."->setNumericMask(";
                            $chaves = array_keys($propCorrente);
                            $aParametros = array();
                            foreach($chaves as $chave){
                                $aParametros[] = $propCorrente[$chave];
                            }
                            call_user_func_array(array($$itemId,'setNumericMask'),$aParametros);
                            //var_dump($cmd);

                        }
                        if(isset($props['tamanho'])){
                            $$itemId->setSize($props['tamanho']);
                        }
                        if(isset($props['valor'])){
                            $$itemId->setValue($props['valor']);
                        }
                    }
                    break;

                case 'senha':
                    $$itemId  = new TPassword($item['id']);
                    break;

                case 'date':
                    $$itemId  = new TDate($item['id']);
                    if (isset($item['props'])) {
                        $props = $item['props'];
                        if(isset($props['formato_mascara'])){
                            $$itemId->setMask($props['formato_mascara']);
                        }
                        if(isset($props['formato_banco'])){
                            $$itemId->setMask($props['formato_banco']);
                        }
                        if(isset($props['tamanho'])){
                            $$itemId->setSize($props['tamanho']);
                        }
                        if(isset($props['valor'])){
                            $$itemId->setValue($props['valor']);
                        }
                    }
                    break;

                case 'dateTime':
                    $$itemId  = new TDateTime($item['id']);
                    if(isset($item['props'])) {
                        $props = $item['props'];
                        if(isset($props['formato_mascara'])){
                            $$itemId->setMask($props['formato_mascara']);
                        }
                        if(isset($props['formato_banco'])){
                            $$itemId->setMask($props['formato_banco']);
                        }
                        if(isset($props['tamanho'])){
                            $$itemId->setSize($props['tamanho']);
                        }
                        if(isset($props['valor'])){
                            $$itemId->setValue($props['valor']);
                        }
                    }
                    break;

                case 'color':
                    $$itemId = new TColor($item['id']);
                    if (isset($item['props'])){
                        $props = $item['props'];
                        if(isset($props['tamanho'])){
                            $$itemId->setSize($props['tamanho']);
                        }
                    }
                    break;

                case 'spinner':
                    $$itemId = new TSpinner($item['id']);
                    if (isset($item['props'])){
                        $props = $item['props'];
                        if(isset($props['tamanho'])){
                            $$itemId->setSize($props['tamanho']);
                        }
                        if(isset($props['valor'])){
                            $$itemId->setValue($props['valor']);
                        }
                        if(isset($props['range'])){
                            $propsRange  = $props['range'];
                            $aPropsRange = explode(',',$propsRange);
                            $$itemId->setRange($aPropsRange[0],$aPropsRange[1],$aPropsRange[2] );
                        }
                    }
                    break;

                case 'combo':
                    $$itemId = new TCombo($item['id']);
                    if (isset($item['props'])){
                        $props = $item['props'];
                        if(isset($props['tamanho'])){
                            $$itemId->setSize($props['tamanho']);
                        }
                        if(isset($props['lista_opcoes'])){
                            $$itemId->addItems($props['lista_opcoes']);
                        }
                    }
                    break;

                case 'texto':
                    $$itemId = new TText($item['id']);
                    if (isset($item['props'])) {
                        $props = $item['props'];
                        if(isset($props['tamanho'])){
                            $$itemId->setSize($props['tamanho']);
                        }
                    }
            }
        }

        $this->form = new BootstrapFormBuilder();
        $this->form->setFormTitle('Formulário bootstrap');




        //1- extrair do array geral  as paginas.
        if(isset($aJson['objetos'])){
            $aObj = (array) $aJson['objetos'];
            $aPaginas = $this->extrairVlsUnicosArray($aObj,'pagina');
            $aLinhas  = $this->extrairVlsUnicosArray($aObj,'linha');
        }else{
            $aObj =array();
        }
        $aOrdem[] = array('nome_coluna'=>'ordem', 'ordenacao'=>SORT_ASC);
        $aObj = $this->ordernarArray($aObj, 'ordem');
        //3- percorrer as paginas.
        if(is_array($aPaginas)){
            foreach ($aPaginas as $pg){
                $this->form->appendPage($aJson['paginas'][$pg]);
                //3.1 - dentro de cada registro da pagina percorrer as linhas
                if(is_array($aLinhas)){
                    foreach($aLinhas as $linha){
                        /*3.1.1 - dentro de cada registro das linhas buscar os objetos que
                        pertencem a linha e pagina corrente dentro da ordem estabelecida.*/
                        $aObjForm = array();
                        foreach($aObj as $obj){
                            $itemId    = $obj['id'];
                            $label     = $obj['descricao'];
                            $linhaObj  = $obj['linha'];
                            $paginaObj = $obj['pagina'];
                            if($pg == $paginaObj and $linha == $linhaObj){
                                $aObjForm[] = [new TLabel($label)];
                                $aObjForm[] = [$$itemId];
                            }
                        }
                        call_user_func_array(array($this->form,'addFields'),$aObjForm);
                    }
                }
            }
        }

/*
        $label = new TLabel('Divisória', '#6979BF', 12, 'bi');
        $label->style = 'text-align:left;border-bottom: 1px solid gray; width: 100%';
        $this->form->addContent([$label]);
*/
        $this->form->addHeaderAction('Enviar', new TAction([$this, 'onSend']), 'fa:save');
        /*$id_id->onExitAction(new TAction([$this,'funcGeral'],
        array('campo'=>'id_id','acao'=>'exit','programa'=>__CLASS__))
       );*/
        parent::add($this->form);
    }

    public function onSend($param)
    {
        $data = $this->form->getData();
        //$this->form->setData($data);

        new TMessage('info', str_replace(',', '<br>', json_encode($data)));
    }
    public static function funcGeral($param)
    {
          $ret = new AcaoDinamica($param);
          $param = $ret['param'];
          $erro = $param['erro'];

    }

}