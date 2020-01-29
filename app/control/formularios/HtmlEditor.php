<?php
class HtmlEditor extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Html editor');
        
        $html = new THtmlEditor('conteudo_html');
        $html->setSize('100%', 200);
        $html->setOption('placeholder', 'Digite aqui...');
        
        $this->form->addFields( [ $html ] );
        
        $this->form->addAction('Enviar', new TAction([$this, 'onSend']), 'far:check-circle green');
        parent::add($this->form);
    }
    
    public function onSend($param)
    {
        $data = $this->form->getData();
        $this->form->setData($data);
        
        new TMessage('info', $data->conteudo_html);
    }
}