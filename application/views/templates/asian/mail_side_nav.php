        <div class="col-sm-3">
            <p class="page-title"><a href="/mail/compose/" class="btn btn-lg btn-block btn-danger"><i class="fa fa-edit"></i> Compose Mail</a></p>
            <div class="content-box-border">
                <ul class="mail-nav">
                    <li><a href="/mail"><i class="fa fa-envelope"></i> Inbox 
                    <?php 
                    if($count>0){
                    ?>
                    <span class="badge">(<?php echo $count;?>)</span></a></li>							
                    <?php
                    }
                    ?>
                    <li><a href="/mail/favorites"><i class="fa fa-star"></i> Favorites </a></li>
                    <!--li><a href="#"><i class="fa fa-folder"></i> Creat New Folder </a></li-->
                    <li><a href="/mail/sent"><i class="fa fa-mail-forward"></i> Sent </a></li>
                    <li><a href="/mail/trash"><i class="fa fa-trash-o"></i> Trash </a></li>
                    <li><a href="/mail/spam"><i class="fa fa-exclamation"></i> Spam </a></li>
                    <!--li><a href="#"><i class="fa fa-filter"></i> Create Filter </a></li-->
                </ul>
            </div>
        </div>