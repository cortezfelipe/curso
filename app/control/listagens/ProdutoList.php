<?php
/**
 * ProdutoList Listing
 * @author  <your name here>
 */
class ProdutoList extends TPage
{
    protected $form;     // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    
    use Adianti\base\AdiantiStandardListTrait;
    
    /**
     * Page constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('curso');            // defines the database
        $this->setActiveRecord('Produto');   // defines the active record
        $this->setDefaultOrder('id', 'asc');         // defines the default order
        $this->setLimit(10);
        // $this->setCriteria($criteria) // define a standard filter

        $this->addFilterField('id', '=', 'id'); // filterField, operator, formField
        $this->addFilterField('descricao', 'like', 'descricao'); // filterField, operator, formField
        $this->addFilterField('estoque', 'like', 'estoque'); // filterField, operator, formField
        $this->addFilterField('preco_venda', 'like', 'preco_venda'); // filterField, operator, formField
        $this->addFilterField('unidade', 'like', 'unidade'); // filterField, operator, formField

        $this->form = new TForm('form_search_Produto');
        
        $id = new TEntry('id');
        $descricao = new TEntry('descricao');
        $estoque = new TEntry('estoque');
        $preco_venda = new TEntry('preco_venda');
        $unidade = new TEntry('unidade');

        $id->exitOnEnter();
        $descricao->exitOnEnter();
        $estoque->exitOnEnter();
        $preco_venda->exitOnEnter();
        $unidade->exitOnEnter();

        $id->setSize('100%');
        $descricao->setSize('100%');
        $estoque->setSize('100%');
        $preco_venda->setSize('100%');
        $unidade->setSize('100%');

        $id->tabindex = -1;
        $descricao->tabindex = -1;
        $estoque->tabindex = -1;
        $preco_venda->tabindex = -1;
        $unidade->tabindex = -1;

        $id->setExitAction( new TAction([$this, 'onSearch'], ['static'=>'1']) );
        $descricao->setExitAction( new TAction([$this, 'onSearch'], ['static'=>'1']) );
        $estoque->setExitAction( new TAction([$this, 'onSearch'], ['static'=>'1']) );
        $preco_venda->setExitAction( new TAction([$this, 'onSearch'], ['static'=>'1']) );
        $unidade->setExitAction( new TAction([$this, 'onSearch'], ['static'=>'1']) );
        
        // creates a DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        // $this->datagrid->enablePopover('Popover', 'Hi <b> {name} </b>');
        

        // creates the datagrid columns
        $column_id = new TDataGridColumn('id', 'Id', 'left');
        $column_descricao = new TDataGridColumn('descricao', 'Descricao', 'left');
        $column_estoque = new TDataGridColumn('estoque', 'Estoque', 'right');
        $column_preco_venda = new TDataGridColumn('preco_venda', 'Preco Venda', 'right');
        $column_unidade = new TDataGridColumn('unidade', 'Unidade', 'left');
        $column_local_foto = new TDataGridColumn('local_foto', 'Local Foto', 'left');


        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_descricao);
        $this->datagrid->addColumn($column_estoque);
        $this->datagrid->addColumn($column_preco_venda);
        $this->datagrid->addColumn($column_unidade);
        $this->datagrid->addColumn($column_local_foto);

        // define the transformer method over image
        $column_preco_venda->setTransformer( function($value, $object, $row) {
            if (is_numeric($value))
            {
                return 'R$ ' . number_format($value, 2, ',', '.');
            }
            return $value;
        });

        // define the transformer method over image
        $column_local_foto->setTransformer( function($value, $object, $row) {
            if (file_exists($value)) {
                return new TImage($value);
            }
        });

        
        $action1 = new TDataGridAction(['ProdutoForm', 'onEdit'], ['id'=>'{id}']);
        $action2 = new TDataGridAction([$this, 'onDelete'], ['id'=>'{id}']);
        
        $this->datagrid->addAction($action1, _t('Edit'),   'far:edit blue');
        $this->datagrid->addAction($action2 ,_t('Delete'), 'far:trash-alt red');
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // add datagrid inside form
        $this->form->add($this->datagrid);
        
        // create row with search inputs
        $tr = new TElement('tr');
        $this->datagrid->prependRow($tr);
        
        $tr->add( TElement::tag('td', ''));
        $tr->add( TElement::tag('td', ''));
        $tr->add( TElement::tag('td', $id));
        $tr->add( TElement::tag('td', $descricao));
        $tr->add( TElement::tag('td', $estoque));
        $tr->add( TElement::tag('td', $preco_venda));
        $tr->add( TElement::tag('td', $unidade));

        $this->form->addField($id);
        $this->form->addField($descricao);
        $this->form->addField($estoque);
        $this->form->addField($preco_venda);
        $this->form->addField($unidade);

        // keep form filled
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data'));
        
        // create the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction([$this, 'onReload']));
        
        $panel = new TPanelGroup('Produto');
        $panel->add($this->form);
        $panel->addFooter($this->pageNavigation);
        
        // header actions
        $dropdown = new TDropDown(_t('Export'), 'fa:list');
        $dropdown->setPullSide('right');
        $dropdown->setButtonClass('btn btn-default waves-effect dropdown-toggle');
        $dropdown->addAction( _t('Save as CSV'), new TAction([$this, 'onExportCSV'], ['register_state' => 'false', 'static'=>'1']), 'fa:table blue' );
        $dropdown->addAction( _t('Save as PDF'), new TAction([$this, 'onExportPDF'], ['register_state' => 'false', 'static'=>'1']), 'far:file-pdf red' );
        $panel->addHeaderWidget( $dropdown );
        
        $panel->addHeaderActionLink( _t('New'),  new TAction(['ProdutoForm', 'onEdit'], ['register_state' => 'false']), 'fa:plus green' );
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($panel);
        
        parent::add($container);
    }
}
