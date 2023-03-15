    <div class="modal fade" id="modal-login">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
            <h4 class="txt-red txt-upper"><i class="fa fa-user"></i> <span><?php echo $this->lang->line('member_login');?></span></h4>
          </div>
          <div class="modal-body">
            <form class="frm-login form-horizontal" action="/auth/login" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-offset-2"><?php echo $this->lang->line('username');?></label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Username " required></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-offset-2"><?php echo $this->lang->line('password');?></label>
                    <div class="col-sm-6">
                    <input type="password" class="form-control" placeholder="Password " required></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-offset-2 checkbox-inline">
                        <input type="checkbox">
                         <?php echo $this->lang->line('remember_me');?>
                    </label>
                    <div class="col-sm-4">
                        <input type="submit" class="btn btn-lg btn-danger pull-right" value="login">
                    </div>
                </div></form>
          </div>
          <div class="modal-footer">
                <p class="txt-center">
				<?php echo $this->lang->line('not_have_an_account');?> 
                	<a href="#"><? echo $this->lang->line('create_acc');?></a> 
				<?php echo $this->lang->line('or');?> 
                	<a href="#"><?=$this->lang->line('get_password')?></a> 
				<?php echo $this->lang->line('if_you_lose');?></p>
          </div>
        </div>
      </div>
    </div>