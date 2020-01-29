<?php
class CollectionShortcurts extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try 
        {
            TTransaction::open('curso');
            
            /*
            $clientes = Cliente::all();
            echo '<pre>'; print_r($clientes); echo '</pre>';
            */
            
            /*
            $count = Cliente::where('situacao', '=', 'Y')
                            ->where('genero', '=', 'F')
                            ->count();
            print_r($count);
            */
            
            /*
            $clientes = Cliente::where('situacao', '=', 'Y')
                               ->where('genero', '=', 'F')
                               ->load();
            echo '<pre>'; print_r($clientes); echo '</pre>';
            */
            
            /*
            $clientes = Cliente::where('situacao', '=', 'Y')
                               ->where('genero', '=', 'F')
                               ->orderBy('nome')
                               ->load();
            echo '<pre>'; print_r($clientes); echo '</pre>';
            */
            
            /*
            $clientes = Cliente::where('id', '>', 0)
                               ->take(10)
                               ->skip(20)
                               ->load();
            echo '<pre>'; print_r($clientes); echo '</pre>';
            */
            
            /*
            $cliente = Cliente::where('situacao', '=', 'Y')
                              ->where('genero', '=', 'F')
                              ->first();
            echo '<pre>'; print_r($cliente); echo '</pre>';
            */
            
            /*
            Cliente::where('cidade_id', '=', '3')
                   ->set('telefone', '222222-4444444')
                   ->update();
            */
            
            /*
            Cliente::where('categoria_id', '=', '3')
                   ->delete();
            */
            
            /*
            $clientes = Cliente::getIndexedArray('id', 'nome');
            echo '<pre>'; print_r($clientes); echo '</pre>';
            */
            
            /*
            $clientes = Cliente::where('situacao', '=', 'Y')
                               ->orderBy('id')
                               ->getIndexedArray('id', 'nome');
            echo '<pre>'; print_r($clientes); echo '</pre>';
            */
            
            TTransaction::close();
        } 
        catch (Exception $e) 
        { 
            new TMessage('error', $e->getMessage()); 
        }
    }
}