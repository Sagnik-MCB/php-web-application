<?php

$sortOrder = "asc";
$data = fetchSortedData();
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
                    $item['image'] = $_FILES['image']['error'] == UPLOAD_ERR_OK ? basename($_FILES['image']['name']) : null;
                    $item['address'] = $_POST['address'];
                    $item['gender'] = $_POST['gender'];
                    break; // Stop iterating once the item is found
                }
            }

            $dataFilePath = 'data.json';

            // Save the updated $data array to a file
            file_put_contents($dataFilePath, json_encode($data));

            // Handle image upload
            if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = 'images/';
                $uploadFile = $uploadDir . basename($_FILES['image']['name']);

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    echo 'File is valid, and was successfully uploaded.';
                } else {
                    echo 'Upload failed.';
                }
            }

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

            $dataFilePath = 'data.json';
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

function fetchSortedData() {
    // Fetch and sort data based on user input (Name or ID)
    $sortKey = isset($_GET['sort']) ? $_GET['sort'] : 'id';
    $sortOrder = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'desc' : 'asc';

    $dataFilePath = 'data.json';
    $data = file_exists($dataFilePath) ? json_decode(file_get_contents($dataFilePath), true) : [];

    // Sort based on the selected key and order
    usort($data, function ($a, $b) use ($sortKey, $sortOrder) {
        // Check if $sortKey is set, otherwise set a default value
        $aValue = isset($a[$sortKey]) ? $a[$sortKey] : '';
        $bValue = isset($b[$sortKey]) ? $b[$sortKey] : '';

        if ($sortOrder === 'asc') {
            return strcmp($aValue, $bValue);
        } else {
            return strcmp($bValue, $aValue);
        }
    });

    return $data;
}
?>