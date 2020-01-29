<?php
class GraficoPizza extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        $html = new THtmlRenderer('app/resources/google_pie_chart.html');
        
        $data = [];
        $data[] = ['Pessoa', 'Valor'];
        $data[] = ['Pedro', 400];
        $data[] = ['Maria', 1300];
        $data[] = ['João', 2300];
        
        $html->enableSection('main', [ 'data' => json_encode($data),
                                       'width' => '100%',
                                       'height' => '300px',
                                       'title' => 'Vendas',
                                       'uniqid' => uniqid() ] );

        parent::add( $html );
    }
}