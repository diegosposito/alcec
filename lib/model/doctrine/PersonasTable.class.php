<?php

/**
 * PersonasTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PersonasTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PersonasTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Personas');
    }

  // Busca la persona
  public static function buscarPersona($tipo, $criterio) {
		$where="";
    	if($tipo!=""){
			$where = " AND p.idtipodoc = ".$tipo;
		}
    	$q = Doctrine_Query::create()
	  		->select("*")
	 		->from("Personas p")
	 		->where("p.nrodoc = ".$criterio.$where)
	    	->fetchOne();

        return $q;
    }

    // Obtener designaciones por persona, filtrando tambien por area y sede
    public static function obtenerRecibosAGenerar($idmes, $idanio)
    {
        if($idmes<10)
            $mes = "0".$idmes;

        $fecharecibo = $idanio."-".$mes."-01";

        $sql ="SELECT per.idpersona, per.nombre, per.apellido, per.monto, mc.mes, '".$fecharecibo."' AS fecha, '".$idanio."' AS anio
        FROM
        personas per JOIN meses_cobro mc ON per.idpersona = mc.idpersona
        LEFT JOIN recibos_generados rg ON per.idpersona = rg.idpersona AND mc.mes = rg.mes AND ".$idanio." = rg.anio AND rg.estado <> 2
        WHERE per.socio AND per.activo AND mc.mes = ".$idmes." AND rg.id IS NULL ORDER BY per.apellido;  ";

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);

        return $q;
    }

    // Obtener designaciones por persona, filtrando tambien por area y sede
    public static function obtenerSociosporprecio($precio)
    {
        $sql ="SELECT per.idpersona, if(per.voluntario,'Voluntario','') as voluntario, per.nombre, per.apellido, per.monto
        FROM
        personas per
        WHERE per.socio AND per.monto = ".$precio." ORDER BY per.voluntario DESC, per.apellido ASC;  ";

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);

        return $q;
    }

    // Obtener recibos por estado
    public static function obtenerRecibosPorEstado($idestado, $idcobrador=null, $idmes=null, $idanio=null)
    {
        $sql ="SELECT rg.id, per.idpersona, per.apellido, per.nombre, CONCAT(per.apellido, ', ', per.nombre) as socio, rg.mes, rg.anio, rg.mesanio,
                per2.idpersona as idcobrador, CONCAT(per2.apellido, ', ', per2.nombre) as cobrador, rg.monto, rg.estado
                FROM recibos_generados rg
                JOIN personas per ON rg.idpersona = per.idpersona
                LEFT JOIN personas per2 ON rg.idcobrador = per2.idpersona
                WHERE rg.estado = ".$idestado." ";

        if ($idcobrador <> NULL){
          $sql .=  " AND rg.idcobrador = ".$idcobrador." ";
        }
        if ($idmes <> NULL){
          $sql .=  " AND rg.mes = ".$idmes." ";
        }
        if ($idanio <> NULL){
          $sql .=  " AND rg.anio = ".$idanio." ";
        }

        $sql .=  " ORDER BY per.apellido; ";

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);

        return $q;
    }

    // Obtener recibos por estado
    public static function obtenerPadronSocios($idcobrador='', $idmodopago='', $idactivo='')
    {
        $sql ="SELECT per.idpersona, per.apellido, per.nombre, per.email, per.direccion, per.telefono, per.numerodoc, 
              CASE
              WHEN meses.cantidad =1 THEN 'ANUAL'
              WHEN meses.cantidad =4 THEN 'TRIMESTRAL'
              WHEN meses.cantidad = 2 THEN 'SEMESTRAL'
              WHEN meses.cantidad =12 THEN 'MENSUAL'
             END as tipopago, per.monto
              FROM personas per
                LEFT JOIN (SELECT idpersona, COUNT(DISTINCT(id)) as cantidad FROM meses_cobro GROUP BY idpersona) as meses ON per.idpersona =meses.idpersona
                WHERE per.socio ";

        if ($idcobrador <> ""){
          $sql .=  " AND per.idcobrador = ".$idcobrador." ";
        }

        if ($idmodopago <> ""){
          $sql .=  " AND meses.cantidad = ".$idmodopago." ";
        }

        if ($idactivo == "1"){
          $sql .=  " AND per.activo = 1 ";
        } 
        else 
        {
          $sql .=  " ";
        }


        $sql .=  " ORDER BY per.apellido; ";

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);

        return $q;
    }

    // crear recibos de personas seleccionadas
    public static function obtenerRecibosGeneradosPorIds($idestado, $idcobrador=null, $idmes=null, $idanio=null, $arrIdRecibosGenerados)
    {

        // Definir elemenos para filtrar por IN
        $datos=''; $cantidad=0;
        if ( count($arrIdRecibosGenerados)>0 ){
            foreach($arrIdRecibosGenerados as $info)
                $datos .= $info.', ';

            $datos = substr($datos, 0, strlen($datos)-2);
        }

        $sql ="SELECT rg.id, per.idpersona, per.apellido, per.nombre, CONCAT(per.apellido, ', ', per.nombre) as socio, rg.mes, rg.anio, rg.mesanio,
                per2.idpersona as idcobrador, CONCAT(per2.apellido, ', ', per2.nombre) as cobrador, rg.monto, rg.estado, per.direccioncobro,
                CASE WHEN meses.cantidad =1 THEN 'ANUAL' WHEN meses.cantidad =4 THEN 'TRIMESTRAL' WHEN meses.cantidad = 2 THEN 'SEMESTRAL' WHEN meses.cantidad =12 THEN 'MENSUAL' END as tipopago
                FROM recibos_generados rg
                JOIN personas per ON rg.idpersona = per.idpersona
                JOIN (SELECT idpersona, COUNT(DISTINCT(id)) as cantidad FROM meses_cobro GROUP BY idpersona) as meses ON per.idpersona =meses.idpersona
                LEFT JOIN personas per2 ON rg.idcobrador = per2.idpersona
                WHERE rg.estado = ".$idestado." ";

        if ($idcobrador <> NULL){
          $sql .=  " AND rg.idcobrador = ".$idcobrador." ";
        }
        if ($idmes <> NULL){
          $sql .=  " AND rg.mes = ".$idmes." ";
        }
        if ($idanio <> NULL){
          $sql .=  " AND rg.anio = ".$idanio." ";
        }
        if ($datos <> ''){
          $sql .=  " AND rg.id NOT IN (".$datos.") ";
        }

        $sql .=  " ORDER BY per.apellido; ";

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($sql);

        return $q;

    }

    // crear recibos de personas seleccionadas
    public static function actualizarRecibosACobradosPorIds($idestado, $idcobrador=null, $idmes=null, $idanio=null, $arrIdRecibosGenerados)
    {

        // Definir elemenos para filtrar por IN
        $datos=''; $cantidad=0;

        if ( count($arrIdRecibosGenerados)>0 ){
            foreach($arrIdRecibosGenerados as $info)
                $datos .= $info.', ';

            $datos = substr($datos, 0, strlen($datos)-2);

         }

        $sql ="UPDATE recibos_generados rg set rg.estado = 3
               WHERE rg.estado = ".$idestado." ";

        if ($idcobrador <> NULL){
          $sql .=  " AND rg.idcobrador = ".$idcobrador." ";
        }
         if ($idmes <> NULL){
          $sql .=  " AND rg.mes = ".$idmes." ";
        }
        if ($idanio <> NULL){
          $sql .=  " AND rg.anio = ".$idanio." ";
        }
        if ($datos <> ''){
          $sql .=  " AND rg.id NOT IN (".$datos.") ";
        }
        $sql .=  ";";

        $q = Doctrine_Manager::getInstance()->getCurrentConnection();

        return $q->execute($sql);
    }


    // crear recibos de personas seleccionadas
    public static function crearRecibos($arrPersonas, $idmes, $idanio)
    {



        // Definir elemenos para filtrar por IN
        $datos=''; $cantidad=0;
        if ( count($arrPersonas)>0 ){

            foreach($arrPersonas as $info)
                $datos .= $info.', ';

            $datos = substr($datos, 0, strlen($datos)-2);

        }

        // actualizar designaciones
        $sql = "INSERT INTO recibos_generados SELECT null, per.idpersona, per.idcobrador, ".$idmes." as mes, ".$idanio." as anio, CONCAT(m.descripcion,' de ', ".$idanio.") as detalle, per.monto, now(), now(),1,1,1
        FROM
            personas per
              JOIN meses m ON m.mes = ".$idmes."
              JOIN meses_cobro mc ON per.idpersona = mc.idpersona
              LEFT JOIN recibos_generados rg ON per.idpersona = rg.idpersona AND mc.mes = rg.mes AND ".$idanio." = rg.anio AND rg.estado <> 2
            WHERE per.activo AND mc.mes = ".$idmes." AND rg.id IS NULL ";

        if ($datos<>'')
            $sql .= " AND per.idpersona NOT IN (".$datos.") ";


        $q = Doctrine_Manager::getInstance()->getCurrentConnection();

        return $q->execute($sql);
    }

    // crear recibos de personas seleccionadas
    public static function updPreciosSocios($arrPersonas, $precio, $nuevoprecio)
    {



        // Definir elemenos para filtrar por IN
        $datos=''; $cantidad=0;
        if ( count($arrPersonas)>0 ){

            foreach($arrPersonas as $info) 
                $datos .= $info.', ';

            $datos = substr($datos, 0, strlen($datos)-2);

        }

        // actualizar designaciones
        $sql = "UPDATE personas per
                SET per.monto = ".$nuevoprecio.", updated_at=now() 
            WHERE per.socio AND per.monto = ".$precio." ";

        if ($datos<>'')
            $sql .= " AND per.idpersona NOT IN (".$datos.") ";


        $q = Doctrine_Manager::getInstance()->getCurrentConnection();

        return $q->execute($sql);
    }

    // Obtiene todas las carreras asociadas a una persona
	public static function obtenerCarrerasPersona($nrodoc)
	{
		$q = Doctrine_Query::create()
			->select('a.*,pe.*, c.idcarrera as idcarrera, c.nombrereducido as nombrereducido')
			->from("Alumnos a")
			->innerJoin('a.Personas p ON a.idpersona = p.idpersona')
			->innerJoin('a.PlanesEstudios pe ON a.idplanestudio = pe.idplanestudio')
			->innerJoin('pe.Carreras c ON pe.idcarrera = c.idcarrera')
			->where("(p.nrodoc ='".$nrodoc."')")
			->andWhere("c.idtipocarrera <> 5 and c.idtipocarrera <> 6");

		return $q->execute();
	}

    // Obtiene todas las carreras asociadas a una persona
	public static function obtenerCarrerasActivasPersona($nrodoc)
	{
		$q = Doctrine_Query::create()
			->select('a.*,pe.*, c.idcarrera as idcarrera, c.nombrereducido as nombrereducido, pe.activo')
			->from("Alumnos a")
			->innerJoin('a.Personas p ON a.idpersona = p.idpersona')
			->innerJoin('a.PlanesEstudios pe ON a.idplanestudio = pe.idplanestudio')
			->innerJoin('pe.Carreras c ON pe.idcarrera = c.idcarrera')
			->where("(p.nrodoc ='".$nrodoc."')")
			->andWhere("pe.idestadoplan=2")
			->andWhere("c.idtipocarrera <> 5 and c.idtipocarrera <> 6 and c.idtipocarrera <> 2");

		return $q->execute();
	}

   // Obtener profesores por facultad
    public static function obtenerProfesoresxfacultad()
    {
        $idfacultad = Doctrine_Core::getTable('AreasCarrera')->obtenerFacultadxdesignacion();

        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
			SELECT p.idpersona, concat(p.apellido, ', ', p.nombre) as nombre
			FROM personas p
			INNER JOIN profesores pr on p.idpersona = pr.idpersona
			WHERE pr.idfacultad = ".$idfacultad
        );

        return $q;
    }

    // Busca todas los alumnos segun los criterios
    public static function obtenerPersonasnoprofesores($tipocriterio, $criterio)
    {
        $idfacultad = Doctrine_Core::getTable('AreasCarrera')->obtenerFacultadxdesignacion();

        if ($tipocriterio == 1) {
			$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
				SELECT p.idpersona, concat(p.apellido, ', ', p.nombre) as nombre, nrodoc
				FROM personas p
				LEFT JOIN profesores pr on p.idpersona = pr.idpersona
				WHERE (pr.idfacultad is null or pr.idfacultad <> ".$idfacultad.") AND p.apellido LIKE '".$criterio."%'"
        	);
        } else {
			$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
				SELECT p.idpersona, concat(p.apellido, ', ', p.nombre) as nombre, nrodoc
				FROM personas p
				LEFT JOIN profesores pr on p.idpersona = pr.idpersona
				WHERE (pr.idfacultad is null or pr.idfacultad <> ".$idfacultad.") AND p.nrodoc LIKE '".$criterio."%'"
			);
        }

        return $q;
    }

    // Busca todas las personas segun criterios
    public static function obtenerPersonas($tipocriterio, $criterio, $criterio2 = "1")
    {
        if ($tipocriterio == 1) {
			$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
				SELECT p.idpersona, concat(p.apellido, ', ', p.nombre) as nombre, nrodoc, idsexo
				FROM personas p
				WHERE p.apellido LIKE '".$criterio."%'"
        	);
        } else {
			$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
				SELECT p.idpersona, concat(p.apellido, ', ', p.nombre) as nombre, nrodoc, idsexo
				FROM personas p
				WHERE p.nrodoc LIKE '".$criterio."%' AND p.idtipodoc = ".$criterio2." "
        	);
        }

        return $q;
    }

       // Busca todas los alumnos segun los criterios
    public static function obtenerEgresados($tipocriterio, $criterio)
    {
        $criterioa = "WHERE e.idestadoalumno = 3 ";

        if ($tipocriterio == 1) {
            $criterioa .= " AND p.apellido LIKE '".$criterio."%'";
        } else {
            $criterioa .= " AND p.nrodoc LIKE '".$criterio."%'";
        }

        if ($tipocriterio == 1) {
			$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
				SELECT p.idpersona, concat(p.apellido, ', ', p.nombre) as nombre, concat(c.nombre, ' - ', pe.nombre) as carrera, s.nombre as sede, e.fecha as fechaegreso
            	FROM personas p
            	INNER JOIN alumnos a on p.idpersona = a.idpersona
            	INNER JOIN estados_alumno_historial e on a.idalumno = e.idalumno
            	INNER JOIN planes_estudios pe on a.idplanestudio = pe.idplanestudio
            	INNER JOIN carreras c on pe.idCarrera = c.idCarrera
            	INNER JOIN sedes s on a.idsede = s.idsede ".$criterioa." ORDER BY s.idsede, c.idCarrera, p.apellido"
        	);
        } else {
			$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
				SELECT p.idpersona, concat(p.apellido, ', ', p.nombre) as nombre, concat(c.nombre, ' - ', pe.nombre) as carrera, s.nombre as sede, e.fecha as fechaegreso
            	FROM personas p
            	INNER JOIN alumnos a on p.idpersona = a.idpersona
            	INNER JOIN estados_alumno_historial e on a.idalumno = e.idalumno
            	INNER JOIN planes_estudios pe on a.idplanestudio = pe.idplanestudio
            	INNER JOIN carreras c on pe.idCarrera = c.idCarrera
            	INNER JOIN sedes s on a.idsede = s.idsede ".$criterioa." ORDER BY s.idsede, c.idCarrera, p.apellido"
        	);
        }

        return $q;
    }

    // Busca todas los alumnos segun los criterios
    public static function obtenerCobradores()
    {

            $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
                SELECT p.idpersona, p.apellido, p.nombre, concat(p.apellido, ', ', p.nombre) as nombrecompleto, nrodoc
                FROM personas p
                WHERE p.activo AND NOT p.socio ORDER BY p.apellido, p.nombre "
            );

            return $q;
    }

    // Busca todas los precios distintos
    public static function obtenerPreciosdiferentes()
    {

            $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
                SELECT DISTINCT p.monto as monto
                FROM personas p
                WHERE p.activo AND p.socio ORDER BY p.monto "
            );

            return $q;
    }

    // Busca todas los alumnos segun los criterios
    public static function obtenerSocios($idcobrador='')
    {

            if($idcobrador <>''){
                $criterioa = " AND p.idcobrador = ".$idcobrador." ";
            } else {
                $criterioa = "";
            }

            $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
                SELECT p.idpersona, p.apellido, p.nombre, p.created_at, concat(p.apellido, ', ', p.nombre) as nombrecompleto, p.nrodoc, p.fechaingreso, IFNULL(concat(p2.apellido, ', ', p2.nombre),'') as cobrador
                FROM personas p LEFT JOIN personas p2 ON p.idcobrador = p2.idpersona
                WHERE p.socio ".$criterioa." AND p.activo ORDER BY p.apellido, p.nombre  "
            );

            return $q;
    }


       // Total egresados detallado por rango
    public static function detalleEgresadosPorRango($fechadesde, $fechahasta)
    {
        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
			SELECT  s.nombre as sede,
              f.nombre as facultad,
              concat(c.nombre, ' - ', pe.nombre) as carrera,
              concat(p.apellido, ' ', p.nombre) as nombre,
              e.fecha as fechaegreso,
              if(p.idsexo=1, 'M','F') as sexo
            FROM personas p
            INNER JOIN alumnos a on p.idpersona = a.idpersona
            INNER JOIN estados_alumno_historial e on a.idalumno = e.idalumno
            INNER JOIN planes_estudios pe on a.idplanestudio = pe.idplanestudio
            INNER JOIN carreras c on pe.idCarrera = c.idCarrera
            INNER JOIN facultades f on c.idfacultad = f.idFacultad
            INNER JOIN sedes s on a.idsede = s.idsede
            WHERE e.idestadoalumno = 3 AND e.fecha between date('".$fechadesde."') and date('".$fechahasta."')
            ORDER BY s.idsede, f.idFacultad, c.idCarrera, p.apellido"
        );

        return $q;
    }

       //total egresados por rango
    public static function totalEgresadosPorRango($fechadesde, $fechahasta)
    {
        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
			SELECT  s.nombre as sede,
              f.nombre as facultad,
              CONCAT(c.nombre, ' - ', pe.nombre) as carrera,
              COUNT(distinct p.idpersona * CASE WHEN ( p.idsexo=1 ) THEN 1 ELSE null END) as varones,
              COUNT(distinct p.idpersona * CASE WHEN ( p.idsexo=2) THEN 1 ELSE null END) as mujeres,
              COUNT(p.idpersona) as total
            FROM personas p
            INNER JOIN alumnos a on p.idpersona = a.idpersona
            INNER JOIN estados_alumno_historial e on a.idalumno = e.idalumno
            INNER JOIN planes_estudios pe on a.idplanestudio = pe.idplanestudio
            INNER JOIN carreras c on pe.idCarrera = c.idCarrera
            INNER JOIN facultades f on c.idfacultad = f.idFacultad
            INNER JOIN sedes s on a.idsede = s.idsede
            WHERE e.idestadoalumno = 3 AND e.fecha between date('".$fechadesde."') and date('".$fechahasta."')
            GROUP BY s.idsede, f.idfacultad, c.idCarrera
            ORDER BY s.idsede, f.idFacultad, c.idCarrera"
        );
        return $q;
    }
}
