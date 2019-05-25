 <?php 
 
session_unset(); 
 if (isset($_SESSION['validar'])){
   $_SESSION["validar"] = "na"; 
   
} else{
  $_SESSION["validar"] = "na"; 

}
 ?>
 <form method="post" class="frm-single">
    <div class="inside">
      <div class="title"><strong>Ninja</strong>Admin</div>
      <!-- /.title -->
      <div class="frm-title">Login</div>
      <!-- /.frm-title -->
      <div class="frm-input"><input type="text" placeholder="Username"  id="usuarioIngreso" name="usuarioIngreso" class="frm-inp"><i class="fa fa-user frm-ico"></i></div>
      <!-- /.frm-input -->
      <div class="frm-input"><input type="password" placeholder="Password"  name="passwordIngreso" id="passwordIngreso" class="frm-inp"><i class="fa fa-lock frm-ico"></i></div>
      <!-- /.frm-input -->
      <div class="clearfix margin-bottom-20">
       
      </div>
      <!-- /.clearfix -->
      <button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>
      <div class="row small-spacing">
        
 
      <!-- /.footer -->
    </div>
    <!-- .inside -->
  </form>


 
 

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<?php
if (isset($_SESSION['validar'])){
   $_SESSION["validar"] = "na"; 
} else{
  $_SESSION["validar"] = "na"; 
}
$ingreso = new MvcController();
$ingreso -> ingresoUsuarioController();

if(isset($_GET["action"])){

	if($_GET["action"] == "fallo"){

		echo "Fallo al ingresar";
	
	} 

}

?>