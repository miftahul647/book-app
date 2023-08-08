<?php

function auth($role, ?string $direct = null): void
{
  if (!isset($_SESSION['login'])) {
    $to = $direct ? $direct : "login.php";
    header("location: $to");
  }
}
