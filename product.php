
<?php

include('includes/header.php');
?>
<?php
if(isset($_POST["add_to_cart"]))
{

    if(isset($_SESSION["shopping_cart"])){
   // var_dump($_SESSION["shopping_cart"]);

        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'       => $_GET["id"],
                'item_name'     => $_POST["hidden_name"],
                'item_price'    => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            echo '<script>alert("Item  Added")</script>';
            echo '<script>window.location="product.php"</script>';
        }
    }
    else
    {
        $item_array = array(
            'item_id'       => $_GET["id"],
            'item_name'     => $_POST["hidden_name"],
            'item_price'    => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }

}





$action = isset($_GET['action']) ? $_GET['action'] : "";
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 12;
$items_total_count = Product::count_all ();

$paginate = new Paginate($page, $items_per_page, $items_total_count);
$sql = "SELECT * FROM products ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset ()}";

$products = Product::find_this_query ($sql);

if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("item removed")</script>';
                echo '<script>window.location="product.php"</script>';

            }
        }
    }
}
?>

<br>
<br>
<br>
<section class="bg0 p-t-23 p-b-140">
    <div class="container-fluid">
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

    <div class="row isotope-grid">
        <?php foreach($products as $product): ?>
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                <div class="block">
                    <div class="block2-pic hov-img0">
                        <form method="post" action="product.php?action=add&id=<?php echo $product->id;?>"
                        <a href="view.php?id=<?php echo $product->id; ?>">
                            <img src="<?php echo 'admin'.DS.$product->picture_path();?>" width="200px" height="400px">
                        </a>
                        <br>
                        <br>
                        <a href="view.php?id=<?php echo $product->id; ?>">
                            <h4 class="text-info"><?php echo $product->title . ":     € ".$product->price;?></h4>
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
            </div>

        <?php endforeach; ?>


    </div>



</section>


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


<?php
include ("includes/footer.php");
?>