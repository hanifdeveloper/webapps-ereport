<body class="app">
	<?php $this->getView('ecomplaint', 'dashboard', 'header', []); ?>
	<!-- BEGIN: Content -->
	<div class="content">
		<div class="grid grid-cols-12 gap-6">
			<div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
				<!-- BEGIN: General Report -->
				<div class="col-span-12 mt-8">
					<div class="intro-y flex items-center h-10">
						<h2 class="text-lg font-medium truncate mr-5">
							General Report
						</h2>
						<a href="javascript:void(0);" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
					</div>
					<div class="grid grid-cols-12 gap-6 mt-5">
					
						<div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
							<div class="report-box zoom-in">
								<a href="<?= $url_path.'/report/pending'; ?>">
									<div class="box p-5">
										<div class="flex">
											<i data-feather="layers" class="report-box__icon text-theme-11"></i> 
										</div>
										<div class="text-3xl font-bold leading-8 mt-6"><?= $general_report['pending']['count']; ?> Aduan</div>
										<div class="text-base text-gray-600 mt-1"><?= $general_report['pending']['text']; ?></div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
							<div class="report-box zoom-in">
								<a href="<?= $url_path.'/report/process'; ?>">
									<div class="box p-5">
										<div class="flex">
											<i data-feather="edit" class="report-box__icon text-theme-10"></i> 
										</div>
										<div class="text-3xl font-bold leading-8 mt-6"><?= $general_report['process']['count']; ?> Laporan</div>
										<div class="text-base text-gray-600 mt-1"><?= $general_report['process']['text']; ?></div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
							<div class="report-box zoom-in">
								<a href="<?= $url_path.'/report/isDeviation|noDeviation'; ?>">
									<div class="box p-5">
										<div class="flex">
											<i data-feather="monitor" class="report-box__icon text-theme-9"></i> 
										</div>
										<div class="text-base font-bold mt-1">Jawaban Klarifikasi</div>
										<div class="">
											<div class="flex items-center mt-2">
												<div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
												<span class="truncate"><?= $general_report['isDeviation']['text']; ?></span> 
												<div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
												<span class="font-medium xl:ml-auto"><?= $general_report['isDeviation']['count']; ?> Kasus</span> 
											</div>
											<div class="flex items-center mt-2">
												<div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
												<span class="truncate"><?= $general_report['noDeviation']['text']; ?></span> 
												<div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
												<span class="font-medium xl:ml-auto"><?= $general_report['noDeviation']['count']; ?> Kasus</span> 
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- END: General Report -->
				<!-- BEGIN: Sales Report -->
				<div class="col-span-12 lg:col-span-12 mt-8">
					<div class="intro-y block sm:flex items-center h-10">
						<h2 class="text-lg font-medium truncate mr-5">
							Statistical Reports
						</h2>
						<div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700">
							<i data-feather="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i> 
							<?= comp\BOOTSTRAP::inputText('filterDate', 'text', '', 'class="datepicker input w-full sm:w-56 box pl-10" data-daterange="true" placeholder=""'); ?>
						</div>
					</div>
					<div class="intro-y box p-5 mt-12 sm:mt-5 zoom-ins">
						<div class="flex flex-col xl:flex-row xl:items-center">
							<div class="p-0" id="input">
								<label for="chartCategory">Filter Chart</label>
								<div class="mt-2">
									<?= comp\BOOTSTRAP::inputSelect('chartCategory', $filter_chart, 'complaintCategory', 'class="input w-full select2"'); ?>
								</div>
                            </div>
						</div>
						<div class="report-charts">
							<canvas id="report-category-chart" height="100" class="mt-6"></canvas>
						</div>
					</div>
				</div>
				<!-- END: Sales Report -->
				<!-- BEGIN: Weekly Top Seller -->
				<div class="col-span-12 lg:col-span-6 lg:col-span-3 mt-8">
					<div class="intro-y flex items-center h-10">
						<h2 class="text-lg font-medium truncate mr-5">
							Ada Penyimpangan
						</h2>
					</div>
					<div class="intro-y box p-5 mt-5 zoom-in">
						<canvas class="mt-3" id="report-isDeviation-chart" height="150"></canvas>
						<!-- <canvas class="mt-3" id="report-pie-chart" height="280"></canvas> -->
						<div class="mt-8">
							<?php foreach ($statistical_report['complaintResponse']['isDeviation'] as $key => $value): ?>
							<div class="flex items-center mt-4">
								<div class="w-2 h-2 rounded-full mr-3" style="background-color: <?= $value['color']; ?>"></div>
								<span class="truncate"><?= $value['text']; ?></span> 
								<div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
								<span class="font-medium xl:ml-auto isDeviation-<?= $key; ?>"><?= $value['percent']; ?>%</span> 
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<!-- END: Weekly Top Seller -->
				<!-- BEGIN: Sales Report -->
				<div class="col-span-12 lg:col-span-6 lg:col-span-3 mt-8">
					<div class="intro-y flex items-center h-10">
						<h2 class="text-lg font-medium truncate mr-5">
							Tidak Ada Penyimpangan
						</h2>
					</div>
					<div class="intro-y box p-5 mt-5 zoom-in">
						<canvas class="mt-3" id="report-noDeviation-chart" height="150"></canvas>
						<div class="mt-8">
							<?php foreach ($statistical_report['complaintResponse']['noDeviation'] as $key => $value): ?>
							<div class="flex items-center mt-4">
								<div class="w-2 h-2 rounded-full mr-3" style="background-color: <?= $value['color']; ?>"></div>
								<span class="truncate"><?= $value['text']; ?></span> 
								<div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
								<span class="font-medium xl:ml-auto noDeviation-<?= $key; ?>""><?= $value['percent']; ?>%</span> 
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<!-- END: Sales Report -->
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