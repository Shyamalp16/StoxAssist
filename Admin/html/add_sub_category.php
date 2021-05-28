<?php
    require('functions.inc.php');
    require('connection.inc.php');
    $msg='';
    $sub_category='';

    if(isset($_POST['submit'])){
        $category = get_safe_value($con,$_POST['categories_id']);
        $sub_category = get_safe_value($con,$_POST['sub_category']);
        $res = mysqli_query($con, "select * from sub_category where sub_category='$sub_category'");
        $check=mysqli_num_rows($res);
        if($check > 0){
            $msg="This Sub Category Already Exists";
        }else{
            mysqli_query($con,"insert into sub_category(sub_category,category_id,status) values('$sub_category','$category','1')");
            header('location:sub_category.php');
            die();
        }
    }

    if(isset($_GET['id']) && $_GET['id'] != ''){
        $id = get_safe_value($con,$_GET['id']);
        $res = mysqli_query($con,"select * from sub_category where id='$id'");
        $check=mysqli_num_rows($res);
        if($check > 0){
            $row=mysqli_fetch_assoc($res);
            $sub_category = $row['sub_category'];
            $category = $row['category'];
        }else{
            header('location: sub_category.php');
            die(); 
        }

    }

?>

<!DOCTYPE html>
<html lang=en>

<head>

    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name=description content="">
    <meta name=author content="">

    <title>Add Sub Categories</title>

    
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

    
            <li class=nav-item>
                <a class=nav-link href=index.php>
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

    
            <li class="nav-item">
                <a class=nav-link href=categories.php>
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Categories</span></a>
            </li>


            <li class="nav-item active">
                <a class=nav-link href=sub_category.php>
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Sub Categories</span></a>
                </a>
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

                        
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href=# id=alertsDropdown role=button data-toggle=dropdown aria-haspopup=true aria-expanded=false>
                                <i class="fas fa-bell fa-fw"></i>
                                
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            
                            
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

                    
                    <h1 class="h3 mb-4 text-gray-800">Add Sub Category</h1>
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class=row>
                                <div class="col-lg-10 d-none d-lg-block">
                                    <div class=col-lg-7>
                                        <div class=p-5>
                                            <div class=text-center>
                                                <h1 class="h4 text-gray-900 mb-4">Add New Sub Categories</h1>
                                            </div>
                                            <form class=user method=post>
                                                <select class="form-control" name="categories_id" autofocus>
                                                    <option>Select Category</option>
                                                    <?php
                                                    $res = mysqli_query($con, "select id,categories from categories order by id asc");
                                                    while($row=mysqli_fetch_assoc($res)){
                                                        echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <br>
                                                <div class=form-group>
                                                    <div class="col-lg-10 d-none d-lg-block">    
                                                        <label for=categories class=form-control-label>Categories:</label>
                                                        <input class="form-control form-control-user" name="sub_category" id="sub_category" placeholder="Sub Category Name" required autofocus>
                                                    </div>
                                                    <br>
                                                </div>
                                                <button href=# class="btn btn-success btn-icon-split" name=submit type=submit>
                                                    <span class="icon text-white-50">   
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                    <span class=text>Submit</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>      
                    </div>
                    <div class=border-left-danger>
                        <?php echo $msg?>
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
                    <a class="btn btn-primary" href=login.html>Logout</a>
                </div>
            </div>
        </div>
    </div>

    
    <script src=vendor/jquery/jquery.min.js></script>
    <script src=vendor/bootstrap/js/bootstrap.bundle.min.js></script>

    
    <script src=vendor/jquery-easing/jquery.easing.min.js></script>

    
    <script src=js/sb-admin-2.min.js></script>

</body>

</html>