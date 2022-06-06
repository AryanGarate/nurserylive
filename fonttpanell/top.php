<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');

$cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
	$cat_arr[]=$row;	
}

$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();

$script_name=$_SERVER['SCRIPT_NAME'];
$script_name_arr=explode('/',$script_name);
$mypage=$script_name_arr[count($script_name_arr)-1];

$meta_title="My Ecom Website";
$meta_desc="My Ecom Website";
$meta_keyword="My Ecom Website";
if($mypage=='product.php'){
	$product_id=get_safe_value($con,$_GET['id']);
	$product_meta=mysqli_fetch_assoc(mysqli_query($con,"select * from product where id='$product_id'"));
	$meta_title=$product_meta['meta_title'];
	$meta_desc=$product_meta['meta_desc'];
	$meta_keyword=$product_meta['meta_keyword'];
}if($mypage=='contact.php'){
	$meta_title='Contact Us';
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $meta_title?></title>
    <link rel="shortcut icon"
        href="//cdn.shopify.com/s/files/1/0047/9730/0847/files/nurserylive-favicon-90x90_32x32.png?v=1597826508"
        type="image/png">
    <meta name="description" content="<?php echo $meta_desc?>">
    <meta name="keyword" content="<?php echo $meta_keyword?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>

    <div class="wrapper">
        <header id="htc__header" class="htc__header__area header--one">
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                                <div class="logo">
                                    <a href="index.php"><img
                                            src="//cdn.shopify.com/s/files/1/0047/9730/0847/files/nurserylive-logo_ba07527e-5e6e-4b78-9553-1b5cde7080ab_200x40.png?v=1598459506"
                                            alt="Nurserylive" data-rimg=""
                                            srcset="//cdn.shopify.com/s/files/1/0047/9730/0847/files/nurserylive-logo_ba07527e-5e6e-4b78-9553-1b5cde7080ab_200x40.png?v=1598459506 1x"
                                            class="site-logo-image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-7 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <?php
										foreach($cat_arr as $list){
											?>
                                        <li><a
                                                href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
                                        </li>
                                        <?php
										}
										?>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <?php
											foreach($cat_arr as $list){
												?>
                                            <li><a
                                                    href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
                                            </li>
                                            <?php
											}
											?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <div class="header__account">
                                        <?php if(isset($_SESSION['USER_LOGIN'])){
											echo '<a href="logout.php">Logout</a> <a href="my_order.php">My Order</a>';
										}else{
											echo '<a href="login.php">Login/Register</a>';
										}
										?>

                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
        </header>