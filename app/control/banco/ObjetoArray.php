<?php
class ObjetoArray extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('curso');
            
            $produto = new Produto(3);
            
            echo '<pre>';
            print_r( $produto->toArray() );
            echo '</pre>';
            
            $dados = [];
            $dados['descricao'] = 'Smart Watch';
            $dados['estoque'] = 2;
            $dados['preco_venda'] = 200;
            $dados['unidade'] = 'PC';
            
            $produto = new Produto;
            $produto->fromArray( $dados );
            $produto->store();
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}