    <!-- MAIN CONTENT -->
    <?php //$_SESSION['url'] = $_SERVER['REQUEST_URI'];?>
    <div class="content-box">
        <section class="container">

            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li class="active"><span>Forums</span></li>
                </ol>
            </div>
            <!-- /BREADCRUMB/ -->
            <div class="row">
                <div class="col-sm-8">
                    <div class="content-box-border">
                        <div class="box-title bg-orange">
                            Welcome to the Forums.
                        </div>
                        <div class="box-ct">If this is your first visit, be sure to check out the FAQ by clicking the link above. You may have to <a href="#">register</a> before you can post: click the register link above to proceed. To start viewing 
messages, select the forum that you want to visit from the selection below. </div>
                    </div>
<?php
foreach($groups as $gkey => $gvalue){
?>
                    <div class="content-box-border">
                        <h4 class="txt-left page-title"><?php echo $gvalue['name']; ?></h4>
                        <div class="forum-tbl">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Forum</th>
                                        <th>Last Thread</th>
                                        <th>Threads</th>
                                        <th>Posts</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								foreach($forums as $fkey => $fvalue){
									if($fvalue['forum_group'] == $gvalue['id']){
								?>
                                    <tr>
                                        <td><i class="fa fa-circle txt-<?php echo $fvalue['color']; ?>"></i></td>
                                        <td>
                                            <a href="/forum/main/<?php echo $fvalue['id']; ?>"><strong><?php echo $fvalue['name']; ?></strong></a>
                                            <p class="help-block"><?php echo $fvalue['description']; ?></p>
                                        </td>
                                        <td>
                                            <a href="#"> Pellentesque tempor risus quam</a>
                                        </td>
                                        <td><?php echo $fvalue['thread_count'];?></td>
                                        <td><?php echo $fvalue['post_count'];?></td>
                                    </tr>								
								<?php
									}
								}
								?>

                                </tbody>
                            </table>
                        </div>
                    </div>
<?php
}
?>

                    <div class="content-box-border">
                        <div class="box-title bg-orange">
                            Forum Statistic
                        </div>
                        <div class="box-ct">
                            <ul class="list-square">
                                <li>Most users ever online was <?php echo $history['user_count'];?> on <?php echo $this->format_model->date_format_from_database($history['date']); ?> <?php echo $this->format_model->time_format_from_database($history['date']);  ?>.</li>
<li><strong>Threads</strong>: <?php echo $forum_statistics['threads'];?> <strong>Posts</strong>: <?php echo $forum_statistics['posts'];?>, <strong>Members</strong>: <?php echo $forum_statistics['members'];?></li>
<li>Welcome to our newest member, <a href="#"><?php echo $forum_statistics['newest_member']['first_name'] .' '. $forum_statistics['newest_member']['last_name'];?></a></li>
                            </ul>
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
