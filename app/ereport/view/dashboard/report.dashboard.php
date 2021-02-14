<body class="app">
	<?php $this->getView('ecomplaint', 'dashboard', 'header', []); ?>
	<!-- BEGIN: Content -->
	<div class="content">
		<div class="col-span-12 mt-6">
			<div class="intro-y block sm:flex items-center h-10">
				<h2 class="text-lg font-medium truncate mr-5"><?= $title; ?></h2>
				<div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
					<!-- <button class="button box flex items-center text-gray-700"> <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to Excel </button> -->
					<!-- <button class="ml-3 button box flex items-center text-gray-700"> <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to PDF </button> -->
					<div class="w-full sm:w-full mt-3 sm:mt-0 sm:ml-auto md:ml-0">
						<div class="w-full relative text-gray-700">
							<!-- <input type="text" class="input w-full box pr-10 placeholder-theme-13" placeholder="Search..."> -->
							<?= comp\BOOTSTRAP::inputText('searchList', 'text', '', 'class="input w-full box pr-10 placeholder-theme-13" placeholder="Search..."'); ?>
							<i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i> 
						</div>
					</div>
				</div>
			</div>
			<div class="intro-y overflow-auto lg:overflow-visible mt-10 sm:mt-10">
				<code><?= $listComplaint['query']; ?></code>
				<table class="table table-report sm:mt-2">
					<thead>
						<tr>
							<th class="whitespace-no-wrap">ID</th>
							<th class="whitespace-no-wrap">PELAPOR</th>
							<th class="whitespace-no-wrap">ADUAN</th>
							<th class="text-center whitespace-no-wrap">STATUS</th>
							<th class="text-left whitespace-no-wrap">KLARIFIKASI</th>
							<th class="text-center whitespace-no-wrap">ACTIONS</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($listComplaint['table'] as $key => $value): ?>
						<tr class="intro-x">
							<td class="w-5 text-left" style="vertical-align: top;">#<?= $value['idComplaint']; ?></td>
							<td>
								<a href="javascript:void(0);" class="font-medium whitespace-no-wrap"><?= $value['fullName']; ?></a> 
								<a class="flex text-gray-600 text-xs whitespace-no-wrap" href="javascript:void(0);"> <i data-feather="mail" class="w-4 h-4 mr-1"></i> <?= $value['emailAddress']; ?> </a>
								<a class="flex text-gray-600 text-xs whitespace-no-wrap" href="javascript:void(0);"> <i data-feather="phone" class="w-4 h-4 mr-1"></i> <?= $value['phoneNumber']; ?> </a>
							</td>
							<td>
								<a href="javascript:void(0);" class="font-medium whitespace-no-wrap"><?= $value['complaintCategory']; ?></a> 
								<a class="flex text-gray-600 text-xs whitespace-no-wrap" href="javascript:void(0);"> 
									<i data-feather="calendar" class="w-4 h-4 mr-1"></i> <?= $value['complaintDate']; ?>,&nbsp;<i data-feather="map-pin" class="w-4 h-4 mr-1"></i> <?= $value['complaintLocation']; ?>
								</a>
							</td>
							<td>
								<div class="flex items-center justify-center" style="color: <?= $value['complaintStatusColor']; ?>"> <i data-feather="tag" class="w-4 h-4 mr-2"></i> <?= $value['complaintStatusText']; ?> </div>
							</td>
							<td>
								<?php foreach ($value['responseName'] as $responseName): ?>
									<div class="flex" style="color: <?= $value['complaintStatusColor']; ?>"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> <?= $responseName; ?> </div>
								<?php endforeach; ?>
							</td>
							<td class="table-report__action">
								<div class="flex justify-center items-center">
									<a class="flex items-center mr-3 btn-detail text-theme-1" href="javascript:void(0);" data-list="<?= base64_encode(json_encode($value)); ?>"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Detail </a>
									<!-- <a class="flex items-center text-theme-2 btn-delete" href="<?= $value['whatsapp']['sendMessage']; ?>"> <i data-feather="message-circle" class="w-4 h-4 mr-1"></i> Whatsapp </a> -->
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="intro-y flex flex-wrap sm:flex-row sm:flex-no-wrap items-center mt-3" style="display: none;">
				<ul class="pagination">
					<li><a class="pagination__link" href="javascript:void(0);"> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a></li>
					<li><a class="pagination__link" href="javascript:void(0);"> <i class="w-4 h-4" data-feather="chevron-left"></i> </a></li>
					<li> <a class="pagination__link" href="javascript:void(0);">...</a> </li>
					<li> <a class="pagination__link" href="javascript:void(0);">1</a> </li>
					<li> <a class="pagination__link pagination__link--active" href="javascript:void(0);">2</a> </li>
					<li> <a class="pagination__link" href="javascript:void(0);">3</a> </li>
					<li> <a class="pagination__link" href="javascript:void(0);">...</a> </li>
					<li><a class="pagination__link" href="javascript:void(0);"> <i class="w-4 h-4" data-feather="chevron-right"></i> </a></li>
					<li><a class="pagination__link" href="javascript:void(0);"> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a></li>
				</ul>
			</div>

			<!-- Modal -->
			<div class="modal" id="report-modal-preview">
				<div class="modal__content modal__content--xl">
					<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
						<h2 class="font-medium text-base mr-auto">Detail Report</h2> 
					</div>
					<form id="frmInput" onsubmit="return false;" autocomplete="off">
						<div class="p-5 grid grid-cols-12 gap-4 row-gap-3 form-content">
							<div class="col-span-12 sm:col-span-6">
								<div class="mt-3">
									<label for="fullName" class="text-gray-600">Nama Lengkap (Sesuai KTP) *</label>
									<?= comp\BOOTSTRAP::inputKey('idComplaint', ''); ?>
									<?= comp\BOOTSTRAP::inputText('fullName', 'text', '', 'class="input w-full border mt-2" placeholder="" disabled'); ?>
								</div>
								<div class="mt-3">
									<label for="genderType" class="text-gray-600">Jenis Kelamin *</label>
									<?= comp\BOOTSTRAP::inputText('genderType', 'text', '', 'class="input w-full border mt-2" placeholder="" disabled'); ?>
								</div>
								<div class="mt-3">
									<label for="emailAddress" class="text-gray-600">Alamat Email *</label>
									<?= comp\BOOTSTRAP::inputText('emailAddress', 'text', '', 'class="input w-full border mt-2" placeholder="" disabled'); ?>
								</div>
								<div class="mt-3">
									<label for="phoneNumber" class="text-gray-600">Nomor Whatsapp *</label>
									<?= comp\BOOTSTRAP::inputText('phoneNumber', 'text', '', 'class="input w-full border mt-2" placeholder="" disabled'); ?>
								</div>
								<div class="mt-3">
									<label for="identityDocument" class="text-gray-600">Lampiran Foto KTP / Data Diri *</label>
									<?= comp\BOOTSTRAP::inputText('identityDocument', 'text', '', 'class="input w-full border mt-2" placeholder="" disabled'); ?>
								</div>
								<div class="mt-3">
									<label for="complaintCategory" class="text-gray-600">Kategori Komplain / Aduan *</label>
									<?= comp\BOOTSTRAP::inputText('complaintCategory', 'text', '', 'class="input w-full border mt-2" placeholder="" disabled'); ?>
								</div>
							</div>
							<div class="col-span-12 sm:col-span-6">
								<div class="mt-3">
									<label for="complaintDate" class="text-gray-600">Tanggal Komplain *</label>
									<?= comp\BOOTSTRAP::inputText('complaintDate', 'text', '', 'class="input w-full border mt-2" placeholder="" disabled'); ?>
								</div>
								<div class="mt-3">
									<label for="complaintLocation" class="text-gray-600">Lokasi Komplain / Aduan *</label>
									<?= comp\BOOTSTRAP::inputText('complaintLocation', 'text', '', 'class="input w-full border mt-2" placeholder="" disabled'); ?>
								</div>
								<div class="mt-3">
									<label for="complaintDescription" class="text-gray-600">Uraian Aduan / Komplain *</label>
									<?= comp\BOOTSTRAP::inputTextArea('complaintDescription', '', 'class="input w-full border mt-2" placeholder="" rows="3" disabled'); ?>
								</div>
								<div class="mt-3">
									<label for="personalName" class="text-gray-600">Nama Anggota (yang dilaporkan) *opsional</label>
									<?= comp\BOOTSTRAP::inputText('personalName', 'text', '', 'class="input w-full border mt-2" placeholder="" disabled'); ?>
								</div>
								<div class="mt-3">
									<label for="fileAttachment" class="text-gray-600">Lampiran (Bukti Kejadian) *opsional</label>
									<?= comp\BOOTSTRAP::inputText('fileAttachment', 'text', '', 'class="input w-full border mt-2" placeholder="" disabled'); ?>
								</div>
							</div>
						</div>
						<div class="col-span-12 sm:col-span-12 px-5 py-3 border-t border-gray-200">
							<label for="complaintStatus" class="text-gray-600">Status Komplain</label>
							<div class="mt-2">
								<?= comp\BOOTSTRAP::inputRadio('complaintStatus', $complaintStatusChoice, ''); ?>
							</div>
							<div class="mt-3">
								<label for="complaintResponse" class="text-gray-600">Jawaban Klarifikasi (Ada/Tidak ada penyimpangan)</label>
								<div class="mt-2">
									<?= comp\BOOTSTRAP::inputSelect('complaintResponse[]', $complaintResponseChoice['pending'], '', 'class="input w-full complaintResponse select2" multiple'); ?>
								</div>
							</div>
						</div>
					</form>
					<div class="px-5 py-3 text-right border-t border-gray-200"> 
						<button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Tutup</button>
						<button type="submit" form="frmInput" class="button w-20 bg-theme-1 text-white">Simpan</button> 
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- END: Content -->
	<!-- BEGIN: JS Assets-->
	<?= $jsPath; ?>
	<script src="<?= $api_path.'/script'; ?>"></script>
	<script src="<?= $url_path.'/script'; ?>"></script>
	<!-- END: JS Assets-->
</body>