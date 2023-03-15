<div class="content-box">
  <section class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li><i class="fa fa-user fa-2x icon-round-border"></i></li>
      <li class="active"><span> Member Homepage </span></li>
    </ol>
  </div>
  <div class="row search-result-ct">
    <div class="col-sm-4">
    <form method="post" action="/search_result" class="frm-search form-horizontal">
      <div class="form-group">
        <label class="col-sm-4 control-label">I am</label>
        <div class="col-sm-8"> <?php echo form_dropdown('i_am', $i_am['options'], $i_am['value'], $i_am['form_options']); ?> </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label"> Looking for </label>
        <div class="col-sm-8"> <?php echo form_dropdown('looking_for', $looking_for['options'], $looking_for['value'], $looking_for['form_options']); ?> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" for="amount"> Age </label>
        <div class="col-sm-9"> <?php echo form_input($age); ?> </div>
      </div>
      <?php	
			if (@isset($this->session->userdata['user_id']))
             {
		?>
      <div>
        <!-- needs to integrate with above variables -->
        <!--
    <div class="form-group">
    <label class="col-sm-3 control-label">I'm seeking a:</label>
    <div class="col-sm-6">
                            <?php echo form_dropdown('im_seeking_a', $match['im_seeking_a']['options'], $match['im_seeking_a']['value'], $match['im_seeking_a']['form_options']); ?>
    </div>
    </div>
    <div class="form-group">
    <label class="col-sm-3 control-label">Age Between</label>
    <div class="col-sm-7">
    <input type="text" id="match_age-slider" name="age" value="18;99" />
    </div>
    </div> -->
        <div class="form-group live-box">
          <label class="col-sm-3 control-label"> Living in </label>
          <div class="col-sm-4"> <?php echo form_dropdown('living_in', $match['living_in']['options'], $match['living_in']['value'], $match['living_in']['form_options']); ?> </div>
          <div class="col-sm-5"> <?php echo form_dropdown('living_in2', $match['living_in2']['options'], $match['living_in2']['value'], $match['living_in2']['form_options']); ?> </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label"> With in (km) </label>
          <div class="col-sm-9"> <?php echo form_dropdown('with_in', $match['with_in']['options'], $match['with_in']['value'], $match['with_in']['form_options']); ?> </div>
        </div>
        <legend>Their Lifestyle</legend>
        <div class="form-group">
          <label class="checkbox-inline col-sm-3"> <?php echo form_radio($match['lifestyle']) . '<br />' . $match['lifestyle']['value']; ?> </label>
          <label class="checkbox-inline col-sm-3"> <?php echo form_radio($match['lifestyle1']) . '<br />' . $match['lifestyle1']['value']; ?> </label>
          <label class="checkbox-inline col-sm-3"> <?php echo form_radio($match['lifestyle2']) . '<br />' . $match['lifestyle2']['value']; ?> </label>
        </div>
        <hr>
        <div class="form-group">
          <label class="col-sm-3 control-label"> Nationality: </label>
          <div class="col-sm-9"> <?php echo form_dropdown('nationality', $match['nationality']['options'], $match['nationality']['value'], $match['nationality']['form_options']); ?> </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label"> Education </label>
          <div class="col-sm-9"> <?php echo form_dropdown('education', $match['education']['options'], $match['education']['value'], $match['education']['form_options']); ?> </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label"> English Ability: </label>
          <div class="col-sm-9"> <?php echo form_dropdown('english_ability', $match['english_ability']['options'], $match['english_ability']['value'], $match['english_ability']['form_options']); ?> </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label"> Vietnamese Ability: </label>
          <div class="col-sm-9"> <?php echo form_dropdown('vietnamese_ability', $match['vietnamese_ability']['options'], $match['vietnamese_ability']['value'], $match['vietnamese_ability']['form_options']); ?> </div>
        </div>
        <legend>Their Appearance</legend>
        <div class="form-group">
          <label class="control-label col-sm-3" for="amount"> Height </label>
          <div class="col-sm-9"> <?php echo form_input($height); ?> </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="amount"> Weight </label>
          <div class="col-sm-9"> <?php echo form_input($weight); ?> </div>
        </div>
        <legend>Body type:</legend>
        <?php

		//print_r($match['body_type']);

		$btcount = 1;

		$xrestart = array(1, 4, 7, 10, 13, 16, 19, 22);

		foreach ($match['body_type'] as $btvalue)
			{
			if (in_array($btcount, $xrestart))
				{
					if($btcount > 1)
					{
			?>
      </div>
      <?php
				  }
			?>
      <div class="form-group">
        <label class="checkbox-inline col-sm-3" >
        <input name="body_type" <?php if (isset($btvalue['selected'])){ echo "checked=\"checked\""; } ?> value="<?php echo $btvalue['value']; ?>" type="radio">
        <br />
        <?php echo $btvalue['options']; ?> </label>
        <?php
					} else
					{
			?>
        <label class="checkbox-inline col-sm-3">
        <input name="body_type" <?php
											if (isset($btvalue['selected']))
											{
												echo "checked=\"checked\"";
											}
											?> value="<?php echo $btvalue['value']; ?>" type="radio">
        <br />
        <?php echo $btvalue['options']; ?> </label>
        <?php
				}
			?>
        <?php
				$btcount++;
					}
            ?>
      </div>
      <legend>Their ethnicity is mostly:</legend>
      <div class="form-group">
        <div class="col-sm-8"> <?php echo form_dropdown('ethnicity', $match['ethnicity']['options'], $match['ethnicity']['value'], $match['ethnicity']['form_options']); ?> </div>
      </div>
      <!--div class="form-group">

                            <label class="control-label col-sm-3" for="amount">Height</label>

                            <div class="col-sm-9">

                                <input type="text" id="height-slider" name="height" value="100;220" />

                            </div>

                        </div>


                        <div class="form-group">

                            <label class="col-sm-4 control-label">Country</label>

                            <div class="col-sm-8">

                                <select class="form-control"><option>Vietnam</option></select>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-sm-4 control-label">County</label>

                            <div class="col-sm-8">

                                <select class="form-control"><option>Hanoi</option></select>

                            </div>

                        </div-->
      <!--div class="form-group">

                            <label class="control-label col-sm-10" for="amount">Apperence Self estimated</label>

                            <div class="col-sm-10 col-sm-offset-1">

                                <input class="single-filter" type="text" name="apperence" value="0;100" />

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-10" for="amount">Matching in %</label>

                            <div class="col-sm-10 col-sm-offset-1">

                                <input class="single-filter" type="text" name="match" value="0;100" />

                            </div>

                        </div-->
      </div>
      <?php
            }
	 ?>
      <div class="form-group frm-search-actions">
        <div class="col-sm-6">
          <button class="btn btn-danger"> Search </button>
        </div>
        <?php
                if (@isset($this->session->userdata['user_id']))
                {
		?>
        <div class="col-sm-6"> <a href="#demo" class="pull-right advanced-search-btn"> Advance Search </a> </div>
        <?php
                }
	    ?>
      </div>
    </form>
  </div>
  <div class="col-sm-8">
    <div class="section-title bg-red txt-upper"> Highest Matching </div>
    <?php

	if ($search_result == 0)
	{
		echo '<div class="row">
			<div class="col-sm-12">
				<div class="member-box content-box-border">
					Search found (0) members matching your criteria.
					<br>
					Pls. Widen your search to get better results.
				</div>
			</div>
		</div>';
	} else

		{
		$found_users_count = 1;
		$odd = array(1, 3, 5, 7, 9, 11, 13, 15, 17, 19, 21);
	
			foreach ($found_users as $fid => $fvalue)
			{
				if (in_array($found_users_count, $odd))
				{
		?>
    <div class="row">
      <div class="col-sm-6">
        <div class="member-box content-box-border">
          <div class="member-avatar pull-left"> <a href="/profile/user/<?php echo $fid; ?>" ><img src="/resources/img/gallery_1.png" alt=""></a> </div>
          <p class="member-id"><a href="/profile/user/<?php echo $fid; ?>"><strong><?php echo $fvalue['first_name'] . ' ' . $fvalue['last_name'] . ' (' . $fvalue['age'] . ')'; ?></strong></a></p>
          <p class="member-quote"><em><i class="fa fa-quote-left"></i> <?php echo $fvalue['profile_head']; ?></em></p>
          <p class="member-loc"><?php echo ucfirst($fvalue['state_province']); ?> <?php echo ucfirst($fvalue['city']); ?>, <?php echo $fvalue['country']; ?></p>
          <p class="member-status"><strong> Seeking: </strong> <?php echo $fvalue['im_seeking_a']; ?> <?php echo str_replace(';', '-', $fvalue['age_between']); ?></p>
          <p class="member-action"> <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a> <a href="#modal-heart" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> <a href="#modal-like" title="Like" data-toggle="modal"><i class="fa fa-thumbs-up"></i></a> <a href="#modal-warning" title="Warning" data-toggle="modal"><i class="fa fa-exclamation"></i></a> <a href="#modal-fav" title="Add to Favourite" data-toggle="modal"><i class="fa fa-plus"></i></a> </p>
        </div>
      </div>
      <?php
		} else
		{
			?>
      <div class="col-sm-6">
        <div class="member-box content-box-border">
          <div class="member-avatar pull-left"> <a href="#modal-login" data-toggle="modal"><img src="/resources/img/gallery_1.png" alt=""></a> </div>
          <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong><?php echo $fvalue['first_name'] . ' ' . $fvalue['last_name'] . ' (' . $fvalue['age'] . ')'; ?></strong></a></p>
          <p class="member-quote"><em><i class="fa fa-quote-left"></i> <?php echo $fvalue['profile_head']; ?></em></p>
          <p class="member-loc"><?php echo ucfirst($fvalue['state_province']); ?> <?php echo ucfirst($fvalue['city']); ?>, <?php echo $fvalue['country']; ?></p>
          <p class="member-status"><strong>Seeking: </strong> <?php echo $fvalue['im_seeking_a']; ?> <?php echo str_replace(';', '-', $fvalue['age_between']); ?></p>
          <p class="member-action"> <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a> <a href="#modal-heart" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> <a href="#modal-like" title="Like" data-toggle="modal"><i class="fa fa-thumbs-up"></i></a> <a href="#modal-warning" title="Warning" data-toggle="modal"><i class="fa fa-exclamation"></i></a> <a href="#modal-fav" title="Add to Favourite" data-toggle="modal"><i class="fa fa-plus"></i></a> </p>
        </div>
      </div>
    </div>
    <?php
			}
				$found_users_count++;
			}
		if (!in_array($found_users_count, $odd))
			{
				echo '</div>';
			}
	
		?>
    <!-- Pagination -->
    <!--<div class="pagination"> <span class="disabled">Prev</span> <a href="#" class="active">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <span class="disabled">...</span> <a href="#">8</a> <a href="#">Next</a> </div>-->
    <?php
				}
            ?>
  </div>
  <?php
	//}
   ?>
</div>
<div class="content-box-border">
  <div class="box-title bg-red txt-upper">Newest Members</div>
  <div class="member-slider">
    <div class="content-box-border clearfix member-box">
      <div class="member-avatar pull-left"> <a href="#modal-login" data-toggle="modal"><img src="/resources/img/gallery_1.png" alt=""></a> </div>
      <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
      <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
      <p class="member-loc">Hai Chau, Danang, Vietnam</p>
      <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
      <p class="member-action"> <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a> <a href="#modal-heart" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> <span class="label label-warning">100%</span> </p>
    </div>
    <div class="content-box-border clearfix member-box">
      <div class="member-avatar pull-left"> <a href="#modal-login" data-toggle="modal"><img src="/resources/img/gallery_1.png" alt=""></a> </div>
      <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
      <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
      <p class="member-loc">Hai Chau, Danang, Vietnam</p>
      <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
      <p class="member-action"> <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a> <a href="#modal-heart" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> <span class="label label-warning">100%</span> </p>
    </div>
    <div class="content-box-border clearfix member-box">
      <div class="member-avatar pull-left"> <a href="#modal-login" data-toggle="modal"><img src="/resources/img/gallery_1.png" alt=""></a> </div>
      <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
      <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
      <p class="member-loc">Hai Chau, Danang, Vietnam</p>
      <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
      <p class="member-action"> <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a> <a href="#modal-heart" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> <span class="label label-warning">100%</span> </p>
    </div>
    <div class="content-box-border clearfix member-box">
      <div class="member-avatar pull-left"> <a href="#modal-login" data-toggle="modal"><img src="/resources/img/gallery_1.png" alt=""></a> </div>
      <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
      <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
      <p class="member-loc">Hai Chau, Danang, Vietnam</p>
      <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
      <p class="member-action"> <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a> <a href="#modal-heart" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> <span class="label label-warning">100%</span> </p>
    </div>
    <div class="content-box-border clearfix member-box">
      <div class="member-avatar pull-left"> <a href="#modal-login" data-toggle="modal"><img src="/resources/img/gallery_1.png" alt=""></a> </div>
      <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
      <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
      <p class="member-loc">Hai Chau, Danang, Vietnam</p>
      <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
      <p class="member-action"> <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a> <a href="#modal-heart" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> <span class="label label-warning">100%</span> </p>
    </div>
    <div class="content-box-border clearfix member-box">
      <div class="member-avatar pull-left"> <a href="#modal-login" data-toggle="modal"><img src="/resources/img/gallery_1.png" alt=""></a> </div>
      <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
      <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
      <p class="member-loc">Hai Chau, Danang, Vietnam</p>
      <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
      <p class="member-action"> <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a> <a href="#modal-heart" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> <span class="label label-warning">100%</span> </p>
    </div>
    <div class="content-box-border clearfix member-box">
      <div class="member-avatar pull-left"> <a href="#modal-login" data-toggle="modal"><img src="/resources/img/gallery_1.png" alt=""></a> </div>
      <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
      <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
      <p class="member-loc">Hai Chau, Danang, Vietnam</p>
      <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
      <p class="member-action"> <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a> <a href="#modal-heart" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> <span class="label label-warning">100%</span> </p>
    </div>
    <div class="content-box-border clearfix member-box">
      <div class="member-avatar pull-left"> <a href="#modal-login" data-toggle="modal"><img src="/resources/img/gallery_1.png" alt=""></a> </div>
      <p class="member-id"><a href="#modal-login" data-toggle="modal"><strong>quynhhuong (29)</strong></a></p>
      <p class="member-quote"><em><i class="fa fa-quote-left"></i> di tim 1 nua cua doi minh, hihi, hehe</em></p>
      <p class="member-loc">Hai Chau, Danang, Vietnam</p>
      <p class="member-status"><strong>Seeking: </strong> Male 32-40</p>
      <p class="member-action"> <a href="#modal-livechat" title="Live Chat" data-toggle="modal"><i class="fa fa-comments"></i></a> <a href="#modal-heart" title="Send Heart" data-toggle="modal"><i class="fa fa-heart"></i></a> <span class="label label-warning">100%</span> </p>
    </div>
  </div>
</div>
</div>
<!-- End .row -->
</section>
<!-- End .container -->
</div>
<!-- End #content -->
