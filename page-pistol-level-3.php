<?php
/**
 * Template Name: Pistol Level 3 - Asymmetry and Stress Integration
 * Template Post Type: page
 */

$pistol_course_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($pistol_course_stylesheet) ? filemtime($pistol_course_stylesheet) : null
);

$jm_pistol_course = [
	'level' => 'Pistol Level 3',
	'title' => 'Level 3 — Asymmetry and Stress Integration',
	'label' => 'Stress Integration',
	'eyebrow' => 'Pistol Level 3',
	'image' => 'pistol-training-overview-level-3.png',
	'image_width' => '2848',
	'image_height' => '1530',
	'image_alt' => 'JM Training pistol students practicing Level 3 asymmetry and stress integration',
	'intro' => 'An advanced integration course that places the pistol progression into less predictable problems requiring composure, movement, communication, and accountability.',
	'detail' => [
		'Level 3 is where the pistol progression shifts from isolated skill-building into adaptive problem-solving. Students are placed under greater stress, less predictable conditions, and more asymmetric shooting problems that require them to process information, move efficiently, communicate, use cover, and make accurate decisions under pressure.',
		'This level begins integrating multi-domain response concepts: movement, positioning, visual processing, target discrimination, low-light considerations, and performance standards that demand both speed and accountability.',
		'The goal is not just to shoot faster, but to remain composed, accurate, and adaptable when the problem is no longer clean or predictable.',
	],
	'outcomes' => [
		[
			'title' => 'Adaptive Problem-Solving',
			'text' => 'Apply earned fundamentals to less predictable problems where the correct answer depends on processing the environment.',
		],
		[
			'title' => 'Stress Management',
			'text' => 'Maintain composure, communication, safe movement, and accountable performance as pressure and complexity increase.',
		],
		[
			'title' => 'Integrated Accountability',
			'text' => 'Combine visual processing, target discrimination, low-light considerations, and performance standards without abandoning judgment.',
		],
	],
	'prerequisites' => [
		'Completion of Pistol Level 2 or instructor-approved equivalent experience is required.',
		'Students must demonstrate mature gun handling, safe movement, reliable manipulation, and decision-making discipline.',
		'Students must be physically and mentally prepared for a demanding course day with elevated stress and instructor evaluation.',
	],
	'blocks' => [
		[
			'name' => 'Alpha Block',
			'time' => '8:00 AM - 12:00 PM',
			'title' => 'Asymmetry, Movement, and Communication',
			'text' => 'Alpha builds the safety and performance framework for asymmetric problems, movement, positioning, communication, use of cover, and visual processing under stress.',
			'qualification' => 'Students must maintain safe control, communicate clearly, move with purpose, and demonstrate instructor-observed composure before moving into Bravo integration.',
		],
		[
			'name' => 'Bravo Block',
			'time' => '1:00 PM - 5:00 PM',
			'title' => 'Integrated Stress Problems and Accountability',
			'text' => 'Bravo combines movement, decision-making, target discrimination, low-light considerations, and performance standards into adaptive problems that are less clean and less predictable.',
			'qualification' => 'Students must make accountable decisions, preserve safety, avoid inappropriate target engagement, and meet Level 3 performance standards under stress.',
		],
	],
];

get_header();
get_template_part('template-parts/pistol-course-landing', null, ['course' => $jm_pistol_course]);
get_footer();
