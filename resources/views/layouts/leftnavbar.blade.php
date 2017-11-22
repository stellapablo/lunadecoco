<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                <!-- /input-group -->
            </li>
            <li class="active">
                <a href="#" class="waves-effect ">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="hide-menu"> Productos
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ url('productos/create') }}"> Nuevo</a> </li>
                    <li> <a href="{{ url('productos') }}">Listado</a> </li>
                </ul>
            </li>
            <li class="active">
                <a href="{{ url('compras') }}" class="waves-effect ">
                    <i class="fa fa-delicious"></i>
                    <span class="hide-menu"> Pedidos
                    <span class="fa arrow"></span>
                </a>
            </li>
        </ul>
    </div>
</div>