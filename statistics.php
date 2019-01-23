<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	session_start();

	if(!isset($_SESSION['limoncon']) || !isset($_SESSION['username'])) {
		header ('Location: index.php');
		exit(0);
	}
	else {
		$_SESSION['location'] = "statistics.php";
	}


	$edit_button = FALSE;

	include("src/assets/php/database_functions.php");
	include("src/assets/php/user_functions.php");

	$database = new database_functions;
	$stats = new user_functions;

	//var_dump($search_result_array);

	include("html/modules/head.html.php");

	$public_messages_last_7_days_array = $stats->get_public_messages_last_n_days_array($database, $_SESSION['username'], 14);
	$private_messages_sent_last_7_days_array = $stats->get_private_messages_sent_last_n_days_array($database, $_SESSION['username'], 14);
	$private_messages_recieved_last_7_days_array = $stats->get_private_messages_recieved_last_n_days_array($database, $_SESSION['username'], 14);

	$upvotes_recieved_last_10_weeks_array = $stats->get_upvotes_recieved_last_n_weeks_array($database, $_SESSION['username'], 12);
	$downvotes_recieved_last_10_weeks_array = $stats->get_downvotes_recieved_last_n_weeks_array($database, $_SESSION['username'], 12);

	$number_of_upvotes_and_downvotes_array = $stats->count_upvotes_and_downvotes($database, $_SESSION['username']);


	?>
	<script>
	//-----------------------------------------------------------------
	//-----------------MAKE SCRIPT FOR PUBLIC MESSAGES-----------------
	//-----------------------------------------------------------------
		function load_script_public_messages(){
		    var chart = new CanvasJS.Chart('chartContainer_Messages_Sent_Public',
		    {
		     	theme: 'theme2',
		    	title:{
			    	text: 'Public messages sent last 14 days'
			    },
			    animationEnabled: true,
		      	data: [
		      	{        
			        type: 'line',
			        dataPoints: [
					<?php foreach ($public_messages_last_7_days_array as $row) :?>
						{label: <?="'".$row["n_o_days_ago"]." days ago'"?>, y: <?=$row["n_o_posts"]?>},
					<?php endforeach;?>
			        ]
	
		      	}
		      	]
		    });

		    chart.render();
		}

	//-----------------------------------------------------------------
	//--------MAKE SCRIPT FOR PRIVATE SENT AND RECIEVED MESSAGES-------
	//-----------------------------------------------------------------
		function load_script_private_sent_recieved_messages(){
		    var chart = new CanvasJS.Chart('chartContainer_Messages_Sent_Recieved_Private',
		    {
		     	theme: 'theme2',
		    	title:{
			    	text: 'Private messages sent / recieved last 14 days'
			    },
			    animationEnabled: true,
		      	data: [
		      	{        
			        type: 'splineArea',
			        name: 'Sent',
			        showInLegend: true,
			        dataPoints: [
					<?php foreach ($private_messages_sent_last_7_days_array as $row) :?>
						{label: <?="'".$row["n_o_days_ago"]." days ago'"?>, y: <?=$row["n_o_posts"]?>},
					<?php endforeach;?>
			        ]
	
		      	},
		      	{        
			        type: 'splineArea',
			        name: 'Recieved',
			        showInLegend: true,
			        dataPoints: [
					<?php foreach ($private_messages_recieved_last_7_days_array as $row) :?>
						{label: <?="'".$row["n_o_days_ago"]." days ago'"?>, y: <?=$row["n_o_posts"]?>},
					<?php endforeach;?>
			        ]
	
		      	}
		      	]
		    });

		    chart.render();
		}

	//-----------------------------------------------------------------
	//--------------MAKE SCRIPT FOR PRIVATE SENT MESSAGES--------------
	//-----------------------------------------------------------------
		function load_script_private_sent_messages(){
		    var chart = new CanvasJS.Chart('chartContainer_Messages_Sent_Private',
		    {
		     	theme: 'theme2',
		    	title:{
			    	text: 'Private messages sent last 14 days'
			    },
			    animationEnabled: true,
		      	data: [
		      	{        
			        type: 'line',
			        dataPoints: [
					<?php foreach ($private_messages_sent_last_7_days_array as $row) :?>
						{label: <?="'".$row["n_o_days_ago"]." days ago'"?>, y: <?=$row["n_o_posts"]?>},
					<?php endforeach;?>
			        ]
	
		      	}
		      	]
		    });

		    chart.render();
		}
	//-----------------------------------------------------------------
	//------------MAKE SCRIPT FOR PRIVATE RECIEVED MESSAGES------------
	//-----------------------------------------------------------------
		function load_script_private_recieved_messages(){
		    var chart = new CanvasJS.Chart('chartContainer_Messages_Recieved_Private',
		    {
		     	theme: 'theme2',
		    	title:{
			    	text: 'Private messages recieved last 14 days'
			    },
			    animationEnabled: true,
		      	data: [
		      	{        
			        type: 'line',
			        dataPoints: [
					<?php foreach ($private_messages_recieved_last_7_days_array as $row) :?>
						{label: <?="'".$row["n_o_days_ago"]." days ago'"?>, y: <?=$row["n_o_posts"]?>},
					<?php endforeach;?>
			        ]
	
		      	}
		      	]
		    });

		    chart.render();
		}

	//-----------------------------------------------------------------
	//------MAKE SCRIPT FOR WEEKLY RECIEVED UPVOTES AND DOWNVOTES------
	//-----------------------------------------------------------------
		function load_script_upvotes_downvotes_weekly(){
		    var chart = new CanvasJS.Chart('chartContainer_Weekly_Upvotes_Downvotes',
		    {
		     	theme: 'theme2',
		    	title:{
			    	text: 'Upvotes / Downvotes Recieved Past 10 Weeks'
			    },
			    animationEnabled: true,
		      	data: [
		      	{        
		      		name: 'Upvotes',
			        type: 'splineArea',
			        showInLegend: true,
			        dataPoints: [
					<?php foreach ($upvotes_recieved_last_10_weeks_array as $row) :?>
						{label: <?="'".$row["n_o_weeks_ago"]." weeks ago'"?>, y: <?=$row["n_o_upvotes"]?>},
					<?php endforeach;?>
			        ]
	
		      	},
		      	{        
		      		name: 'Downvotes',
			        type: 'splineArea',
			        showInLegend: true,
			        dataPoints: [
					<?php foreach ($downvotes_recieved_last_10_weeks_array as $row) :?>
						{label: <?="'".$row["n_o_weeks_ago"]." weeks ago'"?>, y: <?=$row["n_o_downvotes"]?>},
					<?php endforeach;?>
			        ]
	
		      	}
		      	]
		    });

		    chart.render();
		}

	//-----------------------------------------------------------------
	//-------------MAKE SCRIPT FOR WEEKLY RECIEVED UPVOTES-------------
	//-----------------------------------------------------------------
		function load_script_upvotes_weekly(){
		    var chart = new CanvasJS.Chart('chartContainer_Weekly_Upvotes',
		    {
		     	theme: 'theme2',
		    	title:{
			    	text: 'Upvotes Recieved Past 10 Weeks'
			    },
			    animationEnabled: true,
		      	data: [
		      	{        
			        type: 'line',
			        dataPoints: [
					<?php foreach ($upvotes_recieved_last_10_weeks_array as $row) :?>
						{label: <?="'".$row["n_o_weeks_ago"]." weeks ago'"?>, y: <?=$row["n_o_upvotes"]?>},
					<?php endforeach;?>
			        ]
	
		      	}
		      	]
		    });

		    chart.render();
		}

	//-----------------------------------------------------------------
	//------------MAKE SCRIPT FOR WEEKLY RECIEVED DOWNVOTES------------
	//-----------------------------------------------------------------
		function load_script_downvotes_weekly(){
		    var chart = new CanvasJS.Chart('chartContainer_Weekly_Downvotes',
		    {
		     	theme: 'theme2',
		    	title:{
			    	text: 'Downvotes Recieved Past 10 Weeks'
			    },
			    animationEnabled: true,
		      	data: [
		      	{        
			        type: 'line',
			        dataPoints: [
					<?php foreach ($downvotes_recieved_last_10_weeks_array as $row) :?>
						{label: <?="'".$row["n_o_weeks_ago"]." weeks ago'"?>, y: <?=$row["n_o_downvotes"]?>},
					<?php endforeach;?>
			        ]
	
		      	}
		      	]
		    });

		    chart.render();
		}

	//-----------------------------------------------------------------
	//-----------MAKE SCRIPT FOR TOTAL UPVOTES VS DOWNVOTES------------
	//-----------------------------------------------------------------
		function load_script_upvotes_and_downvotes_total(){
			var chart = new CanvasJS.Chart("chartContainer_Total_Upvotes_and_Downvotes",
			{
				title:{
					text: "Total Upvotes vs. Downvotes"
				},
		        animationEnabled: true,
				legend:{
					verticalAlign: "center",
					horizontalAlign: "left",
					fontSize: 20,
					fontFamily: "Helvetica"        
				},
				theme: "theme2",
				data: [
				{        
					type: "pie",       
					indexLabelFontFamily: "Garamond",       
					indexLabelFontSize: 15,
		          	indexLabel: "{y} {label}",
					startAngle:0,      
					toolTipContent:"{y} {legendText}",
					dataPoints: [
						{  y: <?=$number_of_upvotes_and_downvotes_array['upvotes']?>, legendText:"Upvotes", label: "Upvotes" },
						{  y: <?=$number_of_upvotes_and_downvotes_array['downvotes']?>, legendText:"Downvotes", label: "Downvotes" }
					]
				}
				]
			});
			chart.render();
		}

	</script>
	<?php

	//-----------------------------------------------------------------
	//-------------ECHO SCRIPTS AND INCLUDE HTML DOCUMENTS-------------
	//-----------------------------------------------------------------

	?>
	<script type='text/javascript'> 
		window.onload = function() {
			console.log('Loading graphics');
			load_script_public_messages();
			// load_script_private_sent_messages();
			// load_script_private_recieved_messages();
			// load_script_upvotes_weekly();
			// load_script_downvotes_weekly();
			load_script_upvotes_and_downvotes_total();
			load_script_upvotes_downvotes_weekly();
			load_script_private_sent_recieved_messages();
		}
	</script>
	<?php

	include("html/statistics.html.php");
	
	include("src/js/chatbox_script.php");
	
	include("src/js/element_script.php");

	include("html/modules/footer.html.php");