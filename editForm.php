<form id="editForm">
    <!-- Edit form fields go here, pre-populated with data from $record -->
    <div class="mb-2">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $record['name']; ?>" class="form-control">
    </div>

    <div class="mb-2">
        <label for="image">Image:</label>
        <input type="text" id="image" name="image" value="<?= $record['image']; ?>" class="form-control">
    </div>

    <div class="mb-2">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?= $record['address']; ?>" class="form-control">
    </div>

    <div class="mb-2">
        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" value="<?= $record['gender']; ?>" class="form-control">
    </div>

    <button type="button" onclick="saveEdit(<?= $record['id']; ?>)" class="btn btn-sm btn-primary">Save</button>
</form>