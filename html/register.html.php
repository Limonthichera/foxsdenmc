<title>Fox's Den - Register</title>
<link rel="stylesheet" href="css/profile.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

	<nav class="navbar navbar-inverse">
        <div class="container">
          	<div class="navbar-header">
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
	            </button>
            <a class="navbar-brand" href="http://foxsdenmc.com">The Fox's Den</a>
          	</div>
          	<div class="navbar-collapse collapse">
	            <ul class="nav navbar-nav">
		            <li><a href="http://foxsdenmc.com"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;&nbsp;Home</a></li>
		            <li><a href="http://foxsdenmc.com/about.php"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;&nbsp;About</a></li>
		            <li><a href="http://foxsdenmc.com/contact.php"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;&nbsp;Contact us</a></li>
		        </ul>
		        <ul class="nav navbar-nav navbar-right">
		            <li><a href="http://foxsdenmc.com/login.php"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;&nbsp;Login</a></li>
		            <li class="active"><a href="http://foxsdenmc.com/register.php"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;&nbsp;Sign up</a></li>
		            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
		        </ul>
	              	
	            
	           
          	</div><!--/.nav-collapse -->
        </div>
    </nav>

<div id="overall_container" class="container">
    <div class="row">
    	<div class="col-md-3 col-sm-2 col-xs-1"></div>
    	<div class="col-md-6 col-sm-8 col-xs-10">
    		<div class="panel panel-primary" style="width:100%">
				<div class="panel-heading">&nbsp;
				</div>
				<div class="panel-body" style="width:100%">
					<h4>
						<form action="src/php/register_func.php" method="post">
							<table class="table"><tbody>
								<tr>
									<td>Username:</td>
									<td><input class="form-control" type="text" maxlength = "36" name="username" placeholder="Type username here..." autofocus/>
								</tr>
								<tr>
									<td>In-game Name:</td>
									<td><input class="form-control" type="text" maxlength = "16" name="in_game_name" placeholder="IGN here..."/>
								</tr>
								<tr>
									<td>Mail Address:</td>
									<td><input  class="form-control" type="email" name="mail_address" placeholder="example@example.com"/>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input class="form-control" type="password" maxlength = "36" name="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"/>
								</tr>
								<tr>
									<td>Re-type Password:</td>
									<td><input class="form-control" type="password" maxlength = "36" name="re_password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"/>
								</tr>
								<tr>
									<td>Birthday:</td>
									<td><select name="b_day">
											<?php for($i=1; $i<=31; $i++):?>
												<option><?=$i?></option>
											<?php endfor;?>
										</select>
										<select name="b_month">
											<option>January</option>
											<option>February</option>
											<option>March</option>
											<option>April</option>
											<option>May</option>
											<option>June</option>
											<option>July</option>
											<option>August</option>
											<option>September</option>
											<option>October</option>
											<option>November</option>
											<option>December</option>
										</select>
										<select name="b_year">
											<?php for($i=1900; $i<=2016; $i++):?>
												<option><?=$i?></option>
											<?php endfor;?>
										</select>
									</td>
								</tr>
							</tbody></table>
							<input class='btn btn-primary' type="submit" value="Register"/>
						</form>
					</h4>

					<div class="alert alert-warning" role="alert"><strong>Warning</strong> - Although not mandatory, please use a Gmail address if possible. Thank you for the understanding</div>

					<?php if($error['username']): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Error</strong> - Username must have between 6 and 36 characters.
						</div>
					<?php endif; ?>
					<?php if($error['username_register']): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Error</strong> - Username already exists.
						</div>
					<?php endif; ?>
					<?php if($error['fname']): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Error</strong> - Please enter your in-game name (3-16 characters).
						</div>
					<?php endif; ?>
					<?php if($error['lname']): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Error</strong> - In-game name already registered.
						</div>
					<?php endif; ?>
					<?php if($error['mail']): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Error</strong> - Please enter a valid E-mail.
						</div>
					<?php endif; ?>
					<?php if($error['mail_register']): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Error</strong> - E-mail already registered.
						</div>
					<?php endif; ?>
					<?php if($error['password']): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Error</strong> - Password must have between 6 and 36 characters.
						</div>
					<?php endif; ?>
					<?php if($error['re_password']): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Error</strong> - Password mismatch.
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-2 col-xs-1"></div>
	</div>
