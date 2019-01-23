<!DOCTYPE html>

<html>
<head>
	<title>Ticketing</title>
</head>

<body>
	<a href="index.php">Home</a>
	<table>
		<tr>
			<th>Ticket title</th>
			<?php if($ticket_list["session"]=="admin_session"): ?>
				<th>Ticket author</th>
			<?php endif; ?>
			<th>Replies</th>
			<th>Last reply</th>
			<th>Status</th>
		</tr>
		<?php foreach($ticket_list["tickets"] as $ticket_entry): ?>
			<tr>
				<td><a href=<?='"ticket.php?id='.$ticket_entry['id'].'"'?>>
					<?=$ticket_entry['title_text']?>
					</a>
				</td>
			<?php if($ticket_list["session"]=="admin_session"): ?>
					<td><?=$ticket_entry['author']?></td>
				<?php endif; ?>
				<td><?=$ticket_entry['number_of_replies']?> repl<?php if($ticket_entry['number_of_replies']!=1) echo "ies"; else echo "y";?></td>
				<td><?=$ticket_entry['last_reply']?></td>
				<?php if($ticket_entry['closed']==1):?><td>CLOSED</td><?php endif;?>
				<?php if($ticket_entry['closed']==0):?><td>OPEN</td><?php endif;?>

			</tr>
		<?php endforeach;?>


	</table>


</body>
</html>
