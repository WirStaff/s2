<?php

$packages = [12, 6, 3]; // DESC Количество бутылок в обратном порядке
//$packages = array_reverse([3, 6, 12]); //ASC Если хотим по возрастанию

function count_packages(int $order, array $packages): array 
{
    $result = array_fill(0, count($packages), 0);
	
	foreach ($packages as $key => $value) {
		if ($order <= 0) {
			break;
		}
		
		if ($key == count($packages) - 1) {
			$result[$key] = (int)ceil($order / $value);
		} else {
			$result[$key] = (int)floor($order / $value);
		}
		
		$order -= $value * $result[$key];
	}
	
    return $result;
}

if (isset($_GET['order'])) {
	$order = (int)$_GET['order'];
	
	$result = [
		'packages' => $packages,
		'data' 	   => count_packages($order, $packages),
	];
	
	echo json_encode($result);
}