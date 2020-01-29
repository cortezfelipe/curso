<?php
class ObjetoRelacionado extends TPage
{
    public function __construct()
    {
        parent::__construct();
        
        try
        {
			TTransaction::open('curso');
			TTransaction::dump();
			
			$contatos = Cliente::find(1)->hasMany('Contato');
			$contatos = Cliente::find(1)->hasMany('Contato', 'cliente_id', 'id', 'tipo');
			$contatos = Cliente::find(1)->filterMany('Contato')->where('tipo', '=', 'face')->load();
			$contatos = Cliente::find(1)->filterMany('Contato', 'cliente_id', 'id', 'tipo')->where('tipo', '=', 'face')->load();
			$habilidades = Cliente::find(1)->belongsToMany('Habilidade');
			$habilidades = Cliente::find(1)->belongsToMany('Habilidade', 'ClienteHabilidade', 'cliente_id', 'habilidade_id');
			
			TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
}