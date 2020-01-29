<?php
class DatagridScrollVertical extends TPage
{
    private $datagrid;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = '100%';
        //$this->datagrid->enablePopover('Detalhes', '<b>ID</b> {id} <br> <b>Nome</b> {nome} <br> <b>Cidade</b> {cidade} <br> <b> Estado</b> {estado} <br> <b>País</b> {pais}');
        
        $this->datagrid->setHeight(300);
        $this->datagrid->makeScrollable();
        
        $col_id      = new TDataGridColumn('id',     'Código', 'center', '10%');
        $col_nome    = new TDataGridColumn('nome',   'Nome',   'left',   '30%');
        $col_cidade  = new TDataGridColumn('cidade', 'Cidade', 'left',   '30%');
        $col_estado  = new TDataGridColumn('estado', 'Estado', 'left',   '30%');
        
        
        $col_id->title = 'Clique nesta coluna para ação';
        
        $this->datagrid->addColumn( $col_id );
        $this->datagrid->addColumn( $col_nome );
        $this->datagrid->addColumn( $col_cidade );
        $this->datagrid->addColumn( $col_estado );
        
        
        $action1 = new TDataGridAction( [$this, 'onView'],   ['id' => '{id}', 'nome' => '{nome}' ] );
        $action2 = new TDataGridAction( [$this, 'onDelete'], ['id' => '{id}', 'nome' => '{nome}' ] );
        
        $this->datagrid->addAction( $action1, 'Visualiza', 'fa:search blue');
        $this->datagrid->addAction( $action2, 'Exclui',    'fa:trash red');
        
        // após definir colunas, e ações... criar a estrutura
        
        $this->datagrid->createModel();
        
        
        $panel = new TPanelGroup('Datagrid');
        $panel->add($this->datagrid);
         
        parent::add($panel);
    }
    
    public static function onView($param)
    {
        new TMessage('info', 'ID: '. $param['id'] . ' - Nome: ' . $param['nome'] );
    }
    
    public static function onDelete($param)
    {
        new TMessage('error', 'ID: '. $param['id'] . ' - Nome: ' . $param['nome'] );
    }
    
    public function onReload()
    {
        $this->datagrid->clear();
        
        for ($n=1; $n <=40; $n++)
        {
            $item = new stdClass;
            $item->id     = $n;
            $item->nome   = 'Nome pessoa ' . $n;
            $item->cidade = 'Cidade ' . $n;
            $item->estado = 'Estado ' . $n;
            $item->pais   = 'País ' . $n;
            $this->datagrid->addItem($item);
        }
    }
    
    public function show()
    {
        $this->onReload();
        parent::show();
    }
}