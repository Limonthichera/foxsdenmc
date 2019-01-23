<div id=<?="'news_well_id_".$row['id']."'"?> class="well well-lg news_well" style="word-wrap: break-word;">

	<h2><?=nl2br($row['title'])?></h2>
	<div>
		<?=$row["content_short"]?><br/>
		<small>
	   		<?=$news->build_friendly_date_time($row["date"])?>
	   	</small>
		<button type="button" class="btn btn-link" data-toggle="modal" data-target="#news_modal_id_<?=$row['id']?>">
			Read more...
		</button>
	</div>
	<br/>
</div>

<!-- Modal -->
<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby=<?="'news_modal_id_".$row['id']."'"?> id="news_modal_id_<?=$row['id']?>">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<!-- MODAL HEADER -->
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<div class='media-body'>
				   	<small>
				   		<?=$news->build_friendly_date_time($row["date"])?>
				   	</small>
				   
				</div>
				<p><?=nl2br($row['content-short'])?></p>
	      	</div>
	      	<!-- MODAL BODY -->
	      	<div class="modal-body modal_post_content">
	       		<?=nl2br($row['content'])?>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div>
	    </div>
 	</div>
</div>