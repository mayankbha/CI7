    <div class="content-box">
        <section class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li class="inactive"><span>Mail</span></li>
					<li class="active"><span>Compose</span></li>
                </ol>
            </div>
            <div class="mail-wrap row">
				<?php echo $side_navigation;?>
                <div class="col-sm-9">
                    <!--div class="mail-action page-title">
                        <div class="row">
                            <div class="col-sm-6 col-xs-6">
                                <a href="#" class="btn btn-default btn-lg" title="Back to Maillist"><i class="fa fa-angle-double-left"></i></a>
                            </div>
                           <div class="col-sm-6 col-xs-6">
                                <div class="btn-group btn-group-lg pull-right">
                                    <a href="#" class="btn btn-default"><i class="fa fa-angle-left"></i></a>
                                    <a href="#" class="btn btn-default"><i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div-->
                    
                    <div class="mail-ct content-box-border">
                        <form class="form-horizontal" method="post" action="/mail/send">
                            <div class="form-group">
								<label class="col-sm-2 control-label"> Search Recepient </label>
                                <div class="col-sm-8">
                                    <input id="search_recepient" type="text" <?php
									if(isset($to)){
										echo 'value="'.$to.'"';
									}
									?> class="form-control">
									<br><font style="font-size:9;color:red;"> Enter Keywords to display users then click users you want to send a message. </font>
                                </div>
                            </div>						
                            <div class="form-group">
								
                                <label class="col-sm-2 control-label"> Select Recepients </label>
								<input type="hidden" id="selected_recepients" name="selected_recepients">
                                <div id="show_recepients">
                                </div>
                            </div>						
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Subject </label>
                                <div class="col-sm-8">
                                    <input name="subject" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Content </label>
                                <div class="col-sm-10">
                                    <textarea cols="80" id="editor1" name="content" rows="10" class="editor-ck form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2"></label>
                                <div class="col-sm-8">
                                    <button class="btn btn-lg btn-danger" type="submit"> Send </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</section>
	</div><!-- End #content -->