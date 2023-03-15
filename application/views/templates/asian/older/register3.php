</script>
<!--[if IE 8]>	<style>		input.default_form{			padding-top:10px;			height:22px;		}	</style><![endif]-->

<section>
  <center>
    <div class="reg_container">
      <table class="reg_header">
        <tr>
          <td>&#160;&#160;&#160;&#160;</td>
          <td style="vertical-align:middle;"><img style="margin-top:0px;;" src="/templates/asian/registration_img1.png"> </td>
          <td>Create Your Account <span style="color:#777;">(2 steps)</span> </td>
        </tr>
      </table>
      <div class="reg_innerContainer2">
        <div class="reg_innerLabel">STEP 2</div>
        <div class="reg_left1">
          <?php	echo form_open("/register/step3", array('id'=>'registration_form'));?>
          <table class="reg_form2" style="padding-left:30px;width:95%;">
            <tr>
              <td colspan="3" style="font-size:14px;"><b>Your Appearance</b></td>
            </tr>
            <tr>
              <td>Hair Color</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('Hair Color', $hair_color['options'], $hair_color['value'], $hair_color['form_options']);?> </td>
            </tr>
            <tr>
              <td>Eye Color</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('Eye Color', $eye_color['options'], $eye_color['value'], $eye_color['form_options']);?> </td>
            </tr>
            <tr>
              <td>Height</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_error('height') . form_input($height);?> ft. </td>
            </tr>
            <tr>
              <td>Weight</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_error('weight') . form_input($weight);?> kgs. </td>
            </tr>
            <tr>
              <td>Body Type</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('Body Type', $body_type['options'], $body_type['value'], $body_type['form_options']);?> </td>
            </tr>
            <tr>
              <td>Your Ethnicity is mostly:</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('Ethnicity', $ethnicity['options'], $ethnicity['value'], $ethnicity['form_options']);?> </td>
            </tr>
            <tr>
              <td>I consider my appearance as:</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('appearance', $appearance['options'], $appearance['value'], $appearance['form_options']);?> </td>
            </tr>
          </table>
        </div>
        <div class="reg_right1">
          <table class="reg_form2" style="padding-left:30px;width:95%;">
            <tr>
              <td colspan="3" style="font-size:14px;"><b>Your Lifestyle</b></td>
            </tr>
            <tr>
              <td>Do you drink?</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('drink', $drink['options'], $drink['value'], $drink['form_options']);?> </td>
            </tr>
            <tr>
              <td>Do you smoke?</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('smoke', $smoke['options'], $smoke['value'], $smoke['form_options']);?> </td>
            </tr>
            <tr>
              <td>Mental Status:</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('mental_status', $mental_status['options'], $mental_status['value'], $mental_status['form_options']);?> </td>
            </tr>
            <tr>
              <td>Do you have children</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('have_children', $have_children['options'], $have_children['value'], $have_children['form_options']);?> </td>
            </tr>
            <tr>
              <td>Do you want (more) children?</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('want_more_children', $want_more_children['options'], $want_more_children['value'], $want_more_children['form_options']);?> </td>
            </tr>
            <tr>
              <td>Occupation:</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('occupation', $occupation['options'], $occupation['value'], $occupation['form_options']);?> </td>
            </tr>
            <tr>
              <td>Willing to relocate:</td>
              <td>&#160;&#160;&#160;</td>
              <td><?php echo form_dropdown('willing_to_relocate', $willing_to_relocate['options'], $willing_to_relocate['value'], $willing_to_relocate['form_options']);?> </td>
            </tr>
            <tr>
              <td>Relationship you're looking for:</td>
              <td>&#160;&#160;&#160;</td>
              <td></td>
            </tr>
            <tr>
              <td colspan="3"><?php 								//print_r($relationship_your_looking_for);								foreach($relationship_your_looking_for as $rylf){									//print_r($rylf);									echo '&#160;'.form_checkbox($rylf).'&#160;'.str_replace('-', ' ', $rylf['value']).' &#160;&#160;';								}							?>
              </td>
            </tr>
          </table>
        </div>
        <div class="reg_bottom">
          <center>
            <div style="float:left;width:440px;text-align:left;">
              <table class="reg_form3" style="padding-left:30px;width:90%;">
                <tr>
                  <td colspan="3" style="font-size:14px;"><b>Your Background / Cultural Values</b></td>
                </tr>
                <tr>
                  <td>Nationality:</td>
                  <td>&#160;&#160;&#160;</td>
                  <td><?php echo form_dropdown('Hair Color', $hair_color['options'], $hair_color['value'], $hair_color['form_options']);?> </td>
                </tr>
                <tr>
                  <td>Education:</td>
                  <td>&#160;&#160;&#160;</td>
                  <td><?php echo form_dropdown('Eye Color', $eye_color['options'], $eye_color['value'], $eye_color['form_options']);?> </td>
                </tr>
                <tr>
                  <td>English language ability:</td>
                  <td>&#160;&#160;&#160;</td>
                  <td><?php echo form_error('height') . form_input($height);?> ft. </td>
                </tr>
                <tr>
                  <td>Religion:</td>
                  <td>&#160;&#160;&#160;</td>
                  <td><?php echo form_error('weight') . form_input($weight);?> kgs. </td>
                </tr>
                <tr>
                  <td>Chinese sign:</td>
                  <td>&#160;&#160;&#160;</td>
                  <td><?php echo form_dropdown('Body Type', $body_type['options'], $body_type['value'], $body_type['form_options']);?> </td>
                </tr>
                <tr>
                  <td>Star sign:</td>
                  <td>&#160;&#160;&#160;</td>
                  <td><?php echo form_dropdown('Ethnicity', $ethnicity['options'], $ethnicity['value'], $ethnicity['form_options']);?> </td>
                </tr>
              </table>
            </div>
            <div style="float:left;width:450px;text-align:left;">
              <table class="reg_form3" style="padding-left:30px;width:80%;">
                <tr>
                  <td colspan="3" style="font-size:14px;"><b>In your own words</b></td>
                </tr>
                <tr>
                  <td colspan="3"><div style="float:right;width:400px;">
                      <table class="reg_form2" style="padding-left:30px;width:80%;">
                        <tr>
                          <td>Your profile heading</td>
                          <td>&#160;&#160;&#160;</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="3"><?php echo form_dropdown('Eye Color', $eye_color['options'], $eye_color['value'], $eye_color['form_options']);?> </td>
                        </tr>
                        <tr>
                          <td>Your profile heading</td>
                          <td>&#160;&#160;&#160;</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="3"><?php echo form_dropdown('Eye Color', $eye_color['options'], $eye_color['value'], $eye_color['form_options']);?> </td>
                        </tr>
                        <tr>
                          <td>Your profile heading</td>
                          <td>&#160;&#160;&#160;</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="3"><?php echo form_dropdown('Eye Color', $eye_color['options'], $eye_color['value'], $eye_color['form_options']);?> </td>
                        </tr>
                      </table>
                    </div></td>
                </tr>
              </table>
            </div>
            <div style="clear:both"> <br>
              <br>
              <a id="submit_form" style="cursor:pointer"><img src="/templates/asian/continue.jpg"></a> </div>
          </center>
        </div>
        <?php echo form_close();?>
      </div>
    </div>
  </center>
</section>
