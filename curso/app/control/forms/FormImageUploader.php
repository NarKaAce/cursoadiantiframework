<?php

use Adianti\Control\TAction;
use Adianti\Control\TPage;
use Adianti\Widget\Dialog\TMessage;
use Adianti\Widget\Form\TImageCapture;
use Adianti\Widget\Form\TImageCropper;
use Adianti\Widget\Form\TLabel;
use Adianti\Wrapper\BootstrapFormBuilder;

class FormImageUploader extends TPage
{
    private $form;
    public function __construct()
    {
        parent::__construct();

        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Captura e Corte de imagem');

        $imagecropper = new TImageCropper('imagecropper');
        $imagecapture = new TImageCapture('imagecapture');

        $imagecropper->setSize(300,150);
        $imagecropper->setCropSize(300, 150);
        $imagecropper->setAllowedExtensions(['gif', 'png', 'jpg', 'jpeg']);

        $imagecapture->setSize(300, 200);
        $imagecapture->setCropSize(300, 200);

        $this->form->addFields([new TLabel('Image Cropper')], [$imagecropper]);
        $this->form->addFields([new TLabel('Image Capture')], [$imagecapture]);

        $this->form->addAction('Enviar', new TAction([$this, 'onShow']), 'far:check-circle green');

        parent::add($this->form);
    }

    public static function onShow($param)
    {
        new TMessage('info', 'Image Cropper: ' . $param['imagecropper'] . '<br>' .
                                           'Image Capture: ' . $param['imagecapture']);
    }
}