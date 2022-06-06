<?php 
require('top.php');
$order_id = get_safe_value($con,$_GET['id']);
?>

<div class="ht__bradcaump__area"
    style="background: rgba(0, 0, 0, 0) url(img/core-img/bread.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="my_order.php">My Order</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Thank You</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- wishlist-area start -->
<div class="wishlist-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <form action="#">
                        <div class="wishlist-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Product Name</th>
                                        <th class="product-thumbnail">Product Image</th>
                                        <th class="product-thumbnail">Qty</th>
                                        <th class="product-thumbnail">Price</th>
                                        <th class="product-thumbnail">Total Price</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $uid = $_SESSION['USER_ID'];
                                    $total_price = 0;
                                    $res=mysqli_query($con,"select distinct(order_detail.id) ,order_detail.*,product.name,product.image from order_detail,product ,`order` where order_detail.order_id='$order_id' and `order`.user_id='$uid' and order_detail.product_id=product.id");
                                    while($row = mysqli_fetch_assoc($res)){
                                     $total_price = $total_price+($row['qty']*$row['price']);
                                    ?>
                                    <tr>
                                        <td class="product-name"><?php echo $row['name']?></td>
                                        <td class="product-name"> <img
                                                src="<?php echo'../media/product/'.$row['image']?>"></td>
                                        <td class="product-name"><?php echo $row['qty']?></td>
                                        <td class="product-name"><?php echo $row['price']?></td>
                                        <td class="product-name"><?php echo $row['qty']*$row['price']?></td>

                                    </tr>
                                    <?php }?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="product-name">Total Price</td>
                                        <td class="product-name"><?php echo $total_price?></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- wishlist-area end -->

<?php require('footer.php')?>