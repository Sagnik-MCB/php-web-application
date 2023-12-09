<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
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
                <td><img src="images/<?= $item['image']; ?>" alt="Image" class="img-thumbnail" style="width: 100px; height: 100px;"></td>
                <td><?= $item['address']; ?></td>
                <td><?= $item['gender']; ?></td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="editRecord(<?= $item['id']; ?>)">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteRecord(<?= $item['id']; ?>)">Delete</button>
                    <button class="btn btn-info btn-sm" onclick="viewRecord(<?= $item['id']; ?>)">View</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
