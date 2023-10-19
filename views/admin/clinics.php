<div class="content">
    <div class="left-content">
        <div class="search-container">
            <input type="text" placeholder="Search Clinic...">
            <button type="submit">Search</button>
        </div>
        <table class="table-data">
            <thead>
            <tr>
                <th>Clinic ID</th>
                <th>Name</th>
                <th>Total Mothers</th>
                <th>Total Midwives</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            <!-- Displayed rows will be added here -->
            </tbody>
        </table>
        <div class="pagination" id="pagination">
            <!-- Pagination buttons will be added here -->
        </div>
    </div>
</div>
<script>
    // Sample data - Hardcoded values
    var data = [
        { clinicID: 1, name: 'Maharagama', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 2, name: 'Nugegoda', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 2, name: 'Nugegoda', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 3, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 8, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 9, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 10, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        { clinicID: 11, name: 'Pannipitiya', totalMothers: 150, totalMidwives: 23 },
        // Add more data objects
    ];

    var itemsPerPage = 10;
    var currentPage = 1;

    function displayTableData() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;
        var tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        for (var i = startIndex; i < endIndex && i < data.length; i++) {
            var row = data[i];
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                    <td>${row.clinicID}</td>
                    <td>${row.name}</td>
                    <td>${row.totalMothers}</td>
                    <td>${row.totalMidwives}</td>
                    <td class="action-buttons">
                        <button class="action-button view-button">View</button>
                        <button class="action-button update-button">Update</button>
                        <button class="action-button remove-button">Remove</button>
                    </td>
                `;
            tableBody.appendChild(newRow);
        }
    }

    function displayPagination() {
        var totalPages = Math.ceil(data.length / itemsPerPage);
        var pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        for (var i = 1; i <= totalPages; i++) {
            var pageButton = document.createElement('button');
            pageButton.className = 'page-button';
            pageButton.textContent = i;
            pageButton.addEventListener('click', function () {
                currentPage = parseInt(this.textContent);
                displayTableData();
                displayPagination();
            });
            pagination.appendChild(pageButton);
        }
    }

    displayTableData();
    displayPagination();
</script>

