<?php
/**
 * Template Name: Rifle Level 2 - Movement and Target Processing
 * Template Post Type: page
 */

$rifle_course_stylesheet = get_stylesheet_directory() . '/assets/css/support-pages.css';
wp_enqueue_style(
	'jm-support-pages',
	get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
	['child-style'],
	file_exists($rifle_course_stylesheet) ? filemtime($rifle_course_stylesheet) : null
);

$jm_rifle_course = [
	'course_family' => 'rifle',
	'level' => 'Rifle Level 2',
	'title' => 'Level 2 — Movement and Target Processing',
	'label' => 'Movement and Processing',
	'eyebrow' => 'Rifle Level 2',
	'image' => 'rifle-training-overview-level-2.png',
	'image_width' => '4324',
	'image_height' => '2010',
	'image_alt' => 'JM Training rifle students practicing Level 2 movement and target processing',
	'intro' => 'A pressure-building rifle course that adds movement, positional transitions, target processing, and decision discipline to accountable rifle performance.',
	'cta_href' => home_url('/rifle-level-2/'),
	'overview_href' => home_url('/rifle-training-overview/'),
	'detail' => [
		'Rifle Level 2 adds movement, positional transitions, target processing, communication, and higher standards for accuracy under pressure. Students begin applying rifle fundamentals while managing distance, angles, and positive identification.',
		'This course asks students to process more information while keeping the rifle controlled and the muzzle accountable. The environment becomes more demanding, but the expectation remains clear: apply accurate fire only when appropriate.',
		'The goal is to improve the student’s ability to move safely, communicate clearly, process targets, and preserve disciplined rifle performance while the problem becomes less static.',
	],
	'outcomes' => [
		[
			'title' => 'Movement Discipline',
			'text' => 'Build safer movement, positional transitions, and rifle management around changing angles and distances.',
		],
		[
			'title' => 'Target Processing',
			'text' => 'Develop positive identification, target prioritization, communication, and decision standards around the rifle.',
		],
		[
			'title' => 'Applied Accuracy',
			'text' => 'Maintain accountable rifle accuracy as speed, movement, distance, and environmental demands increase.',
		],
	],
	'prerequisites' => [
		'Completion of Rifle Level 1 or instructor-approved equivalent experience is required.',
		'Students must demonstrate reliable rifle manipulation, safe muzzle discipline, and controlled marksmanship before attending.',
		'Students must be able to move safely, follow commands, and maintain awareness around other students and instructors.',
	],
	'blocks' => [
		[
			'name' => 'Alpha Block',
			'time' => '8:00 AM - 12:00 PM',
			'title' => 'Movement, Positions, and Target Confirmation',
			'text' => 'Alpha establishes the safety framework for movement, positional transitions, communication, target confirmation, and the accuracy standards required before added decision pressure.',
			'qualification' => 'Students must demonstrate safe movement, disciplined rifle control, and instructor-observed target confirmation before moving into Bravo pressure work.',
		],
		[
			'name' => 'Bravo Block',
			'time' => '1:00 PM - 5:00 PM',
			'title' => 'Processing, Communication, and Pressure',
			'text' => 'Bravo layers target processing, higher tempo standards, communication, and movement pressure into the student’s rifle work while preserving accuracy and restraint.',
			'qualification' => 'Students must apply accurate fire only when appropriate, preserve safe rifle control, and meet Level 2 movement and target processing standards.',
		],
	],
];

get_header();
get_template_part('template-parts/course-landing', null, ['course' => $jm_rifle_course]);
get_footer();
