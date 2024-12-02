<?php

function dd(mixed $value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}


function convertDate($dateString)
{

    if ($dateString && $dateString != null) {
        $date = new DateTime($dateString);
        $formattedDate = $date->format('F j, Y'); // Outputs: October 23, 2024
        echo $formattedDate;
    }
}

function convertTime($timeString)
{
    if ($timeString) {
        $formatted_time = date("g:i A", strtotime($timeString));
        // $timeString = "23:47:50"; // Example time string
        // $time = new DateTime($timeString);
        // $formattedTime = $time->format('g:i A'); // Outputs: 11:47 PM
        echo $formatted_time;
    } else {
        echo "Time not provided.";
    }
}
