<?php
class DatagridImagem extends TPage
{
    private $datagrid;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->datagrid = new BootstrapDatagridWrapper( new TDataGrid );
        $this->datagrid->width = '100%';
        
        $col_id        = new TDataGridColumn('id', 'Código', 'center' );
        $col_descricao = new TDataGridColumn('descricao', 'Descrição', 'center' );
        $col_imagem    = new TDataGridColumn('imagem', 'Imagem', 'center' );

        $col_imagem->setTransformer( function($imagem, $object, $row) {
            $obj = new TImage( $imagem );
            $obj->style = 'max-width: 140px';
            
            return $obj;
        });
        
        $this->datagrid->addColumn( $col_id );
        $this->datagrid->addColumn( $col_descricao );
        $this->datagrid->addColumn( $col_imagem );
        
        $this->datagrid->createModel();
        
        $panel = new TPanelGroup('Datagrid com imagem');
        $panel->add($this->datagrid);
        
        parent::add($panel);
    }
    
    public function onReload()
    {
        $this->datagrid->clear();
        
        $item = new stdClass;
        $item->id = 1;
        $item->descricao = 'Pendrive';
        $item->imagem = 'app/images/pendrive.jpg';
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id = 2;
        $item->descricao = 'HD';
        $item->imagem = 'app/images/hd.jpg';
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id = 3;
        $item->descricao = 'SD CARD';
        $item->imagem = 'app/images/sdcard.jpg';
        $this->datagrid->addItem($item);
        
    }
    
    public function show()
    {
        $this->onReload();
        parent::show();
    }
}
