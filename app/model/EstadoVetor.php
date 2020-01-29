<?php
/**
 * EstadoVetor Active Record
 * @author  <your-name-here>
 */
class EstadoVetor extends TRecord
{
    const TABLENAME = 'estado';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'serial'; // {max, serial}
    
    
    private $cidades;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
    }

    
    /**
     * Method addCidade
     * Add a Cidade to the EstadoVetor
     * @param $object Instance of Cidade
     */
    public function addCidade(Cidade $object)
    {
        $this->cidades[] = $object;
    }
    
    /**
     * Method getCidades
     * Return the EstadoVetor' Cidade's
     * @return Collection of Cidade
     */
    public function getCidades()
    {
        return $this->cidades;
    }

    /**
     * Reset aggregates
     */
    public function clearParts()
    {
        $this->cidades = array();
    }

    /**
     * Load the object and its aggregates
     * @param $id object ID
     */
    public function load($id)
    {
        $this->cidades = parent::loadComposite('Cidade', 'estado_vetor_id', $id);
    
        // load the object itself
        return parent::load($id);
    }

    /**
     * Store the object and its aggregates
     */
    public function store()
    {
        // store the object itself
        parent::store();
    
        parent::saveComposite('Cidade', 'estado_vetor_id', $this->id, $this->cidades);
    }

    /**
     * Delete the object and its aggregates
     * @param $id object ID
     */
    public function delete($id = NULL)
    {
        $id = isset($id) ? $id : $this->id;
        parent::deleteComposite('Cidade', 'estado_vetor_id', $id);
    
        // delete the object itself
        parent::delete($id);
    }


}
