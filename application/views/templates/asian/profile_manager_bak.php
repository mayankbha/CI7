    <!-- MAIN CONTENT -->
    <div class="content-box">
        <section class="container">

            <div class="row">
                <ol class="breadcrumb">
                    <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
                    <li class="active"><span>Manage Your Account</span></li>
                </ol>
            </div>
            <!-- /BREADCRUMB/ -->
            <div class="box box-tab-content">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#match" data-toggle="tab">Match</a></li>
                  <li><a href="#photo" data-toggle="tab">Photo</a></li>
                  <li><a href="#profile" data-toggle="tab">Profile</a></li>
                  <li><a href="#interest" data-toggle="tab">Interest</a></li>
                  <li><a href="#verify" data-toggle="tab">Profile Verify</a></li>
                  <li><a href="#personality" data-toggle="tab">Personality</a></li>
                  <li><a href="#question" data-toggle="tab">Questions</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane" id="photo">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="profile-photo">
                                <img src="/template/asian/uploads/noimage.jpg" alt="" class="img-responsive img-rounded">
                                <a href="#" title="Change Avatar"><i class="fa fa-picture-o fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="row profile-photo-info">
                                <div class="col-sm-8">
                                    <h4 class="txt-red txt-upper page-title">Upload Photo<br>
                                        <small>add more photos to your gallery</small>
                                    </h4>
                                    <p>1. Browse for a photo<br>
                                        2. Confirm you own the photo<br>
                                        3. Click upload<br>
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <a href="#modal-upload" class="add-photo-btn" data-toggle="modal"><i class="fa fa-plus"></i></a>

                                    <div class="modal fade" id="modal-upload">
                                      <div class="modal-dialog">
                                        <div class="modal-content">

                                          <div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
                                            <h4 class="txt-red txt-upper"><i class="fa fa-picture-o"></i> <span>Upload Photo</span></h4>
										  
                                            
                                          </div>
                                          <div class="modal-body">
										  <iframe style="width:500px;height:350px;border:solid 1px #dedede;" src="/js_image/image_up.php"></iframe>
                                            <!--form class="form">
                                               <div class="fileinput fileinput-new clearfix social-upload-img" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail pull-left" data-trigger="fileinput" style="width: 80px; height: 80px;"></div>
                                            <div class="btn-group pull-left">
                                                <span class="btn btn-file">
                                                    <span class="fileinput-new"><i class="fa fa-plus"></i></span>
                                                    <span class="fileinput-exists"><i class="fa fa-refresh"></i></span>
                                                    <input type="file" name="...">
                                                </span>
                                                <a href="#" class="btn fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>
                                            </form-->
                                          </div>
                                          <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Save</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1 profile-gallery">
                                    <div class="row">
                                        <div class="col-sm-3"><div class="item"><img src="resources/img/gallery_1.png" alt="" class="img-responsive"></div></div>
                                        <div class="col-sm-3"><div class="item"><img src="resources/img/gallery_1.png" alt="" class="img-responsive"></div></div>
                                        <div class="col-sm-3"><div class="item"><img src="resources/img/gallery_1.png" alt="" class="img-responsive"></div></div>
                                        <div class="col-sm-3"><div class="item"><img src="resources/img/gallery_1.png" alt="" class="img-responsive"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4 class="txt-red txt-upper">Photo Guidelines</h4>
                    <h5 class="page-title">How to choose the right gallery photos:</h5>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-1">
                            <div class="row">
                                <div class="col-sm-2">
                                    <img src="resources/img/profile-photo-bg.png" alt="" class="img-responsive margin-top">
                                </div>
                                <ul class="col-sm-5 list-square">
                                    <li>Shows you doing something you enjoy</li>
                                    <li>Reflects your personality</li>
                                    <li>At least 1 photo shows your full body</li>
                                    <li>Shows you in a unique setting (conversation-starters)</li>
                                </ul>
                                <ul class="col-sm-5 list-square">
                                    <li>Clearly shows your face</li>
                                    <li>Good quality and well lit</li>
                                    <li>MUST contain YOU</li>
                                    <li>DOES NOT contain nudity</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                  </div>

                  <!-- Edit Profile -->
                  <div class="tab-pane" id="profile">
                    <h4 class="txt-red txt-upper page-title">Edit Profile</h4>
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="content-box-border">
                                    <legend>Your Appearance</legend>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-offset-1 label-control"> Hair color:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-offset-1 label-control">Eye color:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-offset-1 label-control">Weight:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-offset-1 label-control">Body type:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-offset-1 label-control">Your ethnicity is mostly:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-offset-1 label-control">I consider my appearance as:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="content-box-border">
                                    <legend>Your Lifestyle</legend>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-sm-offset-1">Do you drink?</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-sm-offset-1">Do you smoke?</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-sm-offset-1">Marital Status</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-sm-offset-1">Do you have children?</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-sm-offset-1">Occupation</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label col-sm-offset-1">Willing to relocate</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">Relationship you're looking for</label>
                                        <div class="col-sm-11 col-sm-offset-1">
                                            <label class="checkbox-inline">
                                                <input type="checkbox"> Penpal 
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"> Friendship 
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"> Romance / Dating  
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"> Marriage
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-box-border">
                            <div class="row">
                                <div class="col-sm-6">
                                    <legend>Your Background / Cultural Values</legend>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label col-sm-offset-1"> Nationality:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label col-sm-offset-1">Education:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label col-sm-offset-1">English language ability:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label col-sm-offset-1">Vietnamese language ability:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label col-sm-offset-1">Religion:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label col-sm-offset-1">Chinese sign:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label col-sm-offset-1">Star sign:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <legend>In your own words</legend>
                                    <div class="form-group">
                                        <label class="col-sm-10 col-sm-offset-1"> Your profile heading:</label>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-10 col-sm-offset-1"> A little about yourself:</label>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-10 col-sm-offset-1"> What you're looking for in a partner:</label>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="txt-center">
                            <button type="submit" class="btn btn-lg btn-danger">Submit</button>
                        </p>
                    </form>
                  </div>

                  <!-- Edit Match -->
                  <div class="tab-pane active" id="match">
                    <h4 class="txt-red txt-upper clearfix">Edit Match Criteria
                        <a href="#" class="btn btn-danger pull-right">View Match</a>
                    </h4>
                    <h5 class="page-title">Help us find you the perfect match by telling us what is important to you in a partner. Answer the questions below and tell us what you’re looking for.
Answer at least 3 questions below to complete this step.</h5>
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="content-box-border">
                                    <legend>Their Basic Details</legend>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">I'm seeking a:</label>
                                        <div class="col-sm-6">
											<?php 
											echo form_dropdown('im_seeking_a', $im_seeking_a['options'], $im_seeking_a['value'], $im_seeking_a['form_options']);?>
                                            <!--select id="im_seeking_a" name="im_seeking_a" class="form-control">
												<option value="male">male</option>
												<option value="female">female</option>
											</select-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Age Between</label>
                                        <div class="col-sm-7">
                                            <!--input type="text" id="age-slider" name="age_between" value="16;50" /-->
											<?php echo form_input($age_between); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Living in</label>
                                        <div class="col-sm-3">
                                            <select name="living_in" class="form-control"><option>Hanoi</option></select>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="form-control"><option>Vietnam</option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">With in</label>
                                        <div class="col-sm-2">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                        <label class="col-sm-2 control-label">Km of</label>
                                        <div class="col-sm-4">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-box-border">
                                    <legend>Their Lifestyle</legend>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Any
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Petite 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Full Figured
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Athletic 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Slim
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox">Few Extra Pounds 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Averrage
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Large and Lovely
                                        </label>    
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Nationality:</label>
                                        <div class="col-sm-8">
                                            <select multiple class="form-control">
                                              <option>USA</option>
                                              <option>United Kingdom</option>
                                              <option>Vietnam</option>
                                              <option>Germany</option>
                                              <option>Spain</option>
                                              <option>Holland</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Education</label>
                                        <div class="col-sm-8">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Languages spoken:</label>
                                        <div class="col-sm-8">
                                            <select class="form-control"><option></option></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="content-box-border">
                                    <legend>Their Appearance</legend>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="amount">Height</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="height-slider" name="height" value="100;220" />
                                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="amount">Weight</label>
                                        <div class="col-sm-9">
                                            <input id="weight-slider" type="text" name="weight" value="40;100" />
                                        </div>
                                    </div>
                                    <legend>Body type:</legend>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Any
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Petite 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Full Figured
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Athletic 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Slim
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox">Few Extra Pounds 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Averrage
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Large and Lovely
                                        </label>    
                                    </div>
                                    <legend>Their ethnicity is mostly:</legend>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="txt-center">
                            <button type="submit" class="btn btn-lg btn-danger">Submit</button>
                        </p>
                    </form>    
                  </div>
                  <div class="tab-pane" id="interest">
                      <h4 class="txt-red txt-upper clearfix">Edit Hobbies & Interests
                            <a href="#" class="btn btn-danger pull-right">View Match</a>
                      </h4>
                      <h5 class="page-title">Let others know what your interests are and help us connect you with other users that may have similar interests. Answer all questions below to complete this step.</h5>
                      <form class="form-horizontal">
                        <div class="box-content-border">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="content-box-border">
                                        <legend>What do you do for fun / entertainment?</legend>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    </div>
                              </div>
                              <div class="col-sm-6">
                                    <div class="content-box-border">
                                        <legend>What sort of food do you like?</legend>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline col-sm-4 col-sm-offset-1">
                                            <input type="checkbox"> Checkbox Option
                                        </label>
                                        <label class="checkbox-inline col-sm-4">
                                            <input type="checkbox"> Checkbox Option 
                                        </label>    
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="txt-center">
                            <button type="submit" class="btn btn-lg btn-danger">Submit</button>
                        </p>
                      </form>
                  </div>
                  <!-- Tab Personality -->
                  <div class="tab-pane" id="verify">
                      <h4 class="txt-red txt-upper">Profile Verification</h4>
                      <h5 class="page-title"> Confirm your identity and show others your profile is genuine. Get the "Verified" badge on your profile by uploading your photo identification. Upload a scanned copy of a your passport, license or national 
    ID to complete this step.</h5>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="content-box-border">
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="First Name" class="form-control">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="Last Name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8">
                                                    <input type="text" placeholder="Phone Number" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" placeholder="Address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-3">
                                                    <input type="text" placeholder="Zipcode" class="form-control">
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control"><option>City</option></select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control"><option>State</option></select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="Country" class="form-control">
                                                </div>
                                            </div>
                                            <legend>Upload Verification Document Image </legend>
                                            <div class="form-group">
                                                <div class="col-sm-8">
                                                   <div class="fileinput fileinput-new" data-provides="fileinput">
                                                  <div class="input-group">
                                                    <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                    <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                  </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="checkbox-inline col-sm-offset-1">
                                                    <input type="checkbox"> I confirm that is my ID Passport
                                                </label>
                                            </div>
                                            <p><button class="btn btn-danger btn-lg">Upload</button></p>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="content-box-border">
                                    <h5 class="txt-red txt-upper page-title">Why verify my profile?</h5>
                                    <p>Verifying your profile is optional, however this provides more trust in your profile and shows others that you are serious about finding love, so we recommend that you chose to verify your profile.</p>

                                    <p>To verify your profile, upload a copy of an identification document that contains your name and a photo. We will then verify details such as your name, gender, date of birth etc. This is important because it:</p>

                                        <ul class="list-square">
                                            <li>Gives other members greater interest in your profile</li>
                                            <li>Reduces the likelihood of non-genuine profiles on the site</li>
                                            <li>Distinguishes serious members from less serious members</li>
                                        </ul>

                                    <p>You can also choose to send a copy of the document through the following methods:</p>
                                    <p>Email: <a href="mailto:team@VietnamCupid.com">team@VietnamCupid.com</a></p>
                                    <p>Mail: PO Box 9304 Gold Coast MC QLD 9726 Australia </p>

                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="tab-pane" id="personality">
                        <h4 class="txt-red txt-upper clearfix">Edit Personality Profile
                            <a href="#" class="btn btn-danger btn-lg pull-right">View profile</a>
                        </h4>
                        <p class="page-title">Let your personality shine. Express yourself in your own words to give other users a better understanding of who you are. Answer at least 7 questions below to complete this section.</p>
                        <form class="form">
                            <div class="form-group">
                                <label>What is your favorite movie?</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>What is your favorite book?</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>What sort of food do you like?</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>What sort of music do you like?</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>What are your hobbies and interests?</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>How would you describe your dress sense and physical appearance?</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>How would you describe your sense of humor?</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>How would you describe your personality?</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Where have you traveled or would like to travel to?</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>How adaptive are you to having a partner from a different culture to your own?</label>
                                <input type="text" class="form-control">
                            </div>
                            <p class="txt-center">
                                <button type="submit" class="btn btn-lg btn-danger">Submit</button>
                            </p>
                        </form>
                  </div>
                  <div class="tab-pane" id="question">
                      <h4 class="txt-red txt-upper page-title">Question about persons</h4>
                      <p><strong>Please read the below before you start doing this free personality test:</strong></p>
                      <ul class="list-square">
                            <li>answer the questions very honestly, even if you do not like the answer.</li>
                            <li>try not to leave any “neutral” answers.</li>
                            <li>the test is quite long (60 questions), so please ensure you can dedicate at least 10-15 minutes.</li>
                      </ul>
                      <p>Once finished, please press the “Results” button right below the test. You will see a four-letter combination and a link to your personality profile. Please remember this combination as it will represent your personality type.</p>
                      <p>If you do not have much time, click here to open a less accurate, but much shorter version of this test.</p>
                        <form class="form-horizontal">
                            <div class="content-box-border">
                                <div class="question-ct">
                                    <h5>1.  You find it easy to introduce yourself to other people.</h5>
                                    <div class="choice">
                                        <label class="radio-inline"><input type="radio" name="q1">Disagree</label>
                                        <label class="radio-inline"><input type="radio" name="q1">Partly disgree</label>
                                        <label class="radio-inline"><input type="radio" name="q1">Neither</label>
                                        <label class="radio-inline"><input type="radio" name="q1">Partly Agree</label>
                                        <label class="radio-inline"><input type="radio" name="q1">Agree</label>
                                    </div>
                                </div>
                                <div class="question-ct">
                                    <h5>1.  You find it easy to introduce yourself to other people.</h5>
                                    <div class="choice">
                                        <label class="radio-inline"><input type="radio" name="q2">Disagree</label>
                                        <label class="radio-inline"><input type="radio" name="q2">Partly disgree</label>
                                        <label class="radio-inline"><input type="radio" name="q2">Neither</label>
                                        <label class="radio-inline"><input type="radio" name="q2">Partly Agree</label>
                                        <label class="radio-inline"><input type="radio" name="q2">Agree</label>
                                    </div>
                                </div>
                                <div class="question-ct">
                                    <h5>1.  You find it easy to introduce yourself to other people.</h5>
                                    <div class="choice">
                                        <label class="radio-inline"><input type="radio" name="q3">Disagree</label>
                                        <label class="radio-inline"><input type="radio" name="q3">Partly disgree</label>
                                        <label class="radio-inline"><input type="radio" name="q3">Neither</label>
                                        <label class="radio-inline"><input type="radio" name="q3">Partly Agree</label>
                                        <label class="radio-inline"><input type="radio" name="q3">Agree</label>
                                    </div>
                                </div>
                                <div class="question-ct">
                                    <h5>1.  You find it easy to introduce yourself to other people.</h5>
                                    <div class="choice">
                                        <label class="radio-inline"><input type="radio" name="q4">Disagree</label>
                                        <label class="radio-inline"><input type="radio" name="q4">Partly disgree</label>
                                        <label class="radio-inline"><input type="radio" name="q4">Neither</label>
                                        <label class="radio-inline"><input type="radio" name="q4">Partly Agree</label>
                                        <label class="radio-inline"><input type="radio" name="q4">Agree</label>
                                    </div>
                                </div>
                                <div class="question-ct">
                                    <h5>1.  You find it easy to introduce yourself to other people.</h5>
                                    <div class="choice">
                                        <label class="radio-inline"><input type="radio" name="q5">Disagree</label>
                                        <label class="radio-inline"><input type="radio" name="q5">Partly disgree</label>
                                        <label class="radio-inline"><input type="radio" name="q5">Neither</label>
                                        <label class="radio-inline"><input type="radio" name="q5">Partly Agree</label>
                                        <label class="radio-inline"><input type="radio" name="q5">Agree</label>
                                    </div>
                                </div>
                            </div>
                            <p class="txt-center">
                                <button type="submit" class="btn btn-lg btn-danger">Submit</button>
                            </p>
                        </form>
                  </div>
                </div>
                <!-- /End Tab Panes/ -->
            </div>    
        </section>
    </div><!-- End #content -->