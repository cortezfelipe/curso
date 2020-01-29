<?php
class DatagridExporta extends TPage
{
    private $datagrid;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->width = '100%';
        
        $col_id      = new TDataGridColumn('id',     'Código', 'center', '10%');
        $col_nome    = new TDataGridColumn('nome',   'Nome',   'left',   '30%');
        $col_cidade  = new TDataGridColumn('cidade', 'Cidade', 'left',   '30%');
        $col_estado  = new TDataGridColumn('estado', 'Estado', 'left',   '30%');
        
        
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
         
         
        $panel->addHeaderActionLink( 'Salvar PDF', new TAction( [$this, 'exportaPDF'], ['register_state' => 'false'] ), 'far:file-pdf red');
        $panel->addHeaderActionLink( 'Salvar CSV', new TAction( [$this, 'exportaCSV'], ['register_state' => 'false'] ), 'fa:table blue');
        
        parent::add($panel);
    }
    
    
    public function exportaPDF($param)
    {
        try
        {
            $html = clone $this->datagrid;
            $conteudo = file_get_contents('app/resources/styles-print.html') . $html->getContents();
            
            $dompdf = new \Dompdf\Dompdf;
            $dompdf->loadHtml($conteudo);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            $file = 'app/output/datagrid-exporta.pdf';
            
            file_put_contents( $file, $dompdf->output() );
            
            $window = TWindow::create('Exportação', 0.8, 0.8);
            
            $object = new TElement('object');
            $object->data = $file;
            $object->type = 'application/pdf';
            $object->style = 'width:100%; height: calc(100% - 10px)';
            
            $window->add($object);
            $window->show();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
    public function exportaCSV($param)
    {
        try
        {
            $data = $this->datagrid->getOutputData();
            
            if ($data)
            {
                $file = 'app/output/datagrid-exporta.csv';
                
                $handler = fopen($file, 'w');
                foreach ($data as $row)
                {
                    fputcsv($handler, $row);
                }
                fclose($handler);
            
                parent::openFile($file);
            }
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
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