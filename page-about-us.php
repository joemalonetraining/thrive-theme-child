<?php
/**
 * Template Name: JM About Us Placeholder
 * Template Post Type: page
 */

get_header();

$jm_support_page = [
	'eyebrow' => 'About Us',
	'title' => 'About JM Training',
	'intro' => 'Placeholder framework for the SEO, credibility, instructor cadre, philosophy, and reviews page.',
	'cta_label' => 'Contact JM Training',
	'cta_href' => 'mailto:support@joemalonetraining.com?subject=About%20JM%20Training',
	'cards' => [
		[
			'title' => 'SEO / Credibility',
			'text' => 'Placeholder for credentials, service area, authority signals, and search-focused copy.',
		],
		[
			'title' => 'Instructor Cadre',
			'text' => 'Placeholder for instructor bios, qualifications, and training responsibilities.',
		],
		[
			'title' => 'Training Philosophy',
			'text' => 'Placeholder for standards, progression, accountability, and measurable performance.',
		],
		[
			'title' => 'Reviews / Testimonials',
			'text' => 'Placeholder for reviews, client outcomes, and social proof.',
		],
	],
];

get_template_part('template-parts/jm-support-page-shell', null, ['page' => $jm_support_page]);

get_footer();
