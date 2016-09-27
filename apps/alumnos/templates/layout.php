<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>CIRCULO ODONTOLOGICO CONCEPCION DEL URUGUAY</title>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    
    <?php use_stylesheet('jquery-ui-1.8.20.custom.css') ?>
    <?php use_stylesheet('menu.css') ?>
    <?php use_stylesheet('ui.jqgrid.css') ?>   
    <?php use_stylesheet('jquery.ui.timepicker.css') ?>
    <?php use_stylesheet('jquery.tablescroll.css') ?>
    <?php use_stylesheet('superfish.css') ?>
    <?php use_stylesheet('superfish-vertical.css') ?>
    <?php use_stylesheet('superfish-navbar.css') ?>
    <?php use_stylesheet('ddaccordion.css') ?>
    <?php use_stylesheet('style.css') ?>
    <?php use_stylesheet('prettyCheckboxes.css') ?>
    
    <?php //use_javascript('webcam.js') ?>       
    <?php use_javascript('hoverIntent.js') ?>
    <?php use_javascript('superfish.js') ?>        
	<?php use_javascript('jquery.validator.js') ?>      
    <?php use_javascript('grid.locale-es.js') ?>
    <?php use_javascript('jquery.jqGrid.min.js') ?>
    <?php use_javascript('tiny_mce/tiny_mce.js') ?>    
    <?php use_javascript('jquery.ui.timepicker.js') ?>
    <?php use_javascript('jquery.tablescroll.js') ?>
    <?php use_javascript('jquery-1.7.min.js') ?>
    <?php use_javascript('jquery.jcarousel.js') ?>
    <?php use_javascript('DD_belatedPNG-min.js') ?>
    <?php use_javascript('functions.js') ?>
    <?php use_javascript('ddaccordion.js') ?>
 
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <script type="text/javascript">
	// initialise plugins
	jQuery(function(){
		$('ul.sf-menu sf-navbar').superfish({
			pathClass:  'current' 
		});
		
		$('ul.sf-menu sf-vertical').superfish({ 
    		animation: {height:'show'},   // slide-down effect without fade-in
			delay:     1200               // 1.2 second delay on mouseout 
		}); 
	});
</script> 
<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/plus.gif' class='statusicon' />", "<img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
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
					<a title="Profesionales" href="<?php echo url_for('informes/profesionales') ?>"><span class="sep-left"></span>Socios<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Profesionales" href="<?php echo url_for('informes/padronsocios') ?>"><span class="sep-left"></span>Padron Socios<span class="sep-right"></span></a>
				</li>
				<li>
					<a title="Estadísticas" href="#"><span class="sep-left"></span>Estadísticas<span class="sep-right"></span></a>
					<div class="dd">
						<ul>
							<li><a title="Autoridades" href="<?php echo url_for('graficos/nuevosinscriptos') ?>"><span class="sep-left"></span>Evolución de Socios</a></li>
							<li><a title="Historia" href="<?php echo url_for('graficos/nifranjaetareaxcarrera') ?>"><span class="sep-left"></span>Evolución de Ingresos</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a title="Contacto" href="#"><span class="sep-left"></span>Contacto<span class="sep-right"></span></a>
					<div class="dd">
						<ul>
							<li><a title="Ubicacion" href="<?php echo url_for('ingreso/ubicacion') ?>"><span class="sep-left"></span>Ubicación</a></li>
							<li><a title="Concacto" href="<?php echo url_for('ingreso/contacto') ?>"><span class="sep-left"></span>Contacto</a></li>
						</ul>
					</div>
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
								<?php echo '<li>'.link_to('Socios', 'personas/buscar').'</li>' ; ?>
								<?php echo '<li>'.link_to('Cobradores', 'personas/buscarcobrador').'</li>' ; ?>
								<?php echo '<li>'.link_to('Generar Recibos', 'personas/generarrecibos').'</li>' ; ?>
								<?php echo '<li>'.link_to('Gestión de Recibos', 'personas/gestionrecibosgenerados').'</li>' ; ?>
								<?php echo '<li>'.link_to('Gestión Contenido', 'personas/new').'</li>' ; ?>
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
                        <div class="box" style="background-color:#7dbf0d;width=200px">
								<p style="text-align:center;color:#ffffff;font-weight:bold">Circulo Odontologico</p>
						</div>
						<div class="box" style="width=200px">
							<img alt="Smiley face" height="100" width="220" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/cop.jpeg">
						</div>
                        <br>
						<div class="box" style="background-color:#7dbf0d;width=200px">
								<p style="text-align:center;color:#ffffff;font-weight:bold">&nbsp;&nbsp;Saludent</p>
						</div>
						<div class="box" style="width=200px">
							<img alt="Smiley face" height="100" width="220" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/saludent.jpg">
						</div>
                        <br>
                        <div class="box" style="background-color:#7dbf0d;width=200px">
								<p style="text-align:center;color:#ffffff;font-weight:bold">&nbsp;&nbsp;S.O.S.P.E.</p>
						</div>
						<br>
                        <div class="box" style="width=200px">
							<img alt="Smiley face" height="100" width="220" src="<?php echo $sf_request->getRelativeUrlRoot();?>/images/sospe logo.gif">
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