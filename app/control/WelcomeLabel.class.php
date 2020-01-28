<?php


class WelcomeLabel extends TWindow
{
   
    function __construct()
    {
        parent::__construct();
        
        parent::setTitle('Titulo');
        parent::setSize(0.6,0.4);
        //parent::removeTitleBar();
        //parent::disableEscape();
        
        
        $label = new TLabel('hello world !','blue',15,'i');
        
        
        $panel = new TPanelGroup('Título');
        $panel->add($label);    
        $panel->addFooter('Rodapé');
              
        parent::add($panel);   
        
         //https://www.maujor.com/
        
    }
    
}