<?php

function clear($string)
{
  return htmlspecialchars($string);
}

function get(string $name)
{
  if (isset($_GET[$name]) && $_GET[$name] != '') {
    return htmlspecialchars($_GET[$name]);
  } else {
    return false;
  }
}

function post(?string $name = null)
{
  if ($name) {
    return (isset($_POST[$name]) && $_POST[$name] != '' ) ? htmlspecialchars($_POST[$name]) : false;
  } else {
    return json_decode(json_encode($_POST));
  }
  // if (isset($_GET[$name]) && $_GET[$name] != '') {
  //   return htmlspecialchars($_GET[$name]);
  // } else {
  //   return false;
  // }
}

function session(?string $name = null)
{
  if ($name) {
    return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
  } else {
    return $_SESSION;
  }
}

function submit($name): bool
{
  return isset($_POST[$name]);
}

function direct($path): void
{
  header("location: $path");
  die;
}

function isi($sting)
{
  $str = '';
  for ($i = 0; $i < 30; $i++) {
    $str .= $sting[$i];
  }

  return $str;
}

function dd($data): void
{
  echo '<pre>';
  print_r($data);
  echo '</pre>';
  die;
}

function scriptDirect(string $to, int $delay = 0): void
{
  echo "<script>
  setTimeout(() => {
    location.replace('$to');
  }, $delay);
</script>";
}

function setSuccess(string $data): void
{
  $_SESSION['success'] = $data;
}

function setError(string $data): void
{
  $_SESSION['error'] = $data;
}

function hasSuccess(): bool
{
  return isset($_SESSION['success']);
}

function hasError(): bool
{
  return isset($_SESSION['error']);
}

function success(): ?string
{
  clearFormSession();
  
  if (hasSuccess()) {
    $data = $_SESSION['success'];
    unset($_SESSION['success']);
    return $data;
  } else {
    return null;
  }
}

function error(): ?string
{
  if (hasError()) {
    $data = $_SESSION['error'];
    unset($_SESSION['error']);
    return $data;
  } else {
    return null;
  }
}

function requestMethod()
{
  return $_SERVER['REQUEST_METHOD'];
}
