<?php
class TableView extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $table = new TTable;
        $table->border = '1';
        $table->cellpadding = '4';
        $table->style = 'border-collapse: collapse; width: 100%';
        
        $row = $table->addRow();
        $row->addCell('A');
        $row->addCell('B');
        
        $title = new TLabel('título', 'red', 18);
        
        $row = $table->addRow();
        $cell = $row->addCell( $title );
        $cell->colspan = 2;
        $cell->style = 'padding: 10px';
        
        $id   = new TEntry('id');
        $nome = new TEntry('nome');
        $endereco = new TEntry('endereco');
        $fone = new TEntry('fone');
        $obs = new TEntry('obs');
        
        
        $table->addRowSet( new TLabel('Código'), $id );
        $table->addRowSet( new TLabel('Nome'), $nome );
        $table->addRowSet( new TLabel('Endereço'), $endereco );
        $table->addRowSet( new TLabel('fone'), $fone );
        $table->addRowSet( new TLabel('Obs'), $obs );
        
        parent::add( $table );
    }
}
