<?php

/**
 * TiposDesignacionesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TiposDesignacionesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object TiposDesignacionesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('TiposDesignaciones');
    }

    // Obtiene los tipos de designacion por Categoria
    public static function getByCategory($idCategoriaDesignacion)
    {
    	$sql = "SELECT idtipodesignacion, descripcion FROM tipos_designaciones WHERE idcategoriadesignacion = ".$idCategoriaDesignacion;
    	
    	return Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);
    }
}