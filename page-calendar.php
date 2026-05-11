<?php
/**
 * Template Name: JM Training Calendar
 * Template Post Type: page
 */

get_header();

$jm_calendar_images_uri = get_stylesheet_directory_uri() . '/assets/images';
?>

<div class="jm-calendar-page">
	<header class="calendar-site-header" aria-label="Calendar navigation">
		<a class="calendar-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="JM Training home">
			<img class="calendar-brand-logo" src="<?php echo esc_url($jm_calendar_images_uri . '/jm-logo.png'); ?>" alt="JM Training logo">
			<span>
				<strong>JM Training</strong>
				<small>2026 Training Calendar</small>
			</span>
		</a>

		<nav class="calendar-nav" aria-label="Primary calendar links">
			<a href="<?php echo esc_url(home_url('/16-hour-illinois-ccl/')); ?>">IL CCL</a>
			<a href="<?php echo esc_url(home_url('/calendar/')); ?>" aria-current="page">Calendar</a>
			<a href="<?php echo esc_url(home_url('/memberships/')); ?>">Memberships</a>
			<a href="<?php echo esc_url(home_url('/pistol/')); ?>">Courses</a>
			<a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a>
			<a href="<?php echo esc_url(home_url('/about-us/')); ?>">About Us</a>
		</nav>

		<a class="calendar-header-cta" href="mailto:support@joemalonetraining.com?subject=JM%20Training%20Calendar%20Question">
			<span aria-hidden="true" data-calendar-icon="send"></span>
			Contact
		</a>
	</header>

	<main id="top" class="calendar-main">
		<section class="calendar-section" id="training-calendar" aria-labelledby="calendar-title">
			<div class="calendar-section-inner">
				<div class="calendar-section-heading">
					<p class="calendar-eyebrow">May 1-October 1, 2026 standalone calendar</p>
					<h1 id="calendar-title">JM Training Schedule</h1>
					<p>
						This calendar shows the live training ecosystem across Bourbonnais, Alsip, and Frankfort. Friday evening
						member events and the Bourbonnais block-training sequence begin May 15, while open range, group shoots,
						renewal classes, DSU Class-001, and concealed carry classes remain visible in their assigned locations.
					</p>
				</div>

				<div class="calendar-key" aria-label="Calendar location colors">
					<span class="legend-bourbonnais"><span aria-hidden="true" data-calendar-icon="pin"></span> Bourbonnais</span>
					<span class="legend-alsip"><span aria-hidden="true" data-calendar-icon="pin"></span> Alsip</span>
					<span class="legend-frankfort"><span aria-hidden="true" data-calendar-icon="pin"></span> Frankfort</span>
				</div>

				<div class="calendar-assumptions">
					<article>
						<strong>Bourbonnais launch</strong>
						<span>May 1-2 is reserved for the GBRS Group Rifle/Pistol event. Friday member events and block training begin May 15.</span>
					</article>
					<article>
						<strong>Skill blocks</strong>
						<span>4-hour Bourbonnais blocks run 9:00 AM-1:00 PM and 2:00 PM-6:00 PM, then slide forward around DSU days.</span>
					</article>
					<article>
						<strong>DSU Class-001</strong>
						<span>Starting May 23, every other Saturday in Bourbonnais is reserved for DSU Class-001 from 10:00 AM-5:00 PM.</span>
					</article>
					<article>
						<strong>Member open range</strong>
						<span>Tuesday, Wednesday, and Thursday run 12:00 PM-8:00 PM. Fridays run 12:00 PM-5:00 PM.</span>
					</article>
					<article>
						<strong>First Tuesday</strong>
						<span>Gun cleaning and networking runs 5:30 PM-8:30 PM on the first Tuesday, rotating Alsip then Bourbonnais.</span>
					</article>
					<article>
						<strong>Weekend deconfliction</strong>
						<span>Alsip 16-hour CCL runs second and fourth weekends. Frankfort runs first, third, and fifth Saturdays.</span>
					</article>
					<article>
						<strong>Blackout dates</strong>
						<span>No Bourbonnais training runs May 16 or June 5. Other locations continue as scheduled.</span>
					</article>
				</div>

				<!-- GoHighLevel calendar embed/config hook: replace this generated calendar block with a responsive GHL iframe if needed later. -->
				<div
					class="calendar-months generated-calendar"
					data-training-calendar
					data-friday-event-start="2026-05-15"
					data-bourbonnais-block-start="2026-05-15"
				></div>

				<p class="calendar-footnote">
					Days are plotted on a 6:00 AM-11:00 PM timeline. Hover or tap an event to see full details without crowding
					the overview.
				</p>
			</div>
		</section>
	</main>
</div>

<script>
(() => {
	const pageRoot = document.querySelector('.jm-calendar-page');

	if (!pageRoot) {
		return;
	}

	const iconPaths = {
		pin: '<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle>',
		send: '<path d="m22 2-7 20-4-9-9-4Z"></path><path d="M22 2 11 13"></path>',
	};

	pageRoot.querySelectorAll('[data-calendar-icon]').forEach((icon) => {
		const iconName = icon.getAttribute('data-calendar-icon');
		const path = iconPaths[iconName];

		if (!path) {
			return;
		}

		icon.innerHTML = `<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">${path}</svg>`;
	});

	const calendarRoot = pageRoot.querySelector('[data-training-calendar]');

	function parseDate(value) {
		const parts = value.split('-').map(Number);
		return new Date(parts[0], parts[1] - 1, parts[2]);
	}

	function formatDate(date) {
		const year = date.getFullYear();
		const month = String(date.getMonth() + 1).padStart(2, '0');
		const day = String(date.getDate()).padStart(2, '0');
		return `${year}-${month}-${day}`;
	}

	function addDays(date, amount) {
		const next = new Date(date);
		next.setDate(next.getDate() + amount);
		return next;
	}

	function minutesFromTime(time) {
		const [hour, minute] = time.split(':').map(Number);
		return (hour * 60) + minute;
	}

	function eventStyle(event) {
		const start = minutesFromTime(event.start);
		const end = minutesFromTime(event.end);
		const timelineStart = 6 * 60;
		const timelineEnd = 23 * 60;
		const usable = timelineEnd - timelineStart;
		const top = Math.max(0, ((start - timelineStart) / usable) * 100);
		const height = Math.max(5, ((end - start) / usable) * 100);

		return `top:${top}%;height:${height}%;`;
	}

	function titleCaseMonth(date) {
		return date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
	}

	function addEvent(events, date, event) {
		const key = formatDate(date);

		if (!events.has(key)) {
			events.set(key, []);
		}

		events.get(key).push(event);
	}

	function ordinalWeekdayInMonth(date) {
		const day = date.getDate();
		return Math.floor((day - 1) / 7) + 1;
	}

	function buildTrainingCalendar(root) {
		// GoHighLevel calendar config hook: update data attributes above if the live schedule start dates move.
		const startDate = new Date(2026, 4, 1);
		const endDate = new Date(2026, 9, 1);
		const fridayEventStart = parseDate(root.dataset.fridayEventStart || '2026-05-15');
		const bourbonnaisBlockStart = parseDate(root.dataset.bourbonnaisBlockStart || '2026-05-15');
		const bourbonnaisTrainingStart = parseDate(root.dataset.bourbonnaisTrainingStart || '2026-05-08');
		const events = new Map();
		const blackout = new Set(['2026-05-16', '2026-06-05']);

		const blockSequence = ['Handgun Level 0A', 'Handgun Level 0B', 'Handgun Level 1A', 'Handgun Level 1B', 'Handgun Level 2A', 'Handgun Level 2B', 'Handgun Level 3A', 'Handgun Level 3B', 'Rifle Level 0A', 'Rifle Level 0B', 'Rifle Level 1A', 'Rifle Level 1B', 'Rifle Level 2A', 'Rifle Level 2B', 'Rifle Level 3A', 'Rifle Level 3B', 'Rifle/Pistol Level 4A', 'Rifle/Pistol Level 4B', 'Rifle/Pistol Level 4C', 'Rifle/Pistol Level 5A', 'Rifle/Pistol Level 5B', 'Rifle/Pistol Level 5C'];
		let bourbonnaisBlockIndex = 0;
		let fridayTopicIndex = 0;

		addEvent(events, new Date(2026, 4, 1), {
			title: 'GBRS Group Rifle/Pistol',
			location: 'Bourbonnais',
			start: '09:00',
			end: '18:00',
			type: 'gbrs',
			detail: 'Private indoor range reserved for GBRS Group training.',
		});

		addEvent(events, new Date(2026, 4, 2), {
			title: 'GBRS Group Rifle/Pistol',
			location: 'Bourbonnais',
			start: '09:00',
			end: '18:00',
			type: 'gbrs',
			detail: 'Private indoor range reserved for GBRS Group training.',
		});

		for (let day = new Date(startDate); day <= endDate; day = addDays(day, 1)) {
			const key = formatDate(day);
			const weekday = day.getDay();
			const dateNum = day.getDate();
			const month = day.getMonth();
			const ordinal = ordinalWeekdayInMonth(day);
			const isAfterBourbonnaisStart = day >= bourbonnaisTrainingStart;
			const isAfterFridayStart = day >= fridayEventStart;
			const isBlackout = blackout.has(key);
			const isTuesday = weekday === 2;
			const isWednesday = weekday === 3;
			const isThursday = weekday === 4;
			const isFriday = weekday === 5;
			const isSaturday = weekday === 6;
			const isSunday = weekday === 0;

			if (isAfterBourbonnaisStart && !isBlackout && (isTuesday || isWednesday || isThursday)) {
				addEvent(events, day, {
					title: 'Member Open Range',
					location: 'Bourbonnais',
					start: '12:00',
					end: '20:00',
					type: 'open',
					detail: 'Member open range window.',
				});
			}

			if (isAfterBourbonnaisStart && !isBlackout && isFriday) {
				addEvent(events, day, {
					title: 'Member Open Range',
					location: 'Bourbonnais',
					start: '12:00',
					end: '17:00',
					type: 'open',
					detail: 'Member open range before Friday evening event.',
				});
			}

			if (isTuesday && dateNum <= 7) {
				const location = month % 2 === 0 ? 'Alsip' : 'Bourbonnais';
				addEvent(events, day, {
					title: 'Gun Cleaning and Networking',
					location,
					start: '17:30',
					end: '20:30',
					type: 'networking',
					detail: `First Tuesday community event in ${location}.`,
				});
			}

			if (isBlackout) {
				addEvent(events, day, {
					title: 'Bourbonnais Blackout',
					location: 'Bourbonnais',
					start: '06:00',
					end: '23:00',
					type: 'off',
					detail: 'No Bourbonnais training scheduled on this date.',
				});
			}

			if (isAfterFridayStart && !isBlackout && isFriday) {
				const topic = fridayTopicIndex % 2 === 0 ? 'Skill Builder Group Shoot' : 'Member Scenario Night';
				addEvent(events, day, {
					title: topic,
					location: 'Bourbonnais',
					start: '17:30',
					end: '20:30',
					type: 'friday',
					detail: 'Friday evening member event.',
				});
				fridayTopicIndex += 1;
			}

			if (isAfterBourbonnaisStart && !isBlackout && isWednesday) {
				addEvent(events, day, {
					title: 'Group Shoot',
					location: 'Bourbonnais',
					start: '18:00',
					end: '20:00',
					type: 'group',
					detail: 'Midweek group shoot during member open range.',
				});
			}

			if (isThursday) {
				addEvent(events, day, {
					title: '3-Hour Renewal',
					location: 'Alsip',
					start: '18:00',
					end: '21:00',
					type: 'renewal',
					detail: 'Illinois concealed carry renewal class.',
				});
			}

			if (isSaturday && (ordinal === 2 || ordinal === 4)) {
				addEvent(events, day, {
					title: '16-Hour Illinois CCL',
					location: 'Alsip',
					start: '09:00',
					end: '17:00',
					type: 'ccl',
					detail: 'Weekend CCL course, day one.',
				});
			}

			if (isSunday && (ordinal === 2 || ordinal === 4)) {
				addEvent(events, day, {
					title: '16-Hour Illinois CCL',
					location: 'Alsip',
					start: '09:00',
					end: '17:00',
					type: 'ccl',
					detail: 'Weekend CCL course, day two.',
				});
			}

			if (isSaturday && (ordinal === 1 || ordinal === 3 || ordinal === 5)) {
				addEvent(events, day, {
					title: 'Frankfort Member Range',
					location: 'Frankfort',
					start: '10:00',
					end: '15:00',
					type: 'open',
					detail: 'Outdoor range access in Frankfort.',
				});
			}
		}

		for (let day = new Date(bourbonnaisBlockStart); day <= endDate; day = addDays(day, 1)) {
			const weekday = day.getDay();
			const key = formatDate(day);

			if (blackout.has(key)) {
				continue;
			}

			if (weekday === 6) {
				const daysSinceDsuStart = Math.round((day - new Date(2026, 4, 23)) / 86400000);
				const isDsuDay = daysSinceDsuStart >= 0 && daysSinceDsuStart % 14 === 0;

				if (isDsuDay) {
					addEvent(events, day, {
						title: 'DSU Class-001',
						location: 'Bourbonnais',
						start: '10:00',
						end: '17:00',
						type: 'cert',
						detail: 'Defensive Shooting University Class-001.',
					});
					continue;
				}
			}

			if (weekday === 5 || weekday === 6 || weekday === 0) {
				const morning = blockSequence[bourbonnaisBlockIndex % blockSequence.length];
				const afternoon = blockSequence[(bourbonnaisBlockIndex + 1) % blockSequence.length];

				addEvent(events, day, {
					title: morning,
					location: 'Bourbonnais',
					start: '09:00',
					end: '13:00',
					type: 'skill',
					detail: 'Structured 4-hour qualification block.',
				});

				addEvent(events, day, {
					title: afternoon,
					location: 'Bourbonnais',
					start: '14:00',
					end: '18:00',
					type: 'skill',
					detail: 'Structured 4-hour qualification block.',
				});

				bourbonnaisBlockIndex += 2;
			}
		}

		const months = [4, 5, 6, 7, 8, 9];
		root.innerHTML = months.map((monthIndex) => renderMonth(monthIndex, events, endDate)).join('');
		root.querySelectorAll('.calendar-event').forEach((eventElement) => {
			eventElement.addEventListener('click', () => {
				const isOpen = eventElement.classList.contains('is-open');
				root.querySelectorAll('.calendar-event.is-open').forEach((openEvent) => openEvent.classList.remove('is-open'));

				if (!isOpen) {
					eventElement.classList.add('is-open');
				}
			});
		});

		document.addEventListener('click', (event) => {
			if (!root.contains(event.target)) {
				root.querySelectorAll('.calendar-event.is-open').forEach((openEvent) => openEvent.classList.remove('is-open'));
			}
		});
	}

	function renderMonth(monthIndex, events, endDate) {
		const monthDate = new Date(2026, monthIndex, 1);
		const startOffset = monthDate.getDay();
		const daysInMonth = new Date(2026, monthIndex + 1, 0).getDate();
		const cells = [];
		const totalCells = Math.ceil((startOffset + daysInMonth) / 7) * 7;
		const weekdayLabels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

		for (let index = 0; index < totalCells; index += 1) {
			const dayNum = index - startOffset + 1;
			const validDay = dayNum >= 1 && dayNum <= daysInMonth;
			const date = validDay ? new Date(2026, monthIndex, dayNum) : null;
			const outsideRange = date && date > endDate;
			const key = date ? formatDate(date) : '';
			const dayEvents = date && !outsideRange ? (events.get(key) || []) : [];
			const classes = [
				'calendar-day',
				!validDay || outsideRange ? 'empty-day' : '',
				dayEvents.length ? 'has-events' : 'no-events',
			].filter(Boolean).join(' ');

			cells.push(`
				<div class="${classes}">
					${validDay && !outsideRange ? `<div class="day-number">${dayNum}</div>` : ''}
					<div class="day-timeline">
						${dayEvents.map(renderEvent).join('')}
					</div>
				</div>
			`);
		}

		return `
			<article class="calendar-month">
				<div class="calendar-month-header">
					<h2>${titleCaseMonth(monthDate)}</h2>
					<span>6 AM-11 PM</span>
				</div>
				<div class="course-calendar" aria-label="${titleCaseMonth(monthDate)} training schedule">
					${weekdayLabels.map((label) => `<div class="weekday-heading">${label}</div>`).join('')}
					${cells.join('')}
				</div>
			</article>
		`;
	}

	function renderEvent(event) {
		const locationClass = `location-${event.location.toLowerCase()}`;
		const typeClass = `event-${event.type}`;
		const startLabel = formatTimeLabel(event.start);
		const endLabel = formatTimeLabel(event.end);

		return `
			<button class="calendar-event ${locationClass} ${typeClass}" style="${eventStyle(event)}" type="button">
				<span class="event-time">${startLabel}-${endLabel}</span>
				<strong>${event.title}</strong>
				<small>${event.location}</small>
				<span class="event-detail">
					<strong>${event.title}</strong>
					<em>${event.location} | ${startLabel}-${endLabel}</em>
					${event.detail}
				</span>
			</button>
		`;
	}

	function formatTimeLabel(time) {
		const [hour, minute] = time.split(':').map(Number);
		const suffix = hour >= 12 ? 'PM' : 'AM';
		const displayHour = hour % 12 || 12;

		return `${displayHour}:${String(minute).padStart(2, '0')} ${suffix}`;
	}

	if (calendarRoot) {
		buildTrainingCalendar(calendarRoot);
	}
})();
</script>

<?php get_footer(); ?>
