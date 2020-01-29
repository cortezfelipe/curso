<?php
class ObjectFind extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('curso');
            
            $produto = Produto::find( 8 );
            
            if ($produto instanceof Produto)
            {
                echo '<b>Descrição</b>: ' . $produto->descricao;
                echo '<br>';
                echo '<b>Estoque</b>: ' . $produto->estoque;
            }
            else
            {
                echo 'Produto não encontrado';
            }
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}