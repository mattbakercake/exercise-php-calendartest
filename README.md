OOP Calendar Test
=================

This repository contains my solution to the following programming test:


    Write a simple application using PHP to display a calendar on a web page.

    * There should be a separate drop-down for year and month. Changing the year and
    month and submitting the form will refresh the page with the calendar displaying the dates
    for that month.
    * There should be a previous and next button which will take you to the next/previous
    month
    * The calendar should display overflow days (e.g. if the 1st is on a Wednesday, fill in the
    previous Monday and Tuesday columns with the last 2 dates of the previous month. Same
    for end of month).
    * The columns for the calendar should be Monday, Tuesday, Wednesday, Thursday, Friday,
    Saturday & Sunday in that order.
    You may add simple styling to the table, but you will not be judged on appearance of the
    page.

    The markup should be valid, semantic and accessible HTML (any variant). You should
    display experience with Object Orientated programming. The project must be compatible
    with at least version 5.3 of PHP.

Structure
---------

Root dir contains index.php that is executed by the browser.  Publicly accessible resources 
such as cascading style sheets are contained in the public dir.  The application dir contains
application resources such as classes, view partials and unit tests.