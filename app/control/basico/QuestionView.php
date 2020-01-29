<?php
class QuestionView extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $action1 = new TAction( [$this, 'onActionYes'] );
        $action1->setParameter('nome', 'acao1');
        
        $action2 = new TAction( [$this, 'onActionNo'] );
        $action2->setParameter('nome', 'acao2');
        
        new TQuestion('Você gostaria de executar esta operação?', $action1, $action2);
    }
    
    
    public static function onActionYes($param)
    {
        new TMessage('info', 'Você escolheu SIM: ' . $param['nome']);
    }
    
    public static function onActionNo($param)
    {
        new TMessage('error', 'Você escolheu NÃO: ' . $param['nome']);
    }
}