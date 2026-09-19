(() => {
	const root = document.querySelector('[data-jm-command-center]');
	const configNode = document.getElementById('jm-command-center-config');

	if (!root || !configNode) {
		return;
	}

	let config;

	try {
		config = JSON.parse(configNode.textContent);
	} catch (error) {
		console.error('JM Command Center: config JSON could not be parsed.', error);
		return;
	}

	const settings = Object.assign(
		{
			autoTourSeconds: 12,
			refreshSeconds: 60,
			tierLabels: ['Start', 'Company', 'Locations', 'Departments'],
		},
		config.settings || {}
	);

	const nodes = Array.isArray(config.nodes) ? config.nodes : [];

	const STATUS_RANK = { red: 0, orange: 1, green: 2 };
	const STATUS_WORD = { red: 'Needs attention', orange: 'Slipping', green: 'On target' };

	const el = {
		tiers: root.querySelector('[data-cc-tiers]'),
		connectors: root.querySelector('[data-cc-connectors]'),
		attention: root.querySelector('[data-cc-attention]'),
		attentionList: root.querySelector('[data-cc-attention-list]'),
		attentionEmpty: root.querySelector('[data-cc-attention-empty]'),
		countRed: root.querySelector('[data-cc-count-red]'),
		countOrange: root.querySelector('[data-cc-count-orange]'),
		countGreen: root.querySelector('[data-cc-count-green]'),
		time: root.querySelector('[data-cc-time]'),
		date: root.querySelector('[data-cc-date]'),
		tourButton: root.querySelector('[data-cc-tour]'),
		fullscreenButton: root.querySelector('[data-cc-fullscreen]'),
		focus: root.querySelector('[data-cc-focus]'),
		focusTitle: root.querySelector('[data-cc-focus-title]'),
		focusSubtitle: root.querySelector('[data-cc-focus-subtitle]'),
		focusKpis: root.querySelector('[data-cc-focus-kpis]'),
		focusClose: root.querySelector('[data-cc-focus-close]'),
		focusEdit: root.querySelector('[data-cc-focus-edit]'),
		focusReset: root.querySelector('[data-cc-focus-reset]'),
		focusSaved: root.querySelector('[data-cc-focus-saved]'),
	};

	/* ------------------------------------------------------------ Storage */

	const todayKey = () => {
		const now = new Date();
		const month = String(now.getMonth() + 1).padStart(2, '0');
		const day = String(now.getDate()).padStart(2, '0');
		return `${now.getFullYear()}-${month}-${day}`;
	};

	const storageKey = () => `jm-command-center:${todayKey()}`;

	const readOverrides = () => {
		try {
			const raw = window.localStorage.getItem(storageKey());
			return raw ? JSON.parse(raw) : {};
		} catch (error) {
			return {};
		}
	};

	const writeOverrides = (overrides) => {
		try {
			window.localStorage.setItem(storageKey(), JSON.stringify(overrides));
			return true;
		} catch (error) {
			return false;
		}
	};

	/* ------------------------------------------------------------ Scoring */

	const timeToMinutes = (value) => {
		if (typeof value !== 'string') {
			return NaN;
		}

		const match = value.trim().match(/^(\d{1,2}):(\d{2})$/);

		if (!match) {
			return NaN;
		}

		return Number(match[1]) * 60 + Number(match[2]);
	};

	const toBoolean = (value) => {
		if (typeof value === 'string') {
			return ['1', 'true', 'yes', 'done'].includes(value.trim().toLowerCase());
		}

		return Boolean(value);
	};

	const scoreKpi = (kpi, value) => {
		const type = kpi.type || 'higher';

		if (type === 'check') {
			return toBoolean(value) ? 'green' : 'red';
		}

		if (type === 'time') {
			const minutes = timeToMinutes(value);
			const green = timeToMinutes(kpi.green);
			const orange = timeToMinutes(kpi.orange);

			if (Number.isNaN(minutes)) {
				return 'orange';
			}

			if (minutes <= green) {
				return 'green';
			}

			return minutes <= orange ? 'orange' : 'red';
		}

		const number = Number(value);

		if (value === '' || value === null || value === undefined || Number.isNaN(number)) {
			return 'orange';
		}

		const green = Number(kpi.green);
		const orange = Number(kpi.orange);

		if (type === 'lower') {
			if (number <= green) {
				return 'green';
			}

			return number <= orange ? 'orange' : 'red';
		}

		if (number >= green) {
			return 'green';
		}

		return number >= orange ? 'orange' : 'red';
	};

	const formatTime = (value) => {
		const minutes = timeToMinutes(value);

		if (Number.isNaN(minutes)) {
			return '--';
		}

		const hours24 = Math.floor(minutes / 60) % 24;
		const mins = String(minutes % 60).padStart(2, '0');
		const hours12 = hours24 % 12 === 0 ? 12 : hours24 % 12;
		return `${hours12}:${mins} ${hours24 < 12 ? 'AM' : 'PM'}`;
	};

	const formatNumber = (value) => {
		const number = Number(value);

		if (value === '' || value === null || value === undefined || Number.isNaN(number)) {
			return '--';
		}

		return Number.isInteger(number) ? String(number) : number.toFixed(1);
	};

	const formatValue = (kpi, value) => {
		if (kpi.type === 'check') {
			return toBoolean(value) ? 'Done' : 'Missed';
		}

		if (kpi.type === 'time') {
			return formatTime(value);
		}

		return formatNumber(value);
	};

	const unitFor = (kpi, value) => {
		if (kpi.type === 'check' || kpi.type === 'time') {
			return '';
		}

		const number = Number(value);

		if (Number.isNaN(number) || value === '' || value === null || value === undefined) {
			return 'No data';
		}

		return kpi.unit || '';
	};

	const evaluate = () => {
		const overrides = readOverrides();
		const evaluated = nodes.map((node) => {
			const nodeOverrides = overrides[node.id] || {};
			const kpis = (node.kpis || []).map((kpi) => {
				const hasOverride = Object.prototype.hasOwnProperty.call(nodeOverrides, kpi.id);
				const value = hasOverride ? nodeOverrides[kpi.id] : kpi.value;
				const status = scoreKpi(kpi, value);

				return {
					kpi,
					value,
					status,
					display: formatValue(kpi, value),
					unit: unitFor(kpi, value),
					overridden: hasOverride,
				};
			});

			const counts = { red: 0, orange: 0, green: 0 };
			kpis.forEach((item) => {
				counts[item.status] += 1;
			});

			let status = 'green';
			if (counts.red > 0) {
				status = 'red';
			} else if (counts.orange > 0) {
				status = 'orange';
			}

			return { node, kpis, counts, status, overridden: kpis.some((item) => item.overridden) };
		});

		return new Map(evaluated.map((entry) => [entry.node.id, entry]));
	};

	/* ------------------------------------------------------------ Rendering */

	const create = (tag, className, text) => {
		const element = document.createElement(tag);

		if (className) {
			element.className = className;
		}

		if (text !== undefined) {
			element.textContent = text;
		}

		return element;
	};

	const renderKpi = (item) => {
		const kpiEl = create('div', 'cc-kpi');
		kpiEl.dataset.status = item.status;
		kpiEl.dataset.kpi = item.kpi.id;

		kpiEl.appendChild(create('span', 'cc-kpi-label', item.kpi.label));
		kpiEl.appendChild(create('span', 'cc-kpi-target', item.kpi.target || ''));

		const value = create('span', 'cc-kpi-value', item.display);

		if (item.kpi.type === 'check' || item.kpi.type === 'time') {
			value.classList.add('is-text');
		}

		if (item.unit) {
			value.appendChild(create('small', null, item.unit));
		}

		kpiEl.appendChild(value);
		return kpiEl;
	};

	const renderNode = (entry) => {
		const { node, kpis, counts, status } = entry;
		const button = create('button', 'cc-node');
		button.type = 'button';
		button.dataset.status = status;
		button.dataset.node = node.id;
		button.setAttribute('aria-label', `${node.title}: ${STATUS_WORD[status]}. Open details.`);

		if (node.start) {
			button.classList.add('is-start');
		}

		const header = create('div', 'cc-node-header');
		const titles = create('div');
		titles.appendChild(create('h2', 'cc-node-title', node.title));

		if (node.subtitle) {
			titles.appendChild(create('p', 'cc-node-subtitle', node.subtitle));
		}

		header.appendChild(titles);

		const statusColumn = create('div', 'cc-node-status');
		statusColumn.appendChild(create('span', 'cc-node-badge', status === 'green' ? 'On target' : status === 'orange' ? 'Slipping' : 'Attention'));

		const countRow = create('div', 'cc-node-counts');
		['red', 'orange', 'green'].forEach((key) => {
			if (counts[key] === 0) {
				return;
			}

			const pill = create('span', 'cc-node-count');
			pill.dataset.status = key;
			pill.setAttribute('title', `${counts[key]} ${key}`);
			pill.appendChild(create('i'));
			pill.appendChild(document.createTextNode(String(counts[key])));
			countRow.appendChild(pill);
		});
		statusColumn.appendChild(countRow);
		header.appendChild(statusColumn);
		button.appendChild(header);

		const grid = create('div', 'cc-node-kpis');
		kpis.forEach((item) => grid.appendChild(renderKpi(item)));
		button.appendChild(grid);

		return button;
	};

	const renderTiers = (evaluated) => {
		el.tiers.replaceChildren();

		const tiers = new Map();
		nodes.forEach((node) => {
			const tier = Number(node.tier) || 0;

			if (!tiers.has(tier)) {
				tiers.set(tier, []);
			}

			tiers.get(tier).push(node);
		});

		[...tiers.keys()]
			.sort((a, b) => a - b)
			.forEach((tier) => {
				const column = create('section', 'cc-tier');
				column.dataset.tier = String(tier);

				const members = tiers.get(tier);

				if (members.length === 1) {
					column.classList.add('is-single');
				}

				if (el.tiers.childElementCount === 0) {
					column.classList.add('is-first');
				}

				const label = settings.tierLabels[tier] || `Tier ${tier + 1}`;
				column.setAttribute('aria-label', label);
				column.appendChild(create('p', 'cc-tier-label', label));

				const list = create('div', 'cc-tier-nodes');
				members.forEach((node) => {
					const nodeEl = renderNode(evaluated.get(node.id));

					if (members.length > 1) {
						nodeEl.classList.add('is-compact');
					}

					list.appendChild(nodeEl);
				});
				column.appendChild(list);

				el.tiers.appendChild(column);
			});
	};

	/* Wires descend: from a parent's bottom edge down to a rail between the
	   rows, along the rail, then down into the child's top edge. The rail is
	   neutral; the final drop takes the child's status color. */
	const renderConnectors = (evaluated) => {
		const svg = el.connectors;
		svg.replaceChildren();

		if (window.getComputedStyle(svg).display === 'none') {
			return;
		}

		const bounds = svg.getBoundingClientRect();
		svg.setAttribute('viewBox', `0 0 ${bounds.width} ${bounds.height}`);

		const rectFor = (id) => {
			const target = el.tiers.querySelector(`[data-node="${id}"]`);
			return target ? target.getBoundingClientRect() : null;
		};

		const namespace = 'http://www.w3.org/2000/svg';
		const round = (value) => Math.round(value * 10) / 10;

		nodes.forEach((node) => {
			const to = rectFor(node.id);

			if (!to) {
				return;
			}

			const childX = round(to.left + to.width / 2 - bounds.left);
			const childTop = round(to.top - bounds.top);
			const status = evaluated.get(node.id).status;
			let connected = false;

			(node.parents || []).forEach((parentId) => {
				const from = rectFor(parentId);

				if (!from || from.bottom > to.top) {
					return;
				}

				connected = true;
				const parentX = round(from.left + from.width / 2 - bounds.left);
				const parentBottom = round(from.bottom - bounds.top);
				const railY = round(parentBottom + (childTop - parentBottom) / 2);

				const rail = document.createElementNS(namespace, 'path');
				rail.setAttribute('d', `M ${parentX} ${parentBottom} V ${railY} H ${childX}`);
				svg.appendChild(rail);

				const drop = document.createElementNS(namespace, 'path');
				drop.setAttribute('d', `M ${childX} ${railY} V ${childTop}`);
				drop.dataset.status = status;
				svg.appendChild(drop);
			});

			if (connected) {
				const dot = document.createElementNS(namespace, 'circle');
				dot.setAttribute('cx', String(childX));
				dot.setAttribute('cy', String(childTop));
				dot.setAttribute('r', '6');
				dot.dataset.status = status;
				svg.appendChild(dot);
			}
		});
	};

	const renderAttention = (evaluated) => {
		el.attentionList.replaceChildren();

		const items = [];
		evaluated.forEach((entry) => {
			entry.kpis.forEach((item) => {
				if (item.status !== 'green') {
					items.push({ entry, item });
				}
			});
		});

		items.sort((a, b) => STATUS_RANK[a.item.status] - STATUS_RANK[b.item.status]);

		const totals = { red: 0, orange: 0, green: 0 };
		evaluated.forEach((entry) => {
			totals.red += entry.counts.red;
			totals.orange += entry.counts.orange;
			totals.green += entry.counts.green;
		});

		el.countRed.textContent = String(totals.red);
		el.countOrange.textContent = String(totals.orange);
		el.countGreen.textContent = String(totals.green);

		el.attention.classList.toggle('is-clear', items.length === 0);
		el.attentionEmpty.hidden = items.length > 0;

		items.forEach(({ entry, item }) => {
			const li = create('li');
			const button = create('button', 'cc-attention-item');
			button.type = 'button';
			button.dataset.status = item.status;
			button.dataset.node = entry.node.id;

			const value = create('span', 'cc-attention-value', item.display);

			if (item.kpi.type === 'check') {
				value.classList.add('is-text');
			}

			button.appendChild(value);

			const text = create('span', 'cc-attention-text');
			text.appendChild(create('span', 'cc-attention-label', item.kpi.label));

			const meta = create('span', 'cc-attention-meta');
			meta.appendChild(create('b', null, entry.node.title));
			meta.appendChild(document.createTextNode(item.kpi.target ? ` · ${item.kpi.target}` : ''));
			text.appendChild(meta);
			button.appendChild(text);

			li.appendChild(button);
			el.attentionList.appendChild(li);
		});
	};

	/* When more items need attention than fit on screen, glide the strip so
	   every item gets seen without anyone touching the TV. */
	let marqueeTimer = null;
	let marqueeDirection = 1;

	const startMarquee = () => {
		if (marqueeTimer) {
			window.clearInterval(marqueeTimer);
			marqueeTimer = null;
		}

		el.attentionList.scrollLeft = 0;

		if (el.attentionList.scrollWidth <= el.attentionList.clientWidth + 4) {
			return;
		}

		let pauseTicks = 40;
		marqueeTimer = window.setInterval(() => {
			if (pauseTicks > 0) {
				pauseTicks -= 1;
				return;
			}

			const list = el.attentionList;
			const max = list.scrollWidth - list.clientWidth;
			list.scrollLeft += marqueeDirection;

			if (list.scrollLeft >= max - 1 || list.scrollLeft <= 0) {
				marqueeDirection *= -1;
				pauseTicks = 40;
			}
		}, 40);
	};

	let evaluatedState = evaluate();

	const renderAll = () => {
		evaluatedState = evaluate();
		renderTiers(evaluatedState);
		renderAttention(evaluatedState);
		window.requestAnimationFrame(() => {
			renderConnectors(evaluatedState);
			startMarquee();
		});
	};

	/* ------------------------------------------------------------ Focus dialog */

	let focusedNodeId = null;
	let editing = false;

	const renderFocus = () => {
		const entry = evaluatedState.get(focusedNodeId);

		if (!entry) {
			return;
		}

		el.focus.querySelector('.cc-focus-panel').dataset.status = entry.status;
		el.focusTitle.textContent = entry.node.title;
		el.focusSubtitle.textContent = `${entry.node.subtitle || ''} · ${STATUS_WORD[entry.status]}`;
		el.focusSaved.hidden = !entry.overridden;
		el.focusEdit.textContent = editing ? 'Save' : "Log Today's Numbers";
		el.focusKpis.replaceChildren();

		entry.kpis.forEach((item) => {
			const card = create('div', 'cc-focus-kpi');
			card.dataset.status = item.status;
			card.dataset.kpi = item.kpi.id;
			card.appendChild(create('span', 'cc-focus-kpi-label', item.kpi.label));

			if (editing) {
				if (item.kpi.type === 'check') {
					const toggle = create('button', 'cc-focus-toggle');
					toggle.type = 'button';
					toggle.dataset.input = 'check';
					const done = toBoolean(item.value);
					toggle.setAttribute('aria-pressed', String(done));
					toggle.textContent = done ? 'Done' : 'Not yet';
					toggle.addEventListener('click', () => {
						const next = toggle.getAttribute('aria-pressed') !== 'true';
						toggle.setAttribute('aria-pressed', String(next));
						toggle.textContent = next ? 'Done' : 'Not yet';
					});
					card.appendChild(toggle);
				} else {
					const input = create('input');
					input.type = item.kpi.type === 'time' ? 'time' : 'number';
					input.dataset.input = item.kpi.type === 'time' ? 'time' : 'number';
					input.step = 'any';
					input.value = item.value === null || item.value === undefined ? '' : String(item.value);
					input.setAttribute('aria-label', `${item.kpi.label} value`);
					card.appendChild(input);
				}
			} else {
				const value = create('span', 'cc-focus-kpi-value', item.display);

				if (item.unit) {
					value.appendChild(create('small', null, item.unit));
				}

				card.appendChild(value);
				card.appendChild(create('span', 'cc-focus-kpi-status', STATUS_WORD[item.status]));
			}

			card.appendChild(create('span', 'cc-focus-kpi-target', item.kpi.target ? `Target: ${item.kpi.target}` : ''));
			el.focusKpis.appendChild(card);
		});
	};

	const openFocus = (nodeId) => {
		if (!evaluatedState.has(nodeId)) {
			return;
		}

		focusedNodeId = nodeId;
		editing = false;
		renderFocus();
		el.focus.hidden = false;
		el.focusClose.focus();
	};

	const closeFocus = () => {
		el.focus.hidden = true;
		focusedNodeId = null;
		editing = false;
	};

	const saveFocus = () => {
		const entry = evaluatedState.get(focusedNodeId);

		if (!entry) {
			return;
		}

		const overrides = readOverrides();
		const nodeOverrides = Object.assign({}, overrides[entry.node.id] || {});

		el.focusKpis.querySelectorAll('[data-kpi]').forEach((card) => {
			const kpiId = card.dataset.kpi;
			const control = card.querySelector('[data-input]');

			if (!control) {
				return;
			}

			if (control.dataset.input === 'check') {
				nodeOverrides[kpiId] = control.getAttribute('aria-pressed') === 'true';
			} else if (control.dataset.input === 'time') {
				nodeOverrides[kpiId] = control.value;
			} else {
				nodeOverrides[kpiId] = control.value === '' ? '' : Number(control.value);
			}
		});

		overrides[entry.node.id] = nodeOverrides;
		writeOverrides(overrides);
		editing = false;
		renderAll();
		renderFocus();
	};

	el.focusEdit.addEventListener('click', () => {
		if (editing) {
			saveFocus();
			return;
		}

		editing = true;
		renderFocus();
		const first = el.focusKpis.querySelector('[data-input]');

		if (first) {
			first.focus();
		}
	});

	el.focusReset.addEventListener('click', () => {
		if (!focusedNodeId) {
			return;
		}

		const overrides = readOverrides();
		delete overrides[focusedNodeId];
		writeOverrides(overrides);
		editing = false;
		renderAll();
		renderFocus();
	});

	el.focusClose.addEventListener('click', closeFocus);

	el.focus.addEventListener('click', (event) => {
		if (event.target === el.focus) {
			closeFocus();
		}
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && !el.focus.hidden) {
			closeFocus();
		}
	});

	root.addEventListener('click', (event) => {
		const trigger = event.target.closest('[data-node]');

		if (!trigger || el.focus.contains(trigger)) {
			return;
		}

		stopTour();
		openFocus(trigger.dataset.node);
	});

	/* ------------------------------------------------------------ Auto tour */

	let tourTimer = null;
	let tourIndex = -1;

	const tourStep = () => {
		if (nodes.length === 0) {
			return;
		}

		tourIndex = (tourIndex + 1) % (nodes.length + 1);

		if (tourIndex === nodes.length) {
			closeFocus();
			return;
		}

		openFocus(nodes[tourIndex].id);
	};

	const startTour = () => {
		if (tourTimer) {
			return;
		}

		el.tourButton.setAttribute('aria-pressed', 'true');
		tourIndex = -1;
		tourStep();
		tourTimer = window.setInterval(tourStep, Math.max(4, Number(settings.autoTourSeconds) || 12) * 1000);
	};

	function stopTour() {
		if (!tourTimer) {
			return;
		}

		window.clearInterval(tourTimer);
		tourTimer = null;
		el.tourButton.setAttribute('aria-pressed', 'false');
	}

	el.tourButton.addEventListener('click', () => {
		if (tourTimer) {
			stopTour();
			closeFocus();
		} else {
			startTour();
		}
	});

	/* ------------------------------------------------------------ TV mode */

	el.fullscreenButton.addEventListener('click', () => {
		if (document.fullscreenElement) {
			document.exitFullscreen();
			return;
		}

		if (root.requestFullscreen) {
			root.requestFullscreen().catch(() => {});
		}
	});

	document.addEventListener('fullscreenchange', () => {
		el.fullscreenButton.textContent = document.fullscreenElement ? 'Exit TV Mode' : 'TV Mode';
		window.requestAnimationFrame(() => renderConnectors(evaluatedState));
	});

	/* ------------------------------------------------------------ Clock */

	const tickClock = () => {
		const now = new Date();
		el.time.textContent = now.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
		el.date.textContent = now.toLocaleDateString([], {
			weekday: 'long',
			month: 'long',
			day: 'numeric',
		});
	};

	tickClock();
	window.setInterval(tickClock, 15000);

	/* ------------------------------------------------------------ Boot */

	renderAll();

	let resizeFrame = null;
	const handleResize = () => {
		if (resizeFrame) {
			window.cancelAnimationFrame(resizeFrame);
		}

		resizeFrame = window.requestAnimationFrame(() => renderConnectors(evaluatedState));
	};

	window.addEventListener('resize', handleResize);

	if (typeof ResizeObserver === 'function') {
		new ResizeObserver(handleResize).observe(el.tiers);
	}

	if (document.fonts && document.fonts.ready) {
		document.fonts.ready.then(handleResize);
	}

	let lastDay = todayKey();
	window.setInterval(() => {
		const day = todayKey();

		if (day !== lastDay) {
			lastDay = day;
			renderAll();
		}
	}, Math.max(15, Number(settings.refreshSeconds) || 60) * 1000);
})();
