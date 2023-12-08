<?php
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

// Check if sorting is requested for ID
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

// Check if sorting is requested for Name
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Web Application</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>

    <table border="1">
        <thead>
            <tr>
                <th><a href="?sort=id&order=<?= $sortOrderByID ?>">ID</a></th>
                <th><a href="?sort=name&order=<?= $sortOrderByName ?>">Name</a></th>
                <th>Image</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $item): ?>
                <tr>
                    <td><?= $item['id']; ?></td>
                    <td><?= $item['name']; ?></td>
                    <td><img src="images/<?= $item['image']; ?>" alt="Image"></td>
                    <td><?= $item['address']; ?></td>
                    <td><?= $item['gender']; ?></td>
                    <td>
                        <button>Edit</button>
                        <button>Delete</button>
                        <button>View</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>