<?php //echo '<pre>'; print_r($current_category); die;   ?>
<div class="content-box">
    <section class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                <li><span><?php echo $this->lang->line('ecommerce'); ?></span></li>
                <li><span><?php echo $this->lang->line('categories'); ?></span></li>
                <?php if (isset($current_category['category_name']) && !empty($current_category['category_name'])) : ?>
                    <li class="active"><span><?php echo $current_category['category_name'] ?></span></li>
                <?php endif; ?>
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
                    <?php if (isset($current_category['category_name']) && !empty($current_category['category_name'])) : ?>
                        <h4 class="page-title txt-upper"><?php echo $current_category['category_name'] ?></h4>
                        <div  class="raw page-title">
                            <div class="col-sm-3">
                                <?php if(!empty($current_category['cat_image'])){ ?>
                                    <img src="<?php echo $current_category['cat_image'] ?>" alt="<?php echo $current_category['category_name'] ?>"/>
                                <?php } ?>
                            </div>
                            <div>
                                <?php echo $current_category['description'] ?>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div style="clear: both;"></div>
                    <?php else: ?>
                        <h4 class="page-title txt-upper"><?php echo $this->lang->line('all_categories'); ?></h4>
                    <?php endif; ?>
                    <?php if (isset($products) && !empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <div class="row prod">
                                <div class="col-sm-3">
                                    <?php
                                    $image = "";
                                    if (isset($product['images'][0]) && !empty($product['images'][0])) {
                                        $image = base_url('uploads/product/' . $product['product_id'] . '/' . $product['images'][0]['path']);
                                    }
                                    ?>
                                    <a href="#" class="prod-img"><img src="<?php echo $image; ?>" alt="<?php echo $product['product_title']; ?>"></a>
                                </div>
                                <div class="col-sm-9">
                                    <div class="prod-ct">
                                        <h5><?php echo $product['product_title']; ?></h5>
                                        <p><?php echo $product['description']; ?></p>
                                        <p>Inhalt: <?php echo $product['weight']; ?> g</p>
                                        <button type="button" class="btn btn-danger" onclick="onRedirect('<?php echo base_url('store/productdetail/' . $product['product_id']) ?>');">
                                            <i class="fa fa-shopping-cart"></i> $ <?php echo sprintf("%1\$.2f", $product['price']); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="row prod">
                            <?php echo $this->lang->line('no_data'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </section>
</div><!-- End .row -->
<script>
    function onRedirect(url)
    {
        window.location.assign(url)
    }
</script>
