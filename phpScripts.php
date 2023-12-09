<?php

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

// Load data from a file or set initial data
$dataFilePath = 'data.json';
$data = file_exists($dataFilePath) ? json_decode(file_get_contents($dataFilePath), true) : [];

// Handle form submissions and AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'loadEditForm') {
            $id = $_POST['id'];

            // Find the record in the data array
            $record = null;
            foreach ($data as $item) {
                if ($item['id'] == $id) {
                    $record = $item;
                    break;
                }
            }

            // Load and display the edit form
            include 'editForm.php';
            exit;
        } elseif ($_POST['action'] === 'loadViewForm') {
            $id = $_POST['id'];

            // Find the record in the data array
            $record = null;
            foreach ($data as $item) {
                if ($item['id'] == $id) {
                    $record = $item;
                    break;
                }
            }

            // Load and display the view form
            include 'viewForm.php';
            exit;
        } elseif ($_POST['action'] === 'saveEdit') {
            $id = $_POST['id'];

            // Update the $data array with the submitted values
            foreach ($data as &$item) {
                if ($item['id'] == $id) {
                    $item['name'] = $_POST['name'];
                    $item['image'] = $_POST['image'];
                    $item['address'] = $_POST['address'];
                    $item['gender'] = $_POST['gender'];
                    break; // Stop iterating once the item is found
                }
            }

            // Save the updated $data array to a file
            file_put_contents($dataFilePath, json_encode($data));

            // Respond with the updated HTML content
            echo generateTableAndView($data);
            exit;
        } elseif ($_POST['action'] === 'deleteRecord') {
            $idToDelete = $_POST['id'];

            // Find the index of the record to delete
            $indexToDelete = null;
            foreach ($data as $index => $item) {
                if ($item['id'] == $idToDelete) {
                    $indexToDelete = $index;
                    break;
                }
            }

            // Remove the record from the $data array
            if ($indexToDelete !== null) {
                array_splice($data, $indexToDelete, 1);
            }

            // Save the updated $data array to a file
            file_put_contents($dataFilePath, json_encode($data));

            // Respond with the updated HTML content
            echo generateTableAndView($data);
            exit;
        }
    }
}

// Function to generate HTML content for the table and view mode
function generateTableAndView($data) {
    ob_start(); // Start output buffering

    // Generate HTML for the table and view mode using $data
    include 'tableAndView.php';

    $output = ob_get_clean(); // Get the buffered content

    return $output;
}

// Handle AJAX request for fetching records
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getRecords') {
    echo generateTableAndView($data);
    exit;
}
?>