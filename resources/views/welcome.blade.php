<!DOCTYPE html>
<html dir="rtl"lang="ar">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" >
    <meta name="author" >
    <link href="img/logo/logo.png" rel="icon">
    <title>Nihad Talal Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/vendor/fontawesome-free-6.1.1-web/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/ruang-admin.min.css') }}" rel="stylesheet">
   
</head>

<body id="page-top">
    <div id="app">
        
        <div id="wrapper" style="width: 100%;
            position: absolute;
            min-height: 100% !important;
            height: auto;">
            <!-- Sidebar -->
            <nav id="sidebar" dir="ltr"
                v-show="$route.path === '/' || $route.path === '/register' || $route.path==='/forget' ? fasle : true "
                style="display: none;">
                <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" style="@media(max-width: 768px) .sidebar .toggled {width:14rem!important}">
                    <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/" dir="rtl">
                        <div class="sidebar-brand-icon">
                            <img src="{{ asset('backend/img/logo/logo3.png') }}">
                        </div>
                        <div class="sidebar-brand-text mx-3">Nihad Talal</div>
                    </router-link>
                    <hr class="sidebar-divider my-0">
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/home" dir="rtl">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span ><b>{{ trans('messageAr.dashboard') }}</b></span>
                        </router-link>
                    </li>

                    <li class="nav-item " >
                        <router-link class="nav-link" to="/pos" dir="rtl">
                            <i class="fa-solid fa-store"></i>
                            <span>{{ trans('messageAr.pos') }}</span>
                        </router-link>
                    </li>
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        {{ trans('messageAr.features') }}
                    </div>
                    <li class="nav-item" dir="rtl">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
                            <i class="fa-solid fa-user-tie" ></i>
                            <span>{{ trans('messageAr.employees') }}</span>
                        </a>
                        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/store-employee" >{{ trans('messageAr.AddEmployee') }}</router-link>
                                <router-link class="collapse-item" to="/employee" >{{ trans('messageAr.AllEmployee') }}</router-link>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item" dir="rtl">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseBootstrap1" aria-expanded="true" aria-controls="collapseBootstrap1">
                            <i class="fa-solid fa-people-carry-box"></i>
                            <span>{{ trans('messageAr.suppliers') }}</span>
                        </a>
                        <div id="collapseBootstrap1" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/store-supplier">{{ trans('messageAr.AddSupplier') }}</router-link>
                                <router-link class="collapse-item" to="/supplier">{{ trans('messageAr.AllSupplier') }}</router-link>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item" dir="rtl">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseBootstrap2" aria-expanded="true" aria-controls="collapseBootstrap2">
                            <i class="fa-solid fa-network-wired"></i>
                            <span>{{ trans('messageAr.categories') }}</span>
                        </a>
                        <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/store-category">{{ trans('messageAr.AddCategories') }}</router-link>
                                <router-link class="collapse-item" to="/category">{{ trans('messageAr.AllCategories') }}</router-link>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item" dir="rtl">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseBootstrap3" aria-expanded="true" aria-controls="collapseBootstrap3">
                            <i class="fas fa-shopping-basket"></i>
                            <span>{{ trans('messageAr.products') }}</span>
                        </a>
                        <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/store-product">{{ trans('messageAr.AddProduct') }}</router-link>
                                <router-link class="collapse-item" to="/product">{{ trans('messageAr.AllProduct') }}</router-link>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item" dir="rtl">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseBootstrap4" aria-expanded="true" aria-controls="collapseBootstrap4">
                            <i class="fas fa-wallet"></i>
                            <span>{{ trans('messageAr.expense') }}</span>
                        </a>
                        <div id="collapseBootstrap4" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/store-expense">{{ trans('messageAr.AddExpense') }}</router-link>
                                <router-link class="collapse-item" to="/expense">{{ trans('messageAr.AllExpense') }}</router-link>

                            </div>
                        </div>
                    </li>


                    <li class="nav-item" dir="rtl">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseBootstrap5" aria-expanded="true" aria-controls="collapseBootstrap5">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span>{{ trans('messageAr.salary') }}</span>
                        </a>
                        <div id="collapseBootstrap5" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/given-salary">{{ trans('messageAr.AddSalary') }}</router-link>
                                <router-link class="collapse-item" to="/salary">{{ trans('messageAr.AllSalary') }}</router-link>

                            </div>
                        </div>
                    </li>


                    <li class="nav-item" dir="rtl">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseBootstrap7" aria-expanded="true" aria-controls="collapseBootstrap7">
                            <i class="fa-solid fa-paste"></i>
                            <span>{{ trans('messageAr.orders') }}</span>
                        </a>
                        <div id="collapseBootstrap7" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/order">{{ trans('messageAr.TodayOrder') }}</router-link>
                                <router-link class="collapse-item" to="/searchorder">{{ trans('messageAr.Search') }}</router-link>

                            </div>
                        </div>
                    </li>



                    <li class="nav-item" dir="rtl">
                        <router-link class="nav-link" to="/stock">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            <span>{{trans('messageAr.stock') }}</span>
                        </router-link>
                    </li>

                    <li class="nav-item" dir="rtl">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseBootstrap6" aria-expanded="true" aria-controls="collapseBootstrap6">
                            <i class="fa-solid fa-people-group"></i>
                            <span>{{ trans('messageAr.customers') }}</span>
                        </a>
                        <div id="collapseBootstrap6" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/store-customer">{{ trans('messageAr.AddCustomer') }}</router-link>
                                <router-link class="collapse-item" to="/customer">{{ trans('messageAr.AllCustomer') }}</router-link>

                            </div>
                        </div>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseTable" aria-expanded="true" aria-controls="collapseTable">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Reports</span>
                        </a>
                        <div id="collapseTable" class="collapse" aria-labelledby="headingTable"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                               
                                <a class="collapse-item" href="simple-tables.html">Report One</a>
                                <a class="collapse-item" href="datatables.html">Report Two</a>
                            </div>
                        </div>
                    </li> --}}
                    
            </nav>
            <!-- Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column" style="background-color: #002b47; border-style: solid;
            border-color: #00fba5;">
                <div id="content">
                    <!-- TopBar -->
                    <nav id="topbar" class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top"
                        style="display:none;"
                        v-show="$route.path === '/' || $route.path === '/register' || $route.path==='/forget' ? fasle : true ">
                        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="navbar-nav mr-auto">
                          
                           
                            
                            
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="ml-2 d-none d-lg-inline text-white small">Nihad Talal </span>
                                    <img class="img-profile rounded-circle" src="{{ asset('backend/img/logo/logo3.png') }}"
                                        style="max-width: 60px">
                                    
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown" style="right: -36px;">
                                    {{-- <a class="dropdown-item" href="#">
                                        Profile
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        Settings
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                      
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        Activity Log
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        
                                    </a> --}}
                                    {{-- <div class="dropdown-divider"></div> --}}
                                    <router-link to="/logout" class="dropdown-item" href="login.html">
                                        Logout
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                       
                                    </router-link>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- Topbar -->

                    <!-- Container Fluid-->
                    <div class="container-fluid"  id="container-wrapper">

                        <router-view></router-view>
                    </div>
                    <!---Container Fluid-->


                </div>
                <div>
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>copyright &copy;
                                {{-- <script>
                                    document.write(new Date().getFullYear());
                                </script> - developed by --}}
                                <b><a href="https://nihadtalal.ml/" target="_blank">Nihad Talal</a></b>
                            </span>
                        </div>
                    </div>
                </footer>
                <!-- Footer -->
            </div>
            </div>
        </div>

    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('backend/js/ruang-admin.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script type="text/javascript">
        let token = localStorage.getItem('token');
        if (token) {
            $("#sidebar").css("display", "");
            $("#topbar").css("display", "");
        }
    </script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> --}}
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

   
</body>

</html>
