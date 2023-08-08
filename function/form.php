<?php 
function old(string $name, ?string $value = null)
{
	// value set in validation.php, function validate()
	if (isset($_SESSION['form'][$name])) return ($_SESSION['form'][$name]);
	if($value != null) return $value;
	return null;
}

function clearFormSession(): void
{
	unset($_SESSION['form']);
}