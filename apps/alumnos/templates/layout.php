<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>A.L.C.E.C.</title>
  <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    
    <?php use_stylesheet('jquery-ui-1.8.20.custom.css') ?>
    <?php use_stylesheet('menu.css') ?>
    <?php use_stylesheet('ui.jqgrid.css') ?>   
    <?php use_stylesheet('jquery.ui.timepicker.css') ?>
    <?php use_stylesheet('jquery.tablescroll.css') ?>

    <?php use_stylesheet('style.css') ?>
    
    <?php //use_javascript('webcam.js') ?>       
    <?php use_javascript('hoverIntent.js') ?>
	<?php use_javascript('jquery.validator.js') ?>      
    <?php use_javascript('grid.locale-es.js') ?>
    <?php use_javascript('jquery.jqGrid.min.js') ?>
    <?php use_javascript('tiny_mce/tiny_mce.js') ?>    
    <?php use_javascript('jquery.ui.timepicker.js') ?>
    <?php use_javascript('jquery.tablescroll.js') ?>
    <?php use_javascript('jquery-1.7.min.js') ?>
    <?php use_javascript('jquery.jcarousel.js') ?>
    <?php use_javascript('DD_belatedPNG-min.js') ?>
    <?php use_javascript('jquery.maskedinput-1.2.2.min.js') ?>
   
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>

</head>
<body>
<?php
	$autenticated =false;
	if ($sf_user->isAuthenticated()) { 
	    $esalumno = false;
	    $autenticated =true;
	    $credencial = '';
		$arrCredenciales = array();
		foreach ($sf_user->getCredentials() as $credencial) {
			array_push($arrCredenciales, $credencial); 
		}
		$sis=$sf_user->getGuardUser()->obtenerSistemas();
		$sf_user->setAttribute('idsede',$sf_user->getProfile()->getIdsede());
	}	
?>

	<div class="shell">
		<!-- Header -->
		<div id="header">
			<div class="cl"></div>
			<!-- Logo -->
			<img alt="Smiley face" height="142" width="940" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/header.png">

			<?php if ($autenticated){ ?>
			<p align="right"><?php echo '<b>Usuario:</b> '.$sf_user->getGuardUser()->getUsername(); ?> </p>
			<?php } ?>
			
		
			<!-- END Top Navigation -->	
		</div>
		<!-- END Header -->
		<!-- Navigation -->
		<div id="navigation">
			<ul>
				<li>
					<a title="Profesionales" href="<?php echo url_for('ingreso/index') ?>"><span class="sep-left"></span>Inicio<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Profesionales" href="<?php echo url_for('informes/socios') ?>"><span class="sep-left"></span>Socios<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Profesionales" href="<?php echo url_for('personas/buscarcobrador') ?>"><span class="sep-left"></span>Cobradores<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Estadísticas" href="<?php echo url_for('informes/estadisticas') ?>"><span class="sep-left"></span>Estadísticas<span class="sep-right"></span></a>
					<div class="dd">
						<ul>
							<li><a title="Autoridades" href="<?php echo url_for('graficos/nuevosinscriptos') ?>"><span class="sep-left"></span>Evolución de Socios</a></li>
							<li><a title="Historia" href="<?php echo url_for('graficos/nifranjaetareaxcarrera') ?>"><span class="sep-left"></span>Evolución de Ingresos</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a title="Resumen Cob." href="<?php echo url_for('informes/cobradores') ?>"><span class="sep-left"></span>Resumen Cob.<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Ubicacion" href="<?php echo url_for('ingreso/ubicacion') ?>"><span class="sep-left"></span>Ubicación<span class="sep-right"></span></a>
				</li>
			</ul>
			<div class="cl"></div>
		</div>
		<!-- END Navigation -->
		<!-- Main  -->
		<div id="main">
			<!-- Slider -->
			<!-- <div id="slider-holder">				
				
			</div> -->
			<!-- END Slider -->

            <!-- Content -->
			<div id="content">				
				 <?php echo $sf_content; ?>
			</div>
			<!-- ЕND Content  -->
			<!-- Sidebar -->
			<?php if ($autenticated){ ?>
					<div id="sidebar">
						<div class="box">
							<h2>Gestión General</h2>
							<ul>
							    <?php   if ($autenticated){
							                if ($sf_user->getGuardUser()->getIsSuperAdmin()) {
							    	            echo '<li>'.link_to('Usuarios', 'sf_guard_user').'</li>' ; 
							    	        } 
							    	    } ?>   
								<?php echo '<li>'.link_to('Socios', 'personas/new').'</li>' ; ?>
								<?php echo '<li>'.link_to('Cobradores', 'personas/newcobrador').'</li>' ; ?>
								<?php echo '<li>'.link_to('Nuevos Recibos', 'personas/generarrecibos').'</li>' ; ?>
								<?php echo '<li>'.link_to('Imprimir Recibos', 'personas/gestionrecibosgenerados').'</li>' ; ?>
								<?php echo '<li>'.link_to('Gestión Cobros', 'personas/gestioncobros').'</li>' ; ?>
								<?php echo '<li>'.link_to('Gestión Precios', 'personas/actualizarprecios').'</li>' ; ?>
								<?php echo '<li>'.link_to('Salir', 'sf_guard_signout').'</li>' ; ?>
							</ul>
						</div>
					</div>	
			<?php } else { ?>	
				     <div id="sidebar">

				        <div class="box" style="width=200px"><br></div>	
				        
					    <div class="box" style="background-color:#7dbf0d;width=200px">
								<p style="text-align:center;color:#ffffff;font-weight:bold"><a style="text-align:left;color:#ffffff;font-weight:bold" href="<?php echo url_for('guard/login') ?>">Administrador</a></p>
						</div>
						<div class="box" style="width=200px">
							<a  href="<?php echo url_for('guard/login') ?>"><img alt="Smiley face"  src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/login.png"></a>
						</div>
                        <br>
						
					
					</div>	 
			<?php } ?>	
			<!-- END Sidebar -->
			<div class="cl"></div>
			<!-- Feartured Products -->
			<div class="products featured">
			</div>
			<!-- END Featured Products -->			
			<!-- Footer  -->
			<div id="footer">
				<div id="footer-bottom">
					<p style="color:black;">&copy;Copyright  A.L.C.E.C. Diseñado por <a style="color:black;" href="#">C.del U.</a></p>
				</div>
			</div>
			<!-- END Footer -->
		</div>
		<!-- END Main -->
	</div>	
</body>
</html>