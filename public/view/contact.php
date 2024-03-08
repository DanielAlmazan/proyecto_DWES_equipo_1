<?php
	session_start();
	require_once("header.php");
?>

<!-- Principal Content Start -->
   <div id="contact">
   	  <div class="container">
   	    <div id="contactForm" class="col-xs-12 col-sm-8 col-sm-push-2">
       	   <h1>CONTÁCTANOS</h1>
       	   <hr>
       	   <p>¿Quieres preguntarnos algo? Usa nuestro formulario.</p>
	       <form class="form-horizontal">
	       	  <div class="form-group">
	       	  	<div class="col-xs-6">
	       	  	    <label class="label-control">Nombre(s)
	       	  		    <input class="form-control" type="text" name="name">
                    </label>
	       	  	</div>
	       	  	<div class="col-xs-6">
	       	  	    <label class="label-control">Apellido(s)
	       	  		    <input class="form-control" type="text" name="surnames">
                    </label>
	       	  	</div>
	       	  </div>
	       	  <div class="form-group">
	       	  	<div class="col-xs-12">
	       	  		<label class="label-control">Email
	       	  		    <input class="form-control" type="text" name="email">
                    </label>
	       	  	</div>
	       	  </div>
	       	  <div class="form-group">
	       	  	<div class="col-xs-12">
	       	  		<label class="label-control">Asunto
	       	  		    <input class="form-control" type="text" name="subject">
                    </label>
	       	  	</div>
	       	  </div>
	       	  <div class="form-group">
	       	  	<div class="col-xs-12">
	       	  		<label class="label-control">Mensaje
	       	  		    <textarea class="form-control" name="message"></textarea>
                    </label>
	       	  		<button class="pull-right btn btn-lg sr-button" type="submit">Enviar</button>
	       	  	</div>
	       	  </div>
	       </form>
	    </div>   
   	  </div>
   </div>
<!-- Principal Content Start -->

<?php
    require_once('footer.php');
?>