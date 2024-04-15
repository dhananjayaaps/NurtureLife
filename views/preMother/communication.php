<?php
/** @var $this app\core\view */

use app\models\User;
use app\models\Mother;

$this->title = 'preMother Test';
?>
<link rel="stylesheet" href="./assets/styles/Form.css">

<link rel="stylesheet" href="./assets/styles/table.css">
<link rel="stylesheet" href="./assets/styles/mother.css">

<?php
/** @var $model User **/
?>

<div class="Midwifes content">
    <div class="shadowBox">
        <div class="left-content">
            <table class="table-data">
                <thead>
                <tr>
                    <th>Midwife Name</th>
                    <th>Email</th>
                    <th>Phone no.</th>
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
</div>

<script>
    var data = <?php echo (new Mother())->getMidwifeContact() ?>;

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
                <td>${row.firstname} ${row.lastname}</td>
                <td>${row.email}</td>
                <td>${row.contact_no}</td>
                <td class="action-buttons">
                    <button class="copy-phone-btn">Copy Phone No.</button>
                </td>
            `;
            tableBody.appendChild(newRow);
        }

        // Add event listener to copy phone number button
        var copyPhoneButtons = document.querySelectorAll('.copy-phone-btn');
        copyPhoneButtons.forEach(button => {
            button.addEventListener('click', function() {
                var phoneNo = this.parentElement.previousElementSibling.textContent;
                copyToClipboard(phoneNo);
            });
        });
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

    function copyToClipboard(text) {
        var textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        alert('Phone number copied to clipboard: ' + text);
    }

    displayTableData();
    displayPagination();
</script>
