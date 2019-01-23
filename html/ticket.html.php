	<title>Fox's Den - Ticket</title>
<link rel="stylesheet" href="css/profile.css">
	<script type="text/javascript" src="src/assets/js/canvasjs.min.js"></script>
</head>
<body>
	<a href="javascript:" id="return-to-top"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span></a>
	<div id="overall_container" class="container">

	<?php include("html/modules/nav_bar.html.php");?>

	<div class="row" style="padding:15px">

	<div>
		<h2>
			<?=$reply_array[0]['ticket_title']?>
			<?php if($reply_array[0]['ticket_closed']==1):?>
				-CLOSED
			<?php endif;?>
		</h2>
		<h4>from: <?=$reply_array[0]['ticket_author']?></h4>
		<p><?=$reply_array[0]['ticket_text']?>
	</div>
	<?php foreach($reply_array[1] AS $row):?>
		<div>
			<h4><?=$row['author']?> replied:</h4>
			<p><?=$row['long_text']?></p>
		</div>

	<?php endforeach;?>
		
	
	<?php if($reply_array[0]['ticket_closed']==0):?>
	<form method='POST' action=<?="src/reply_to_ticket.php?id=".$ticketID?>>
		Reply(max. 2000 characters):
		<textarea name='long_text' class='text_area_box'/></textarea>
		<br/>
		<input type='Submit' value='Reply' class='submit_button'/>
	</form>

	<br/><br/>
	<button type="button"
		onclick="document.getElementById('close_ticket_confirm').style.display='block'">
	Close ticket
	</button>

	<p id="close_ticket_confirm" style="display:none">
		Are you sure you want to close this ticket?
		<a href=<?="src/close_ticket.php?id=".$id?>>Yes</a>
	</p>
	<?php endif;?>
	

</body>
</html>
