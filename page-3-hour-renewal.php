<?php
/**
 * Template Name: JM 3-Hour Renewal Placeholder
 * Template Post Type: page
 */

get_header();

$jm_support_page = [
	'eyebrow' => 'ILCCL',
	'title' => '3-Hour Renewal',
	'intro' => 'Placeholder framework for the Illinois concealed carry renewal course page.',
	'cta_label' => 'Reserve Renewal Seat',
	'cta_href' => '#ghl-ilccl-signup',
	'cards' => [
		[
			'title' => 'Renewal Overview',
			'text' => 'Placeholder for renewal requirements, documents, range expectations, and class schedule.',
		],
		[
			'title' => 'Signup Flow',
			'text' => 'Go High Level form and payment flow will be connected here later.',
		],
	],
	'notes' => [
		'Replace #ghl-ilccl-signup with the final Go High Level renewal signup URL or embedded form.',
	],
];

get_template_part('template-parts/jm-support-page-shell', null, ['page' => $jm_support_page]);

get_footer();
