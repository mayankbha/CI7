    <!-- MAIN CONTENT -->
    <div class="content-box">
	<?php 
	//print_r($forum);
	//print_r($thread);
	?>
        <section class="container">

            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li><span><a href="/forum">Forums</a></span></li>
                    <li class="active"><span><?php echo $forum['name'];?></span></li>
                </ol>
            </div>
            <!-- /BREADCRUMB/ -->
            <div class="row">
                <div class="col-sm-8">


                    <div class="page-title">
                        <a href="/forum/compose/<?php echo $forum['id'];?>" class="btn btn-warning"><i class="fa fa-plus"></i> New Thread</a>
                    </div>
                    <div class="content-box-border">
                        <h4 class="txt-left page-title"><?php echo $forum['name'];?></h4>
						<?php //echo $forum['description'];?>
                        <div class="forum-tbl">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Thread</th>
                                        <th>Posts</th>
                                        <th>Last Post</th>
                                        <th>Reply</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
									foreach($thread as $tkey => $tvalue){
										?>
											<tr>
												<td><i class="fa fa-circle txt-orange"></i></td>
												<td>
													<a href="/forum/thread/<?php echo $tvalue['id'];?>"><strong><?php echo $tvalue['title'];?></strong></a> - <?php echo @$users[$tvalue['user_id']]['first_name'];?>
												</td>
												<td>0</td>
												<td>
													<a href="#"> Pellentesque tempor risus quam</a>
												</td>
												<td>0</td>
											</tr>										
										<?php
									}
									?>
                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="page-title">
                        <a href="/forum/compose/<?php echo $forum['id'];?>" class="btn btn-warning"><i class="fa fa-plus"></i> New Thread</a>
                    </div>
                    <!--div class="content-box-border">
                        <div class="box-title bg-orange">
                            Quick Reply
                        </div>
                        <div class="box-ct">
                            <textarea cols="80" id="editor1" name="editor1" rows="10" class="editor-ck form-control"></textarea><br>
                            <p class="txt-center"><button type="button" class="btn btn-warning">Submit</button> <button class="btn btn-default" type="button" >Preview</button> </p>
                        </div>
                    </div-->
                </div>
                <div class="col-sm-4">
                    <div class="content-box-border mod-top-user">
                        <div class="box-title bg-orange">Top Users</div>
                        <div class="box-ct">
							<?php
							foreach($top_users as $tukey => $tuvalue){
							?>
                            <div class="media">
                                <a class="pull-left avatar-sm" href="#">
                                    <img class="media-object" src="/uploads/profile/thumbnail/<?php echo $users[$tuvalue['user_id']]['avatar'];?>" alt="...">
                                </a>
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        <a href="#"><?php echo $users[$tuvalue['user_id']]['first_name'].' '. $users[$tuvalue['user_id']]['last_name'];?></a>
                                        <i class="fa fa-circle txt-green"></i>
                                    </h5>
                                    <p>
                                        <span><i class="fa fa-thumbs-up"></i> <?php echo $users[$tuvalue['user_id']]['thanks'];?> thanks</span>
                                        <span><i class="fa fa-file-text"></i> <?php echo $tuvalue['count'];?> posts</span>
                                    </p>
                                </div>
                            </div>							
							<?php
							}
							?>

                        </div>					
					</div>
                </div>
            </div>    
        </section>
    </div><!-- End #content -->
