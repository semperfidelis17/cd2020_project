<?php

use Blog\Util;
use Blog\AuthenticationManager;

$user = AuthenticationManager::getAuthenticatedUser();
if (isset($_GET["errors"])) {
	$errors = unserialize(urldecode($_GET["errors"]));
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Continuous-Delivery Blog</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/main.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" defer></script>
    <script src="https://unpkg.com/@popperjs/core@2" defer></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" defer></script>

    <script src="https://cdn.tiny.cloud/1/<?php print getenv("TINYMCE_KEY") ?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#inputText',
        plugins: 'casechange formatpainter linkchecker autolink lists media mediaembed pageembed powerpaste table advtable',
        toolbar: 'undo redo | formatpainter | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent |',
        toolbar_mode: 'floating',
    });
</script>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">

		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">Continuous Delivery Blog</a>
		</div>

		<div class="navbar-collapse collapse" id="bs-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li <?php if(!isset($_REQUEST['view']) || $_REQUEST['view'] == 'list') echo 'class="active"'; ?>><a href="/">Home</a></li>
                <?php if($user != null): ?>
                <li <?php if(isset($_REQUEST['view']) && $_REQUEST['view'] == 'newEntry') echo 'class="active"'; ?>><a href="index.php?view=newEntry">Create new Article</a></li>
                <?php endif; ?>
			</ul>
      <ul class="nav navbar-nav navbar-right login">
        <li class="dropdown">
			<?php if ($user == null): ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                Not logged in!
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a href="index.php?view=login">Login now</a>
                </li>
              </ul>
			<?php else: ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                Logged in as  <span class="badge"><?php echo Util::escape($user->getUserName()); ?></span>
                <b class="caret"></b>
              </a>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li class="centered">
                  <form method="post" action="<?php echo Util::action(Blog\Controller::ACTION_LOGOUT); ?>">
                    <input class="btn btn-xs" role="button" type="submit" value="Logout" />
                  </form>
                </li>
              </ul>
			<?php endif; ?>
        </li>
      </ul> <!-- /. login -->
		</div><!--/.navbar-collapse -->

	</div>
</div>

<div class="container">
