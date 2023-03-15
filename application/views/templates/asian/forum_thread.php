    <!-- MAIN CONTENT -->
    <div class="content-box">
        <section class="container">

            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li><span><a href="/forum">Forums</a></span></li>
                    <li><span><?php echo $forum['name'];?></span></li>
                    <li class="active"><span><?php echo $thread['title'];?></span></li>
                </ol>
            </div>
            <!-- /BREADCRUMB/ -->
            <div class="row">
                <div class="col-sm-8">
                    <!--div class="forum-action clearfix page-title">
                        <div class="btn-group pull-left">
                            <a href="#" class="btn btn-warning">Register</a>
                            <a href="#" class="btn btn-default">FAQs</a>
                            <a href="#" class="btn btn-default">Policy</a>
                        </div>
                        <div class="btn-group pull-right">
                            <a href="#" class="btn btn-default">Calendar</a>
                            <a href="#" class="btn btn-default">Archived Threads</a>
                            <a href="#" class="btn btn-default">Help</a>
                            <a href="#" class="btn btn-default">Sitemap</a>
                        </div>
                    </div-->

                    <!--div class="page-title">
                        <a href="#" class="btn btn-warning"><i class="fa fa-comment"></i> Reply</a>
                    </div-->
                    <div class="content-box-border">
                        <div class="forum-post">
                            <div class="post-meta clearfix">
                                <span class="post-time"><i class="fa fa-clock"></i><?php echo $thread['formatted_date'];?></span>
                                <span class="pull-right post-no">#1</span>
                            </div>
                           <div class="post-header clearfix">
                               <div class="post-author media pull-left">
                                    <a class="pull-left avatar-md" href="#">
                                        <img class="media-object" src="/uploads/profile/thumbnail/<?php echo $users[$thread['user_id']]['avatar'];?>" alt="...">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <a href="#"><?php echo $users[$thread['user_id']]['first_name'].' '. $users[$thread['user_id']]['last_name'];?></a>
                                            <i class="fa fa-circle txt-green"></i>
                                        </h5>
                                        <p><strong class="txt-orange">Member</strong></p>
                                        <p><strong>Joined Date: </strong> <?php echo date('d M Y', $users[$thread['user_id']]['created_on']);?></p>
                                    </div>
                                </div>
                                <div class="post-author-meta pull-right">
                                    <p><i class="fa fa-map-marker"></i> <?php echo $users[$thread['user_id']]['city'];?></p>
                                    <p><strong>Posts:</strong> 2,011</p>
                                </div>
                           </div>
                           <div class="post-ct">
                                <h4 class="page-title"><?php echo $thread['title'];?></h4>
                                <?php echo html_entity_decode($thread['body']);?>
                           </div>
                           <div class="post-footer clearfix">
                                <a class="add_thanks" name="<?php echo $thread['user_id'];?>" style="cursor:pointer;"><i class="fa fa-thumbs-up"></i> Thanks</a>
                                <a href="#"><i class="fa fa-envelope"></i> Send Message</a>
                                <a href="#"><i class="fa fa-star"></i> Bookmark</a>
                                <!--a href="#"><i class="fa fa-comment"> Reply</i></a-->
                                <!--a href="#"><i class="fa fa-quote-left"> Quote</i></a-->
                           </div>
                        </div>
                    </div>

					<?php
					$post_count=2;
					foreach($posts as $pkey=>$pvalue){
					?>
                    <div class="content-box-border forum-post-reply">
                        <h4 class="page-title">Re: <?php echo $thread['title'];?></h4>
                        <div class="forum-post">
                            <div class="post-meta clearfix">
                                <span class="post-time"><i class="fa fa-clock"></i> <?php echo date('d M Y', strtotime($pvalue['date']));?></span>
                                <span class="pull-right post-no">#<?php echo $post_count;?></span>
                            </div>
                           <div class="post-header clearfix">
                               <div class="post-author media pull-left">
                                    <a class="pull-left avatar-md" href="#">
                                        <img class="media-object" src="/uploads/profile/thumbnail/<?php echo $users[$pvalue['user_id']]['avatar'];?>" alt="...">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <a href="#"><?php echo $users[$pvalue['user_id']]['first_name'].' '. $users[$pvalue['user_id']]['last_name'];?></a>
                                            <i class="fa fa-circle txt-green"></i>
                                        </h5>
                                        <p><strong class="txt-orange">Member</strong></p>
                                        <p><strong>Joined Date: </strong> <?php echo date('d M Y', $users[$pvalue['user_id']]['created_on']);?></p>
                                    </div>
                                </div>
                                <div class="post-author-meta pull-right">
                                    <p><i class="fa fa-map-marker"></i> <?php echo $users[$thread['user_id']]['city'];?></p>
                                    <p><strong>Posts:</strong> 2,011</p>
                                </div>
                           </div>
                           <div class="post-ct">
                                <?php echo html_entity_decode($pvalue['body']);?>
                           </div>
                        </div>
                    </div>					
					<?php
					$post_count++;
					}
					?>

                    <!--div class="page-title">
                        <a href="#" class="btn btn-warning"><i class="fa fa-comment"></i> Reply</a>
                    </div-->

                    <div class="content-box-border">
                        <div class="box-title bg-orange">
                            Reply
                        </div>
                        <div class="box-ct">
							<form method="post" action="/forum/thread_post/<?php echo $thread['id'];?>">
                            <textarea cols="80" id="editor1" name="editor1" rows="10" class="editor-ck form-control"></textarea><br>
                            <input type="hidden" name="reply_body" id="reply_body">
							<input type="hidden" name="thread_id" id="thread_id" value="<?php echo $thread['id'];?>">
							<p class="txt-center">
                                <button id="reply_to_thread" type="button" class="btn btn-warning">Submit</button> 
                                <!--button class="btn btn-default" type="button">Preview</button-->
                            </p>
							</form>
                        </div>
                    </div>
                    
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