<?php

/**
 * BaseTiposDocumentos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idtipodoc
 * @property string $descripcion
 * @property integer $idpais
 * @property string $formato
 * @property Paises $Paises
 * @property Doctrine_Collection $TiposDocumentos
 * 
 * @method integer             getIdtipodoc()       Returns the current record's "idtipodoc" value
 * @method string              getDescripcion()     Returns the current record's "descripcion" value
 * @method integer             getIdpais()          Returns the current record's "idpais" value
 * @method string              getFormato()         Returns the current record's "formato" value
 * @method Paises              getPaises()          Returns the current record's "Paises" value
 * @method Doctrine_Collection getTiposDocumentos() Returns the current record's "TiposDocumentos" collection
 * @method TiposDocumentos     setIdtipodoc()       Sets the current record's "idtipodoc" value
 * @method TiposDocumentos     setDescripcion()     Sets the current record's "descripcion" value
 * @method TiposDocumentos     setIdpais()          Sets the current record's "idpais" value
 * @method TiposDocumentos     setFormato()         Sets the current record's "formato" value
 * @method TiposDocumentos     setPaises()          Sets the current record's "Paises" value
 * @method TiposDocumentos     setTiposDocumentos() Sets the current record's "TiposDocumentos" collection
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTiposDocumentos extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tipos_documentos');
        $this->hasColumn('idtipodoc', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('descripcion', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'sin informacion',
             'length' => 50,
             ));
        $this->hasColumn('idpais', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('formato', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'sin informacion',
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Paises', array(
             'local' => 'idpais',
             'foreign' => 'idpais'));

        $this->hasMany('Personas as TiposDocumentos', array(
             'local' => 'idtipodoc',
             'foreign' => 'idtipodoc'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}