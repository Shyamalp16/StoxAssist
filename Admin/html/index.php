<?php
    require('connection.inc.php');
    require('functions.inc.php');

    if ($_SESSION['ADMIN_USERNAME'] != ''){
        
    }else{
        header('location:login.php');
    }

    $sql=mysqli_query($con,"select qty from product");
    while($row=mysqli_fetch_array($sql)){
        $qty[] = $row['qty'];
    }

    $inc=mysqli_query($con,"select total_price from orders");
    while($row=mysqli_fetch_array($inc)){
        $price[] = $row['total_price'];
    }
    
    $qur=mysqli_query($con,"select id from contact_us");
    $queries=mysqli_num_rows($qur);



    $pending_ord=mysqli_query($con,"select id from orders where order_status='1'");
    $orders=mysqli_num_rows($pending_ord);

?>

<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name=description content="">
    <meta name=author content="">

    <title>Admin Panel</title>

    
    <link href=vendor/fontawesome-free/css/all.min.css rel=stylesheet type=text/css>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel=stylesheet>

    
    <link href=css/sb-admin-2.min.css rel=stylesheet>
</head>

<body id=page-top>
    
    <div id=wrapper>
    
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id=accordionSidebar>
    
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href=index.php>
                <div class="sidebar-brand-text mx-3">StoxAssist</div>
            </a>

    
            <hr class="sidebar-divider my-0">

    
            <li class="nav-item active">
                <a class=nav-link href=index.php>
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

    
            <li class=nav-item>
                <a class=nav-link href=categories.php>
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Categories</span></a>
            </li>

      
            <li class=nav-item>
                <a class=nav-link href=products.php>
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Products</span></a>
            </li>

      
            <li class=nav-item>
                <a class=nav-link href=contact_us.php>
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Queries</span></a>
            </li>

            <li class=nav-item>
                <a class=nav-link href=users.php>
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Users</span></a>
            </li>
			
			<li class=nav-item>
                <a class=nav-link href=orders.php>
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Orders</span></a>
            </li>

            <li class=nav-item>
                <a class=nav-link href=charts.php>
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span>
                </a>
            </li>

            
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id=sidebarToggle></button>
            </div>
        </ul>
        

        
        <div id=content-wrapper class="d-flex flex-column">

            
            <div id=content>

                
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    
                    <button id=sidebarToggleTop class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    
                    <ul class="navbar-nav ml-auto">

                        
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href=# id=searchDropdown role=button data-toggle=dropdown aria-haspopup=true aria-expanded=false>
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby=searchDropdown>
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class=input-group>
                                        <input class="form-control bg-light border-0 small" placeholder="Search for..." aria-label=Search aria-describedby=basic-addon2>
                                        <div class=input-group-append>
                                            <button class="btn btn-primary" type=button>
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        
                        <?php
                        $alert = mysqli_query($con,"select id,name,qty,qty_limit from product where qty<qty_limit");
                        $tot = mysqli_num_rows($alert);
                        ?>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href=# id=alertsDropdown role=button data-toggle=dropdown aria-haspopup=true aria-expanded=false>
                                <i class="fas fa-bell fa-fw"></i>
                                
                                <span class="badge badge-danger badge-counter"><?php echo $tot; ?></span>
                            </a>
                            
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby=alertsDropdown>
                                <h6 class=dropdown-header>
                                    Alerts Center
                                </h6>
                                <?php
                                while($row = mysqli_fetch_assoc($alert)){
                                ?>
                                <a class="dropdown-item d-flex align-items-center" href=#>
                                    <div class=mr-3>
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">QUANTITY LIMIT!</div>
                                        <span class=font-weight-bold><?php echo $row['name'].'Is Below Minimum Quantity Limit' ?></span>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                        
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href=# id=userDropdown role=button data-toggle=dropdown aria-haspopup=true aria-expanded=false>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['ADMIN_USERNAME'] ?></span>
                                <img class="img-profile rounded-circle" src=img/undraw_profile.svg>
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby=userDropdown>
                                <a class=dropdown-item href=# data-toggle=modal data-target=#logoutModal>
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                

                
                <div class=container-fluid>

                    
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    
                    <div class=row>

                        

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class=card-body>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Quantity (All Products)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo array_sum($qty) ?></div>
                                        </div>
                                        <div class=col-auto>
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class=card-body>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo array_sum($price) ?></div>
                                        </div>
                                        <div class=col-auto>
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class=card-body>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Orders
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class=col-auto>
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $orders ?></div>
                                                </div>
                                                <div class=col>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class=col-auto>
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class=card-body>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Queries</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $queries ?></div>
                                        </div>
                                        <div class=col-auto>
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class=row>

                        
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                </div>
                                
                                <div class=card-body>
                                    <div class=chart-area>
                                        <canvas id=myAreaChart></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                </div>
                                
                                <div class=card-body>
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id=myPieChart></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class=mr-2>
                                            <i class="fas fa-circle text-primary"></i> Sellings
                                        </span>
                                        <span class=mr-2>
                                            <i class="fas fa-circle text-success"></i> Fundings
                                        </span>
                                        <span class=mr-2>
                                            <i class="fas fa-circle text-info"></i> Shares
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; StoxAssist</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href=#page-top>
        <i class="fas fa-angle-up"></i>
    </a>

    
    <div class="modal fade" id=logoutModal tabindex=-1 role=dialog aria-labelledby=exampleModalLabel aria-hidden=true>
        <div class=modal-dialog role=document>
            <div class=modal-content>
                <div class=modal-header>
                    <h5 class=modal-title id=exampleModalLabel>Ready to Leave?</h5>
                    <button class=close type=button data-dismiss=modal aria-label=Close>
                        <span aria-hidden=true>×</span>
                    </button>
                </div>
                <div class=modal-body>Select "Logout" below if you are ready to end your current session.</div>
                <div class=modal-footer>
                    <button class="btn btn-secondary" type=button data-dismiss=modal>Cancel</button>
                    <a class="btn btn-primary" href=logout.php>Logout</a>
                </div>
            </div>
        </div>
    </div>

    
    <script src=vendor/jquery/jquery.min.js></script>
    <script src=vendor/bootstrap/js/bootstrap.bundle.min.js></script>

    
    <script src=vendor/jquery-easing/jquery.easing.min.js></script>

    
    <script src=js/sb-admin-2.min.js></script>

    
    <script src=vendor/chart.js/Chart.min.js></script>

    
    <script src=js/demo/chart-area-demo.js></script>
    <script src=js/demo/chart-pie-demo.js></script>

</body>

</html>