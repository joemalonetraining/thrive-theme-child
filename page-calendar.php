<?php
/**
 * Template Name: JM Calendar Placeholder
 * Template Post Type: page
 */

get_header();

$jm_support_page = [
	'eyebrow' => 'Calendar',
	'title' => 'Training Calendar',
	'intro' => 'Placeholder framework for the JM Training calendar route.',
	'cta_label' => 'Calendar Placeholder',
	'cta_href' => '#calendar-placeholder',
	'cards' => [
		[
			'title' => 'Schedule Framework',
			'text' => 'Placeholder for upcoming classes, training blocks, open range windows, and events.',
		],
		[
			'title' => 'Calendar Integration',
			'text' => 'Calendar embed, booking links, or Go High Level scheduling flow will be connected later.',
		],
	],
	'notes' => [
		'Replace #calendar-placeholder with the final calendar embed, booking route, or scheduling integration when ready.',
	],
];

get_template_part('template-parts/jm-support-page-shell', null, ['page' => $jm_support_page]);

get_footer();
