/**
 * JM Training — Staff Scheduler & Time Clock
 * -------------------------------------------------
 * A single Google Sheet is the database AND your review surface.
 * A lightweight web app (Index.html) lets employees pick their name,
 * choose the duty they're performing, and clock in / out. Shifts live
 * in the Shifts tab, sync to Google Calendar when claimed, and a daily
 * trigger emails everyone about shifts still unclaimed 7 days out.
 *
 * Nothing here runs on the WordPress site — it all runs in your Google
 * account. See README.md for the one-time setup steps.
 */

// ----------------------------------------------------------------------------
// CONFIG — edit these, then run "Staff Scheduler ▸ Set up sheet tabs" once.
// ----------------------------------------------------------------------------
const CONFIG = {
  // Public URL of your logo shown at the top of the clock page.
  // Defaults to the logo already in your theme; swap for a hosted URL if needed.
  LOGO_URL: 'https://joemalonetraining.com/wp-content/themes/thrive-theme-child/assets/images/jm-logo.png',

  // Business name shown on the clock page.
  BUSINESS_NAME: 'Joe Malone Training',

  // Leave '' when the script is bound to the Sheet (recommended).
  // Otherwise paste the Spreadsheet ID to target a specific sheet.
  SPREADSHEET_ID: '',

  // Leave '' to use your default Google Calendar for claimed shifts,
  // or paste a calendar ID to keep shifts on a dedicated calendar.
  SHIFT_CALENDAR_ID: '',

  // How many days ahead the "unclaimed shift" alert fires.
  ALERT_DAYS_AHEAD: 7,
};

const TABS = {
  EMPLOYEES: 'Employees',
  DUTIES: 'Duties',
  RATES: 'Pay Rates',
  ENTRIES: 'Time Entries',
  SHIFTS: 'Shifts',
};

// ----------------------------------------------------------------------------
// MENU + SETUP
// ----------------------------------------------------------------------------
function onOpen() {
  SpreadsheetApp.getUi()
    .createMenu('Staff Scheduler')
    .addItem('Set up sheet tabs', 'setupSheets')
    .addItem('Install daily 7-day alert', 'installDailyTrigger')
    .addItem('Send test unclaimed-shift alert', 'checkUnclaimedShifts')
    .addToUi();
}

function getSS_() {
  return CONFIG.SPREADSHEET_ID
    ? SpreadsheetApp.openById(CONFIG.SPREADSHEET_ID)
    : SpreadsheetApp.getActiveSpreadsheet();
}

function sheet_(name) {
  const ss = getSS_();
  return ss.getSheetByName(name) || ss.insertSheet(name);
}

/** Creates the four/five tabs with headers and a couple of sample rows. */
function setupSheets() {
  const ss = getSS_();

  const employees = sheet_(TABS.EMPLOYEES);
  if (employees.getLastRow() === 0) {
    employees.getRange(1, 1, 1, 3).setValues([['Name', 'Email', 'Active']]);
    employees.getRange(2, 1, 2, 3).setValues([
      ['Sample Employee One', 'one@example.com', true],
      ['Sample Employee Two', 'two@example.com', true],
    ]);
  }

  const duties = sheet_(TABS.DUTIES);
  if (duties.getLastRow() === 0) {
    duties.getRange(1, 1, 1, 2).setValues([['Duty', 'Default Rate']]);
    duties.getRange(2, 1, 3, 2).setValues([
      ['Range Safety Officer', 30],
      ['Lead Instruction', 45],
      ['Setup / Breakdown', 20],
    ]);
  }

  const rates = sheet_(TABS.RATES);
  if (rates.getLastRow() === 0) {
    rates.getRange(1, 1, 1, 3).setValues([['Employee', 'Duty', 'Rate']]);
    rates.getRange(2, 1, 1, 3).setValues([
      ['Sample Employee One', 'Lead Instruction', 55],
    ]);
  }

  const entries = sheet_(TABS.ENTRIES);
  if (entries.getLastRow() === 0) {
    entries.getRange(1, 1, 1, 10).setValues([[
      'ID', 'Name', 'Duty', 'Clock In', 'Clock Out',
      'Hours', 'Rate', 'Pay', 'Status', 'Note',
    ]]);
    entries.setFrozenRows(1);
  }

  const shifts = sheet_(TABS.SHIFTS);
  if (shifts.getLastRow() === 0) {
    shifts.getRange(1, 1, 1, 9).setValues([[
      'ID', 'Title', 'Date', 'Start Time', 'End Time', 'Duty', 'Claimed By', 'Event ID', 'Notified',
    ]]);
    // One sample row so the date/time format is obvious.
    const d = new Date();
    d.setDate(d.getDate() + 14);
    d.setHours(0, 0, 0, 0);
    shifts.getRange(2, 1, 1, 6).setValues([[
      'S' + Date.now(), 'Sample Training Event', d,
      new Date(1899, 11, 30, 9, 0), new Date(1899, 11, 30, 17, 0), 'Lead Instruction',
    ]]);
    shifts.getRange(2, 3).setNumberFormat('M/d/yyyy');         // Date
    shifts.getRange(2, 4, 1, 2).setNumberFormat('h:mm am/pm'); // Start/End Time
    shifts.setFrozenRows(1);
  }

  SpreadsheetApp.getUi().alert(
    'Tabs are ready.\n\n' +
    '1) Fill in the Employees, Duties and Pay Rates tabs.\n' +
    '2) Add shifts as rows in the Shifts tab (Title, Date, Start Time, End Time, Duty).\n' +
    '3) Deploy ▸ New deployment ▸ Web app to get the clock-in link.'
  );
}

// ----------------------------------------------------------------------------
// WEB APP
// ----------------------------------------------------------------------------
function doGet() {
  const t = HtmlService.createTemplateFromFile('Index');
  t.logoUrl = CONFIG.LOGO_URL;
  t.businessName = CONFIG.BUSINESS_NAME;
  return t.evaluate()
    .setTitle(CONFIG.BUSINESS_NAME + ' — Time Clock')
    .addMetaTag('viewport', 'width=device-width, initial-scale=1')
    .setXFrameOptionsMode(HtmlService.XFrameOptionsMode.ALLOWALL);
}

/** Everything the page needs on load: employees, duties, who's clocked in, shifts. */
function getBootstrapData() {
  const employees = readRows_(TABS.EMPLOYEES)
    .filter(function (r) { return r['Name'] && r['Active'] !== false; })
    .map(function (r) { return r['Name']; });

  const duties = readRows_(TABS.DUTIES)
    .filter(function (r) { return r['Duty']; })
    .map(function (r) { return r['Duty']; });

  // Open (currently clocked-in) entries, keyed by name.
  const openByName = {};
  readRows_(TABS.ENTRIES).forEach(function (r) {
    if (String(r['Status']).toLowerCase() === 'open') {
      openByName[r['Name']] = {
        duty: r['Duty'],
        since: formatTime_(r['Clock In']),
      };
    }
  });

  // Upcoming shifts (now → +60 days), soonest first.
  const now = new Date();
  const horizon = new Date(now.getTime() + 60 * 86400000);
  const shifts = readRows_(TABS.SHIFTS)
    .map(function (r) {
      const start = combineDateTime_(r['Date'], r['Start Time']);
      const end = combineDateTime_(r['Date'], r['End Time']);
      return {
        id: r['ID'],
        title: r['Title'],
        duty: r['Duty'],
        start: start,
        when: formatRange_(start, end),
        claimedBy: r['Claimed By'] || '',
      };
    })
    .filter(function (s) { return s.start && s.start >= now && s.start <= horizon; })
    .sort(function (a, b) { return a.start - b.start; });

  return { employees: employees, duties: duties, openByName: openByName, shifts: shifts };
}

/** Clock a person in. Rejects a second open punch for the same person. */
function clockIn(name, duty) {
  if (!name || !duty) throw new Error('Pick your name and a duty first.');
  if (findOpenRow_(name)) throw new Error(name + ' is already clocked in.');

  const sh = sheet_(TABS.ENTRIES);
  const row = sh.getLastRow() + 1;
  const id = 'T' + Date.now();
  sh.getRange(row, 1, 1, 10).setValues([[
    id, name, duty, new Date(), '', '', '', '', 'Open', '',
  ]]);
  // Hours (F) and Pay (H) are formulas so manual edits to times auto-recompute.
  sh.getRange(row, 6).setFormula('=IF(AND(ISNUMBER($D' + row + '),ISNUMBER($E' + row + ')),($E' + row + '-$D' + row + ')*24,"")');
  sh.getRange(row, 8).setFormula('=IF(AND(ISNUMBER($F' + row + '),ISNUMBER($G' + row + ')),$F' + row + '*$G' + row + ',"")');

  return 'Clocked in for ' + duty + '.';
}

/** Clock a person out, freezing their rate for the duty they were performing. */
function clockOut(name) {
  const found = findOpenRow_(name);
  if (!found) throw new Error(name + ' is not clocked in.');

  const sh = sheet_(TABS.ENTRIES);
  const rate = lookupRate_(name, found.duty);
  sh.getRange(found.row, 5).setValue(new Date()); // Clock Out
  sh.getRange(found.row, 7).setValue(rate);       // Rate (frozen as a value)
  sh.getRange(found.row, 9).setValue('Closed');   // Status
  return 'Clocked out. Thanks!';
}

/** Employee claims an open shift → recorded in the Sheet + a Calendar invite. */
function claimShift(shiftId, name) {
  if (!name) throw new Error('Pick your name first.');
  const sh = sheet_(TABS.SHIFTS);
  const data = sh.getDataRange().getValues();
  const header = data[0];
  const col = indexMap_(header);

  for (var i = 1; i < data.length; i++) {
    if (String(data[i][col['ID']]) !== String(shiftId)) continue;
    if (data[i][col['Claimed By']]) {
      throw new Error('That shift was just claimed by ' + data[i][col['Claimed By']] + '.');
    }
    const start = combineDateTime_(data[i][col['Date']], data[i][col['Start Time']]);
    if (!start) throw new Error('That shift is missing a date or start time.');
    const end = combineDateTime_(data[i][col['Date']], data[i][col['End Time']]) ||
      new Date(start.getTime() + 3600000);
    const title = data[i][col['Title']];
    const duty = data[i][col['Duty']];

    const eventId = createShiftEvent_(title, duty, name, start, end);
    sh.getRange(i + 1, col['Claimed By'] + 1).setValue(name);
    if (eventId) sh.getRange(i + 1, col['Event ID'] + 1).setValue(eventId);
    return 'You claimed: ' + title + '. A calendar invite is on the way.';
  }
  throw new Error('Shift not found.');
}

// ----------------------------------------------------------------------------
// DAILY ALERT — unclaimed shifts within ALERT_DAYS_AHEAD
// ----------------------------------------------------------------------------
function installDailyTrigger() {
  ScriptApp.getProjectTriggers().forEach(function (t) {
    if (t.getHandlerFunction() === 'checkUnclaimedShifts') ScriptApp.deleteTrigger(t);
  });
  ScriptApp.newTrigger('checkUnclaimedShifts')
    .timeBased().everyDays(1).atHour(7).create();
  SpreadsheetApp.getUi().alert('Daily alert installed — it runs each morning around 7am.');
}

function checkUnclaimedShifts() {
  const sh = sheet_(TABS.SHIFTS);
  const data = sh.getDataRange().getValues();
  if (data.length < 2) return;
  const col = indexMap_(data[0]);

  const now = new Date();
  const cutoff = new Date(now.getTime() + CONFIG.ALERT_DAYS_AHEAD * 86400000);
  const newlyDue = [];

  for (var i = 1; i < data.length; i++) {
    const start = combineDateTime_(data[i][col['Date']], data[i][col['Start Time']]);
    const end = combineDateTime_(data[i][col['Date']], data[i][col['End Time']]);
    const claimed = data[i][col['Claimed By']];
    const notified = data[i][col['Notified']];
    if (start && start >= now && start <= cutoff && !claimed && notified !== true) {
      newlyDue.push({ row: i + 1, title: data[i][col['Title']], when: formatRange_(start, end) });
    }
  }
  if (!newlyDue.length) return;

  const emails = readRows_(TABS.EMPLOYEES)
    .filter(function (r) { return r['Email'] && r['Active'] !== false; })
    .map(function (r) { return r['Email']; });
  if (!emails.length) return;

  var body = 'These shifts are within ' + CONFIG.ALERT_DAYS_AHEAD +
    ' days and still need someone to claim them:\n\n';
  newlyDue.forEach(function (s) { body += '• ' + s.title + ' — ' + s.when + '\n'; });
  body += '\nClaim one on the time-clock page.';

  MailApp.sendEmail({
    to: emails.join(','),
    subject: CONFIG.BUSINESS_NAME + ': unclaimed shift(s) coming up',
    body: body,
  });

  newlyDue.forEach(function (s) { sh.getRange(s.row, col['Notified'] + 1).setValue(true); });
}

// ----------------------------------------------------------------------------
// HELPERS
// ----------------------------------------------------------------------------
function indexMap_(header) {
  const m = {};
  header.forEach(function (h, i) { m[h] = i; });
  return m;
}

/** Reads a tab into an array of {Header: value} objects. */
function readRows_(name) {
  const sh = getSS_().getSheetByName(name);
  if (!sh || sh.getLastRow() < 2) return [];
  const data = sh.getDataRange().getValues();
  const header = data.shift();
  return data.map(function (row) {
    const obj = {};
    header.forEach(function (h, i) { obj[h] = row[i]; });
    return obj;
  });
}

/** Latest open time-entry row for a person, or null. */
function findOpenRow_(name) {
  const sh = getSS_().getSheetByName(TABS.ENTRIES);
  if (!sh || sh.getLastRow() < 2) return null;
  const data = sh.getDataRange().getValues();
  const col = indexMap_(data[0]);
  for (var i = data.length - 1; i >= 1; i--) {
    if (data[i][col['Name']] === name && String(data[i][col['Status']]).toLowerCase() === 'open') {
      return { row: i + 1, duty: data[i][col['Duty']] };
    }
  }
  return null;
}

/** Per-employee+duty override from Pay Rates, else the duty's default rate. */
function lookupRate_(name, duty) {
  const override = readRows_(TABS.RATES).filter(function (r) {
    return r['Employee'] === name && r['Duty'] === duty;
  })[0];
  if (override && override['Rate'] !== '' && override['Rate'] != null) return Number(override['Rate']);

  const def = readRows_(TABS.DUTIES).filter(function (r) { return r['Duty'] === duty; })[0];
  return def ? Number(def['Default Rate']) || 0 : 0;
}

function createShiftEvent_(title, duty, name, start, end) {
  try {
    const cal = CONFIG.SHIFT_CALENDAR_ID
      ? CalendarApp.getCalendarById(CONFIG.SHIFT_CALENDAR_ID)
      : CalendarApp.getDefaultCalendar();
    const email = employeeEmail_(name);
    const event = cal.createEvent(
      title + (duty ? ' (' + duty + ')' : '') + ' — ' + name,
      start, end,
      { description: 'Shift claimed by ' + name, guests: email || '', sendInvites: !!email }
    );
    return event.getId();
  } catch (e) {
    return ''; // Don't block the claim if calendar fails.
  }
}

function employeeEmail_(name) {
  const r = readRows_(TABS.EMPLOYEES).filter(function (x) { return x['Name'] === name; })[0];
  return r ? r['Email'] : '';
}

/**
 * Combines a Date-cell (the event day) with a Time-cell (start or end time)
 * into a single Date. Google Sheets returns a date cell as midnight of that
 * day and a time cell as that time on 1899-12-30, so we splice them together.
 */
function combineDateTime_(dateVal, timeVal) {
  if (!(dateVal instanceof Date)) return null;
  const d = new Date(dateVal.getTime());
  if (timeVal instanceof Date) {
    d.setHours(timeVal.getHours(), timeVal.getMinutes(), 0, 0);
  }
  return d;
}

function formatTime_(d) {
  if (!(d instanceof Date)) return '';
  return Utilities.formatDate(d, getSS_().getSpreadsheetTimeZone(), 'h:mm a');
}

function formatRange_(start, end) {
  if (!(start instanceof Date)) return '';
  const tz = getSS_().getSpreadsheetTimeZone();
  const s = Utilities.formatDate(start, tz, 'EEE MMM d, h:mm a');
  const e = end instanceof Date ? Utilities.formatDate(end, tz, 'h:mm a') : '';
  return e ? s + '–' + e : s;
}
