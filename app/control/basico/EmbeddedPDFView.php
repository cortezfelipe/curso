<?php
class EmbeddedPDFView extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $object = new TElement('iframe');
        $object->width  = '100%';
        $object->height = '600px';
        $object->src    = 'http://www.adianti.com.br/framework_files/adianti_framework.pdf';
        $object->type   = 'application/pdf';

        parent::add( $object );
    }
}