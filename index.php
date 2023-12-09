<?php

// Include phpScripts
include 'phpScripts.php';

// Include header
include 'header.php';
?>

<body>
    <div id="recordsContainer">
        <!-- Records will be dynamically loaded here via AJAX -->
    </div>

    <div id="editFormContainer" class="ms-5 pt-4 w-25">
        <!-- Forms will be dynamically loaded here -->
    </div>

    <script>
        let idClickedCount = 0;
        let nameClickedCount = 0;
        // Async loading for images ensuring smooth scrolling
        document.addEventListener('DOMContentLoaded', function () {
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                img.setAttribute('loading', 'lazy');
            });

            // Call AJAX to fetch records on page load
            fetchRecords();
        });

        // Function to fetch records via AJAX
        function fetchRecords() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Load table after fetch
                    document.getElementById('recordsContainer').innerHTML = xhr.responseText;
                    attachSortHandlers(); 
                }
            };
            xhr.open("GET", "phpScripts.php?action=getRecords", true);
            xhr.send();
        }

        // Function to edit record

        function editRecord(id) {
            // Perform an AJAX request to fetch the edit form
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Load the form for editing and pre-populate with data
                    loadFormHtml(xhr.responseText);
                }
            };
            xhr.open("POST", "phpScripts.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("action=loadEditForm&id=" + id);

            document.getElementById('editFormContainer').scrollIntoView({ behavior: 'smooth' });
        }

        // Function to view record
        function viewRecord(id) {
            // Perform an AJAX request to fetch the view form
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Load the form for viewing and pre-populate with data
                    loadFormHtml(xhr.responseText);
                }
            };
            xhr.open("POST", "phpScripts.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("action=loadViewForm&id=" + id);

            document.getElementById('editFormContainer').scrollIntoView({ behavior: 'smooth' });
        }

        // Function to delete record
        function deleteRecord(id) {
            // Confirm deletion with the user
            if (confirm('Are you sure you want to delete this record?')) {
                // Perform an AJAX request to delete the record
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Load the updated table after saving
                        document.getElementById('recordsContainer').innerHTML = xhr.responseText;
                    }
                };
                xhr.open("POST", "phpScripts.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("action=deleteRecord&id=" + id);
            }
        }

        function updateTableAndView(response) {
            // Update the table and view mode using the response data
            // This might involve updating the DOM directly
            document.getElementById('editFormContainer').innerHTML = response;
        }

        function loadFormHtml(formHtml) {
            document.getElementById('editFormContainer').innerHTML = formHtml;
        }

        // Function to save on edit
        function saveEdit(id) {
            // Get form data
            var formData = new FormData(document.getElementById('editForm'));

            // Append the action and record ID to the form data
            formData.append('action', 'saveEdit');
            formData.append('id', id);

            // Perform an AJAX request to save the edited data
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Load the updated table after saving
                    document.getElementById('recordsContainer').innerHTML = xhr.responseText;
                }
            };
            xhr.open("POST", "phpScripts.php", true);
            xhr.send(formData);
        }

        // Function to attach click handlers for sorting
        function attachSortHandlers() {
            const sortLinks = document.querySelectorAll('th a');
            let isAsc = true;

            sortLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    const sortKey = link.getAttribute('data-sort');

                    if (sortKey === "id") {
                        idClickedCount++;
                        isAsc = idClickedCount % 2 !== 0;
                    } else {
                        nameClickedCount++;
                        isAsc = nameClickedCount % 2 !== 0;
                    }
                    
                    const sortOrder = isAsc ? 'desc' : 'asc'; // Toggle between asc and desc
                    sortTable(link, sortKey, sortOrder);
                });
            });
        }

        // Function to sort the table
        function sortTable(link, sortKey, sortOrder) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('recordsContainer').innerHTML = xhr.responseText;
                    attachSortHandlers();
                }
            };
            xhr.open("GET", "phpScripts.php?action=getRecords&sort=" + sortKey + "&order=" + sortOrder, true);
            xhr.send();
        }
    </script>
</body>
</html>