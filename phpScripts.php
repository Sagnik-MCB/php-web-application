<?php
// Below is dummy data for the application
$data = [
    [
        'id' => 1,
        'name' => 'Tester',
        'image' => 'test.jpg',
        'address' => 'Test Address',
        'gender' => 'Male',
    ],
    [
        'id' => 2,
        'name' => 'Tester Two',
        'image' => 'test2.jpg',
        'address' => 'Test Address 2',
        'gender' => 'Female',
    ],
    // Add more data as needed
];

// Function to toggle sorting order
function toggleOrder($currentOrder)
{
    return $currentOrder === 'asc' ? 'desc' : 'asc';
}

// Sorting data by ID
$sortOrderByID = 'asc'; // Default sorting order
if (isset($_GET['sort']) && $_GET['sort'] === 'id') {
    $sortOrderByID = toggleOrder($_GET['order']);
    if ($sortOrderByID === 'asc') {
        // Sort in ascending order
        usort($data, function ($a, $b) {
            return $a['id'] - $b['id'];
        });
    } else {
        // Sort in descending order
        usort($data, function ($a, $b) {
            return $b['id'] - $a['id'];
        });
    }
}

// Sorting data by Name
$sortOrderByName = 'asc'; // Default sorting order
if (isset($_GET['sort']) && $_GET['sort'] === 'name') {
    $sortOrderByName = toggleOrder($_GET['order']);
    if ($sortOrderByName === 'asc') {
        // Sort in ascending order
        usort($data, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
    } else {
        // Sort in descending order
        usort($data, function ($a, $b) {
            return strcmp($b['name'], $a['name']);
        });
    }
}
?>