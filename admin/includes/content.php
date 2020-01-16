<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <h1 class="page-header">Babita's Dashboard</h1>
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">

                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo User::count_all (); ?></div>

                                </div>
                                <a class="col-auto" href="users.php" >
                                    <i class="fas fa-users" ></i>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Products</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo Product::count_all (); ?></div>
                                </div>

                                <a class="col-auto" href="products.php" >
                                    <i class="fas fa-tshirt" ></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Photos</div>
                                     <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo Photo::count_all (); ?></div>
                                </div>

                                <a class="col-auto" href="photos.php" >
                                    <i class="fas fa-images" ></i>
                                </a>


                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Orders</div>
                                   <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo Order::count_all (); ?></div>
                                </div>
                                <a class="col-auto" href="orders.php" >
                                    <i class="fas fa-shopping-cart" ></i>
                                </a>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Comments</div>
                                     <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo Comment::count_all (); ?></div>
                                </div>
                                <a class="col-auto" href="comments.php" >
                                    <i class="fas fa-comments" ></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Category</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo Category::count_all (); ?></div>
                                </div>

                                <a class="col-auto" href="categories.php" >
                                    <i class="fas fa-sort" ></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


<!--                <div class="col-12 col-md-4 mb-4">-->
<!--                    <div class="card border-left-primary shadow h-100 py-2">-->
<!--                        <div class="card-body">-->
<!--                            <div class="row no-gutters align-items-center">-->
<!--                                <div class="col mr-2">-->
<!--                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Basket</div>-->
<!--                                 <div class="h5 mb-0 font-weight-bold text-gray-800">--><?php //echo Basket::count_all (); ?><!--</div>                                </div>-->
<!---->
<!--                                <a class="col-auto" href="baskets.php" >-->
<!--                                    <i class="fas fa-cart-plus" ></i>-->
<!--                                </a>-->
<!---->
<!---->
<!--                                </a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

                <!-- pie chart -->
                <div class="row">
                    <div class="mx-auto" id="donutchart" style="width: 900px; height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->