<?php
class FormularioCheckList extends TPage
{
    private $form;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder;
        $this->form->setFormTitle('Check list');
        
        $id    = new TEntry('id');
        $nome  = new TEntry('nome');
        $lista = new TCheckList('lista_produtos');
        
        $lista->addColumn( 'id',          'Id',          'center',  '10%');
        $lista->addColumn( 'descricao',   'Descrição',   'left',    '50%');
        $lista->addColumn( 'preco_venda', 'Preço venda', 'left',    '40%');
        $lista->setHeight(250);
        $lista->makeScrollable();
        
        $input = new TEntry('busca');
        $input->placeholder = 'Busca...';
        $input->setSize('100%');
        
        $lista->enableSearch($input, 'id, descricao');
        
        $hbox = new THBox;
        $hbox->style = 'border-bottom:1px solid gray; padding-bottom:10px';
        $hbox->add( new TLabel('Produtos') );
        $hbox->add($input)->style = 'float:right; width:30%';
        
        $this->form->addFields( [ new TLabel('Id')],        [$id] );
        $this->form->addFields( [ new TLabel('Nome')],      [$nome] );
        
        $this->form->addContent( [$hbox] );
        $this->form->addFields( [ new TLabel('Produtos')],  [$lista] );
        
        /*
        TTransaction::open('curso');
        $produtos = Produto::all();
        TTransaction::close();
        */
        
        
        $lista->addItems( Produto::allInTransaction('curso') );
        
        $this->form->addAction( 'Enviar', new TAction( [$this, 'onSend'] ), 'fa:save');
        
        parent::add( $this->form );
    }
    
    public function onSend($param)
    {
        $data = $this->form->getData();
        $this->form->setData($data);
        
        echo '<pre>';
        var_dump($data->id);
        var_dump($data->nome);
        var_dump($data->lista_produtos);
        echo '</pre>';
    }
}