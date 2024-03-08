<?php
	session_start();
    
    if (!empty($_POST['name']) &&
        !empty($_POST['surnames']) &&
        !empty($_POST['email']) &&
        !empty($_POST['subject']) &&
        !empty($_POST['message'])
    ) {
        echo "<div class='alert alert-success'>Mensaje enviado correctamente</div>";
    } else {
        echo "<div class='alert alert-danger'>Por favor, rellena todos los campos</div>";
    }
    
	require_once("header.php");
?>

<!-- Principal Content Start -->
   <div id="contact">
   	  <div class="container">
   	    <div id="contactForm" class="col-xs-12 col-sm-8 col-sm-push-2">
       	   <h1>CONTÁCTANOS</h1>
       	   <hr>
       	   <p>¿Quieres preguntarnos algo? Usa nuestro formulario.</p>
	       <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
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