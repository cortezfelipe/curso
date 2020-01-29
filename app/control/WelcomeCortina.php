<?php

class WelcomeCortina extends TPage
{
   
    function __construct()
    {
        parent::__construct();
        parent::setTargetContainer('adianti_right_panel');
        
        $label = new TLabel('hello world','blue',25,'i');   
        
        $panel = new TPanelGroup('Título');
        

        $botaofechar = new TButton('fechar');
        $botaofechar->setLabel('Fechar');
        $botaofechar->addFunction("Template.closeRightPanel()");
        
        $panel->add($label);    
        $panel->addFooter($botaofechar);
        
        
        
        parent::add($panel);   
        
    }
    
    
    
}
