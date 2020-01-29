<?php
class DatagridBootstrap extends TPage
{
    private $datagrid;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = '100%';
        $this->datagrid->enablePopover('Detalhes', '<b>ID</b> {id} <br> <b>Nome</b> {nome} <br> <b>Cidade</b> {cidade} <br> <b> Estado</b> {estado} <br> <b>País</b> {pais}');
        
        $col_id      = new TDataGridColumn('id',     'Código', 'center', '10%');
        $col_nome    = new TDataGridColumn('nome',   'Nome',   'left',   '30%');
        $col_cidade  = new TDataGridColumn('cidade', 'Cidade', 'left',   '30%');
        $col_estado  = new TDataGridColumn('estado', 'Estado', 'left',   '30%');
        
        
        $col_id->title = 'Clique nesta coluna para ação';
        
        $this->datagrid->addColumn( $col_id, new TAction([$this, 'onColumnAction'], ['coluna' => 'id']) );
        $this->datagrid->addColumn( $col_nome );
        $this->datagrid->addColumn( $col_cidade );
        $this->datagrid->addColumn( $col_estado );
        
        
        $action1 = new TDataGridAction( [$this, 'onView'],   ['id' => '{id}', 'nome' => '{nome}' ] );
        $action2 = new TDataGridAction( [$this, 'onDelete'], ['id' => '{id}', 'nome' => '{nome}' ] );
        
        // $action1->setUseButton(true);
        // $action2->setUseButton(true);
        
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
    
    public static function onColumnAction($param)
    {
        new TMessage('info', 'Coluna clicada: ' .  $param['coluna']);
    }
    
    public function onReload()
    {
        $this->datagrid->clear();
        
        $item = new stdClass;
        $item->id     = 1;
        $item->nome   = 'Aretha Franklin';
        $item->cidade = 'Memphis';
        $item->estado = 'Tenessee (US)';
        $item->pais   = 'Estados Unidos';
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id     = 2;
        $item->nome   = 'Eric Clapton';
        $item->cidade = 'Ripley';
        $item->estado = 'Surrey (UK)';
        $item->pais   = 'Reino Unido';
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id     = 3;
        $item->nome   = 'B.B. King';
        $item->cidade = 'Itta Bena';
        $item->estado = 'Mississipi (US)';
        $item->pais   = 'Estados Unidos';
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id     = 4;
        $item->nome   = 'Janis Joplin';
        $item->cidade = 'Port Arthur';
        $item->estado = 'Texas (US)';
        $item->pais   = 'Estados Unidos';
        $this->datagrid->addItem($item);
    }
    
    public function show()
    {
        $this->onReload();
        parent::show();
    }
}