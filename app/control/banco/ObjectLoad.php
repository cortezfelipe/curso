<?php
class ObjectLoad extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('curso');
            
            TTransaction::dump();
            
            $produto = new Produto( 8876 );
            
            echo '<b>Descrição</b>: ' . $produto->descricao;
            echo '<br>';
            echo '<b>Estoque</b>: ' . $produto->estoque;
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}