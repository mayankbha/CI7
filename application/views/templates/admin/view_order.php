<?php if ($orders) { ?>
    <div class="row">
        <div id="center-contents">
            <div id="section-to-print">
                <div class="page-header clearfix">
                    <h3 class="pull-left">View Order Details</h3>
                </div>
                <div class="tabular_cont" style="padding: 40px;">

                    <h4 style="color: white;background: rgb(115, 202, 243);padding: 10px;border-radius: 3px;"><b>Product Details</b></h4>
					
					<?php if(!empty($products)): ?>
					<?php foreach($products as $product): ?>
					<div class="product-wrapper">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Product Title</label>
                        <div class="col-sm-5">
                            <?php echo $product['product_title']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Unit Price</label>
                        <div class="col-sm-5">
                            <?php echo "$" . $product['unit_price']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
					<div class="form-group">
                        <label class="col-sm-4 control-label">Qunatity</label>
                        <div class="col-sm-5">
                            <?php echo $product['quantity']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Total</label>
                        <div class="col-sm-5">
                            <?php echo "$" . $product['total']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
					
					</div>
					<?php endforeach; ?>
					<?php endif; ?>
					
					<!-- order total -->
					<?php /*
					<div class="form-group">
						<label class="col-sm-4 control-label">Ship Amount</label>
						<div class="col-sm-5">
							<?php echo "$".$orders['ship_amount']; ?>
						</div>
					</div>
					<div class="clearfix"></div>
					*/ ?>
					
					<div class="form-group">
						<label class="col-sm-4 control-label">Tax Applied</label>
						<div class="col-sm-5">
							<?php echo "$".$orders['tax_amount']; ?>
						</div>
					</div>
					<div class="clearfix"></div>
					
					
					<div class="form-group">
						<label class="col-sm-4 control-label">Grand Amount</label>
						<div class="col-sm-5">
							<?php echo "$".$orders['product_amount']; ?>
						</div>
					</div>
					<div class="clearfix"></div>
					
                    <br />

                    <h4 style="color: white;background: rgb(115, 202, 243);padding: 10px;border-radius: 3px;"><b>Billing Details</b></h4>
                    <br />
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Person Name</label>
                        <div class="col-sm-5">
                            <?php echo $orders['b_first_name'] . " " . $orders['b_last_name']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Company</label>
                        <div class="col-sm-5">
                            <?php echo $orders['b_company']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Phone Number</label>
                        <div class="col-sm-5">
                            <?php echo $orders['b_phone']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">City</label>
                        <div class="col-sm-5">
                            <?php echo $orders['b_city']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">State</label>
                        <div class="col-sm-5">
                            <?php echo $orders['b_state']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Country</label>
                        <div class="col-sm-5">
                            <?php echo $orders['b_country_id']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 1</label>
                        <div class="col-sm-5">
                            <?php echo $orders['b_address_1']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 2</label>
                        <div class="col-sm-5">
                            <?php echo $orders['b_address_2']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Zip</label>
                        <div class="col-sm-5">
                            <?php echo $orders['b_zip']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br />
                    <h4 style="color: white;background: rgb(115, 202, 243);padding: 10px;border-radius: 3px;"><b>Shipping Details</b></h4>
                    <br />
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Person Name</label>
                        <div class="col-sm-5">
                            <?php echo $orders['s_first_name'] . " " . $orders['s_last_name']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Company</label>
                        <div class="col-sm-5">
                            <?php echo $orders['s_company']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Phone Number</label>
                        <div class="col-sm-5">
                            <?php echo $orders['s_phone']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">City</label>
                        <div class="col-sm-5">
                            <?php echo $orders['s_city']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">State</label>
                        <div class="col-sm-5">
                            <?php echo $orders['s_state']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Country</label>
                        <div class="col-sm-5">
                            <?php echo $orders['s_country_id']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 1</label>
                        <div class="col-sm-5">
                            <?php echo $orders['s_address_1']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 2</label>
                        <div class="col-sm-5">
                            <?php echo $orders['s_address_2']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Zip</label>
                        <div class="col-sm-5">
                            <?php echo $orders['s_zip']; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <br />


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10 print_hide">
                            <button type="submit" id="go_backid" class="btn btn-success">Go back</button>&nbsp;
                            <?php /*<button type="button" onclick="return export_order()" name="export" class="btn btn-primary">Export Order List</button>&nbsp; */?>
                            <button type="button" onclick="window.print();" name="print" class="btn btn-primary">Print Order List</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end right contents --> 
<?php } ?>
<script>
    $('#go_backid').click(function() {
        window.location = "/admins/orders";
    });
    function export_order()
    {
        window.location = "<?php echo base_url('/admins/orders/export_data/' . $orders["order_id"]); ?>";

    }
</script>
