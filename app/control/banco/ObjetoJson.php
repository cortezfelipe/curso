<?php
class ObjetoJson extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('curso');
            
            $produto = new Produto(3);
            
            echo '<pre>';
            print_r( $produto->toJson() );
            echo '</pre>';
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}