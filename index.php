<?php

// Include phpScripts
include 'phpScripts.php';

// Include header
include 'header.php';
?>
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