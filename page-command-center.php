<?php
/**
 * Template Name: JM Business Command Center
 * Template Post Type: page
 *
 * Lobby TV command center. Renders a flow diagram of "locations" (Personal,
 * company, physical locations). Each block collapses its departments, and
 * each department collapses its KPIs. Every KPI is scored green / orange /
 * red against its thresholds, and the worst status rolls up through the
 * department to the block so the team sees at a glance where to look.
 *
 * Data model (edit $jm_command_center below):
 *   nodes[]            One block on the flow diagram (a "location").
 *     id               Unique slug. Used for wires and saved values.
 *     title            Big label on the block.
 *     subtitle         Small label under the title.
 *     tier             Row on the diagram, top down: 0 = start, 1, 2, ...
 *     start            true marks the first block in the flow.
 *     open             true keeps the block expanded when the board loads.
 *     parents[]        ids this block flows from (draws the wires). Keep
 *                      parents on the row directly above so wires never cross.
 *     kpis[]           KPIs owned directly by the block (optional).
 *     kpisLabel        Heading for those direct KPIs when the block also has
 *                      departments (they show as the first expandable group).
 *     departments[]    Expandable groups inside the block (optional).
 *       id, title, subtitle, kpis[]  Same shape as a block, without tiers.
 *
 *   Tap a block to open its departments; tap a department to open its KPIs.
 *   A block with KPIs and no departments opens straight to its KPIs.
 *
 *   KPI fields:
 *       id, label      Unique slug and display label.
 *       type           'higher'  numeric, higher is better
 *                      'lower'   numeric, lower is better
 *                      'time'    clock time "HH:MM" (24h), earlier is better
 *                      'check'   done / not done
 *       unit           Display unit, e.g. 'hrs', 'oz', 'min'.
 *       green, orange  Thresholds. For 'higher': value >= green is green,
 *                      value >= orange is orange, below is red. For 'lower'
 *                      and 'time' the comparison flips (<=). 'check' ignores
 *                      thresholds: done = green, not done = red.
 *       value          Today's starting value. The team can overwrite values
 *                      from the screen; overrides are saved in the browser
 *                      that displays the board, keyed by date.
 *       target         Short human description of the green target.
 */

$jm_command_center_css = '/assets/css/command-center.css';
$jm_command_center_js = '/assets/js/command-center.js';

wp_enqueue_style(
	'jm-command-center',
	get_stylesheet_directory_uri() . $jm_command_center_css,
	[],
	file_exists(get_stylesheet_directory() . $jm_command_center_css) ? filemtime(get_stylesheet_directory() . $jm_command_center_css) : null
);

wp_enqueue_script(
	'jm-command-center',
	get_stylesheet_directory_uri() . $jm_command_center_js,
	[],
	file_exists(get_stylesheet_directory() . $jm_command_center_js) ? filemtime(get_stylesheet_directory() . $jm_command_center_js) : null,
	true
);

$jm_command_center = [
	'brand' => [
		'name' => 'JM Training',
		'board' => 'Business Command Center',
		'logo' => get_stylesheet_directory_uri() . '/assets/images/jm-logo.png',
	],
	'settings' => [
		'autoTourSeconds' => 12,
		'refreshSeconds' => 60,
		'tierLabels' => ['Start', 'Company', 'Locations'],
	],
	'nodes' => [
		[
			'id' => 'personal',
			'title' => 'Personal',
			'subtitle' => 'Daily foundation',
			'tier' => 0,
			'start' => true,
			'open' => true,
			'parents' => [],
			'kpis' => [
				[
					'id' => 'sleep',
					'label' => 'Sleep',
					'type' => 'higher',
					'unit' => 'hrs',
					'green' => 7,
					'orange' => 4,
					'value' => 7.5,
					'target' => '7+ hours',
				],
				[
					'id' => 'wake-up',
					'label' => 'Wake Up',
					'type' => 'time',
					'unit' => '',
					'green' => '05:30',
					'orange' => '06:30',
					'value' => '05:15',
					'target' => 'Up by 5:30 AM',
				],
				[
					'id' => 'hydrate',
					'label' => 'Hydrate',
					'type' => 'higher',
					'unit' => 'oz',
					'green' => 100,
					'orange' => 64,
					'value' => 72,
					'target' => '100+ oz',
				],
				[
					'id' => 'read',
					'label' => 'Read',
					'type' => 'higher',
					'unit' => 'min',
					'green' => 20,
					'orange' => 10,
					'value' => 20,
					'target' => '20+ minutes',
				],
				[
					'id' => 'pray',
					'label' => 'Pray',
					'type' => 'check',
					'unit' => '',
					'green' => 1,
					'orange' => 1,
					'value' => true,
					'target' => 'Done today',
				],
				[
					'id' => 'exercise',
					'label' => 'Exercise',
					'type' => 'higher',
					'unit' => 'min',
					'green' => 45,
					'orange' => 20,
					'value' => 15,
					'target' => '45+ minutes',
				],
				[
					'id' => 'nutrition',
					'label' => 'Nutrition',
					'type' => 'higher',
					'unit' => 'meals',
					'green' => 3,
					'orange' => 2,
					'value' => 3,
					'target' => '3 clean meals',
				],
			],
		],
		[
			'id' => 'company',
			'title' => 'JM Training',
			'subtitle' => 'Company scoreboard',
			'tier' => 1,
			'parents' => ['personal'],
			'kpisLabel' => 'Company Scoreboard',
			'kpis' => [
				[
					'id' => 'revenue-mtd',
					'label' => 'Revenue MTD',
					'type' => 'higher',
					'unit' => '% of goal',
					'green' => 100,
					'orange' => 70,
					'value' => 82,
					'target' => '100% of monthly goal',
				],
				[
					'id' => 'cash-days',
					'label' => 'Cash Runway',
					'type' => 'higher',
					'unit' => 'days',
					'green' => 90,
					'orange' => 45,
					'value' => 96,
					'target' => '90+ days',
				],
				[
					'id' => 'active-members',
					'label' => 'Active Members',
					'type' => 'higher',
					'unit' => 'members',
					'green' => 250,
					'orange' => 200,
					'value' => 214,
					'target' => '250+ members',
				],
				[
					'id' => 'reviews',
					'label' => 'Google Rating',
					'type' => 'higher',
					'unit' => 'stars',
					'green' => 4.8,
					'orange' => 4.5,
					'value' => 4.9,
					'target' => '4.8+ stars',
				],
			],
			'departments' => [
				[
					'id' => 'sales',
					'title' => 'Sales',
					'subtitle' => 'Pipeline & close',
					'kpis' => [
						[
							'id' => 'new-leads',
							'label' => 'New Leads',
							'type' => 'higher',
							'unit' => 'this week',
							'green' => 40,
							'orange' => 20,
							'value' => 31,
							'target' => '40+ per week',
						],
						[
							'id' => 'close-rate',
							'label' => 'Close Rate',
							'type' => 'higher',
							'unit' => '%',
							'green' => 30,
							'orange' => 20,
							'value' => 26,
							'target' => '30%+',
						],
						[
							'id' => 'follow-ups-due',
							'label' => 'Follow-Ups Overdue',
							'type' => 'lower',
							'unit' => 'contacts',
							'green' => 0,
							'orange' => 5,
							'value' => 9,
							'target' => 'Zero overdue',
						],
					],
				],
				[
					'id' => 'marketing',
					'title' => 'Marketing',
					'subtitle' => 'Content & reach',
					'kpis' => [
						[
							'id' => 'youtube-posts',
							'label' => 'YouTube Posts',
							'type' => 'higher',
							'unit' => 'this week',
							'green' => 2,
							'orange' => 1,
							'value' => 1,
							'target' => '2+ videos per week',
						],
						[
							'id' => 'social-posts',
							'label' => 'Social Posts',
							'type' => 'higher',
							'unit' => 'this week',
							'green' => 5,
							'orange' => 3,
							'value' => 6,
							'target' => '5+ posts per week',
						],
						[
							'id' => 'email-sent',
							'label' => 'Email Campaign',
							'type' => 'check',
							'unit' => '',
							'green' => 1,
							'orange' => 1,
							'value' => false,
							'target' => 'Weekly email sent',
						],
					],
				],
			],
		],
		[
			'id' => 'bourbonnais',
			'title' => 'Bourbonnais',
			'subtitle' => 'Range & classroom',
			'tier' => 2,
			'parents' => ['company'],
			'departments' => [
				[
					'id' => 'range-operations',
					'title' => 'Range Operations',
					'subtitle' => 'Lanes, classes, safety',
					'kpis' => [
						[
							'id' => 'range-utilization',
							'label' => 'Range Use',
							'type' => 'higher',
							'unit' => '% booked',
							'green' => 75,
							'orange' => 50,
							'value' => 68,
							'target' => '75%+ lanes booked',
						],
						[
							'id' => 'class-fill',
							'label' => 'Class Fill',
							'type' => 'higher',
							'unit' => '% seats',
							'green' => 80,
							'orange' => 60,
							'value' => 84,
							'target' => '80%+ seats sold',
						],
						[
							'id' => 'safety-incidents',
							'label' => 'Safety Incidents',
							'type' => 'lower',
							'unit' => 'this month',
							'green' => 0,
							'orange' => 1,
							'value' => 0,
							'target' => 'Zero incidents',
						],
						[
							'id' => 'open-tickets',
							'label' => 'Facility Tickets',
							'type' => 'lower',
							'unit' => 'open',
							'green' => 2,
							'orange' => 5,
							'value' => 3,
							'target' => '2 or fewer open',
						],
					],
				],
				[
					'id' => 'memberships',
					'title' => 'Memberships',
					'subtitle' => 'DSU, Pro, Starter',
					'kpis' => [
						[
							'id' => 'new-members',
							'label' => 'New Members',
							'type' => 'higher',
							'unit' => 'this month',
							'green' => 20,
							'orange' => 10,
							'value' => 14,
							'target' => '20+ per month',
						],
						[
							'id' => 'churn',
							'label' => 'Cancellations',
							'type' => 'lower',
							'unit' => 'this month',
							'green' => 3,
							'orange' => 6,
							'value' => 2,
							'target' => '3 or fewer',
						],
						[
							'id' => 'past-due',
							'label' => 'Past-Due Accounts',
							'type' => 'lower',
							'unit' => 'accounts',
							'green' => 2,
							'orange' => 6,
							'value' => 7,
							'target' => '2 or fewer',
						],
					],
				],
			],
		],
		[
			'id' => 'alsip',
			'title' => 'Alsip',
			'subtitle' => 'CCL classroom',
			'tier' => 2,
			'parents' => ['company'],
			'departments' => [
				[
					'id' => 'ccl-classes',
					'title' => 'CCL Classes',
					'subtitle' => '16-hour & renewal',
					'kpis' => [
						[
							'id' => 'ccl-seats',
							'label' => '16-Hr CCL Seats',
							'type' => 'higher',
							'unit' => '% sold',
							'green' => 80,
							'orange' => 60,
							'value' => 55,
							'target' => '80%+ seats sold',
						],
						[
							'id' => 'renewal-seats',
							'label' => 'Renewal Seats',
							'type' => 'higher',
							'unit' => '% sold',
							'green' => 80,
							'orange' => 60,
							'value' => 70,
							'target' => '80%+ seats sold',
						],
						[
							'id' => 'lead-response',
							'label' => 'Lead Response',
							'type' => 'lower',
							'unit' => 'min',
							'green' => 15,
							'orange' => 60,
							'value' => 12,
							'target' => 'Under 15 minutes',
						],
					],
				],
			],
		],
		[
			'id' => 'frankfort',
			'title' => 'Frankfort',
			'subtitle' => 'Outdoor range',
			'tier' => 2,
			'parents' => ['company'],
			'departments' => [
				[
					'id' => 'outdoor-range',
					'title' => 'Outdoor Range',
					'subtitle' => 'Events & private sessions',
					'kpis' => [
						[
							'id' => 'events-booked',
							'label' => 'Events Booked',
							'type' => 'higher',
							'unit' => 'next 30 days',
							'green' => 6,
							'orange' => 3,
							'value' => 4,
							'target' => '6+ events',
						],
						[
							'id' => 'private-sessions',
							'label' => 'Private Sessions',
							'type' => 'higher',
							'unit' => 'this month',
							'green' => 8,
							'orange' => 4,
							'value' => 3,
							'target' => '8+ sessions',
						],
						[
							'id' => 'range-ready',
							'label' => 'Range Ready',
							'type' => 'check',
							'unit' => '',
							'green' => 1,
							'orange' => 1,
							'value' => true,
							'target' => 'Berms, targets, gear checked',
						],
					],
				],
			],
		],
	],
];

get_header();
?>

<div class="jm-command-center" data-jm-command-center>
	<header class="cc-topbar">
		<a class="cc-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="JM Training home">
			<img class="cc-brand-logo" src="<?php echo esc_url($jm_command_center['brand']['logo']); ?>" alt="JM Training logo">
			<span class="cc-brand-text">
				<strong><?php echo esc_html($jm_command_center['brand']['name']); ?></strong>
				<small><?php echo esc_html($jm_command_center['brand']['board']); ?></small>
			</span>
		</a>

		<div class="cc-summary" data-cc-summary aria-live="polite">
			<span class="cc-summary-pill is-red"><b data-cc-count-red>0</b> Red</span>
			<span class="cc-summary-pill is-orange"><b data-cc-count-orange>0</b> Orange</span>
			<span class="cc-summary-pill is-green"><b data-cc-count-green>0</b> Green</span>
		</div>

		<div class="cc-clock" aria-label="Current date and time">
			<strong data-cc-time>--:--</strong>
			<small data-cc-date>Loading</small>
		</div>

		<div class="cc-controls">
			<button type="button" class="cc-button" data-cc-tour aria-pressed="false">Auto Tour</button>
			<button type="button" class="cc-button" data-cc-fullscreen>TV Mode</button>
		</div>
	</header>

	<main class="cc-main">
		<section class="cc-flow" aria-label="Business flow diagram">
			<svg class="cc-connectors" data-cc-connectors aria-hidden="true" focusable="false"></svg>
			<div class="cc-tiers" data-cc-tiers></div>
		</section>

		<aside class="cc-attention" data-cc-attention aria-label="Indicators that need attention">
			<h2 class="cc-attention-title">Needs Attention</h2>
			<ol class="cc-attention-list" data-cc-attention-list></ol>
			<p class="cc-attention-empty" data-cc-attention-empty hidden>Everything is green. Keep it there.</p>
		</aside>
	</main>

	<footer class="cc-legend" aria-label="Status color legend">
		<span class="cc-legend-item is-green"><i></i> Green: on target</span>
		<span class="cc-legend-item is-orange"><i></i> Orange: slipping, fix today</span>
		<span class="cc-legend-item is-red"><i></i> Red: needs attention now</span>
		<span class="cc-legend-note">Tap a block to open its departments, then a department to open its KPIs.</span>
	</footer>

	<div class="cc-focus" data-cc-focus hidden role="dialog" aria-modal="true" aria-labelledby="cc-focus-title">
		<div class="cc-focus-panel">
			<header class="cc-focus-header">
				<div>
					<p class="cc-focus-eyebrow" data-cc-focus-subtitle></p>
					<h2 id="cc-focus-title" data-cc-focus-title></h2>
				</div>
				<button type="button" class="cc-button cc-button-close" data-cc-focus-close aria-label="Close">Close</button>
			</header>
			<div class="cc-focus-kpis" data-cc-focus-kpis></div>
			<footer class="cc-focus-footer">
				<button type="button" class="cc-button" data-cc-focus-edit>Log Today's Numbers</button>
				<button type="button" class="cc-button cc-button-quiet" data-cc-focus-reset>Reset to Defaults</button>
				<span class="cc-focus-saved" data-cc-focus-saved hidden>Saved on this screen</span>
			</footer>
		</div>
	</div>
</div>

<script id="jm-command-center-config" type="application/json"><?php echo wp_json_encode($jm_command_center); ?></script>

<?php
get_footer();
