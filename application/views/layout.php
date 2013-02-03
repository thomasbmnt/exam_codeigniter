<!DOCTYPE HTML>
<html lang="fr-BE">
<head>
	<meta charset="UTF-8">
	<title>Google Plus Like</title>
	<link type="text/css" rel="stylesheet" href="<?php echo site_url(); ?>web/css/style.css" />
	 <link href="<?php echo site_url(); ?>web/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo site_url(); ?>">CurlLinks</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="<?php echo site_url(); ?>">Home</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
<div class="container">
	<div class="hero-unit">
	<?php
		echo $vue ;
	?>
	</div>
</div>
	<script src='<?php echo site_url(); ?>web/js/jquery.js'></script>
	<script src='<?php echo site_url(); ?>web/js/code.js'></script>
</body>
</html>