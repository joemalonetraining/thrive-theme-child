<?php
/**
 * Template Name: JM Pistol Courses Placeholder
 * Template Post Type: page
 */

get_header();

$jm_support_page = [
	'eyebrow' => 'Courses',
	'title' => 'Pistol Overview',
	'intro' => 'Placeholder framework for pistol course progression and level pages.',
	'cta_label' => 'Request Pistol Course Info',
	'cta_href' => '#ghl-course-signup',
	'cards' => [
		['title' => 'Level 0A', 'text' => 'Placeholder for Level 0A pistol course details.'],
		['title' => 'Level 0B', 'text' => 'Placeholder for Level 0B pistol course details.'],
		['title' => 'Level 1A', 'text' => 'Placeholder for Level 1A pistol course details.'],
		['title' => 'Level 1B', 'text' => 'Placeholder for Level 1B pistol course details.'],
		['title' => 'Level 2A', 'text' => 'Placeholder for Level 2A pistol course details.'],
		['title' => 'Level 2B', 'text' => 'Placeholder for Level 2B pistol course details.'],
		['title' => 'Level 3A', 'text' => 'Placeholder for Level 3A pistol course details.'],
		['title' => 'Level 3B', 'text' => 'Placeholder for Level 3B pistol course details.'],
	],
	'notes' => [
		'Replace #ghl-course-signup with the final Go High Level pistol course signup URL or embedded form.',
	],
];

get_template_part('template-parts/jm-support-page-shell', null, ['page' => $jm_support_page]);

get_footer();
