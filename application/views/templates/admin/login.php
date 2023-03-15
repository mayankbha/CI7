
			<h3>Login</h3>
		   <div class="col-md-8" id="login_container">
				
				<center>
					<?php
					if(isset($message)){
					 ?>
					 <div id="infoMessage"><?php echo $message;?></div>
					<?php
					}
					?>
						
						<form class="frm-login form-horizontal" action="/auth/login/true" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label col-sm-offset-2">Username</label>
								<div class="col-sm-6">
								<input type="text" class="form-control" name="identity" placeholder="Username " required></div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label col-sm-offset-2">Password</label>
								<div class="col-sm-6">
								<input type="password" class="form-control" name="password" placeholder="Password " required></div>
							</div>
							<div class="form-group">
								<!--label class="col-sm-4 col-sm-offset-2 checkbox-inline">
									<input type="checkbox">
									Remember me
								</label-->
								<div class="col-sm-4">
									<input type="submit" class="btn btn-lg btn-danger pull-right" value="login">
								</div>
							</div></form>
					  </div>
					<br><br><br><br>
					<br><br>
					<!-- End .container -->
				</div><!-- End #content -->			 
				</center>		   
		   
		   </div>

   
