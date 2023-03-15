    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <ul class="footer-links">
                        <li><a href="#"><?php echo $this->lang->line('about_us');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('privacy_terms');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('faq');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('invite_a_friend');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('contact_us');?>  </a></li>
                        <li><a href="#"><?php echo $this->lang->line('bookmark');?> </a></li>
                        <li><a href="#"><?php echo $this->lang->line('language');?> </a></li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <div class="copyright">
                        <p><?php echo $this->lang->line('copyright');?></p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End #footer -->
    <div class="modal fade" id="modal-login">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
            <h4 class="txt-red txt-upper"><i class="fa fa-user"></i> <span>Member Login</span></h4>
          </div>
			<?php $this->load->view('/templates/asian/modal_login');?>
          <div class="modal-footer">
                <p class="txt-center">You haven’t any account? <a href="#">Create account now</a> - Or <a href="#">get password</a> if you lose</p>
          </div>
        </div>
      </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/jshashtable-2.1_src.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/tmpl.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/datepicker.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/jquery.dependClass-0.1.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/draggable-0.1.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/jquery.slider.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="/template/asian/resources/js/main.js"></script>
  </body>
</html>