
<?php

include('includes/header.php');


$user = User::find_all();

/*
if (!$session->is_signed_in()) {
    redirect('login.php');
}*/


include ("includes/content_top.php");




if(isset($_POST['submitorder'])){

    $new_order = Order::create_order($product->id, $_SESSION['user'],$user->id);
    if($new_order && $new_order->save()){
        redirect("product.php?id={$user->id}");
    }
    else{
        $message =" There are some problems saving";
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : "";
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 5;
$items_total_count = Product::count_all ();

$paginate = new Paginate($page, $items_per_page, $items_total_count);
$sql = "SELECT * FROM products ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset ()}";

$products = Product::find_this_query ($sql);

?>





<br>
<br>
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Product Overview
            </h3>
        </div>


        <div class="flex-w flex-c-m m-tb-10">
            <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                Filter
            </div>

            <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                Search
            </div>
        </div>

        <!-- Search product -->
        <div class="dis-none panel-search w-full p-t-10 p-b-15">
            <div class="bor8 dis-flex p-l-15">
                <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>

                <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
            </div>
        </div>

        <!-- Filter -->
        <div class="dis-none panel-filter w-full p-t-10">
            <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                <div class="filter-col1 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Sort By
                    </div>

                    <ul>
                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                Default
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                Popularity
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                Average rating
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                Newness
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                Price: Low to High
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                Price: High to Low
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="filter-col2 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Price
                    </div>

                    <ul>
                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                All
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                $0.00 - $50.00
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                $50.00 - $100.00
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                $100.00 - $150.00
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                $150.00 - $200.00
                            </a>
                        </li>

                        <li class="p-b-6">
                            <a href="#" class="filter-link stext-106 trans-04">
                                $200.00+
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

    <div class="row isotope-grid">

        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
            <!-- Block2 -->
            <div class="block2">
                <?php foreach($products as $product): ?>
                <div class="block2-pic hov-img0">
                    <a href="view.php?id=<?php echo $product->id; ?>">
                        <img src="<?php echo 'admin'.DS.$product->picture_path();?>">


                        Quick View
                    </a>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="product.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            <?php echo $product->title; ?>

                            <span class="stext-105 cl3">
								<?php echo "PRICE: ".$product->price; ?>
								</span>
                    </div>

                    <div class="block2-txt-child2 flex-r p-t-3">
                        <button name="submitorder" type="submit" class="btn btn-primary">add to cart</button>
                        <a href="product.php" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                            <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                            <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item watches">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="images/product-15.jpg" alt="IMG-PRODUCT">

                    <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                        Quick View
                    </a>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            Mini Silver Mesh Watch
                        </a>

                        <span class="stext-105 cl3">
									$86.85
								</span>
                    </div>

                    <div class="block2-txt-child2 flex-r p-t-3">
                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                            <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                            <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Load more -->




        <div class="flex-c-m flex-w w-full p-t-45">
            <div class="row">

                <div class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    <?php

                    if($paginate->has_previous ()){
                        echo "<class='previous'><a href='product.php?page={$paginate->previous ()}'>Previous</a>"." ";
                    }
                    for ($i=1; $i <= $paginate->page_total (); $i++){
                        if($i == $paginate->current_page){
                            echo " <class='active'><a href='product.php?page={$i}'>{$i}</a>". "   ";
                        }else{
                            echo "<a href='product.php?page={$i}'>{$i}</a>"." ";
                        }
                    }
                    if($paginate->has_next()){
                        echo "<class='next'><a href='product.php?page={$paginate->next ()}'>Next</a>"." ";
                    }?>
                    <br>

                    <?php   echo "PAGE ". $paginate->current_page;
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
include ("includes/footer.php");
?>


