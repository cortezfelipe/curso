<?php
class FormularioManual extends TPage
{
    private $form;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new TForm('meu_form');
        
        $notebook = new TNotebook;
        $this->form->add($notebook);
        
        $table1 = new TTable;
        $table2 = new TTable;
        
        $table1->width = '100%';
        $table2->width = '100%';

        $table1->style = 'padding:10px';
        $table2->style = 'padding:10px';
        
        $notebook->appendPage('Página 1', $table1);
        $notebook->appendPage('Página 2', $table2);
        
        $field1 = new TEntry('field1');
        $field2 = new TEntry('field2');
        $field3 = new TEntry('field3');
        $field4 = new TEntry('field4');
        $field5 = new TEntry('field5');
        $field6 = new TEntry('field6');
        $field7 = new TEntry('field7');
        $field8 = new TEntry('field8');
        
        $table1->addRowSet( new TLabel('Campo 1'), $field1 );
        $table1->addRowSet( new TLabel('Campo 2'), $field2 );
        $table1->addRowSet( new TLabel('Campo 3'), $field3 );
        $table1->addRowSet( new TLabel('Campo 4'), $field4 );
        
        $table2->addRowSet( new TLabel('Campo 5'), $field5 );
        $table2->addRowSet( new TLabel('Campo 6'), $field6 );
        $table2->addRowSet( new TLabel('Campo 7'), $field7 );
        $table2->addRowSet( new TLabel('Campo 8'), $field8 );
        
        $botao = new TButton('enviar');
        $botao->setAction( new TAction( [$this, 'onSend']), 'Enviar');
        $botao->setImage('fa:save');
        
        $this->form->setFields( [ $field1, $field2, $field3, $field4, $field5, $field6, $field7, $field8, $botao ] );
        
        $panel = new TPanelGroup('Formulário manual');
        $panel->add($this->form);
        $panel->addFooter($botao);
        
        parent::add($panel);
    }
    
    public function onSend($param)
    {
        $data = $this->form->getData();
        
        $this->form->setData( $data );
        
        new TMessage('info', str_replace(',', '<br>', json_encode($data)));
    }
}