<?php
/**
 * ProdutoForm Form
 * @author  <your name here>
 */
class ProdutoFormMulti extends TPage
{
    protected $form; // form
    
    
    use Adianti\Base\AdiantiFileSaveTrait;
    
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_Produto');
        $this->form->setFormTitle('Produto');
        

        // create the form fields
        $id = new TEntry('id');
        $descricao = new TEntry('descricao');
        $estoque = new TEntry('estoque');
        $preco_venda = new TEntry('preco_venda');
        $unidade = new TCombo('unidade');
        $local_foto = new TMultiFile('local_foto');
        
        //limita  extenção do arquivo
        $local_foto->setAllowedExtensions(['gif','png','jpg','jpeg']);
        //comando faz barra de prograsso
        $local_foto->enableFileHandling();
        //aparecer a imagem
        $local_foto->enablePopover();
        
        
        

        // add the fields
        $this->form->addFields( [ new TLabel('Id') ], [ $id ] );
        $this->form->addFields( [ new TLabel('Descricao') ], [ $descricao ] );
        $this->form->addFields( [ new TLabel('Estoque') ], [ $estoque ] );
        $this->form->addFields( [ new TLabel('Preco Venda') ], [ $preco_venda ] );
        $this->form->addFields( [ new TLabel('Unidade') ], [ $unidade ] );
        $this->form->addFields( [ new TLabel('Local Foto') ], [ $local_foto ] );



        // set sizes
        $id->setSize('100%');
        $descricao->setSize('100%');
        $estoque->setSize('100%');
        $preco_venda->setSize('100%');
        $unidade->setSize('100%');
        $local_foto->setSize('100%');



        if (!empty($id))
        {
            $id->setEditable(FALSE);
        }
        
        /** samples
         $fieldX->addValidation( 'Field X', new TRequiredValidator ); // add validation
         $fieldX->setSize( '100%' ); // set size
         **/
         
        // create the form actions
        $btn = $this->form->addAction(_t('Save'), new TAction([$this, 'onSave']), 'fa:save');
        $btn->class = 'btn btn-sm btn-primary';
        $this->form->addActionLink(_t('New'),  new TAction([$this, 'onEdit']), 'fa:eraser red');
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        
        parent::add($container);
    }

    /**
     * Save form data
     * @param $param Request
     */
    public function onSave( $param )
    {
        try
        {
            TTransaction::open('curso'); // open a transaction
            
            /**
            // Enable Debug logger for SQL operations inside the transaction
            TTransaction::setLogger(new TLoggerSTD); // standard output
            TTransaction::setLogger(new TLoggerTXT('log.txt')); // file
            **/
            
            $this->form->validate(); // validate form data
            $data = $this->form->getData(); // get form data as array
            
            $object = new Produto;  // create an empty object
            $object->fromArray( (array) $data); // load the object with data
            $object->store(); // save the object
            
            //$this->saveFile($object, $data, 'local_foto', 'files');
            $this->saveFiles($object, $data, 'local_foto', 'files', 'ProdutoImagem', 'imagem', 'produto_id');
            
            // get the generated id
            $data->id = $object->id;
            
            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction
            
            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'));
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }
    
    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(TRUE);
    }
    
    /**
     * Load object to form data
     * @param $param Request
     */
    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open('curso'); // open a transaction
                $object = new Produto($key); // instantiates the Active Record
                $this->form->setData($object); // fill the form
                TTransaction::close(); // close the transaction
            }
            else
            {
                $this->form->clear(TRUE);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }
}
