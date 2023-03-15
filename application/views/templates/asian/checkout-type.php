<div class="content-box commerce-wrap-box">
        <section class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li><span><?php echo $this->lang->line('ecommerce'); ?></span></li>
                    <li class="active"><span><?php echo $this->lang->line('checkout'); ?></span></span></li>
                </ol>
            </div>
            <div class="row ecommerce viewcart">
                <div class="content-box-border">
                    <form class="form-horizontal" action="/auth/login/" method="post">
						<input type="hidden" name="checkput" value="checkput"/>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-1">
                                <h4 class="txt-upper page-title"><?php echo $this->lang->line('new_customer'); ?></h4>
                                <p><?php echo $this->lang->line('new_customer_text'); ?></p>
                                <a href="<?php echo base_url('register') ?>" class="btn btn-danger"><?php echo $this->lang->line('continue'); ?></a>
                            </div>
                            <div class="col-sm-5 col-sm-offset-1">
                                <h4 class="txt-upper page-title"><?php echo $this->lang->line('returning_customer'); ?></h4>
                                <div class="form-group">
                                    <label class="control-label col-sm-3"><?php echo $this->lang->line('email'); ?></label>
                                    <div class="col-sm-9">
                                        <?php /*<input class="form-control" type="email" required>*/ ?>
                                        <input type="text" class="form-control" name="identity" placeholder="Username " required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3"><?php echo $this->lang->line('password'); ?></label>
                                    <div class="col-sm-9">
                                        <?php /*<input class="form-control" type="password" required>*/ ?>
                                        <input type="password" class="form-control"  name="password" placeholder="Password " required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3"></label>
                                    <div class="col-sm-9">
                                        <button class="btn btn-danger" type="submit"><?php echo $this->lang->line('login'); ?></button>
                                        <a href="#"><?php echo $this->lang->line('forgot_password'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End .row -->
    </section><!-- End .container -->
</div><!-- End #content -->
