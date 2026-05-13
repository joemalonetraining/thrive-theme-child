<?php
/**
 * Template Name: Pistol Level 1 - Control and Manipulation
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
	'level' => 'Pistol Level 1',
	'title' => 'Level 1 — Control and Manipulation',
	'label' => 'Control and Manipulation',
	'eyebrow' => 'Pistol Level 1',
	'image' => 'pistol-training-overview-level-1.png',
	'image_width' => '2908',
	'image_height' => '1826',
	'image_alt' => 'JM Training pistol student practicing Level 1 control and manipulation',
	'intro' => 'A focused development course for students who need repeatable pistol control, accountable manipulation, and safer performance at a higher tempo.',
	'detail' => [
		'Level 1 moves beyond basic handling into repeatable pistol control. Students refine grip, presentation, sight management, trigger control, recoil management, reloads, and clearing common stoppages while maintaining strict muzzle and trigger discipline.',
		'The course is built around consistency. Students learn to recognize when technique breaks down, correct problems under instructor observation, and keep accuracy and safety intact as the pace increases.',
		'The goal is to help students build safe, accountable gun handling at a higher tempo and begin performing core manipulations without sacrificing awareness, accuracy, or control.',
	],
	'outcomes' => [
		[
			'title' => 'Repeatable Control',
			'text' => 'Improve grip, presentation, trigger control, recoil management, and the ability to return to accountable sights under pressure.',
		],
		[
			'title' => 'Core Manipulation',
			'text' => 'Develop safer reloads, correction of common stoppages, and administrative consistency without allowing speed to outrun discipline.',
		],
		[
			'title' => 'Performance Awareness',
			'text' => 'Learn to measure accuracy, identify weak points, and maintain safety while working at a more demanding pace.',
		],
	],
	'prerequisites' => [
		'Completion of Pistol Level 0 or instructor-approved equivalent experience is required.',
		'Students must already understand safe loading, unloading, verification, and range conduct.',
		'Students must arrive prepared to work from instructor-approved equipment and accept correction throughout the course.',
	],
	'blocks' => [
		[
			'name' => 'Alpha Block',
			'time' => '8:00 AM - 12:00 PM',
			'title' => 'Control, Presentation, and Accountability',
			'text' => 'Alpha reviews safety and handling standards, then builds repeatable grip, presentation, sight management, trigger control, recoil management, and accuracy expectations at a controlled pace.',
			'qualification' => 'Students must demonstrate safe presentation, controlled handling, and instructor-observed accuracy accountability before moving into Bravo manipulation work.',
		],
		[
			'name' => 'Bravo Block',
			'time' => '1:00 PM - 5:00 PM',
			'title' => 'Reloads, Stoppages, and Higher-Tempo Standards',
			'text' => 'Bravo introduces more demanding repetitions around reloads, common stoppage response, and performance standards that require students to keep accuracy and safety intact under time and task pressure.',
			'qualification' => 'Students must maintain muzzle and trigger discipline while safely completing Level 1 manipulation standards before receiving completion credit.',
		],
	],
];

get_header();
get_template_part('template-parts/pistol-course-landing', null, ['course' => $jm_pistol_course]);
get_footer();
