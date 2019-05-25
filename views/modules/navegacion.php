<script type="text/javascript">
	function salir(){
		window.location.href = "index.php?action=salir"; 
	}
</script>
<?php
//session_start();
if($_SESSION["validar"]=="na"){
?>
<nav>
	<ul>
		
	</ul>
</nav>
<?php
}elseif ($_SESSION["validar"]=="Admin") {
?>
 <h5 class="title">MENU ADMIN</h5>
<ul class="menu js__accordion">
        <li>
          <a class="waves-effect" href="index.php?action=ganancias"><i class="menu-icon fa fa-money"></i><span>Calcular Ganancias</span></a>
        </li>
        <li>
          <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-home"></i><span>Habitaciones</span><span class="menu-arrow fa fa-angle-down"></span></a>
          <ul class="sub-menu js__content">
            <li><a href="index.php?action=registrohab">Registro Habitaciones</a></li>
            <li><a href="index.php?action=habitaciones">Ver Habitaciones</a></li> 
          </ul>
          <!-- /.sub-menu js__content -->
        </li>
        <li>
          <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-users"></i><span>Clientes</span><span class="menu-arrow fa fa-angle-down"></span></a>
          <ul class="sub-menu js__content">
            <li><a href="index.php?action=registrocli">Registro Clientes</a></li>
            <li><a href="index.php?action=clientes">Ver Clientes</a></li> 
          </ul>
          <!-- /.sub-menu js__content -->
        </li>
        <li>
          <a class="waves-effect"  href="index.php?action=salir"   onclick="salir();" ><i class="menu-icon fa fa-sign-out"></i><span>Salir</span></a>
        </li>



</ul>
 

<?php
}elseif ($_SESSION["validar"]=="Recepcionista") {
 
?>
 <h5 class="title">MENU RECEPCIONISTA</h5>
<ul class="menu js__accordion">
        <li>
          <a class="waves-effect" href="index.php?action=registroreserva"><i class="menu-icon fa fa-book"></i><span>Realizar Reserva</span></a>
        </li>
        <li>
          <a class="waves-effect" href="index.php?action=verhabitaciones"><i class="menu-icon fa fa-home"></i><span>Buscar Habitaciones</span></a>
        </li>
        <li>
          <a class="waves-effect" href="index.php?action=verreservas"><i class="menu-icon fa fa-building-o"></i><span>Buscar Reserva</span></a>
        </li>
        <li>
          <a class="waves-effect" href="index.php?action=habitaciones2"><i class="menu-icon fa fa-eye"></i><span>Ver Habitaciones</span></a>
        </li>
         <li>
          <a class="waves-effect" href="index.php?action=reservas2"><i class="menu-icon fa fa-exchange"></i><span>Moficiar/Borrar Reservas</span></a>
        </li>
        <li>
          <a class="waves-effect"  href="index.php?action=salir"   onclick="salir();" ><i class="menu-icon fa fa-sign-out"></i><span>Salir</span></a>
        </li>

</ul>
 

<?php
} 
?>
