<?php

/* 
 * view partial that loops through date array and displays calendar table
 */

//build table content
$table = "<table>";
$table .= "<tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr>";
$day = 0;
for($c=0; $c < count($view->cal); $c++) {
    if ($day === 0) {
        $table .= "<tr>";
    }
    $table .= "<td class=" . $view->cal[$c]['type'] . ">" . $view->cal[$c]['date'] . "</td>";
    if ($day === 6) {
        $table .= "</tr>";
        $day = 0;
    } else {
        $day++;
    }
}
$table .= "</table><div class='clear'></div>";

echo $table; //display table content

