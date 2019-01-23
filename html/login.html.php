<title>Fox's Den - Login</title>
<link rel="stylesheet" href="css/profile.css">
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
		            <li class="active"><a href="http://foxsdenmc.com/login.php"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;&nbsp;Login</a></li>
		            <li><a href="http://foxsdenmc.com/register.php"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;&nbsp;Sign up</a></li>
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
					<form action="src/php/login_func.php" method="post">
						<h4>
							<table class="table"><tbody>
								<tr>
									<td>E-mail:</td>
									<td><input class="form-control" type="email" name="mail_address" placeholder="Type your E-mail address here..." autofocus/>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input class="form-control" type="password" maxlength = "36" name="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"/>
								</tr>
							</tbody></table>
							<input class='btn btn-primary' type="submit" value="Login"/>
						</h4>
					</form>

					New to <b>the Fox's Den</b>?
					<br/>
					Register <a href="register.php">here</a>!

					<?php if($error['mail_address']): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Error</strong> - Please enter a valid Mail address.
						</div>
					<?php endif; ?>
					<?php if($error['password']): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Error</strong> - Password must have between 6 and 36 characters.
						</div>
					<?php endif; ?>
					<?php if($error['credentials']): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Error</strong> - Invalid credentials.
						</div>
					<?php endif; ?>
					<?php if($error['confirm']): ?>
						<div class="alert alert-warning alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Please confirm your E-Mail Address.
						</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-2 col-xs-1"></div>
	</div>
