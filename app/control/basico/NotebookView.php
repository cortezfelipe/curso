<?php
class NotebookView extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $notebook = new TNotebook;
        
        $table1 = new TTable;
        $table2 = new TTable;
        
        $notebook->appendPage('Aba 1', $table1);
        $notebook->appendPage('Aba 2', $table2);
        
        $field1 = new TEntry('field1');
        $field2 = new TEntry('field2');
        $field3 = new TEntry('field3');
        $field4 = new TEntry('field4');
        $field5 = new TEntry('field5');
        $field6 = new TEntry('field6');
        $field7 = new TEntry('field7');
        $field8 = new TEntry('field8');
        
        $table1->addRowSet( new TLabel('Field 1'), $field1);
        $table1->addRowSet( new TLabel('Field 2'), $field2);
        $table1->addRowSet( new TLabel('Field 3'), $field3);
        $table1->addRowSet( new TLabel('Field 4'), $field4);
        
        $table2->addRowSet( new TLabel('Field 5'), $field5);
        $table2->addRowSet( new TLabel('Field 6'), $field6);
        $table2->addRowSet( new TLabel('Field 7'), $field7);
        $table2->addRowSet( new TLabel('Field 8'), $field8);
        
        parent::add( $notebook );
    }
}