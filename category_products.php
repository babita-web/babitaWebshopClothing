
<?php include ('includes/header.php');
/*if (!$session->is_signed_in()){
    redirect('login.php');
}
if (empty($_GET['id'])){
    redirect('categories.php');
}*/

$products = Product::find_the_category_products($_GET['id']);
?>
<br>
<br>
<br>
<div class="flex-w flex-c-m m-tb-10">
    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
        Filter
    </div>
</div>

<div class="dis-none panel-filter w-full p-t-10">
    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
        <div class="filter-col1 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
                search By
            </div>


        </div>

        <div class="filter-col2 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
                Category
            </div>

            <ul>
                <li class="p-b-6">
                    <a href="product.php" class="filter-link stext-106 trans-04 filter-link-active">
                        All
                    </a>
                </li>

                <li class="p-b-6">
                    <a href="category_products.php?id=2" class="filter-link stext-106 trans-04">
                        Shirt
                    </a>
                </li>

                <li class="p-b-6">
                    <a href="category_products.php?id=4" class="filter-link stext-106 trans-04">
                        Skirts
                    </a>
                </li>

                <li class="p-b-6">
                    <a href="category_products.php?id=6" class="filter-link stext-106 trans-04">
                        Dress
                    </a>
                </li>

                <li class="p-b-6">
                    <a href="category_products.php?id=21" class="filter-link stext-106 trans-04">
                        tShirt
                    </a>
                </li>

                <li class="p-b-6">
                    <a href="category_products.php?id=8" class="filter-link stext-106 trans-04">
                        Acessories
                    </a>
                </li>
            </ul>
        </div>

        <div class="filter-col3 p-r-15 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
                Color
            </div>

            <ul>
                <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #222;">
										<i class="zmdi zmdi-circle"></i>
									</span>

                    <a href="#" class="filter-link stext-106 trans-04">
                        Black
                    </a>
                </li>

                <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #4272d7;">
										<i class="zmdi zmdi-circle"></i>
									</span>

                    <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                        Blue
                    </a>
                </li>

                <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #b3b3b3;">
										<i class="zmdi zmdi-circle"></i>
									</span>

                    <a href="#" class="filter-link stext-106 trans-04">
                        Grey
                    </a>
                </li>

                <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #00ad5f;">
										<i class="zmdi zmdi-circle"></i>
									</span>

                    <a href="#" class="filter-link stext-106 trans-04">
                        Green
                    </a>
                </li>

                <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #fa4251;">
										<i class="zmdi zmdi-circle"></i>
									</span>

                    <a href="#" class="filter-link stext-106 trans-04">
                        Red
                    </a>
                </li>

                <li class="p-b-6">
									<span class="fs-15 lh-12 m-r-6" style="color: #aaa;">
										<i class="zmdi zmdi-circle-o"></i>
									</span>

                    <a href="#" class="filter-link stext-106 trans-04">
                        White
                    </a>
                </li>
            </ul>
        </div>

        <div class="filter-col4 p-b-27">
            <div class="mtext-102 cl2 p-b-15">
                Tags
            </div>

            <div class="flex-w p-t-4 m-r--5">
                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    Fashion
                </a>

                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    Lifestyle
                </a>

                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    Denim
                </a>

                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    Streetstyle
                </a>

                <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    Crafts
                </a>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">

            <h2>Products Category :  <?php $category=Category::find_by_id($_GET['id']); echo $category->name_category; ?></h2>

            </div>
            <hr>

            <div class="row isotope-grid">
                <?php foreach($products as $product): ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                        <form class="block2">

                            <div class="block2-pic hov-img0">
                                <form method="post" action="category_products.php?action=add&id=<?php echo $product->id;?>"
                                <a href="view.php?id=<?php echo $product->id; ?>">
                                    <img src="<?php echo 'admin'.DS.$product->picture_path();?>" width="200px" height="400px">
                                </a>
                                <br>
                                <br>
                                <a href="view.php?id=<?php echo $product->id; ?>">
                                    <h4 class="text-info"><?php echo $product->title?></h4>
                                </a>


                                <label for="tentacles">Select Quantity:</label>
                                <div class="media">

                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>

                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity" value="1">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>
                                <input type="hidden" name="hidden_name" value="<?php echo $product->title; ?>"/>
                                <input type="hidden" name="hidden_price" value="<?php echo $product->price; ?>"/>
                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="add to cat"/>
                            </div>

                        </form>
                    </div>
                <?php endforeach; ?>
            </div>


        </div>
    </div>
</div>


<?php include ('includes/footer.php')?>
