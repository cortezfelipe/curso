<?php
class DatagridFormatacao extends TPage
{
    private $datagrid;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = '100%';
        
        $col_id         = new TDataGridColumn('id',     'Código', 'center' );
        $col_nome       = new TDataGridColumn('nome',   'Nome',   'left' );
        $col_cidade     = new TDataGridColumn('cidade', 'Cidade', 'left' );
        $col_estado     = new TDataGridColumn('estado', 'Estado', 'left' );
        $col_nascimento = new TDataGridColumn('nascimento', 'Nascimento', 'left' );
        $col_cache      = new TDataGridColumn('cache', 'Cache', 'right' );
        
        $col_cache->setDataProperty('style', 'font-weight: bold');
        $col_cache->setTransformer( [ $this, 'formatCache' ] );
        
        $col_nascimento->setTransformer( function ($nascimento, $object, $row){
            $date = new DateTime($object->nascimento);
            return $date->format('d/m/Y');
        });
        
        $this->datagrid->addColumn( $col_id );
        $this->datagrid->addColumn( $col_nome );
        $this->datagrid->addColumn( $col_cidade );
        $this->datagrid->addColumn( $col_estado );
        $this->datagrid->addColumn( $col_nascimento );
        $this->datagrid->addColumn( $col_cache );
        
        
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
    
    public function formatCache($cache, $object, $row)
    {
        $formatado = number_format($cache, 2, ',', '.');
        
        if ($cache > 1000000)
        {
            $row->style = 'background: #FFF9A7';
            
            return "<span style='color:green'> $formatado </span>";
        }
        else
        {
            return "<span style='color:blue'> $formatado </span>";
        }
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
        
        $item = new stdClass;
        $item->id     = 1;
        $item->nome   = 'Aretha Franklin';
        $item->cidade = 'Memphis';
        $item->estado = 'Tenessee (US)';
        $item->pais   = 'Estados Unidos';
        $item->nascimento = '1942-03-25';
        $item->cache = 1200000;
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id     = 2;
        $item->nome   = 'Eric Clapton';
        $item->cidade = 'Ripley';
        $item->estado = 'Surrey (UK)';
        $item->pais   = 'Reino Unido';
        $item->nascimento = '1945-03-30';
        $item->cache = 900000;
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id     = 3;
        $item->nome   = 'B.B. King';
        $item->cidade = 'Itta Bena';
        $item->estado = 'Mississipi (US)';
        $item->pais   = 'Estados Unidos';
        $item->nascimento = '1925-09-16';
        $item->cache = 1500000;
        $this->datagrid->addItem($item);
        
        $item = new stdClass;
        $item->id     = 4;
        $item->nome   = 'Janis Joplin';
        $item->cidade = 'Port Arthur';
        $item->estado = 'Texas (US)';
        $item->pais   = 'Estados Unidos';
        $item->nascimento = '1943-01-19';
        $item->cache = 800000;
        $this->datagrid->addItem($item);
    }
    
    public function show()
    {
        $this->onReload();
        parent::show();
    }
}