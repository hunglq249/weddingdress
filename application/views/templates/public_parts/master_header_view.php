<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- TITLE -->
	<title>Ciel de Gia</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo site_url('node_modules/bootstrap/') ?>dist/css/bootstrap.min.css">

	<!-- FontAwesome 5 -->
	<link rel="stylesheet" href="<?php echo site_url('node_modules/@fortawesome/') ?>fontawesome-free/css/all.min.css">

	<!-- Style -->
	<link rel="stylesheet" href="<?php echo site_url('assets/sass/') ?>style.min.css">


	<!-- JS -->
	<script src="<?php echo site_url('node_modules/jquery/') ?>dist/jquery.min.js"></script>

</head>

<body>

<header class="">
	<nav>
		<div class="nav-brand nav-item">
			<a href="<?php echo base_url('') ?>">
				<!--<img src="<?php echo site_url('assets/img/') ?>logo-w.svg" alt="logo Ciel de Gia">-->
				<div class="logo"></div>
			</a>
		</div>

		<div class="nav-main nav-item">
			<div id="expand-nav">
				<a class="btn-nav-expand" role="button" id="btn-nav-expand">
					<span class="nav-icon"></span>
				</a>
			</div>

			<ul>
				<li>
					<a href="<?php echo base_url('about') ?>">
						<?php echo $this->lang->line('about')?>
					</a>
				</li>

				<li>
					<a href="<?php echo base_url('bo-suu-tap') ?>">
						<?php echo $this->lang->line('collection')?>
					</a>
				</li>

				<li>
					<a href="<?php echo base_url('nhom/phu-dau-dip-le-hoi') ?>">
						<?php echo $this->lang->line('bridesmaids')?>
					</a>
				</li>

				<li>
					<a href="<?php echo base_url('nhom/phu-kien') ?>">
						<?php echo $this->lang->line('accessories')?>
					</a>
				</li>

				<li>
					<a href="<?php echo base_url('danh-muc/blogs-tin-tuc') ?>">
						<?php echo $this->lang->line('blogs')?>
					</a>
				</li>

				<li>
					<a href="<?php echo base_url('danh-muc/khuyen-mai') ?>">
						<?php echo $this->lang->line('promotion')?>
					</a>
				</li>

				<li class="li-lang">
					<a href="<?php echo base_url('') ?>">
						En
					</a>
					|
					<a href="<?php echo base_url('') ?>">
						Vi
					</a>
				</li>

				<!--
				<li>
					<a href="<?php echo base_url('') ?>">
						Appointment
					</a>
				</li>
				-->
			</ul>
		</div>

		<div class="nav-lang nav-item">
			<ul>
				<li>
					<a class="active change-language" data-language="vi" href="javascript:void(0)" href="<?php echo base_url('') ?>">
						Vi
					</a>
				</li>
				<li>
					<a class="change-language" data-language="en" href="javascript:void(0)" href="<?php echo base_url('') ?>">
						En
					</a>
				</li>
			</ul>
		</div>

		<div class="nav-btn nav-item">
			<a href="<?php echo base_url('booking/') ?>" class="btn btn-primary" role="button">
				<?php  echo ($lang=='vi') ? 'Đặt Hẹn' : 'Booking an Appointment';?>
			</a>
		</div>

	</nav>
</header>
