<?php
// Below is dummy data for the application
$data = [
    [
        'id' => 1,
        'name' => 'Tester',
        'image' => 'Default.jpg',
        'address' => 'Test Address',
        'gender' => 'Male',
    ],
    [
        'id' => 2,
        'name' => 'Tester Two',
        'image' => 'test 2.jpg',
        'address' => 'Test Address 2',
        'gender' => 'Female',
    ],
    [
        'id' => 3,
        'name' => 'Tester Three',
        'image' => 'test 3.jpg',
        'address' => 'Test Address 3',
        'gender' => 'Male',
    ],
    [
        'id' => 4,
        'name' => 'Tester Four',
        'image' => 'test 4.jpg',
        'address' => 'Test Address 4',
        'gender' => 'Female',
    ],
    [
        'id' => 5,
        'name' => 'Tester Five',
        'image' => 'test 5.jpg',
        'address' => 'Test Address 5',
        'gender' => 'Male',
    ],
    [
        'id' => 6,
        'name' => 'Tester Six',
        'image' => 'test 6.jpg',
        'address' => 'Test Address 6',
        'gender' => 'Female',
    ],
    [
        'id' => 7,
        'name' => 'Tester Seven',
        'image' => 'test 7.jpg',
        'address' => 'Test Address 7',
        'gender' => 'Male',
    ],
    [
        'id' => 8,
        'name' => 'Tester Eight',
        'image' => 'test 8.jpg',
        'address' => 'Test Address 8',
        'gender' => 'Female',
    ],
    [
        'id' => 9,
        'name' => 'Tester Nine',
        'image' => 'test 9.jpg',
        'address' => 'Test Address 9',
        'gender' => 'Male',
    ],
    [
        'id' => 10,
        'name' => 'Tester Ten',
        'image' => 'test 10.jpg',
        'address' => 'Test Address 10',
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