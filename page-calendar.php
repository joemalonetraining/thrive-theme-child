<?php
/**
 * Template Name: JM Training Calendar
 * Template Post Type: page
 */

get_header();

$jm_calendar_images_uri = get_stylesheet_directory_uri() . '/assets/images';
$jm_calendar_home_url = function_exists('jm_training_primary_landing_url') ? jm_training_primary_landing_url() : '#top';
$jm_calendar_csv = <<<'CSV'
event_id,start_date,end_date,start_time,end_time,all_day,title,location,category,description,status,recurrence_source,color_key,notes
frankfort-ics-001,2026-05-23,2026-05-23,,,True,ALL RANGES CLOSED FOR MRF SET UP,Frankfort,Closure,,Closed,Frankfort ICS,Frankfort,Imported from uploaded ICS calendar
frankfort-ics-002,2026-05-24,2026-05-24,,,True,MRF Charity Event,Frankfort,Frankfort Training,,Scheduled,Frankfort ICS,Frankfort,Imported from uploaded ICS calendar
bourbonnais-ics-003,2026-05-25,2026-05-25,,,True,BOURBONNAIS CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-004,2026-05-26,2026-05-26,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-005,2026-05-27,2026-05-27,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-006,2026-05-27,2026-05-27,5:00 PM,8:30 PM,False,3hr CCL Class,Alsip,Concealed Carry Class,,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-007,2026-05-28,2026-05-28,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-008,2026-05-29,2026-05-29,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-009,2026-05-29,2026-05-29,5:30 PM,9:30 PM,False,Members Competition,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-010,2026-05-30,2026-05-30,,,True,CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-011,2026-05-30,2026-05-30,9:00 AM,7:00 PM,False,16-Hour Concealed Carry Course — Day 1,Alsip,Concealed Carry Class,Day 1 of 2. Saturday session: 9:00 AM–7:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
alsip-ics-012,2026-05-31,2026-05-31,10:00 AM,4:00 PM,False,16-Hour Concealed Carry Course — Day 2,Alsip,Concealed Carry Class,Day 2 of 2. Sunday session: 10:00 AM–4:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-013,2026-05-31,2026-05-31,10:00 AM,5:00 PM,False,H1-B,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-014,2026-06-01,2026-06-01,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-015,2026-06-01,2026-06-01,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-016,2026-06-02,2026-06-02,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-017,2026-06-02,2026-06-02,5:00 PM,8:00 PM,False,Gun Clean & Gear Check,Bourbonnais,Bourbonnais Member Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-018,2026-06-03,2026-06-03,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-019,2026-06-04,2026-06-04,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-020,2026-06-04,2026-06-04,5:30 PM,8:30 PM,False,Tactical Trauma Medical Care- TQ,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-021,2026-06-05,2026-06-05,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-022,2026-06-05,2026-06-05,5:30 PM,9:30 PM,False,Members Competition,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-023,2026-06-06,2026-06-06,,,True,BOURBONNAIS CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-024,2026-06-07,2026-06-07,10:00 AM,5:00 PM,False,R1-A,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
frankfort-ics-025,2026-06-08,2026-06-08,,,True,FRANKFORT CLOSED 1-1 SESSION,Frankfort,Closure,NORM & Monique Hall 1-1,Closed,Frankfort ICS,Frankfort,Imported from uploaded ICS calendar
bourbonnais-ics-026,2026-06-08,2026-06-08,7:00 AM,6:30 PM,False,Range Closed for Private Training Session,Bourbonnais,Closure,D-Cali,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-027,2026-06-09,2026-06-09,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-028,2026-06-09,2026-06-09,6:00 PM,8:30 PM,False,OPE EVENT,Alsip,Alsip Training,,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-029,2026-06-10,2026-06-10,12:00 PM,4:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-030,2026-06-10,2026-06-10,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Bourbonnais,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-031,2026-06-11,2026-06-11,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-032,2026-06-12,2026-06-12,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-033,2026-06-12,2026-06-12,5:00 PM,9:30 PM,False,H-0 Orientation/ Fun Night,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-034,2026-06-12,2026-06-12,6:00 PM,8:30 PM,False,OPE,Alsip,Alsip Training,,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
frankfort-ics-035,2026-06-13,2026-06-13,8:00 AM,10:00 AM,False,Holster Draw,Frankfort,Frankfort Training,,Scheduled,Frankfort ICS,Frankfort,Imported from uploaded ICS calendar
bourbonnais-ics-036,2026-06-13,2026-06-13,9:00 AM,7:00 PM,False,16-Hour Concealed Carry Course — Day 1,Bourbonnais,Concealed Carry Class,Day 1 of 2. Saturday session: 9:00 AM–7:00 PM.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
frankfort-ics-037,2026-06-13,2026-06-13,10:00 AM,3:00 PM,False,Lethal U Group Shoot,Frankfort,Frankfort Group Event,,Scheduled,Frankfort ICS,Frankfort,Imported from uploaded ICS calendar
bourbonnais-ics-038,2026-06-14,2026-06-14,10:00 AM,4:00 PM,False,16-Hour Concealed Carry Course — Day 2,Bourbonnais,Concealed Carry Class,Day 2 of 2. Sunday session: 10:00 AM–4:00 PM.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-039,2026-06-15,2026-06-15,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-040,2026-06-15,2026-06-15,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-041,2026-06-16,2026-06-16,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-042,2026-06-16,2026-06-16,6:00 PM,8:30 PM,False,Should I Shoot,Alsip,Alsip Training,Should I Shoot - Educational seminar at JM Training Alsip classroom.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-043,2026-06-17,2026-06-17,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-044,2026-06-18,2026-06-18,12:00 PM,6:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-045,2026-06-18,2026-06-18,6:00 PM,9:00 PM,False,Instructor Development,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-046,2026-06-19,2026-06-19,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-047,2026-06-19,2026-06-19,5:00 PM,9:30 PM,False,Rifle Comp/Fun Night,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-048,2026-06-20,2026-06-20,8:30 AM,12:30 PM,False,H-0A,Bourbonnais,Bourbonnais Training,"830-9: safety brief
9-950: grip/holster draw/ shoot
10-1050: stoppages/ reloads
11-1230: Qual",Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-049,2026-06-21,2026-06-21,1:30 PM,5:30 PM,False,H-0B,Bourbonnais,Bourbonnais Training,"130-220: NPOA
230-320: Distance shooting
330-420: shoot & move
430-520: Qual",Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-050,2026-06-22,2026-06-22,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-051,2026-06-23,2026-06-23,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-052,2026-06-24,2026-06-24,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-053,2026-06-24,2026-06-24,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-054,2026-06-25,2026-06-25,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-055,2026-06-26,2026-06-26,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-056,2026-06-26,2026-06-26,5:00 PM,9:30 PM,False,HNDGN- 1/2/3 Comp/ Fun Night,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-057,2026-06-27,2026-06-27,8:00 AM,5:00 PM,False,R-0 A,Bourbonnais,Bourbonnais Training,JM Training R-0. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-058,2026-06-27,2026-06-27,9:00 AM,7:00 PM,False,16-Hour Concealed Carry Course — Day 1,Alsip,Concealed Carry Class,Day 1 of 2. Saturday session: 9:00 AM–7:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-059,2026-06-28,2026-06-28,8:00 AM,5:00 PM,False,R-0 B,Bourbonnais,Bourbonnais Training,JM Training R-0. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-060,2026-06-28,2026-06-28,10:00 AM,4:00 PM,False,16-Hour Concealed Carry Course — Day 2,Alsip,Concealed Carry Class,Day 2 of 2. Sunday session: 10:00 AM–4:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-061,2026-06-29,2026-06-29,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-062,2026-06-29,2026-06-29,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-063,2026-06-30,2026-06-30,,,True,Mike Sherek OES,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-064,2026-06-30,2026-06-30,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-065,2026-07-01,2026-07-01,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-066,2026-07-02,2026-07-02,12:00 PM,5:45 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-067,2026-07-02,2026-07-02,5:30 PM,8:30 PM,False,Tactical Trauma Medical Care- TQ,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-068,2026-07-02,2026-07-02,6:00 PM,9:00 PM,False,Instructor Development,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-069,2026-07-03,2026-07-03,,,True,4th of July BBQ,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-070,2026-07-03,2026-07-03,11:00 AM,7:00 PM,False,4th of July BBQ,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-071,2026-07-04,2026-07-04,,,True,CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-072,2026-07-05,2026-07-05,,,True,CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-073,2026-07-06,2026-07-06,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-074,2026-07-06,2026-07-06,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-075,2026-07-07,2026-07-07,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-076,2026-07-07,2026-07-07,5:00 PM,8:00 PM,False,Gun Clean & Gear Check,Bourbonnais,Bourbonnais Member Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-077,2026-07-08,2026-07-08,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-078,2026-07-09,2026-07-09,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-079,2026-07-10,2026-07-10,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-080,2026-07-10,2026-07-10,5:00 PM,9:30 PM,False,H-0 Orientation/ Fun Night,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-081,2026-07-11,2026-07-11,10:00 AM,7:00 PM,False,Grand Opening Event/ Competition,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-082,2026-07-12,2026-07-12,8:00 AM,5:00 PM,False,H1-A,Bourbonnais,Bourbonnais Training,JM Training H-3. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-083,2026-07-13,2026-07-13,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-084,2026-07-14,2026-07-14,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-085,2026-07-15,2026-07-15,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-086,2026-07-15,2026-07-15,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-087,2026-07-16,2026-07-16,12:00 PM,5:45 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-088,2026-07-16,2026-07-16,6:00 PM,9:00 PM,False,Instructor Development,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-089,2026-07-17,2026-07-17,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-090,2026-07-17,2026-07-17,5:00 PM,9:30 PM,False,Rifle/Pistol Comp/ Fun Night,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-091,2026-07-18,2026-07-18,8:00 AM,5:00 PM,False,H1-B,Bourbonnais,Bourbonnais Training,JM Training R-2. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-092,2026-07-18,2026-07-18,9:00 AM,7:00 PM,False,16-Hour Concealed Carry Course — Day 1,Alsip,Concealed Carry Class,Day 1 of 2. Saturday session: 9:00 AM–7:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-093,2026-07-19,2026-07-19,8:00 AM,5:00 PM,False,R1-A,Bourbonnais,Bourbonnais Training,JM Training R-3. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-094,2026-07-19,2026-07-19,10:00 AM,4:00 PM,False,16-Hour Concealed Carry Course — Day 2,Alsip,Concealed Carry Class,Day 2 of 2. Sunday session: 10:00 AM–4:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-095,2026-07-20,2026-07-20,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-096,2026-07-20,2026-07-20,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-097,2026-07-21,2026-07-21,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-098,2026-07-22,2026-07-22,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-099,2026-07-23,2026-07-23,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-100,2026-07-24,2026-07-24,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-101,2026-07-24,2026-07-24,5:00 PM,9:30 PM,False,HNDGN- 1/2/3 Comp/ Fun Night,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-102,2026-07-24,2026-07-24,5:00 PM,9:30 PM,False,HNDGN- 2/3 Comp/ Fun Night,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-103,2026-07-25,2026-07-25,8:00 AM,5:00 PM,False,R1-B,Bourbonnais,Bourbonnais Training,JM Training R/P-4. Rifle-pistol combined Level 4. Two-day course: Day 1 of 2.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-104,2026-07-26,2026-07-26,8:00 AM,5:00 PM,False,H2-A,Bourbonnais,Bourbonnais Training,JM Training R/P-4. Rifle-pistol combined Level 4. Two-day course: Day 2 of 2.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-105,2026-07-27,2026-07-27,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-106,2026-07-28,2026-07-28,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-107,2026-07-29,2026-07-29,12:00 PM,8:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-108,2026-07-29,2026-07-29,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-109,2026-07-30,2026-07-30,12:00 PM,5:45 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-110,2026-07-30,2026-07-30,6:00 PM,9:00 PM,False,Instructor Development,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-111,2026-07-31,2026-07-31,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-112,2026-07-31,2026-07-31,5:30 PM,9:30 PM,False,Members Competition,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-113,2026-08-01,2026-08-01,8:00 AM,5:00 PM,False,H2-B,Bourbonnais,Bourbonnais Training,JM Training H-0. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
frankfort-ics-114,2026-08-01,2026-08-01,8:00 AM,10:00 AM,False,Holster Draw -Bourbonnais,Frankfort,Frankfort Training,,Scheduled,Frankfort ICS,Frankfort,Imported from uploaded ICS calendar
alsip-ics-115,2026-08-01,2026-08-01,9:00 AM,7:00 PM,False,16-Hour Concealed Carry Course — Day 1,Alsip,Concealed Carry Class,Day 1 of 2. Saturday session: 9:00 AM–7:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-116,2026-08-02,2026-08-02,8:00 AM,5:00 PM,False,R2-A,Bourbonnais,Bourbonnais Training,JM Training H-0. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-117,2026-08-02,2026-08-02,10:00 AM,4:00 PM,False,16-Hour Concealed Carry Course — Day 2,Alsip,Concealed Carry Class,Day 2 of 2. Sunday session: 10:00 AM–4:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-118,2026-08-03,2026-08-03,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-119,2026-08-04,2026-08-04,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-120,2026-08-04,2026-08-04,5:00 PM,8:00 PM,False,Gun Clean & Gear Check,Bourbonnais,Bourbonnais Member Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-121,2026-08-05,2026-08-05,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-122,2026-08-05,2026-08-05,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-123,2026-08-06,2026-08-06,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-124,2026-08-07,2026-08-07,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-125,2026-08-07,2026-08-07,5:30 PM,9:30 PM,False,Members Competition,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
frankfort-ics-126,2026-08-08,2026-08-08,8:00 AM,10:00 AM,False,Holster Draw,Frankfort,Frankfort Training,,Scheduled,Frankfort ICS,Frankfort,Imported from uploaded ICS calendar
bourbonnais-ics-127,2026-08-08,2026-08-08,8:00 AM,5:00 PM,False,R2-B,Bourbonnais,Bourbonnais Training,JM Training H-1. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
frankfort-ics-128,2026-08-08,2026-08-08,10:00 AM,4:00 PM,False,Group Shoot Event,Frankfort,Frankfort Group Event,,Scheduled,Frankfort ICS,Frankfort,Imported from uploaded ICS calendar
bourbonnais-ics-129,2026-08-09,2026-08-09,8:00 AM,5:00 PM,False,H3-A,Bourbonnais,Bourbonnais Training,JM Training R-1. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-130,2026-08-10,2026-08-10,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-131,2026-08-10,2026-08-10,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-132,2026-08-11,2026-08-11,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-133,2026-08-12,2026-08-12,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-134,2026-08-13,2026-08-13,12:00 PM,5:45 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-135,2026-08-13,2026-08-13,6:00 PM,9:00 PM,False,Instructor Development,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-136,2026-08-14,2026-08-14,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-137,2026-08-14,2026-08-14,5:00 PM,9:30 PM,False,H-0 Orientation/ Fun Night,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-138,2026-08-15,2026-08-15,8:00 AM,5:00 PM,False,H3-B,Bourbonnais,Bourbonnais Training,JM Training H-2. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
frankfort-ics-139,2026-08-15,2026-08-15,8:00 AM,10:00 AM,False,Holster Draw- Bourbonnais,Frankfort,Frankfort Training,,Scheduled,Frankfort ICS,Frankfort,Imported from uploaded ICS calendar
alsip-ics-140,2026-08-15,2026-08-15,9:00 AM,7:00 PM,False,16-Hour Concealed Carry Course — Day 1,Alsip,Concealed Carry Class,Day 1 of 2. Saturday session: 9:00 AM–7:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-141,2026-08-16,2026-08-16,8:00 AM,5:00 PM,False,R3-A,Bourbonnais,Bourbonnais Training,JM Training H-3. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-142,2026-08-16,2026-08-16,10:00 AM,4:00 PM,False,16-Hour Concealed Carry Course — Day 2,Alsip,Concealed Carry Class,Day 2 of 2. Sunday session: 10:00 AM–4:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-143,2026-08-17,2026-08-17,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-144,2026-08-18,2026-08-18,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-145,2026-08-19,2026-08-19,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-146,2026-08-19,2026-08-19,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-147,2026-08-20,2026-08-20,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-148,2026-08-21,2026-08-21,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-149,2026-08-21,2026-08-21,5:00 PM,9:30 PM,False,Rifle/Pistol Comp/ Fun Night,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-150,2026-08-22,2026-08-22,8:00 AM,5:00 PM,False,R3-B,Bourbonnais,Bourbonnais Training,JM Training R-2. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-151,2026-08-23,2026-08-23,8:00 AM,5:00 PM,False,R/P 4-A,Bourbonnais,Bourbonnais Training,JM Training R-3. Full 1-day course. 9-hour training block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-152,2026-08-24,2026-08-24,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-153,2026-08-24,2026-08-24,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-154,2026-08-25,2026-08-25,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-155,2026-08-26,2026-08-26,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-156,2026-08-27,2026-08-27,12:00 PM,6:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-157,2026-08-27,2026-08-27,6:00 PM,9:00 PM,False,Instructor Development,Bourbonnais,Bourbonnais Training,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-158,2026-08-28,2026-08-28,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-159,2026-08-28,2026-08-28,5:00 PM,9:30 PM,False,HNDGN- 1/2/3 Comp/ Fun Night,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-160,2026-08-29,2026-08-29,8:00 AM,5:00 PM,False,R/P 4-B,Bourbonnais,Bourbonnais Training,JM Training R/P-4. Rifle-pistol combined Level 4. Two-day course: Day 1 of 2.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-161,2026-08-29,2026-08-29,9:00 AM,7:00 PM,False,16-Hour Concealed Carry Course — Day 1,Alsip,Concealed Carry Class,Day 1 of 2. Saturday session: 9:00 AM–7:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-162,2026-08-30,2026-08-30,8:00 AM,5:00 PM,False,R/P 5-A,Bourbonnais,Bourbonnais Training,JM Training R/P-4. Rifle-pistol combined Level 4. Two-day course: Day 2 of 2.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-163,2026-08-30,2026-08-30,10:00 AM,4:00 PM,False,16-Hour Concealed Carry Course — Day 2,Alsip,Concealed Carry Class,Day 2 of 2. Sunday session: 10:00 AM–4:00 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-164,2026-08-31,2026-08-31,,,True,Bourbonnais CLOSED,Bourbonnais,Closure,,Closed,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-165,2026-09-01,2026-09-01,12:00 PM,5:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-166,2026-09-01,2026-09-01,5:00 PM,8:00 PM,False,Gun Clean & Gear Check,Bourbonnais,Bourbonnais Member Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-167,2026-09-02,2026-09-02,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
alsip-ics-168,2026-09-02,2026-09-02,5:00 PM,8:30 PM,False,Concealed Carry Renewal,Alsip,Concealed Carry Renewal,Renewal class. Scheduled 5:00 PM–8:30 PM.,Scheduled,Alsip ICS,Alsip,Imported from uploaded ICS calendar
bourbonnais-ics-169,2026-09-03,2026-09-03,12:00 PM,8:00 PM,False,Members-Only Open Range,Bourbonnais,Bourbonnais Open Range,JM Training members-only open range block.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-170,2026-09-04,2026-09-04,12:00 PM,5:00 PM,False,Members Open Range,Bourbonnais,Bourbonnais Open Range,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
bourbonnais-ics-171,2026-09-04,2026-09-04,5:30 PM,9:30 PM,False,Members Competition,Bourbonnais,Bourbonnais Group Event,,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
frankfort-ics-172,2026-09-05,2026-09-05,8:00 AM,10:00 AM,False,Holster Draw,Frankfort,Frankfort Training,,Scheduled,Frankfort ICS,Frankfort,Imported from uploaded ICS calendar
bourbonnais-ics-173,2026-09-05,2026-09-05,8:00 AM,5:00 PM,False,R/P 5-B,Bourbonnais,Bourbonnais Training,JM Training R/P-5. Rifle-pistol Level 5. Two-day event: Day 1 of 2.,Scheduled,Bourbonnais ICS,Bourbonnais,Imported from uploaded ICS calendar
frankfort-ics-174,2026-09-05,2026-09-05,10:00 AM,4:00 PM,False,Group Shoot Event,Frankfort,Frankfort Group Event,,Scheduled,Frankfort ICS,Frankfort,Imported from uploaded ICS calendar
CSV;
?>

<main class="jm-calendar-page">
	<header class="calendar-site-header" aria-label="Calendar navigation">
		<a class="calendar-brand" href="<?php echo esc_url($jm_calendar_home_url); ?>" aria-label="JM Training home">
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
			<details class="nav-dropdown">
				<summary>Courses</summary>
				<div class="nav-dropdown-menu">
					<a href="<?php echo esc_url(home_url('/pistol-training-overview/')); ?>">Pistol</a>
					<a href="<?php echo esc_url(home_url('/rifle-training-overview/')); ?>">Rifle</a>
					<a href="<?php echo esc_url(home_url('/rifle-pistol-training-overview/')); ?>">Rifle &amp; Pistol</a>
				</div>
			</details>
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
					<p class="calendar-eyebrow">May 23-September 5, 2026 standalone calendar</p>
					<h1 id="calendar-title">JM Training Schedule</h1>
					<p>
						View scheduled classes, member range availability, special events, closures, and holiday notices across
						active JM Training locations.
					</p>
				</div>

				<div class="calendar-key" aria-label="Calendar location colors">
					<span class="legend-bourbonnais"><span aria-hidden="true" data-calendar-icon="pin"></span> Bourbonnais</span>
					<span class="legend-alsip"><span aria-hidden="true" data-calendar-icon="pin"></span> Alsip</span>
					<span class="legend-frankfort"><span aria-hidden="true" data-calendar-icon="pin"></span> Frankfort</span>
					<span class="legend-closure"><span aria-hidden="true" data-calendar-icon="pin"></span> Closed</span>
					<span class="legend-holiday"><span aria-hidden="true" data-calendar-icon="pin"></span> Holidays</span>
				</div>

				<div class="calendar-assumptions">
					<article>
						<strong>Schedule Notice</strong>
						<span>Training schedules, range availability, and special events may change. When possible, register for any class or event you plan to attend so you receive updates regarding schedule changes, cancellations, or rescheduling.</span>
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
	<div id="jm-calendar-floating-tooltip" class="calendar-floating-tooltip" data-calendar-tooltip role="tooltip" aria-hidden="true" hidden></div>
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
	const calendarTooltip = pageRoot.querySelector('[data-calendar-tooltip]');
	const calendarCsvElement = document.getElementById('jm-calendar-csv-data');
	const calendarCsv = calendarCsvElement ? JSON.parse(calendarCsvElement.textContent || '""') : '';
	const calendarStartDate = parseDate('2026-05-23');
	const calendarEndDate = parseDate('2026-09-05');
	const browserToday = startOfDay(new Date());
	const todayKey = formatDate(browserToday);
	const highlightToday = browserToday >= calendarStartDate && browserToday <= calendarEndDate;
	let activeTooltipEvent = null;

	function parseDate(value) {
		const parts = value.split('-').map(Number);
		return new Date(parts[0], parts[1] - 1, parts[2]);
	}

	function startOfDay(date) {
		return new Date(date.getFullYear(), date.getMonth(), date.getDate());
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

	function publicLocationLabel(value) {
		const normalizedValue = String(value || '').trim().toLowerCase();

		if (normalizedValue === 'berkeley') {
			return 'Alsip';
		}

		if (!normalizedValue || normalizedValue === 'general') {
			return 'Frankfort';
		}

		return String(value || '').trim() || 'Frankfort';
	}

	function publicColorKey(row, type) {
		const rawColorKey = String(row.color_key || '').trim().toLowerCase();
		const rawLocation = String(row.location || '').trim().toLowerCase();
		const sourceValue = type === 'closure' ? rawLocation || rawColorKey : rawColorKey || rawLocation;

		if (sourceValue === 'berkeley') {
			return 'Alsip';
		}

		if (!sourceValue || sourceValue === 'general') {
			return 'Frankfort';
		}

		if (sourceValue === 'holiday') {
			return 'Holiday';
		}

		if (sourceValue === 'closure') {
			return 'Closed';
		}

		return publicLocationLabel(sourceValue);
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
		const location = publicLocationLabel(row.location || row.color_key);
		const colorKey = publicColorKey(row, type);
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

		const months = [4, 5, 6, 7, 8];
		root.innerHTML = months.map((monthIndex) => renderMonth(monthIndex, events, endDate)).join('');
		root.querySelectorAll('.calendar-event').forEach((eventElement) => {
			eventElement.addEventListener('mouseenter', () => showCalendarTooltip(eventElement));
			eventElement.addEventListener('focus', () => showCalendarTooltip(eventElement));
			eventElement.addEventListener('mouseleave', () => hideCalendarTooltip());
			eventElement.addEventListener('blur', () => hideCalendarTooltip());
			eventElement.addEventListener('click', (event) => {
				event.stopPropagation();
				showCalendarTooltip(eventElement);
			});
		});

		document.addEventListener('click', (event) => {
			if (!event.target.closest('.calendar-event')) {
				hideCalendarTooltip();
			}
		});
		window.addEventListener('scroll', hideCalendarTooltip, true);
		window.addEventListener('resize', hideCalendarTooltip);
	}

	function showCalendarTooltip(eventElement) {
		if (!calendarTooltip) {
			return;
		}

		activeTooltipEvent = eventElement;
		calendarRoot.querySelectorAll('.calendar-event.is-open').forEach((openEvent) => {
			openEvent.classList.remove('is-open');
			openEvent.removeAttribute('aria-describedby');
		});
		eventElement.classList.add('is-open');
		eventElement.setAttribute('aria-describedby', 'jm-calendar-floating-tooltip');
		calendarTooltip.innerHTML = `
			<strong class="tooltip-location">${eventElement.dataset.tooltipLocation || ''}</strong>
			<span class="tooltip-title">${eventElement.dataset.tooltipTitle || ''}</span>
			<em class="tooltip-time">${eventElement.dataset.tooltipTime || ''}</em>
		`;
		calendarTooltip.hidden = false;
		calendarTooltip.setAttribute('aria-hidden', 'false');
		positionCalendarTooltip(eventElement);
	}

	function positionCalendarTooltip(eventElement) {
		if (!calendarTooltip || calendarTooltip.hidden) {
			return;
		}

		const viewportPadding = 12;
		const eventRect = eventElement.getBoundingClientRect();
		const viewportWidth = window.innerWidth;
		const viewportHeight = window.innerHeight;
		const tooltipWidth = Math.min(Math.max(eventRect.width, 170), 300, viewportWidth - (viewportPadding * 2));

		calendarTooltip.style.width = `${tooltipWidth}px`;
		calendarTooltip.style.left = '0px';
		calendarTooltip.style.top = '0px';

		const tooltipRect = calendarTooltip.getBoundingClientRect();
		let left = eventRect.left;
		let top = eventRect.bottom + 8;

		if (left + tooltipRect.width > viewportWidth - viewportPadding) {
			left = viewportWidth - viewportPadding - tooltipRect.width;
		}

		if (left < viewportPadding) {
			left = viewportPadding;
		}

		if (top + tooltipRect.height > viewportHeight - viewportPadding) {
			top = eventRect.top - tooltipRect.height - 8;
		}

		if (top < viewportPadding) {
			top = Math.max(viewportPadding, viewportHeight - viewportPadding - tooltipRect.height);
		}

		calendarTooltip.style.left = `${left}px`;
		calendarTooltip.style.top = `${top}px`;
	}

	function hideCalendarTooltip() {
		if (!calendarTooltip) {
			return;
		}

		if (activeTooltipEvent) {
			activeTooltipEvent.classList.remove('is-open');
			activeTooltipEvent.removeAttribute('aria-describedby');
		}

		activeTooltipEvent = null;
		calendarTooltip.hidden = true;
		calendarTooltip.setAttribute('aria-hidden', 'true');
		calendarTooltip.innerHTML = '';
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
			const isToday = validDay && !outsideRange && highlightToday && key === todayKey;
			const classes = [
				'calendar-day',
				!validDay || outsideRange ? 'empty-day' : '',
				dayEvents.length ? 'has-events' : 'no-events',
				isToday ? 'is-today' : '',
			].filter(Boolean).join(' ');

			cells.push(`
				<div class="${classes}">
					${validDay && !outsideRange ? `<div class="day-number">${dayNum}</div>` : ''}
					${isToday ? '<span class="today-label">Today</span>' : ''}
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

		return `
			<button class="${eventClasses}" style="${eventStyle(event)}" type="button" data-tooltip-location="${location}" data-tooltip-title="${title}" data-tooltip-time="${timeLabel}">
				<span class="event-time">${timeLabel}</span>
				<strong>${title}</strong>
				<small>${location}</small>
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
