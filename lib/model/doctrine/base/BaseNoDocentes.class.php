<?php

/**
 * BaseNoDocentes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $idlegajo
 * @property string $nombre
 * @property string $apellido
 * @property integer $idsexo
 * @property integer $idtipodoc
 * @property string $nrodoc
 * @property string $cuit
 * @property date $fechanac
 * @property date $fechaingreso
 * @property integer $idcategoria
 * @property string $categoria
 * @property integer $idciudadnac
 * @property integer $idnacionalidad
 * @property integer $idsede
 * @property integer $idfacultad
 * @property string $titulo
 * @property string $cargo
 * @property string $nivel_educativo
 * @property string $area
 * @property string $direccion
 * @property TiposDocumentos $TiposDocumentos
 * @property Paises $Paises
 * @property Ciudades $Ciudades
 * @property Sexo $Sexo
 * 
 * @method integer         getId()              Returns the current record's "id" value
 * @method integer         getIdlegajo()        Returns the current record's "idlegajo" value
 * @method string          getNombre()          Returns the current record's "nombre" value
 * @method string          getApellido()        Returns the current record's "apellido" value
 * @method integer         getIdsexo()          Returns the current record's "idsexo" value
 * @method integer         getIdtipodoc()       Returns the current record's "idtipodoc" value
 * @method string          getNrodoc()          Returns the current record's "nrodoc" value
 * @method string          getCuit()            Returns the current record's "cuit" value
 * @method date            getFechanac()        Returns the current record's "fechanac" value
 * @method date            getFechaingreso()    Returns the current record's "fechaingreso" value
 * @method integer         getIdcategoria()     Returns the current record's "idcategoria" value
 * @method string          getCategoria()       Returns the current record's "categoria" value
 * @method integer         getIdciudadnac()     Returns the current record's "idciudadnac" value
 * @method integer         getIdnacionalidad()  Returns the current record's "idnacionalidad" value
 * @method integer         getIdsede()          Returns the current record's "idsede" value
 * @method integer         getIdfacultad()      Returns the current record's "idfacultad" value
 * @method string          getTitulo()          Returns the current record's "titulo" value
 * @method string          getCargo()           Returns the current record's "cargo" value
 * @method string          getNivelEducativo()  Returns the current record's "nivel_educativo" value
 * @method string          getArea()            Returns the current record's "area" value
 * @method string          getDireccion()       Returns the current record's "direccion" value
 * @method TiposDocumentos getTiposDocumentos() Returns the current record's "TiposDocumentos" value
 * @method Paises          getPaises()          Returns the current record's "Paises" value
 * @method Ciudades        getCiudades()        Returns the current record's "Ciudades" value
 * @method Sexo            getSexo()            Returns the current record's "Sexo" value
 * @method NoDocentes      setId()              Sets the current record's "id" value
 * @method NoDocentes      setIdlegajo()        Sets the current record's "idlegajo" value
 * @method NoDocentes      setNombre()          Sets the current record's "nombre" value
 * @method NoDocentes      setApellido()        Sets the current record's "apellido" value
 * @method NoDocentes      setIdsexo()          Sets the current record's "idsexo" value
 * @method NoDocentes      setIdtipodoc()       Sets the current record's "idtipodoc" value
 * @method NoDocentes      setNrodoc()          Sets the current record's "nrodoc" value
 * @method NoDocentes      setCuit()            Sets the current record's "cuit" value
 * @method NoDocentes      setFechanac()        Sets the current record's "fechanac" value
 * @method NoDocentes      setFechaingreso()    Sets the current record's "fechaingreso" value
 * @method NoDocentes      setIdcategoria()     Sets the current record's "idcategoria" value
 * @method NoDocentes      setCategoria()       Sets the current record's "categoria" value
 * @method NoDocentes      setIdciudadnac()     Sets the current record's "idciudadnac" value
 * @method NoDocentes      setIdnacionalidad()  Sets the current record's "idnacionalidad" value
 * @method NoDocentes      setIdsede()          Sets the current record's "idsede" value
 * @method NoDocentes      setIdfacultad()      Sets the current record's "idfacultad" value
 * @method NoDocentes      setTitulo()          Sets the current record's "titulo" value
 * @method NoDocentes      setCargo()           Sets the current record's "cargo" value
 * @method NoDocentes      setNivelEducativo()  Sets the current record's "nivel_educativo" value
 * @method NoDocentes      setArea()            Sets the current record's "area" value
 * @method NoDocentes      setDireccion()       Sets the current record's "direccion" value
 * @method NoDocentes      setTiposDocumentos() Sets the current record's "TiposDocumentos" value
 * @method NoDocentes      setPaises()          Sets the current record's "Paises" value
 * @method NoDocentes      setCiudades()        Sets the current record's "Ciudades" value
 * @method NoDocentes      setSexo()            Sets the current record's "Sexo" value
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNoDocentes extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('no_docentes');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('idlegajo', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('nombre', 'string', 100, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 100,
             ));
        $this->hasColumn('apellido', 'string', 100, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 100,
             ));
        $this->hasColumn('idsexo', 'integer', 4, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             'length' => 4,
             ));
        $this->hasColumn('idtipodoc', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('nrodoc', 'string', 80, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 80,
             ));
        $this->hasColumn('cuit', 'string', 80, array(
             'type' => 'string',
             'primary' => false,
             'notnull' => true,
             'default' => '',
             'length' => 80,
             ));
        $this->hasColumn('fechanac', 'date', 25, array(
             'type' => 'date',
             'primary' => false,
             'notnull' => true,
             'default' => '2002-01-01',
             'length' => 25,
             ));
        $this->hasColumn('fechaingreso', 'date', 25, array(
             'type' => 'date',
             'primary' => false,
             'notnull' => true,
             'default' => '2002-01-01',
             'length' => 25,
             ));
        $this->hasColumn('idcategoria', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('categoria', 'string', 300, array(
             'type' => 'string',
             'primary' => false,
             'autoincrement' => false,
             'default' => '',
             'length' => 300,
             ));
        $this->hasColumn('idciudadnac', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '734',
             ));
        $this->hasColumn('idnacionalidad', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('idsede', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('idfacultad', 'integer', null, array(
             'type' => 'integer',
             'primary' => false,
             'autoincrement' => false,
             'default' => '1',
             ));
        $this->hasColumn('titulo', 'string', 300, array(
             'type' => 'string',
             'primary' => false,
             'autoincrement' => false,
             'default' => '',
             'length' => 300,
             ));
        $this->hasColumn('cargo', 'string', 300, array(
             'type' => 'string',
             'primary' => false,
             'autoincrement' => false,
             'default' => '',
             'length' => 300,
             ));
        $this->hasColumn('nivel_educativo', 'string', 300, array(
             'type' => 'string',
             'primary' => false,
             'autoincrement' => false,
             'default' => '',
             'length' => 300,
             ));
        $this->hasColumn('area', 'string', 300, array(
             'type' => 'string',
             'primary' => false,
             'autoincrement' => false,
             'default' => '',
             'length' => 300,
             ));
        $this->hasColumn('direccion', 'string', 150, array(
             'type' => 'string',
             'primary' => false,
             'autoincrement' => false,
             'default' => '',
             'length' => 150,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('TiposDocumentos', array(
             'local' => 'idtipodoc',
             'foreign' => 'idtipodoc'));

        $this->hasOne('Paises', array(
             'local' => 'idnacionalidad',
             'foreign' => 'idpais'));

        $this->hasOne('Ciudades', array(
             'local' => 'idciudadnac',
             'foreign' => 'idciudad'));

        $this->hasOne('Sexo', array(
             'local' => 'idsexo',
             'foreign' => 'idsexo'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $fzblameable0 = new Doctrine_Template_fzblameable();
        $this->actAs($timestampable0);
        $this->actAs($fzblameable0);
    }
}