<?php
$data = [
    [
        'id' => 1,
        'name' => 'Tester',
        'image' => 'test.jpg',
        'address' => 'Test Address',
        'gender' => 'Male',
    ],
    // Add more data as needed
];

// Sort data based on user input (Name or ID)
if (isset($_GET['sort'])) {
    $sortKey = $_GET['sort'];
    if ($sortKey === 'name') {
        usort($data, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
    } elseif ($sortKey === 'id') {
        usort($data, function ($a, $b) {
            return $a['id'] - $b['id'];
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
                <th><a href="?sort=id">ID</a></th>
                <th><a href="?sort=name">Name</a></th>
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