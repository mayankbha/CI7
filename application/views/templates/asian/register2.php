    <div class="content-box">
        <section class="container">
                <div class="row">
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home fa-2x icon-round-border"></i></li>
                        <li><a  class="icon_home" href="#"><?php echo $this->lang->line('home');?></a></li>
                        <li class="active"><span><?php echo $this->lang->line('reg_label');?> <i>(<?php echo $this->lang->line('reg_steps');?>)</i></span></li>
                    </ol>
                </div>
                <h3 class="page-title txt-red txt-upper"><?php echo $this->lang->line('reg_step_2');?></h3>
				
				<?php
				echo form_open("./register/step_2", array('id'=>'registration_form', 'class'=>'frm-register form-horizontal'));?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="content-box-border">
                                <legend><?php echo $this->lang->line('reg_your_appearance');?></legend>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_hair_color');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('hair_color', $hair_color['options'], $hair_color['value'], $hair_color['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_eye_color');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('eye_color', $eye_color['options'], $eye_color['value'], $eye_color['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_height');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_error('height') . form_input($height);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_weight');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_error('weight') . form_input($weight);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_body_type');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('body_type', $body_type['options'], $body_type['value'], $body_type['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_your_ethnicity_is_mostly');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('ethnicity', $ethnicity['options'], $ethnicity['value'], $ethnicity['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_consider_my_appearance');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('appearance', $appearance['options'], $appearance['value'], $appearance['form_options']);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="content-box-border">
                                <legend><?php echo $this->lang->line('reg_your_ethnicity_is_mostly');?></legend>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_do_you_drink');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('drink', $drink['options'], $drink['value'], $drink['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_do_you_smoke');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('smoke', $smoke['options'], $smoke['value'], $smoke['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_marital_status');?></label>
                                    <div class="col-sm-6">
                                         <?php echo form_dropdown('marital_status', $marital_status['options'], $marital_status['value'], $marital_status['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_do_you_have_children');?></label>
                                    <div class="col-sm-6">
                                       <?php echo form_dropdown('have_children', $have_children['options'], $have_children['value'], $have_children['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_occupation');?></label>
                                    <div class="col-sm-6">
                                       <?php echo form_dropdown('occupation', $occupation['options'], $occupation['value'], $occupation['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_willing_to_relocate');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('willing_to_relocate', $willing_to_relocate['options'], $willing_to_relocate['value'], $willing_to_relocate['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12"><?php echo $this->lang->line('reg_relationship_your_looking_for');?></label>
                                    <div class="col-sm-11 col-sm-offset-1">
                                    <?
									//echo "here";print_r($relationship_your_looking_for['relationship_is_looking_for_options']);echo "<br>";die;
                                    foreach($relationship_your_looking_for['relationship_is_looking_for_options'] as $rylf)
										{
											?>
												<input id="Rel_<?php echo str_replace(' ', '_', $rylf['options']); ?>" name="relationship_your_looking_for[]" <?php if(isset($rylf['selected'])){ echo "checked=\"checked\"";}?> value="<?php echo $rylf['options']; ?>" type="checkbox"> <?php echo $rylf['options']; ?>
																				
											<? }?>	
									<?php /*?><?php
										echo form_error('relationship_your_looking_for');
										//print_r($relationship_your_looking_for);
										foreach($relationship_your_looking_for as $rylf){
											//print_r($rylf);
											echo '
											<label class="checkbox-inline">'.form_checkbox($rylf).' '.str_replace('-', ' ', $this->lang->line('reg_'.$rylf['value'])).'
											</label>';
										}
									?>
<?php */?>                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-box-border">
                        <div class="row">
                            <div class="col-sm-6">
                                <legend><?php echo $this->lang->line('reg_your_background_cultural_values');?></legend>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1">  <?php echo $this->lang->line('reg_nationality');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('nationality', $nationality['options'], $nationality['value'], $nationality['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_education');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('education', $education['options'], $education['value'], $education['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_english_language_ability');?></label>
                                    <div class="col-sm-6">
                                       <?php echo form_dropdown('english_ability', $english_ability['options'], $english_ability['value'], $english_ability['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_vietnamese_language_ability');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('vietnamese_ability', $vietnamese_ability['options'], $vietnamese_ability['value'], $vietnamese_ability['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_religion');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('religion', $religion['options'], $religion['value'], $religion['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_chinese_sign');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('chinese_sign', $chinese_sign['options'], $chinese_sign['value'], $chinese_sign['form_options']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label col-sm-offset-1"><?php echo $this->lang->line('reg_star_sign');?></label>
                                    <div class="col-sm-6">
                                        <?php echo form_dropdown('star_sign', $star_sign['options'], $star_sign['value'], $star_sign['form_options']);?>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <legend><?php echo $this->lang->line('reg_in_your_own_words');?></legend>
                                <div class="form-group">
                                    <label class="col-sm-10 col-sm-offset-1"> <?php echo $this->lang->line('reg_your_profile_heading');?></label>
                                    <div class="col-sm-10 col-sm-offset-1">
                                       <?php echo form_error('profile_head') . form_input($profile_head); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-10 col-sm-offset-1"> <?php echo $this->lang->line('reg_a_little_about_yourself');?></label>
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <?php echo form_error('about_yourself') . form_input($about_yourself); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-10 col-sm-offset-1"> <?php echo $this->lang->line('reg_what_your_looking_for_in_a_partner');?></label>
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <?php echo form_error('looking_for_in_partner') . form_textarea($looking_for_in_partner); ?>
                                    </div>
                                </div>
                                <script> 
									$('#about_yourself').keyup(function() {
        								this.value = this.value.replace(/[^A-Za-z '()\.]/g,' ');
    								});
									$('#looking_for_in_partner').keyup(function() {
        								//$(this).val($(this).val().replace(/[^A-Za-z0-9~`!@#$%^&*()_+-=\[\]{};'\\:"|,.\/<>?]/g,''))
										this.value = this.value.replace(/[^A-Za-z '()\.]/g,' ');
    								});
								</script>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <label class="checkbox-inline">
							<?php echo form_error('terms2'); ?> <?php echo form_input($terms2);?>
                            <?php echo $this->lang->line('reg_terms');?> <a href="#"><?php echo $this->lang->line('reg_terms_link');?></a> <?php echo $this->lang->line('reg_terms_and');?> <a href="#"><?php echo $this->lang->line('reg_terms_link_2');?> </a>
						</label>
                    </div>
                    <p class="txt-center">
                        <button type="submit" class="btn btn-lg btn-danger" ><?php echo $this->lang->line('register');?></button>
                    </p>
                </form>
            </div><!-- End .row -->
        </section><!-- End .container -->
    </div><!-- End #content -->
<style>
.reg-none{ visibility:hidden !important;}
</style>        