<?php
class ObjectStore extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('curso');
            
            /*
            TTransaction::setLoggerFunction( function($mensagem) {
                print $mensagem . '<br>';
            });
            */
            
            TTransaction::dump();
            
            $produto = new Produto;
            $produto->descricao = 'GRAVADOR DVD';
            $produto->estoque = 10;
            $produto->preco_venda = 100;
            $produto->unidade = 'PC';
            $produto->local_foto =  '';
            $produto->store();
            
            new TMessage('info', 'Produto gravado com sucesso');
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}