<table class="table table-bordered">
    <thead>
        <tr>
            <th><a href="#" data-sort="id">ID</a></th>
            <th><a href="#" data-sort="name">Name</a></th>
            <th>Image</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $item): ?>
            <tr>
                <td data-key="id"><?= $item['id']; ?></td>
                <td data-key="name"><?= $item['name']; ?></td>
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
