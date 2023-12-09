<form id="viewForm">
    <!-- View form fields go here, pre-populated with data from $record -->

    <div class="mb-2">
        <label for="name">Name:</label>
        <span><?= $record['name']; ?></span>
    </div>

    <div class="mb-2">
        <label for="image">Image:</label>
        <img src="images/<?= $record['image']; ?>" alt="Image" class="img-thumbnail" style="width: 100px; height: 100px;" readonly>
    </div>

    <div class="mb-2">
        <label for="address">Address:</label>
        <span><?= $record['address']; ?></span>
    </div>

    <div class="mb-2">
        <label for="gender">Gender:</label>
        <span><?= $record['gender']; ?></span>
    </div>
</form>
