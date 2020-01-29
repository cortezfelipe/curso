<?php
/**
 * Cliente Active Record
 * @author  <your-name-here>
 */
class Cliente extends TRecord
{
    const TABLENAME = 'cliente';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    const CREATEDAT = 'created_at';
    const UPDATEDAT = 'updated_at';
    
    private $cidade;
    private $categoria;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('endereco');
        parent::addAttribute('telefone');
        parent::addAttribute('nascimento');
        parent::addAttribute('situacao');
        parent::addAttribute('email');
        parent::addAttribute('genero');
        parent::addAttribute('categoria_id');
        parent::addAttribute('cidade_id');
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
    }

    public function get_categoria()
    {
        if (empty($this->categoria))
        {
            $this->categoria = new Categoria($this->categoria_id);
        }
        return $this->categoria;
    }
    
    public function get_cidade()
    {
        if (empty($this->cidade))
        {
            $this->cidade = new Cidade($this->cidade_id);
        }
        return $this->cidade;
    }
    
    
    
}
