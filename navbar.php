<?php require_once "functions.php"; ?>
<div class="page-header navbar navbar-fixed-top" style="background-color: #002147;">
	<div class="page-header-inner ">
		<!-- start mobile menu -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse" style="color:white;">
			<span style="color:white;"></span>
		</a>
		<ul class="nav navbar-nav navbar-left in">
			<li><a href="#" class="menu-toggler sidebar-toggler" style="color:white;"><i class="icon-menu" style="color:white;"></i></a></li>
		</ul>
		<div class="page-logo" style="background-color:#002147;">
			<img src="img/MHAlogo.png" alt="User Image" style="width: inherit;" />
		</div>
		<!-- end mobile menu -->
		<!-- start header menu -->
		<div class="top-menu col-md-6">
			<ul class="nav navbar-nav pull-right">
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="color:white;">
						<img alt="" class="img-circle " src="img/undraw_profile.svg" />
						<span class="username username-hide-on-mobile" style="color:white;"> John Doe </span>
						<i class="fa fa-angle-down" style="color:white;"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li><a href="dashboard?logout=' 1'"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>

<!-- CSRF token -->
<script type="text/javascript">
	const csrf_token = '<?php echo $_SESSION['_auth']; ?>';
</script>