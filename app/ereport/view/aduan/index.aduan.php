<body class="login">
	<div class="container sm:px-10">
		<div class="block xl:grid grid-cols-2 gap-4">
			<!-- BEGIN: Register Info -->
			<div class="hidden xl:flex flex-col min-h-screen">
				<a href="<?= $link_admin; ?>" target="_blank" class="-intro-x flex items-center pt-5">
					<span class="text-white text-lg ml-3"> e-Complaint On 7 </span>
				</a>
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
				<div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto" style="margin-top:50px;">
					<h2 class="intro-x font-bold text-2xl text-center xl:text-left">
						Seluruh isian Form Pengaduan Anda, akan kami Jamin Kerahasiaannya (Whistle Blower)
					</h2>
					<div class="intro-x mt-8">
						<form id="form-complaint" class="form-complaint" onsubmit="return false;">
							<div>
								<label for="fullName" class="text-gray-600">Nama Lengkap (Sesuai KTP) *</label>
								<?= comp\BOOTSTRAP::inputKey('idComplaint', $form_complaint['form']['idComplaint']); ?>
								<?= comp\BOOTSTRAP::inputText('fullName', 'text', $form_user['form']['fullName'], 'class="input w-full border mt-2" placeholder="" required'); ?>
							</div>
							<div class="mt-3">
								<label for="genderType" class="text-gray-600">Jenis Kelamin *</label>
								<div class="mt-2">
									<?= comp\BOOTSTRAP::inputSelect('genderType', $form_user['genderChoice'], $form_user['form']['genderType'], 'class="input w-full select2" required'); ?>
								</div>
							</div>
							<div class="mt-3">
								<label for="emailAddress" class="text-gray-600">Alamat Email *</label>
								<?= comp\BOOTSTRAP::inputText('emailAddress', 'email', $form_user['form']['emailAddress'], 'class="input w-full border mt-2" placeholder="" required'); ?>
							</div>
							<div class="mt-3">
								<label for="phoneNumber" class="text-gray-600">Nomor Whatsapp *</label>
								<?= comp\BOOTSTRAP::inputText('phoneNumber', 'tel', $form_user['form']['phoneNumber'], 'class="input w-full border mt-2" placeholder="" required'); ?>
							</div>
							<div class="mt-3">
								<label for="identityDocument" class="text-gray-600">Upload Foto KTP / Data Diri *</label>
								<input type="file" name="identityDocument" id="identityDocument" class="input w-full border mt-2" accept="<?= $form_user['mimes_type']; ?>" requireds />
								<div class="text-xs text-gray-600 mt-2"><?= $form_user['upload_description']; ?></div>
							</div>
							<div class="mt-3">
								<label for="complaintCategory" class="text-gray-600">Kategori Komplain / Aduan *</label>
								<div class="mt-2">
									<?= comp\BOOTSTRAP::inputSelect('complaintCategory', $form_complaint['complaintCategoryChoice'], $form_complaint['form']['complaintCategory'], 'class="input w-full select2" required'); ?>
								</div>
							</div>
							<div class="mt-3">
								<label for="complaintDate" class="text-gray-600">Tanggal Komplain *</label>
								<div class="relative w-full mx-auto">
									<div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"> 
										<i data-feather="calendar" class="w-4 h-4"></i> 
									</div> 
									<?= comp\BOOTSTRAP::inputText('complaintDate', 'text', date('d-M-Y', strtotime($form_complaint['form']['complaintDate'])), 'class="mydatepicker input w-full border pl-12" placeholder=""'); ?>
								</div>
							</div>
							<div class="mt-3">
								<label for="complaintLocation" class="text-gray-600">Lokasi Komplain / Aduan *</label>
								<div class="mt-2">
									<?= comp\BOOTSTRAP::inputSelect('complaintLocation', $form_complaint['complaintLocationChoice'], $form_complaint['form']['complaintLocation'], 'class="input w-full select2" required'); ?>
								</div>
							</div>
							<div class="mt-3">
								<label for="complaintDescription" class="text-gray-600">Uraian Aduan / Komplain *</label>
								<?= comp\BOOTSTRAP::inputTextArea('complaintDescription', $form_complaint['form']['complaintDescription'], 'class="input w-full border mt-2" placeholder="" rows="5" required'); ?>
							</div>
							<div class="mt-3">
								<label for="personalName" class="text-gray-600">Nama Anggota (yang dilaporkan) *opsional</label>
								<?= comp\BOOTSTRAP::inputText('personalName', 'text', $form_complaint['form']['personalName'], 'class="input w-full border mt-2" placeholder=""'); ?>
							</div>
							<div class="mt-3">
								<label for="fileAttachment" class="text-gray-600">Upload Lampiran (Bukti Kejadian) *opsional</label>
								<input type="file" name="fileAttachment" id="fileAttachment" class="input w-full border mt-2" accept="<?= $form_complaint['mimes_type']; ?>" />
								<div class="text-xs text-gray-600 mt-2"><?= $form_complaint['upload_description']; ?></div>
							</div>
						</form>
					</div>
					<div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
						<button type="submit" form="form-complaint" value="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Kirim Aduan</button>
					</div>
				</div>
			</div>
			<!-- END: Register Form -->
		</div>
	</div>
	<!-- BEGIN: JS Assets-->
	<?= $jsPath; ?>
	<script src="<?= $api_path.'/script'; ?>"></script>
    <script src="<?= $url_path.'/script'; ?>"></script>
	<!-- END: JS Assets-->
</body>