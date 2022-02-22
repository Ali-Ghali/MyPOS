<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ url('/dashboard') }}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">لوحة
                                    التحكم</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">غالي ويب سوفت لادارة نقاط البيع </li>
                    <!-- menu item Elements-->
                    <!-- Categores-->
                    @can('الأقسام')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">

                                <div class="pull-left"><i class="fa fa-list-alt"></i><span
                                        class="right-nav-text">الأقسام</span></div>

                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>

                            <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                                @can('قائمة الأقسام')
                                    <li><a href="{{ route('categories.index') }}">قائمة الاقسام</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    <!-- Products-->
                    @can(' المنتجات')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Products-menu">
                                <div class="pull-left"><i class="fa fa-product-hunt"></i><span
                                        class="right-nav-text">المنتجات</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Products-menu" class="collapse" data-parent="#sidebarnav">
                                @can('قائمة المنتجات')
                                    <li><a href="{{ route('products.index') }}">قائمة المنتجات</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    <!-- Clients-->
                    @can('الزبائن')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Clients-menu">
                                <div class="pull-left"><i class="fa fa-user-circle"></i><span
                                        class="right-nav-text">الزبائن</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Clients-menu" class="collapse" data-parent="#sidebarnav">
                                @can('قائمة الزبائن')
                                    <li><a href="{{ route('clients.index') }}">قائمة الزبائن</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    <!-- Orders-->
                    @can('الطلبات')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Orders-menu">
                                <div class="pull-left"><i class="fa fa-first-order"></i><span
                                        class="right-nav-text">الطلبات</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Orders-menu" class="collapse" data-parent="#sidebarnav">
                                @can('قائمة الطلبات')
                                    <li><a href="{{ route('orders.index') }}">قائمة الطلبات</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    <!-- Users-->
                    @can('المستخدمين')
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-menu">
                                <div class="pull-left"><i class="fa fa-first-order"></i><span
                                        class="right-nav-text">المستخدمين</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="Users-menu" class="collapse" data-parent="#sidebarnav">
                                @can('قائمة المستخدمين')
                                    <li><a href="{{ url('/' . ($page = 'users')) }}">قائمة المستخدمين</a>
                                    </li>
                                @endcan

                                @can('صلاحيات المستخدمين')
                                    <li><a href="{{ url('/' . ($page = 'roles')) }}">صلاحيات المستخدمين</a>
                                    </li>
                                @endcan
                            </ul>

                        </li>
                    @endcan


            </div>
        </div>
    </div>
</div>
<!-- Left Sidebar End-->

<!--=================================
