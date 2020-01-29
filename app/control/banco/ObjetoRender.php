<?php
class ObjetoRender extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('curso');
            
            $produto = new Produto(3);
            
            print $produto->render('O produto (<b>{id}</b>) - nome <b>{descricao}</b> - preco R$ <b>{preco_venda}</b>');
            echo '<br>';
            echo 'Resultado: ';
            print $produto->evaluate('= {preco_venda} * {estoque}');
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}