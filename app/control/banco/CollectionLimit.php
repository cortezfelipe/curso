<?php
class CollectionLimit extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
            TTransaction::open('curso');
            
            $criteria = new TCriteria;
            $criteria->setProperty('limit', 10);
            $criteria->setProperty('offset', 20);
            $criteria->setProperty('order', 'id');
            
            $repository = new TRepository('Cliente');
            $objetos = $repository->load( $criteria );
            
            if ($objetos)
            {
                foreach ($objetos as $objeto)
                {
                    echo $objeto->id . '-' . $objeto->nome;
                    echo '<br>';
                }
            }
            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}