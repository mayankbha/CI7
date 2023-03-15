    <!-- MAIN CONTENT -->
    <div class="content-box">
        <section class="container">

            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li><span>Forums</span></li>
                    <li class="active"><span>Compose</span></li>
                </ol>
            </div>
            <!-- /BREADCRUMB/ -->
            <div class="row">
                <div class="col-sm-8">

                    
                    <div class="content-box-border">
                        <div class="box-title bg-orange">
                            New Thread
                        </div>
                        <div class="box-ct">
							<form method="post" action="/forum/compose">
                            <div class="form-group">
                                <input name="title" class="form-control" type="text" placeholder="Thread title...">
                            </div>
							
                             <textarea cols="80" id="editor1" name="editor1" rows="10" class="editor-ck form-control"></textarea><br>
                            <input id="content_body" name="content_body" type="hidden" value="">
							<input id="forum_id" name="forum_id" type="hidden" value="<?php echo $id;?>">
							<p class="txt-center">
                                <button id="submit_content" name="submit_content" type="button" class="btn btn-warning">Submit</button> 
                                <!--button class="btn btn-default" type="button">Preview</button-->
                            </p>
							</form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="content-box-border">
                        <div class="box-title bg-orange">Top Users</div>
                        <div class="box-ct">
                            <div class="media">
                                <a class="pull-left avatar-sm" href="#">
                                    <img class="media-object" src="resources/img/gallery_1.png" alt="...">
                                </a>
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        <a href="#">Jenny Trinh</a>
                                        <i class="fa fa-circle txt-green"></i>
                                    </h5>
                                    <p>
                                        <span><i class="fa fa-thumbs-up"></i> 659 thanks</span>
                                        <span><i class="fa fa-file-text"></i> 1,056 posts</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </section>
    </div><!-- End #content -->