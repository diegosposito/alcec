<?php

/**
 * BaseTiposDesignaciones
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idtipodesignacion
 * @property integer $idcategoriadesignacion
 * @property string $descripcion
 * @property integer $idordinaria
 * @property Doctrine_Collection $TiposDesignaciones
 * 
 * @method integer             getIdtipodesignacion()      Returns the current record's "idtipodesignacion" value
 * @method integer             getIdcategoriadesignacion() Returns the current record's "idcategoriadesignacion" value
 * @method string              getDescripcion()            Returns the current record's "descripcion" value
 * @method integer             getIdordinaria()            Returns the current record's "idordinaria" value
 * @method Doctrine_Collection getTiposDesignaciones()     Returns the current record's "TiposDesignaciones" collection
 * @method TiposDesignaciones  setIdtipodesignacion()      Sets the current record's "idtipodesignacion" value
 * @method TiposDesignaciones  setIdcategoriadesignacion() Sets the current record's "idcategoriadesignacion" value
 * @method TiposDesignaciones  setDescripcion()            Sets the current record's "descripcion" value
 * @method TiposDesignaciones  setIdordinaria()            Sets the current record's "idordinaria" value
 * @method TiposDesignaciones  setTiposDesignaciones()     Sets the current record's "TiposDesignaciones" collection
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTiposDesignaciones extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tipos_designaciones');
        $this->hasColumn('idtipodesignacion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('idcategoriadesignacion', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('descripcion', 'string', 100, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => ' ',
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('idordinaria', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Designaciones as TiposDesignaciones', array(
             'local' => 'idtipodesignacion',
             'foreign' => 'idtipodesignacion'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}