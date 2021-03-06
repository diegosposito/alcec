<?php

/**
 * DocumentacionExpedientesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DocumentacionExpedientesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object DocumentacionExpedientesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('DocumentacionExpedientes');
    }
    
    // Return DocumentacionExpedientes
  	public static function getDocumentacionExpediente($idexpediente, $iddocumentacion)
	{
		$q = Doctrine_Query::create()
			->select('d.*')
			->from('DocumentacionExpedientes d')
			->where('d.idexpediente=?', $idexpediente)
			->andWhere('d.iddocumentacion=?', $iddocumentacion);
		   
		return $q->fetchOne();
	}         
}