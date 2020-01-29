<?php

class GraficoBarras extends TPage
{
    private $html;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->html = new THtmlRenderer( 'app/resources/google_bar_chart.html');

        $data = [];
        $data[] = ['Dia', 'Prospects', 'Compras'];
        $data[] = ['01/10', 120, 100];
        $data[] = ['02/10', 200, 140];
        $data[] = ['03/10', 160, 120];
        
        $this->html->enableSection('main', ['data' => json_encode($data),
                                            'width' => '100%',
                                            'height' => '300px',
                                            'title' => 'Vendas do dia',
                                            'xtitle' => 'Vendas',
                                            'ytitle' => 'Dias',
                                            'uniqid' => uniqid()]);
        
        parent::add($this->html);
    }
}