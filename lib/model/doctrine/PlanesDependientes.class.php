<?php

/**
 * PlanesDependientes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sig
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class PlanesDependientes extends BasePlanesDependientes
{
	// Obtener las comisiones de una catedra
	public function getPlanesEstudiosDependiente() {
		$oPlanEstudio = Doctrine_Core::getTable('PlanesEstudios')->find($this->getIdplanestudiod());
   			
		return $oPlanEstudio;
	}  
}
