<?php //echo '<pre>'; print_r($product); die;      ?>
<div class="content-box">
    <section class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                <li><span><?php echo $this->lang->line('ecommerce'); ?></span></li>
                <li><span><?php echo $this->lang->line('categories'); ?></span></li>
                <li><span><?php echo $product['category_name']; ?></span></li>
                <li class="active"><span><?php echo $product['product_title']; ?></span></li>
            </ol>
        </div>

        <div class="cart-btn" id="cartsummary">
            <?php /* Content will load using ajax */ ?>
            <button class="btn btn-lg dropdown-toggle btn-danger" type="button" data-toggle="dropdown">
                <i class="fa fa-shopping-cart"></i><span class="badge">0</span>
            </button>
            <div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <div class="cart-item-ct clearfix">
                    <table class="table table-hover">
                        <tr>
                            <td><?php echo $this->lang->line('empty_cart'); ?></td>
                        </tr>
                    </table>
                    <div class="cart-total">
                        <h5>Total: <span class="txt-red">$ 0.00</span></h5>
                    </div>
                    <div class="cart-action">
                        <a href="<?php echo base_url('store/view_cart'); ?>" class="btn btn-danger btn-sm">View Cart</a>
                        <a href="#" class="btn btn-warning btn-sm">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ecommerce">
            <div class="col-sm-3">
                <div class="content-box-border">
                    <div class="cat-sidebar">
                        <h4 class="page-title txt-upper"><?php echo $this->lang->line('categories'); ?></h4>
                        <?php if (isset($categories) && !empty($categories)): ?>
                            <?php foreach ($categories as $catId => $category): ?>
                                <a href="<?php echo base_url('store/index/' . $catId); ?>"><i class="fa fa-folder"></i> <?php echo $category; ?> </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <a href="#"><i class="fa fa-folder"></i> <?php echo $this->lang->line('no_data'); ?> </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="content-box-border">
                    <h4 class="page-title txt-upper"><?php echo $product['product_title']; ?> <span class="badge bg-red">hot</span></h4>
                    <div class="row prod">
                        <div class="col-sm-5">
                            <?php $img = isset($product_images[0]['path']) ? base_url('uploads/product/' . $product['product_id'] . '/' . $product_images[0]['path']) : '' ?>
                            <a href="#" class="prod-img"><img src="<?php echo $img; ?>" alt="<?php echo $product['product_title']; ?>"></a>
                            <div class="prod-img-slider">
                                <?php if (isset($product_images) && !empty($product_images)) : ?>
                                    <?php foreach ($product_images as $image): ?>	
                                        <div class="item">
                                            <a href="#"><img src="<?php echo base_url('uploads/product/' . $product['product_id'] . '/' . $image['path']); ?>" alt="<?php echo $product['product_title']; ?>"/></a>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="prod-ct">
                                <form action="<?php echo base_url('store/view_cart') ?>" method="post">
                                    <h5><?php echo $product['product_title']; ?></h5>
                                    <!--<p>Woksauce für ein mildes Curry - 120 g <br>
                                            Mit deutscher Anleitung - Go Tan <br>
                                            Leichte Woksauce für ein mildes Curry.</p>-->
                                    <p>Inhalt: <?php echo $product['weight']; ?> g</p>
                                    <p>Available: <?php echo $product['quantity']; ?> </p>
                                    <p><?php echo $product['description']; ?></p>
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>" />
                                    <input type="hidden" name="qty" value="1" />
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-shopping-cart"></i> $ <?php echo sprintf("%1\$.2f", $product['price']); ?>
                                    </button>
                                </form>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="content-box-border feature-product">
                    <div class="box-title bg-red txt-upper"><?php echo $this->lang->line('featured_product'); ?></div>
                    <div class="member-slider">
                        <?php if (isset($featured_products) && !empty($featured_products)): ?>
                            <?php foreach ($featured_products as $featured): ?>
                                <div class="content-box-border">
                                    <h5><a href="<?php echo base_url('store/productdetail/' . $featured['product_id']) ?>"><?php echo $featured['product_title'] ?></a></h5>
                                    <?php
                                    $image = "";
                                    if (isset($featured['images'][0]) && !empty($featured['images'][0])) {
                                        $image = base_url('uploads/product/' . $featured['product_id'] . '/' . $featured['images'][0]['path']);
                                    }
                                    ?>
                                    <a href="<?php echo base_url('store/productdetail/' . $featured['product_id']) ?>">
                                        <img src="<?php echo $image; ?>" alt="<?php echo $featured['product_title'] ?>"/>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <a href="#"><i class="fa fa-folder"></i> <?php echo $this->lang->line('no_data'); ?> </a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div><!-- End .row -->
