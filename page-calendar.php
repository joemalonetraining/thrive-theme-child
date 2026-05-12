<?php
/**
 * Template Name: JM Training Calendar
 * Template Post Type: page
 */

get_header();

$jm_calendar_images_uri = get_stylesheet_directory_uri() . '/assets/images';
$jm_calendar_csv = <<<'CSV'
event_id,start_date,end_date,start_time,end_time,all_day,title,location,category,description,status,recurrence_source,color_key,notes
2026-05-01-001,2026-05-01,2026-05-01,9:00 AM,6:00 PM,False,GBRS Two-Day Rifle/Pistol,Berkeley,Rifle/Pistol,Day 1 of two-day GBRS rifle/pistol course.,Scheduled,Specific,Berkeley,User specified Berkeley location; all-day interpreted as 9 AM-6 PM.
2026-05-01-020,2026-05-01,2026-05-01,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-05-02-002,2026-05-02,2026-05-02,9:00 AM,6:00 PM,False,GBRS Two-Day Rifle/Pistol,Berkeley,Rifle/Pistol,Day 2 of two-day GBRS rifle/pistol course.,Scheduled,Specific,Berkeley,User specified Berkeley location; all-day interpreted as 9 AM-6 PM.
2026-05-04-021,2026-05-04,2026-05-04,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-05-05-022,2026-05-05,2026-05-05,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-05-06-023,2026-05-06,2026-05-06,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-05-07-024,2026-05-07,2026-05-07,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-05-08-025,2026-05-08,2026-05-08,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-05-08-026,2026-05-08,2026-05-08,5:00 PM,9:00 PM,False,Handgun Level 0 Orientation / New Member Orientation,Bourbonnais,Orientation,Handgun level 0 orientation for new members.,Scheduled,Second Friday Monthly,Bourbonnais,Corrected from earlier 1-2-3 competition.
2026-05-09-003,2026-05-09,2026-05-09,10:00 AM,5:00 PM,False,DSU Handgun Level 1 Block Alpha,Bourbonnais,DSU Handgun,DSU handgun level 1 alpha block.,Scheduled,Specific,Bourbonnais,
2026-05-10-004,2026-05-10,2026-05-10,,,True,Closed - Mother's Day,Bourbonnais,Holiday/Closure,Closed for Mother's Day.,Closed,Specific,Closure,Mother's Day
2026-05-10-093,2026-05-10,2026-05-10,,,True,Mother's Day,Holiday,Holiday,Observed/Informational,Info,Holiday list,Holiday,
2026-05-11-027,2026-05-11,2026-05-11,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-05-12-028,2026-05-12,2026-05-12,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-05-13-005,2026-05-13,2026-05-13,,,True,Closed - Private Training,Bourbonnais,Private Training,Closed for private training.,Closed,Specific,Closure,Overrides normal Wednesday open range.
2026-05-14-029,2026-05-14,2026-05-14,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-05-15-030,2026-05-15,2026-05-15,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-05-15-031,2026-05-15,2026-05-15,5:00 PM,9:00 PM,False,Level 4 Rifle/Pistol Competition,Bourbonnais,Rifle/Pistol Competition,Monthly level 4 rifle/pistol competition.,Scheduled,Third Friday Monthly,Bourbonnais,
2026-05-16-006,2026-05-16,2026-05-16,,,True,Closed - Bourbonnais,Bourbonnais,Closure,Bourbonnais location closed.,Closed,Specific,Closure,
2026-05-17-007,2026-05-17,2026-05-17,10:00 AM,5:00 PM,False,DSU Handgun Level 1 Block Bravo,Bourbonnais,DSU Handgun,DSU handgun level 1 bravo block.,Scheduled,Specific,Bourbonnais,
2026-05-18-032,2026-05-18,2026-05-18,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-05-19-033,2026-05-19,2026-05-19,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-05-20-034,2026-05-20,2026-05-20,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-05-21-035,2026-05-21,2026-05-21,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-05-22-036,2026-05-22,2026-05-22,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-05-22-037,2026-05-22,2026-05-22,5:00 PM,9:00 PM,False,Handgun Levels 1-2-3 Competition,Bourbonnais,Handgun Competition,"Monthly handgun levels 1, 2, and 3 competition.",Scheduled,Fourth Friday Monthly,Bourbonnais,
2026-05-23-008,2026-05-23,2026-05-23,,,True,Closed - Charity Setup,Bourbonnais,Closure,Closed for charity setup.,Closed,Specific,Closure,
2026-05-24-009,2026-05-24,2026-05-24,,,True,Closed - Charity Event,Bourbonnais,Closure,Closed for charity event.,Closed,Specific,Closure,
2026-05-25-038,2026-05-25,2026-05-25,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-05-25-094,2026-05-25,2026-05-25,,,True,Memorial Day,Holiday,Holiday,Federal Holiday,Info,Holiday list,Holiday,
2026-05-26-039,2026-05-26,2026-05-26,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-05-27-040,2026-05-27,2026-05-27,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-05-28-041,2026-05-28,2026-05-28,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-05-29-042,2026-05-29,2026-05-29,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-05-30-010,2026-05-30,2026-05-30,,,True,Closed - Memorial Rock Run,Bourbonnais,Closure,Closed for Memorial Rock Run.,Closed,Specific,Closure,
2026-05-31-011,2026-05-31,2026-05-31,10:00 AM,5:00 PM,False,DSU Handgun Level 2 Block Alpha,Bourbonnais,DSU Handgun,DSU handgun level 2 alpha block.,Scheduled,Specific,Bourbonnais,
2026-06-01-043,2026-06-01,2026-06-01,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-06-02-044,2026-06-02,2026-06-02,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-03-045,2026-06-03,2026-06-03,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-04-046,2026-06-04,2026-06-04,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-05-012,2026-06-05,2026-06-05,,,True,Closed,Bourbonnais,Closure,Closed.,Closed,Specific,Closure,Overrides normal Friday open range.
2026-06-06-013,2026-06-06,2026-06-06,,,True,Closed,Bourbonnais,Closure,Closed.,Closed,Specific,Closure,
2026-06-07-014,2026-06-07,2026-06-07,10:00 AM,5:00 PM,False,DSU Handgun Level 2 Block Bravo,Bourbonnais,DSU Handgun,DSU handgun level 2 bravo block.,Scheduled,Specific,Bourbonnais,
2026-06-08-047,2026-06-08,2026-06-08,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-06-09-048,2026-06-09,2026-06-09,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-10-049,2026-06-10,2026-06-10,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-11-050,2026-06-11,2026-06-11,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-12-051,2026-06-12,2026-06-12,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-06-12-052,2026-06-12,2026-06-12,5:00 PM,9:00 PM,False,Handgun Level 0 Orientation / New Member Orientation,Bourbonnais,Orientation,Handgun level 0 orientation for new members.,Scheduled,Second Friday Monthly,Bourbonnais,Corrected from earlier 1-2-3 competition.
2026-06-13-015,2026-06-13,2026-06-13,10:00 AM,5:00 PM,False,Rifle Level 0 Alpha,Bourbonnais,Rifle,Rifle level 0 alpha block.,Scheduled,Specific,Bourbonnais,Time assumed 10 AM-5 PM; confirm if different.
2026-06-14-016,2026-06-14,2026-06-14,10:00 AM,5:00 PM,False,Rifle Level 0 Bravo,Bourbonnais,Rifle,Rifle level 0 bravo block.,Scheduled,Specific,Bourbonnais,Time assumed 10 AM-5 PM; confirm if different.
2026-06-15-053,2026-06-15,2026-06-15,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-06-16-054,2026-06-16,2026-06-16,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-17-055,2026-06-17,2026-06-17,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-18-056,2026-06-18,2026-06-18,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-19-095,2026-06-19,2026-06-19,,,True,Juneteenth,Holiday,Holiday,Federal Holiday,Info,Holiday list,Holiday,
2026-06-19-057,2026-06-19,2026-06-19,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-06-19-058,2026-06-19,2026-06-19,5:00 PM,9:00 PM,False,Level 4 Rifle/Pistol Competition,Bourbonnais,Rifle/Pistol Competition,Monthly level 4 rifle/pistol competition.,Scheduled,Third Friday Monthly,Bourbonnais,
2026-06-20-018,2026-06-20,2026-06-20,9:00 AM,7:00 PM,False,16-Hour Illinois CCL - Day 1,Bourbonnais,IL CCL,"16-hour Illinois CCL course, day one.",Scheduled,Specific,Bourbonnais,User said “Thursday 9 to 7”; interpreted as first day of weekend course on June 20. Confirm.
2026-06-20-017,2026-06-20,2026-06-20,10:00 AM,5:00 PM,False,Handgun Level 1 Alpha,Bourbonnais,DSU Handgun,Handgun level 1 alpha block.,Scheduled,Specific,Bourbonnais,
2026-06-21-096,2026-06-21,2026-06-21,,,True,Father's Day,Holiday,Holiday,Observed/Informational,Info,Holiday list,Holiday,
2026-06-21-019,2026-06-21,2026-06-21,10:00 AM,4:00 PM,False,16-Hour Illinois CCL - Day 2,Bourbonnais,IL CCL,"16-hour Illinois CCL course, day two.",Scheduled,Specific,Bourbonnais,
2026-06-22-059,2026-06-22,2026-06-22,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-06-23-060,2026-06-23,2026-06-23,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-24-061,2026-06-24,2026-06-24,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-25-062,2026-06-25,2026-06-25,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-06-26-063,2026-06-26,2026-06-26,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-06-26-064,2026-06-26,2026-06-26,5:00 PM,9:00 PM,False,Handgun Levels 1-2-3 Competition,Bourbonnais,Handgun Competition,"Monthly handgun levels 1, 2, and 3 competition.",Scheduled,Fourth Friday Monthly,Bourbonnais,
2026-06-29-065,2026-06-29,2026-06-29,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-06-30-066,2026-06-30,2026-06-30,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-01-067,2026-07-01,2026-07-01,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-02-068,2026-07-02,2026-07-02,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-03-097,2026-07-03,2026-07-03,,,True,Independence Day Observed,Holiday,Holiday,Federal Holiday Observed,Info,Holiday list,Holiday,
2026-07-03-069,2026-07-03,2026-07-03,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-07-04-098,2026-07-04,2026-07-04,,,True,Independence Day,Holiday,Holiday,Federal Holiday,Info,Holiday list,Holiday,
2026-07-06-070,2026-07-06,2026-07-06,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-07-07-071,2026-07-07,2026-07-07,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-08-072,2026-07-08,2026-07-08,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-09-073,2026-07-09,2026-07-09,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-10-074,2026-07-10,2026-07-10,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-07-10-075,2026-07-10,2026-07-10,5:00 PM,9:00 PM,False,Handgun Level 0 Orientation / New Member Orientation,Bourbonnais,Orientation,Handgun level 0 orientation for new members.,Scheduled,Second Friday Monthly,Bourbonnais,Corrected from earlier 1-2-3 competition.
2026-07-13-076,2026-07-13,2026-07-13,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-07-14-077,2026-07-14,2026-07-14,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-15-078,2026-07-15,2026-07-15,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-16-079,2026-07-16,2026-07-16,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-17-080,2026-07-17,2026-07-17,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-07-17-081,2026-07-17,2026-07-17,5:00 PM,9:00 PM,False,Level 4 Rifle/Pistol Competition,Bourbonnais,Rifle/Pistol Competition,Monthly level 4 rifle/pistol competition.,Scheduled,Third Friday Monthly,Bourbonnais,
2026-07-20-082,2026-07-20,2026-07-20,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-07-21-083,2026-07-21,2026-07-21,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-22-084,2026-07-22,2026-07-22,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-23-085,2026-07-23,2026-07-23,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-24-086,2026-07-24,2026-07-24,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
2026-07-24-087,2026-07-24,2026-07-24,5:00 PM,9:00 PM,False,Handgun Levels 1-2-3 Competition,Bourbonnais,Handgun Competition,"Monthly handgun levels 1, 2, and 3 competition.",Scheduled,Fourth Friday Monthly,Bourbonnais,
2026-07-27-088,2026-07-27,2026-07-27,,,True,Closed - Monday,Bourbonnais,Closure,Bourbonnais location closed every Monday.,Closed,Every Monday,Closure,
2026-07-28-089,2026-07-28,2026-07-28,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-29-090,2026-07-29,2026-07-29,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-30-091,2026-07-30,2026-07-30,12:00 PM,8:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Tue/Wed/Thu,Bourbonnais,
2026-07-31-092,2026-07-31,2026-07-31,12:00 PM,5:00 PM,False,Members Only Open Range,Bourbonnais,Members Only Open Range,Members-only open range.,Scheduled,Every Friday,Bourbonnais,
ics-1,2026-06-24,2026-06-25,10:00 PM,1:30 AM,false,Concealed Carry Renewal,,Imported,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-2,2026-06-30,2026-07-01,11:00 PM,1:30 AM,false,OPE Event,,Imported,,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-3,2026-07-13,2026-07-14,10:00 PM,1:30 AM,false,Concealed Carry Renewal,,Imported,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-4,2026-06-07,2026-06-07,3:00 PM,9:00 PM,false,16-Hour Concealed Carry Course — Day 2,,Imported,Day 2 of 2. Sunday session: 10:00 AM–4:00 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-5,2026-07-22,2026-07-23,10:00 PM,1:30 AM,false,Concealed Carry Renewal,,Imported,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-6,2026-06-15,2026-06-16,10:00 PM,1:30 AM,false,Concealed Carry Renewal,,Imported,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-7,2026-07-08,2026-07-09,10:00 PM,1:30 AM,false,Concealed Carry Renewal,,Imported,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-8,2026-06-01,2026-06-02,10:00 PM,1:30 AM,false,Concealed Carry Renewal,,Imported,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-9,2026-07-27,2026-07-28,10:00 PM,1:30 AM,false,Concealed Carry Renewal,,Imported,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-10,2026-07-18,2026-07-19,2:00 PM,12:00 AM,false,16-Hour Concealed Carry Course — Day 1,,Imported,Day 1 of 2. Saturday session: 9:00 AM–7:00 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-11,2026-07-19,2026-07-19,3:00 PM,9:00 PM,false,16-Hour Concealed Carry Course — Day 2,,Imported,Day 2 of 2. Sunday session: 10:00 AM–4:00 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-12,2026-06-29,2026-06-30,10:00 PM,1:30 AM,false,Concealed Carry Renewal,,Imported,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-13,2026-06-06,2026-06-07,2:00 PM,12:00 AM,false,16-Hour Concealed Carry Course — Day 1,,Imported,Day 1 of 2. Saturday session: 9:00 AM–7:00 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-14,2026-06-10,2026-06-11,10:00 PM,1:30 AM,false,Concealed Carry Renewal,,Imported,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-15,2026-06-13,2026-06-13,3:00 PM,8:00 PM,false,Lethal U Group Shoot,,Imported,,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-16,2026-06-13,2026-06-13,10:00 AM,4:00 PM,false,Group Shoot Event,,Imported,,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-17,2026-06-13,2026-06-13,8:00 AM,10:00 AM,false,Holster Draw,,Imported,,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-18,2026-05-16,2026-05-16,8:00 AM,10:00 AM,false,Holster Draw- Frankfort,,Imported,,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-19,2026-05-02,2026-05-02,3:00 PM,8:00 PM,false,Lethal U Group Shoot,,Imported,,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-20,2026-06-08,2026-06-09,,,false,Norm 1:1 Monique Hall time?,,Imported,,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-21,2026-07-03,2026-07-04,,,false,4th of July BBQ,,Imported,,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-22,2026-05-16,2026-05-16,3:00 PM,8:00 PM,false,All LVL Group Shoot,,Imported,,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-24,2026-05-02,2026-05-02,8:00 AM,10:00 AM,false,Holster Draw -Bourbonnais,,Imported,,Scheduled,Imported ICS,General,Imported from uploaded calendar
ics-25,2026-05-02,2026-05-02,8:00 AM,10:00 AM,false,Holster Draw -Frankfort,,Imported,,Scheduled,Imported ICS,General,Imported from uploaded calendar
CSV;
?>

<main class="jm-calendar-page">
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

	<div id="top" class="calendar-main">
		<section class="calendar-section" id="training-calendar" aria-labelledby="calendar-title">
			<div class="calendar-section-inner">
				<div class="calendar-section-heading">
					<p class="calendar-eyebrow">May 1-July 31, 2026 standalone calendar</p>
					<h1 id="calendar-title">JM Training Schedule</h1>
					<p>
						This calendar is populated from the merged May-July 2026 course schedule. It includes scheduled courses,
						member open range windows, imported calendar items, closures, and holiday markers across the active JM
						Training locations.
					</p>
				</div>

				<div class="calendar-key" aria-label="Calendar location colors">
					<span class="legend-bourbonnais"><span aria-hidden="true" data-calendar-icon="pin"></span> Bourbonnais</span>
					<span class="legend-berkeley"><span aria-hidden="true" data-calendar-icon="pin"></span> Berkeley</span>
					<span class="legend-general"><span aria-hidden="true" data-calendar-icon="pin"></span> General / Imported</span>
					<span class="legend-closure"><span aria-hidden="true" data-calendar-icon="pin"></span> Closed</span>
					<span class="legend-holiday"><span aria-hidden="true" data-calendar-icon="pin"></span> Holiday</span>
				</div>

				<div class="calendar-assumptions">
					<article>
						<strong>CSV source</strong>
						<span>All visible events are parsed from the uploaded merged May-July 2026 calendar file.</span>
					</article>
					<article>
						<strong>Color key</strong>
						<span>Event colors come from the CSV color_key and location fields.</span>
					</article>
					<article>
						<strong>Closures</strong>
						<span>Closed rows render as muted full-day closure blocks.</span>
					</article>
					<article>
						<strong>Holidays</strong>
						<span>Holiday and informational rows render as lightweight markers.</span>
					</article>
					<article>
						<strong>Overlaps</strong>
						<span>Events sharing the same time window are placed side by side inside the day column.</span>
					</article>
					<article>
						<strong>Imported items</strong>
						<span>Imported calendar rows are preserved and coded as general events unless a specific color key is present.</span>
					</article>
					<article>
						<strong>Date range</strong>
						<span>Only events from May 1 through July 31, 2026 are rendered.</span>
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
	</div>
</main>

<script id="jm-calendar-csv-data" type="application/json"><?php echo wp_json_encode($jm_calendar_csv); ?></script>

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
	const calendarCsvElement = document.getElementById('jm-calendar-csv-data');
	const calendarCsv = calendarCsvElement ? JSON.parse(calendarCsvElement.textContent || '""') : '';
	const calendarStartDate = parseDate('2026-05-01');
	const calendarEndDate = parseDate('2026-07-31');

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

	function isTruthy(value) {
		return String(value || '').trim().toLowerCase() === 'true';
	}

	function slugify(value) {
		const slug = String(value || 'general').trim().toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
		return slug || 'general';
	}

	function escapeHtml(value) {
		return String(value || '').replace(/[&<>"']/g, (character) => ({
			'&': '&amp;',
			'<': '&lt;',
			'>': '&gt;',
			'"': '&quot;',
			"'": '&#039;',
		})[character]);
	}

	function normalizeTime(value) {
		const rawValue = String(value || '').trim();

		if (!rawValue) {
			return '';
		}

		const meridianMatch = rawValue.match(/^(\d{1,2}):(\d{2})\s*([AP]M)$/i);

		if (meridianMatch) {
			let hour = Number(meridianMatch[1]);
			const minute = meridianMatch[2];
			const meridian = meridianMatch[3].toUpperCase();

			if (meridian === 'PM' && hour !== 12) {
				hour += 12;
			}

			if (meridian === 'AM' && hour === 12) {
				hour = 0;
			}

			return `${String(hour).padStart(2, '0')}:${minute}`;
		}

		const hourMatch = rawValue.match(/^(\d{1,2}):(\d{2})$/);

		if (hourMatch) {
			return `${String(Number(hourMatch[1])).padStart(2, '0')}:${hourMatch[2]}`;
		}

		return '';
	}

	function minutesFromTime(time) {
		const [hour, minute] = time.split(':').map(Number);
		return (hour * 60) + minute;
	}

	function getEventRange(event) {
		const start = minutesFromTime(event.start);
		let end = minutesFromTime(event.end);

		if (end <= start) {
			end += 24 * 60;
		}

		return { start, end };
	}

	function eventStyle(event) {
		const { start, end } = getEventRange(event);
		const timelineStart = 6 * 60;
		const timelineEnd = 23 * 60;
		const usable = timelineEnd - timelineStart;
		const visibleStart = Math.min(timelineEnd, Math.max(timelineStart, start));
		const visibleEnd = Math.min(timelineEnd, Math.max(visibleStart + 30, end));
		const top = Math.max(0, ((visibleStart - timelineStart) / usable) * 100);
		const height = Math.max(event.isMarker ? 4 : 5, ((visibleEnd - visibleStart) / usable) * 100);
		const columnCount = Math.max(1, event.columnCount || 1);
		const columnIndex = Math.min(columnCount - 1, Math.max(0, event.columnIndex || 0));
		const horizontalGap = columnCount > 1 ? 3 : 0;
		const width = columnCount > 1 ? `calc(100% / ${columnCount} - ${horizontalGap}px)` : '100%';
		const left = columnCount > 1 ? `calc(${columnIndex * 100}% / ${columnCount})` : '0';

		return `top:${top}%;height:${height}%;width:${width};left:${left};`;
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

	function parseCsv(csvText) {
		const rows = [];
		let row = [];
		let field = '';
		let inQuotes = false;

		for (let index = 0; index < csvText.length; index += 1) {
			const character = csvText[index];
			const nextCharacter = csvText[index + 1];

			if (character === '"' && inQuotes && nextCharacter === '"') {
				field += '"';
				index += 1;
				continue;
			}

			if (character === '"') {
				inQuotes = !inQuotes;
				continue;
			}

			if (character === ',' && !inQuotes) {
				row.push(field);
				field = '';
				continue;
			}

			if ((character === '\n' || character === '\r') && !inQuotes) {
				if (character === '\r' && nextCharacter === '\n') {
					index += 1;
				}

				row.push(field);
				field = '';

				if (row.some((cell) => cell !== '')) {
					rows.push(row);
				}

				row = [];
				continue;
			}

			field += character;
		}

		if (field || row.length) {
			row.push(field);
			rows.push(row);
		}

		const [headers, ...dataRows] = rows;

		return dataRows.map((dataRow) => {
			return headers.reduce((eventRow, header, index) => {
				eventRow[header] = dataRow[index] || '';
				return eventRow;
			}, {});
		});
	}

	function eventDatesForRow(row) {
		const startDate = parseDate(row.start_date);
		const endDate = parseDate(row.end_date || row.start_date);
		const startTime = normalizeTime(row.start_time);
		const endTime = normalizeTime(row.end_time);
		const timedOvernight = startTime && endTime && endDate > startDate;
		const dates = [];
		const finalDate = timedOvernight ? startDate : endDate;

		for (let day = new Date(startDate); day <= finalDate; day = addDays(day, 1)) {
			if (day >= calendarStartDate && day <= calendarEndDate) {
				dates.push(new Date(day));
			}
		}

		return dates;
	}

	function eventTypeFromRow(row) {
		const status = String(row.status || '').toLowerCase();
		const category = String(row.category || '').toLowerCase();
		const colorKey = String(row.color_key || '').toLowerCase();

		if (status === 'closed' || colorKey === 'closure') {
			return 'closure';
		}

		if (colorKey === 'holiday' || category.includes('holiday') || status === 'info') {
			return 'holiday';
		}

		if (category.includes('competition')) {
			return 'competition';
		}

		if (category.includes('open range')) {
			return 'open';
		}

		if (category.includes('orientation')) {
			return 'orientation';
		}

		if (category.includes('ccl') || category.includes('concealed')) {
			return 'ccl';
		}

		if (category.includes('rifle')) {
			return 'rifle';
		}

		if (category.includes('handgun')) {
			return 'handgun';
		}

		return 'general';
	}

	function normalizeCalendarRow(row, occurrenceDate) {
		const type = eventTypeFromRow(row);
		const isClosure = type === 'closure';
		const isHoliday = type === 'holiday';
		const providedStart = normalizeTime(row.start_time);
		const providedEnd = normalizeTime(row.end_time);
		const hasProvidedTimes = Boolean(providedStart && providedEnd);
		const isUntimed = isTruthy(row.all_day) || !hasProvidedTimes || isClosure || isHoliday;
		const start = isClosure ? '06:00' : isHoliday ? '06:00' : providedStart || '09:00';
		const end = isClosure ? '23:00' : isHoliday ? '07:00' : providedEnd || '10:00';
		const location = row.location || row.color_key || 'General';
		const colorKey = row.color_key || row.location || 'General';
		const timeLabel = isClosure ? 'Closed' : isHoliday ? 'Holiday' : hasProvidedTimes ? `${formatTimeLabel(start)}-${formatTimeLabel(end)}` : 'All day';
		const details = [row.description, row.notes].filter(Boolean).join(' ');

		return {
			id: row.event_id,
			title: row.title || 'Training Event',
			location,
			start,
			end,
			type,
			status: row.status || 'Scheduled',
			statusSlug: slugify(row.status || 'scheduled'),
			category: row.category || '',
			categorySlug: slugify(row.category || 'general'),
			colorKey,
			colorKeySlug: slugify(colorKey),
			detail: details || row.category || row.recurrence_source || '',
			timeLabel,
			allDay: isUntimed,
			isMarker: isHoliday || (!hasProvidedTimes && !isClosure),
			date: formatDate(occurrenceDate),
		};
	}

	function buildEventsFromCsv(csvText) {
		const events = new Map();

		parseCsv(csvText).forEach((row) => {
			eventDatesForRow(row).forEach((date) => {
				addEvent(events, date, normalizeCalendarRow(row, date));
			});
		});

		return events;
	}

	function layoutDayEvents(dayEvents) {
		const sortedEvents = dayEvents.map((event, originalIndex) => ({
			...event,
			originalIndex,
			startMinutes: getEventRange(event).start,
			endMinutes: getEventRange(event).end,
			columnIndex: 0,
			columnCount: 1,
		})).sort((first, second) => {
			if (first.startMinutes !== second.startMinutes) {
				return first.startMinutes - second.startMinutes;
			}

			if (first.endMinutes !== second.endMinutes) {
				return first.endMinutes - second.endMinutes;
			}

			return first.originalIndex - second.originalIndex;
		});
		const laidOutEvents = [];
		let overlapGroup = [];
		let overlapGroupEnd = -1;

		sortedEvents.forEach((event) => {
			if (overlapGroup.length && event.startMinutes >= overlapGroupEnd) {
				laidOutEvents.push(...assignOverlapColumns(overlapGroup));
				overlapGroup = [event];
				overlapGroupEnd = event.endMinutes;
				return;
			}

			overlapGroup.push(event);
			overlapGroupEnd = Math.max(overlapGroupEnd, event.endMinutes);
		});

		if (overlapGroup.length) {
			laidOutEvents.push(...assignOverlapColumns(overlapGroup));
		}

		return laidOutEvents.sort((first, second) => {
			if (first.startMinutes !== second.startMinutes) {
				return first.startMinutes - second.startMinutes;
			}

			return first.originalIndex - second.originalIndex;
		}).map((event) => {
			const { startMinutes, endMinutes, originalIndex, ...renderableEvent } = event;
			return renderableEvent;
		});
	}

	function assignOverlapColumns(overlapGroup) {
		const activeColumns = [];

		overlapGroup.forEach((event) => {
			let assignedColumn = activeColumns.findIndex((activeEvent) => {
				return !activeEvent || activeEvent.endMinutes <= event.startMinutes;
			});

			if (assignedColumn === -1) {
				assignedColumn = activeColumns.length;
			}

			event.columnIndex = assignedColumn;
			activeColumns[assignedColumn] = event;
		});

		const columnCount = Math.max(1, activeColumns.length);

		return overlapGroup.map((event) => ({
			...event,
			columnCount,
		}));
	}

	function buildTrainingCalendar(root) {
		const events = buildEventsFromCsv(calendarCsv);
		const endDate = calendarEndDate;

		const months = [4, 5, 6];
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
			const dayEvents = date && !outsideRange ? layoutDayEvents(events.get(key) || []) : [];
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
		const locationClass = `location-${event.colorKeySlug}`;
		const colorClass = `color-${event.colorKeySlug}`;
		const typeClass = `event-${event.type}`;
		const statusClass = `status-${event.statusSlug}`;
		const markerClass = event.isMarker ? 'is-marker' : '';
		const allDayClass = event.allDay ? 'is-all-day' : '';
		const eventClasses = ['calendar-event', locationClass, colorClass, typeClass, statusClass, markerClass, allDayClass].filter(Boolean).join(' ');
		const title = escapeHtml(event.title);
		const location = escapeHtml(event.location);
		const timeLabel = escapeHtml(event.timeLabel);
		const detail = escapeHtml(event.detail);

		return `
			<button class="${eventClasses}" style="${eventStyle(event)}" type="button">
				<span class="event-time">${timeLabel}</span>
				<strong>${title}</strong>
				<small>${location}</small>
				<span class="event-detail">
					<strong>${title}</strong>
					<em>${location} | ${timeLabel}</em>
					${detail ? `<span>${detail}</span>` : ''}
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
