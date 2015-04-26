<!-- 
perfil
1->administrador
2->alumno
3->administrativo
4->docente
-->
{for $i=0 to 6}
    {if $optionActive eq $i}
    	{$VActive[$i]= 'class="open"'}
    {/if}
{/for}
{if $optionActive neq ''}
<!-- -->
<div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">Menu</a></div>
    <ul id="nav">
    <li {$VActive[0]}><a href="principal.php"><i class="fa fa-home"></i> Principal</a></li>
    {if $sessionIdPerfil eq 1 or $sessionIdPerfil eq 3}  
    <li {$VActive[1]} class="has_sub"><a href=""><i class="fa fa-tasks"></i> Configuración  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a> 
        <ul>
            <li><a href="usuarios.php">Usuarios</a></li>
            <li><a href="carreras.php">Carreras</a></li>
            <li><a href="cursos.php">Cursos</a></li>
            <li><a href="planEstudio.php">Plan de Estudios</a></li>
            <li><a href="seccion.php">Secciones</a></li>
            <li><a href="horarios.php">Horarios</a></li>
            <li><a href="tipoPago.php">Tipo de Pago</a></li>
            <li><a href="modoPago.php">Modo de Pago</a></li>
            <!--<li><a href="docentes.php">Docentes</a></li>-->
        </ul>
    </li>
    {/if}
    <li {$VActive[2]}><a href="miperfil.php"><i class="fa fa-user"></i> Mi Perfil</a></li>
    {if $sessionIdPerfil==1 or $sessionIdPerfil==3}  
    <li {$VActive[3]} class="has_sub"><a href=""><i class="fa fa-file"></i> Inscripciones <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a> 
        <ul>
            <li><a href="fichaInscripcion.php">Ficha Inscripción</a></li>
            <!--<li><a href="inscripciones.php">Lista Inscripciones</a></li>-->
            <!--<li><a href="docentes.php">Docentes</a></li>-->
        </ul>
    </li>
    {/if}
    {if $sessionIdPerfil==1 or $sessionIdPerfil==2 or $sessionIdPerfil==3}  
    <li {$VActive[4]} class="has_sub"><a href=""><i class="fa fa-users"></i> Alumnos <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a> 
        <ul>
            {if $sessionIdPerfil==1 or $sessionIdPerfil==3}
            <li><a href="registrarAlumno.php">Registrar Alumno</a></li>
            <li><a href="alumnos.php">Lista de Alumnos</a></li>
            {/if}
            <li><a href="notas.php">Mis Notas</a></li>
            <li><a href="misPagos.php">Mis Pagos</a></li>
        </ul>
    </li>
    {/if}
    {if $sessionIdPerfil==1 or $sessionIdPerfil==3}  
    <li {$VActive[5]} class="has_sub"><a href=""><i class="fa fa-file"></i> Matriculas  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a> 
        <ul>
            <li><a href="generarInscripcionCarrera.php">Inscribir Alumno</a></li>
            <li><a href="adjuntarArchivos.php">Adjuntar Archivos</a></li>
            <li><a href="generarMatricula.php">Matricular Alumno</a></li>
            <li><a href="pagos.php">Pagos</a></li>
            <li><a href="mantenimientoMatricula.php">Mantenimiento Matricula</a></li>
        </ul>
    </li>
    {/if}
    {if $sessionIdPerfil==1 or $sessionIdPerfil==3 or $sessionIdPerfil==4}  
    <li {$VActive[6]} class="has_sub"><a href=""><i class="fa fa-briefcase"></i> Docentes  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a> 
        <ul>
            {if $sessionIdPerfil==1 or $sessionIdPerfil==3}  
            <li><a href="asignarCursos.php">Asignar Cursos</a></li>
            {/if}
            <li><a href="ingresarNotas.php">Ingresar Notas</a></li>
        </ul>
    </li>
    {/if}
    </ul>
</div>
{/if}