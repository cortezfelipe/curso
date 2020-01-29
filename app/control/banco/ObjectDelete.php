<?php
class ObjectDelete extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('curso');
            
            TTransaction::dump();
            
            $produto = Produto::find( 29 );
            
            if ($produto instanceof Produto)
            {
                $produto->delete();
            }
            
            /*
            $produto = new Produto;
            $produto->delete( 28 );
            */
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}