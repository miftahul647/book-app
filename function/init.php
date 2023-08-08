<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

require_once 'db.php';
require_once 'array.php';
require_once 'Request.php';
require_once 'helper.php';
require_once 'query.php';
require_once 'validation.php';
require_once 'File.php';
require_once 'session.php';
require_once 'date.php';
require_once "partials.php";
require_once "form.php";


function usia(string $date, string $end): int
{
  $birthDate = new DateTime($date);
  $now = new DateTime($end);

  $diff = date_diff($birthDate, $now);
  $ageInMonths = ($diff->format('%y') * 12) + $diff->format('%m');
  return $ageInMonths;
}

function compareDates($date1, $date2) {
  if ($date1 == $date2) {
    return 0;
  }

  return ($date1 < $date2) ? -1 : 1;
}
