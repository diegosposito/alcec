<?php

/**
 * AluMatTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AluMatTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AluMatTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('AluMat');
    }
    
    // Obtiene el objeto AluMat buscado
  	public static function getAluMat($idalumno,$idcatedra,$estado)
 	{
 		$q = Doctrine_Query::create()
	  		->select('*')
	 		->from('AluMat')		
	    	->where('idalumno = '.$idalumno)
	    	->andWhere('idestadomateria = '.$estado)
	    	->andWhere('idcatedra = '.$idcatedra)
 			->orderBy('fecha DESC, id DESC');
	    	
		return $q->fetchOne();
    }
    
    // Obtiene el ultimo objeto AluMat
    public static function getUltimaFecha($idalumno)
    {
    	$q = Doctrine_Query::create()
    		->select('*')
    		->from('AluMat')
    		->where('idalumno = '.$idalumno)
    		->orderBy('fecha DESC, id DESC');
    
    	return $q->fetchOne();
    }
        
    // Obtiene el ultimo objeto AluMat
    public static function getUltimoEstado($idalumno,$idcatedra)
    {
    	$q = Doctrine_Query::create()
    		->select('*')
    		->from('AluMat')
    		->where('idalumno = '.$idalumno)
    		->andWhere('idcatedra = '.$idcatedra)
    		->orderBy('fecha DESC, id DESC');
    
    	return $q->fetchOne();
    }    
    
    // Obtiene si el alumno aprobo la materia
    public static function tieneAprobado($idalumno,$idmateriaplan)
    {
    	$q = Doctrine_Query::create()
    		->select('am.*')
    		->from('AluMat am')
    		->innerjoin('am.Catedras ca on am.idcatedra=ca.idcatedra')
    		->where('am.idalumno = '.$idalumno)
    		->andWhere('ca.idmateriaplan = '.$idmateriaplan)
    		->andWhere('am.idestadomateria = 9')
    		->orderBy('am.fecha DESC, am.id DESC');
    
    	return $q->fetchOne();
    }    
    
    // Obtiene si el alumno esta regular a la materia
    public static function tieneRegular($idalumno,$idmateriaplan)
    {
    	$fechaActual = date('Y-m-d');
    	
    	$q = Doctrine_Query::create()
    		->select('am.*')
    		->from('AluMat am')
    		->innerjoin('am.Catedras ca on am.idcatedra=ca.idcatedra')
    		->where('am.idalumno = '.$idalumno)
    		->andWhere('ca.idmateriaplan = '.$idmateriaplan)

    		->orderBy('am.fecha DESC, am.id DESC')
    		->fetchOne();

		$fechaVence = date("Y-m-d", strtotime($q['fechavencimiento']));
		
		if ($fechaVence  <= $fechaActual and $q['idestadomateria']==3) {
			$resultado = 1;    		
    	} else {
    		$resultado = 0;
    	}
    	
    	return $resultado;
    }
    
    // Obtiene el ultimo objeto AluMat
    public static function getUltimoEstadoPre($idpersona,$idcatedra)
    {
    	$q = Doctrine_Query::create()
    		->select('am.*')
    		->from('AluMat am')
    		->innerjoin('am.Alumnos al ON am.idalumno=al.idalumno')
    		->where('al.idpersona = '.$idpersona)
    		->andWhere('idcatedra = '.$idcatedra)
    		->orderBy('am.id DESC');
    
    	return $q->fetchOne();
    }    

    // Obtiene las materias cursando de un alumno
	public static function getMateriasCursando($idalumno)
 	{
		$arreglo = array();

		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
    		SELECT co.*
   			FROM (
   				SELECT * FROM (
				    SELECT *
				    FROM alu_mat
				    ORDER BY id DESC, fecha DESC
				) AS eah
				GROUP BY eah.idalumno, eah.idmateria
   			) AS am
			INNER JOIN comisiones co ON am.idcomision=co.idcomision
			INNER JOIN catedras ca ON co.idcatedra=ca.idcatedra
			INNER JOIN materias_planes mp ON ca.idmateriaplan=mp.idmateriaplan
    		INNER JOIN alumnos al ON am.idalumno=al.idalumno
    		INNER JOIN personas pe ON al.idpersona=pe.idpersona
    		WHERE
    			am.idalumno = ".$idalumno."
    			AND am.idestadomateria=1
 			ORDER BY mp.anodecursada ASC, mp.orden ASC
    	");
		
		foreach($q as $item) {
			$oComision = Doctrine_Core::getTable('Comisiones')->find($item['idcomision']);
			//$arreglo[$oComision->getIdcomision()] = $oComision;
			$arreglo[$oComision->getIdcatedra()] = $oComision;
		}
	
		return $arreglo;
    }

    // Obtiene las materias cursando de un alumno
	public static function getCantidadMateriasCursando($idalumno)
 	{
 		$q = Doctrine_Query::create()
 			->select('count(am.id) as cantidad, max(am.fecha) as ultimafecha')
	 		->from('AluMat am')
	    	->where('am.idalumno = '.$idalumno)
			->andWhere('am.idestadomateria = 1')
	    	->execute();

		return $q;
    }

    // Obtiene los alumnos cursando a una materia
    public static function getAlumnosCursandoPre($idcomision)
    {
    	$arreglo = array();
    	
    	$idcicloactual = Doctrine_Core::getTable('CiclosLectivos')->getIdCicloLectivoActual();
    	
		// Buscar si hay cupo en la comision
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
			SELECT DISTINCT * 
				FROM alu_mat AM 
				INNER JOIN alumnos AL ON AM.idalumno=AL.idalumno
				INNER JOIN personas PE ON AL.idpersona=PE.idpersona
				WHERE
					AM.idestadomateria=1 
					AND AM.idcomision = ".$idcomision."
					AND AL.idciclolectivo=".$idcicloactual."
				ORDER BY PE.apellido ASC, PE.nombre ASC
		");

    	// Obtiene la comision
    	$oComision = Doctrine_Core::getTable('Comisiones')->find($idcomision);
    
    	//por cada alumno obtenido verifico que el ultimo estado sea cursando
    	foreach($q as $item) {
    		$oAluMat = self::getUltimoEstado($item['idalumno'],$oComision->getCatedras()->getIdcatedra());
    		if ($oAluMat->getIdestadomateria()==1) {
    			// si el ultimo estado es cursando de alumno lo agrego al arreglos
    			if ($oAluMat->getIdcomision()==$idcomision) {
    				$oAlumno = Doctrine_Core::getTable('Alumnos')->find($item['idalumno']);
    				$arreglo[$item['idalumno']] = $oAlumno;
    			}
    		}
    	}
    
    	return $arreglo;
    }
    
    
    // Obtiene los alumnos cursando a una materia
    public static function getCantidadAlumnosCursando($idcomision)
    {
    	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
    		SELECT COUNT(*) as cantidad
    		FROM alu_mat am
   			INNER JOIN (
   				SELECT * FROM (
				    SELECT *
				    FROM estados_alumno_historial
				    ORDER BY fecha DESC, id DESC
				) AS eah
				GROUP BY eah.idalumno
   			) AS ea ON am.idalumno = ea.idalumno
    		INNER JOIN alumnos al ON am.idalumno=al.idalumno
    		INNER JOIN personas pe ON al.idpersona=pe.idpersona
    		WHERE
    			am.idcomision = ".$idcomision."
 				AND ea.idestadoalumno=1
    			AND am.idestadomateria=1 
 			ORDER BY pe.apellido ASC, pe.nombre ASC
    	");
    	
		return $q[0]['cantidad'];
    }
        

    // Obtiene los alumnos cursando a una materia
  	public static function getAlumnosCursando($idcomision)
 	{
	    $arreglo = array();
		    
	    $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc("
    			SELECT am.*
    			FROM alu_mat am
   				INNER JOIN (
   					SELECT * FROM (
					    SELECT *
					    FROM estados_alumno_historial
					    ORDER BY fecha DESC, id DESC
					) AS eah
					GROUP BY eah.idalumno
   				) AS ea ON am.idalumno = ea.idalumno
    			INNER JOIN alumnos al ON am.idalumno=al.idalumno
    			INNER JOIN personas pe ON al.idpersona=pe.idpersona
    			WHERE
    				am.idcomision = ".$idcomision."
 					AND ea.idestadoalumno=1
 				ORDER BY pe.apellido ASC, pe.nombre ASC
    		");	

	    // Obtiene la comision
		$oComision = Doctrine_Core::getTable('Comisiones')->find($idcomision);
	    	
		//por cada alumno obtenido verifico que el ultimo estado sea cursando
		foreach($q as $item) {		
			$oAluMat = self::getUltimoEstado($item['idalumno'],$oComision->getCatedras()->getIdcatedra());
			if ($oAluMat->getIdestadomateria()==1) {
				// si el ultimo estado es cursando de alumno lo agrego al arreglos
				if ($oAluMat->getIdcomision()==$idcomision) {
					$oAlumno = Doctrine_Core::getTable('Alumnos')->find($item['idalumno']);
					$arreglo[$item['idalumno']] = $oAlumno;
				}
			}			
		} 

		return $arreglo;
    }


    // Obtiene los alumnos cursando a una materia
  	public static function getAlumnosRegulares($idcomision)
 	{
	    $arreglo = array();
		
	    $q = Doctrine_Query::create()
	  		->select('am.*')
	 		->from('AluMat am')	
	 		->innerjoin('am.Alumnos al on am.idalumno=al.idalumno')
	 		->innerjoin('al.Personas pe on al.idpersona=pe.idpersona')	
	    	->where('am.idestadomateria = 3')
	    	->andWhere('am.fecha > "2015-01-01" ')
	    	->andWhere('am.idcomision = '.$idcomision)
	    	->orderBy('pe.apellido ASC, pe.nombre ASC')
	    	->execute();

	    // Obtiene la comision
		$oComision = Doctrine_Core::getTable('Comisiones')->find($idcomision);
	    	
		//por cada alumno obtenido verifico que el ultimo estado sea cursando
		foreach($q as $item) {		
			$oAluMat = self::getUltimoEstado($item->getIdalumno(),$oComision->getCatedras()->getIdcatedra());
			//if ($oAluMat->getIdestadomateria()==3) {
				// si el ultimo estado es cursando de alumno lo agrego al arreglos
				if ($oAluMat->getIdcomision()==$idcomision) {
					$arreglo[$item->getIdalumno()] = $item->getAlumnos();
				}
			//}			
		} 

	return $arreglo;
    }

        
    // Obtiene los alumnos activos a una comision
  	public static function getAlumnosActivos($idcomision)
 	{
	    $arreglo = array();
 		$q = Doctrine_Query::create()
	  		->select('am.*')
	 		->from('AluMat am')		
	 		->innerJoin('am.Alumnos al on am.idalumno=al.idalumno')
	 		->innerJoin('al.Personas pe on al.idpersona=pe.idpersona')
	    	->where('am.idcomision = '.$idcomision)
	    	->orderBy('pe.apellido ASC, pe.nombre ASC')
	    	->execute();

		//por cada alumno obtenido verifico que el ultimo estado sea cursando
		foreach($q as $item) {
			$arreglo[$item->getIdalumno()]=$item->getAlumnos();
		} 

		return $arreglo;
    } 

    // Obtiene los alumnos activos a una comision
  	public static function getAlumnosActivosRecarga($idcomision)
 	{
	    $arreglo = array();
 		$q = Doctrine_Query::create()
	  		->select('a.*')
	 		->from('Alumnos a')
			->innerJoin('PlanesEstudios pe on pe.idplanestudio=a.idplanestudio')		
			->innerJoin('MateriasPlanes mp on pe.idplanestudio=mp.idplanestudio')	
			->innerJoin('Catedras ca on ca.idmateriaplan=mp.idmateriaplan')	
			->innerJoin('Comisiones co on ca.idcomision=co.idplanestudio')
	    	->where('co.idcomision = '.$idcomision)
	    	->execute();

		//por cada alumno obtenido verifico que el ultimo estado sea cursando
		foreach($q as $item) {
			$arreglo[$item->getIdalumno()]=$item->getAlumnos();
		} 

		return $arreglo;
    } 
       
	public static function getVefificarUltimoEstado($idalumno,$idmateria,$idestado) {
		$q = Doctrine_Query::create()
	  		->select('am.idcatedra as id')
	 		->from('AluMat AS am')
	 		->innerjoin('am.Catedras ca on am.idcatedra=ca.idcatedra')
	 		->innerjoin('ca.MateriasPlanes mp on ca.idmateriaplan=mp.idmateriaplan')
	    	->where('am.idalumno = '.$idalumno)
	    	->andWhere('mp.idmateria = '.$idmateria)
	    	->andWhere('am.idestadomateria = '.$idestado)
	    	->andWhere('am.id=(
	    				SELECT AluMat.id 
	    				FROM AluMat 
	    				WHERE AluMat.idalumno = '.$idalumno.'
	    				AND AluMat.idcatedra = Catedras.idcatedra
						AND Catedras.idmateriaplan = MateriasPlanes.idmateriaplan 
	    				AND MateriasPlanes.idmateria = '.$idmateria.'
	    				ORDER BY AluMat.fecha DESC, AluMat.id DESC
	    				LIMIT 1)')
	    	->orderBy('am.fecha DESC, am.id DESC')
	    	->execute();

  	    if (isset($q)) {
	 		foreach ($q as $item) {
				return 1;
			}
	     } else {
			return 0;
	     }
	}    
	
    // parameters: idalumno, idplanestudio, situacion  (C o R)
    public static function getAlumnosPromocionables($idcomision, $situacion=null, $idalumno=null)
    {
        $resultado = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc(
        "SELECT am2.idcatedra as idcatedra, am2.idalumno as idalumno, 
            COUNT(DISTINCT IF(cor.Condicion ='R' and cor.idmateriaplan<>cor.idmateriaplanc,cor.idmateriaplanc,NULL)) AS cantcorrelatr, 
            COUNT(DISTINCT IF(am.idestadomateria=3 AND cor.Condicion ='R' and cor.idmateriaplan<>cor.idmateriaplanc, cor.idmateriaplanc,NULL)) cantcorrelatreg,
            COUNT(DISTINCT IF(cor.Condicion ='A',cor.idmateriaplanc,NULL)) AS cantcorrelata, 
            COUNT(DISTINCT IF(am.idestadomateria=9 AND cor.Condicion ='A', cor.idmateriaplanc,NULL)) cantcorrelatrend,
            COUNT(DISTINCT IF(am2.idestadomateria=9, am2.idcatedra,NULL)) esta_aprobada,
            COUNT(DISTINCT IF(cor.Condicion ='E', am2.idcatedra,NULL)) exenta  
            FROM alu_mat am2 
            JOIN catedras cat ON am2.idcatedra = cat.idcatedra
            JOIN correlatividades cor ON cat.idmateriaplan = cor.idmateriaplan
            JOIN catedras cat2 ON cor.idmateriaplanc = cat2.idmateriaplan
            LEFT JOIN alu_mat am on cat2.idcatedra = am.idcatedra AND am2.idalumno = am.idalumno
            JOIN alumnos al on am2.idalumno = al.idalumno
   			INNER JOIN ( 
   						SELECT * FROM (
						    SELECT * 
						    FROM alu_mat
						    WHERE idcomision= ".$idcomision."
						    ORDER BY fecha DESC, id DESC
						) AS am
						GROUP BY am.idalumno, am.idcatedra
   					) AS am3 ON al.idalumno = am3.idalumno                 
            JOIN personas pe on al.idpersona = pe.idpersona
            WHERE 
            cor.situacion= '".$situacion."' AND am2.idcomision= ".$idcomision." AND am3.idestadomateria=1
            GROUP BY am2.idcatedra, am2.idalumno
            HAVING (cantcorrelatr = cantcorrelatreg AND cantcorrelata= cantcorrelatrend OR exenta=1) AND esta_aprobada=0
            ORDER BY pe.apellido ASC, pe.nombre ASC;"
        );
        
        return $resultado;              
    }   	
}
