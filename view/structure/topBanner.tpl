<div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
    <div class="conjtainer">
        <!-- Menu button for smallar screens -->
        <div class="navbar-header">
            <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span>Sesión</span>
            </button>
            <!-- Site name for smallar screens -->
            <a href="#" class="navbar-brand hidden-lg"><img src="{$imgDir}logos/min-perucatolica.png" width="180px" /></a>
        </div>
        <!-- Navigation starts -->
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">         
        <!-- Links -->
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown pull-right">            
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-user"></i> {$sessionUsuario} <b class="caret"></b>              
                    </a>
                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu">
                        <li><a href="miperfil.php"><i class="fa fa-user"></i> Perfil</a></li>
                        <li><a href="javascript:logOut();"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
                    </ul>
               </li>
            </ul>
        </nav>
    </div>
</div>