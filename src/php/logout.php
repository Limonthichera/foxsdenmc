<?php
	session_start();
	session_destroy();
	header('Location: http://foxsdenmc.com');
	exit(0);