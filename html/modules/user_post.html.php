<div id=<?="'user_post_well_id_".$row['id']."'"?> class="well well-lg user_post_well" style="word-wrap: break-word;">
	<div class="media-left">
	   	<a href= <?='"profile.php?user='.$row["username"].'"'?>>
	   		<img style="width:48px; height:48px;" class="media-object" src=<?='"'.$row["profile_picture"].'"'?>>
	   	</a>
	</div>
	<div class='media-body'>
	   	<h4 class='media-heading'><a href= <?='"profile.php?user='.$row["username"].'"'?>><?=ucfirst($row["username"])?></a></h4>
	   	<small>
	   		<?php 
	   			if(isset($profile)) {
	   				echo $profile->build_friendly_date_time($row["date"]); 
	   				
	   			}
	   			elseif(isset($homepg)) {
	   				echo $homepg->build_friendly_date_time($row["date"]);
	   			}
	   		?>
	   	</small>
	   
	</div>
	<h2><?=nl2br($row['title'])?></h2>
	<div>
		<?php if(strlen($row['text'])>200) {
				echo nl2br(substr($row['text'], 0, 120));?><br/>
				<button type="button" class="btn btn-link" data-toggle="modal" data-target="#user_post_modal_id_<?=$row['id']?>">
					Read more...
				</button>
		<?php
			}
			else {
				echo nl2br($row['text']);
			}
		?>
	</div>
	<br/>
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class=<?php echo '"btn btn-default'; if($row['like']==TRUE) echo " active"; echo '"';?> aria-label="Left Align" onclick=<?='"upvote_post_of_id('.$row['id'].')"'?> id=<?='"upvote_post_button_of_id_'.$row['id'].'"'?>>
			<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> <?=$row["n_o_upvotes"]?><span class="hidden-sm hidden-xs"> Upvote<?php if ($row["n_o_upvotes"] != 1) {echo "s";} ?></span>
		</button>
		<button type="button" class=<?php echo '"btn btn-default'; if($row['dislike']==TRUE) echo " active"; echo '"';?> aria-label="Left Align"onclick=<?='"downvote_post_of_id('.$row['id'].')"'?> id=<?='"downvote_post_button_of_id_'.$row['id'].'"'?>>
			<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> <?=$row["n_o_downvotes"]?><span class="hidden-sm hidden-xs"> Downvote<?php if ($row["n_o_downvotes"] != 1) {echo "s";} ?><span>
		</button>
		<button type="button" class="btn btn-default disabled" aria-label="Left Align">
			<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <?=$row["n_o_comments"]?><span class="hidden-sm hidden-xs"> Comment<?php if ($row["n_o_comments"] != 1) {echo "s";} ?><span>
		</button>
	</div>

	<div class="form-group">
		<div class="input-group">
		  	<input type="text" class="form-control" name="search_text" placeholder="Comment..."/>
		  	<span class="input-group-btn">
		  		<input type="submit" class="btn btn-default" value="Comment"/>
		  	</span>
	  	</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby=<?="'user_post_modal_id_".$row['id']."'"?> id="user_post_modal_id_<?=$row['id']?>">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<!-- MODAL HEADER -->
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<div class="media-left">
				   	<a href= <?='"profile.php?user='.$row["username"].'"'?>>
				   		<img style="width:48px; height:48px;" class="media-object" src=<?='"'.$profile_picture.'"'?>>
				   	</a>
				</div>
				<div class='media-body'>
				   	<h4 class='media-heading'><a href= <?='"profile.php?user='.$row["username"].'"'?>><?=$row["username"]?></a></h4>
				   	<small>
				   		<?php 
				   			if(isset($profile)) {
				   				echo $profile->build_friendly_date_time($row["date"]); 
				   				
				   			}
				   			elseif(isset($homepg)) {
				   				echo $homepg->build_friendly_date_time($row["date"]);
				   			}
				   		?>
				   	</small>
				   
				</div>
				<h2><?=nl2br($row['title'])?></h2>
	      	</div>
	      	<!-- MODAL BODY -->
	      	<div class="modal-body modal_post_content">
	       		<?=nl2br($row['text'])?>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div>
	    </div>
 	</div>
</div>