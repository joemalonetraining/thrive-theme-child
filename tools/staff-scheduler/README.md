# Staff Scheduler & Time Clock

A simple employee **time clock + shift scheduler** that runs entirely inside your
Google account. One Google Sheet is the database *and* the screen you open to
review or adjust hours. Employees use a branded web page to pick their name,
choose the **duty** they're performing, and clock in/out. Shifts live in the
Sheet, sync to Google Calendar when claimed, and everyone gets emailed about any
shift still unclaimed 7 days out.

> This tool does **not** run on the WordPress site. It lives in Google. These
> files are kept in the repo so the source is version-controlled. Nothing here
> changes the theme.

## What you get

- **Logo + Clock In / Clock Out** — employees pick their name (no login), pick a
  duty, and punch. Times are stamped by Google's server, not the device.
- **Per-duty pay rates** — each person can have a different rate per duty.
  Pay is calculated on every row and is fully editable by you.
- **A Google Sheet you control** — review and adjust any entry by hand. Editing a
  clock-in/out time auto-recalculates hours and pay.
- **Shifts on Google Calendar** — employees claim open shifts and get calendar
  reminders. A daily check emails the whole team about unclaimed shifts inside 7 days.

## The Sheet tabs

| Tab | Columns | Purpose |
|-----|---------|---------|
| **Employees** | Name, Email, Active | Who shows up in the dropdown + who gets alerts |
| **Duties** | Duty, Default Rate | The duties employees can choose + fallback rate |
| **Pay Rates** | Employee, Duty, Rate | Per-person overrides (optional) |
| **Time Entries** | ID, Name, Duty, Clock In, Clock Out, Hours, Rate, Pay, Status, Note | The time log — edit freely |
| **Shifts** | ID, Title, Date, Start Time, End Time, Duty, Claimed By, Event ID, Notified | Add training events as rows; claiming/alerts update them |

## One-time setup (about 10 minutes)

1. Create a new Google Sheet in the account that should own the data.
2. **Extensions ▸ Apps Script** to open the bound script project.
3. Create three files matching this folder and paste in the contents:
   - `Code.gs`
   - `Index.html` (File ▸ New ▸ HTML, name it `Index`)
   - `appsscript.json` (Project Settings ▸ "Show appsscript.json", then paste)
4. Edit the `CONFIG` block at the top of `Code.gs` — at minimum confirm
   `LOGO_URL` and `BUSINESS_NAME`.
5. Reload the Sheet. A **Staff Scheduler** menu appears → click
   **Set up sheet tabs** and approve the permission prompt.
6. Fill in **Employees**, **Duties**, **Pay Rates**, and add a few **Shifts**.
7. **Staff Scheduler ▸ Install daily 7-day alert** (approve once).
8. **Deploy ▸ New deployment ▸ Web app**
   - Execute as: **Me**
   - Who has access: **Anyone** (so staff don't need to log in)
   - Copy the web-app URL — that's the clock-in link. Bookmark it or print a QR code.

## Day-to-day

- **Employees:** open the link → Clock In / Out, or the **Shifts** tab to claim a shift.
- **You:** open the Sheet to review hours, fix a missed punch, or change a rate.
  Add new shifts by adding rows to the **Shifts** tab.

## Adjusting later (when you're ready)

- **Payroll export** — pay is already computed per row, so pushing approved hours
  into QuickBooks Payroll is a small add-on.
- **Dedicated shift calendar** — set `SHIFT_CALENDAR_ID` in `CONFIG` to keep
  claimed shifts off your personal calendar.
- **Require logins** — change `appsscript.json` access to `DOMAIN` and have
  employees sign in with Google for verified punches.
