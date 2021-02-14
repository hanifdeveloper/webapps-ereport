<body class="login">
	<div class="container sm:px-10">
		<div class="block xl:grid grid-cols-2 gap-4">
			<!-- BEGIN: Register Info -->
			<div class="hidden xl:flex flex-col min-h-screen">
				<span class="text-white text-lg ml-3"> e-Complaint On 7 </span>
				<div class="my-auto" style="margin-top: 120px;">
					<img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="dist/images/icon.png" />
					<div class="-intro-x text-white font-medium text-2xl leading-tight mt-10">
						Selamat Datang<br />di Portal Resmi Aduan Masyarakat<br />Polda Kalbar 
					</div>
					<div class="-intro-x mt-5 text-md text-white">E-Complaint on 7 (Cepat Lapor, Cepat Respon)</div>
				</div>
			</div>
			<!-- END: Register Info -->
			<!-- BEGIN: Register Form -->
			<div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
				<div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
					<h2 class="intro-x font-bold text-3xl text-center xl:text-left">
						Sign In to Continue
					</h2>
					<div class="intro-x mt-8">
						<?php
							if ($this->getSession('SESSION_MESSAGE') != '') {
								echo '<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg> '.$this->getSession('SESSION_MESSAGE').' </div>';
							}
						?>
						<form id="form-login" class="form-login" action="<?= $url_path.'/login'; ?>" method="post">
							<div>
								<?= comp\BOOTSTRAP::inputText('username', 'text', $username, 'class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Username" required'); ?>
							</div>
							<div class="mt-3">
								<?= comp\BOOTSTRAP::inputText('password', 'password', $password, 'class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Password" required'); ?>
							</div>
						</form>
					</div>
					<div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
						<button type="submit" form="form-login" value="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3" style="background-color: #f44336;">Login</button>
					</div>
				</div>
			</div>
			<!-- END: Register Form -->
		</div>
	</div>
	<!-- BEGIN: JS Assets-->
	<?= $jsPath; ?>
	<script src="<?= $api_path.'/script'; ?>"></script>
	<!-- END: JS Assets-->
</body>