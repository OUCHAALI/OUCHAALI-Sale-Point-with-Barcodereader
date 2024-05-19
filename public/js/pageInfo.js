window.addEventListener('load', function () {
    const xhrPrevious = new XMLHttpRequest();
    xhrPrevious.open('GET', '../model/getPreviousOrders.php', true);
    xhrPrevious.onload = function () {
        if (xhrPrevious.status === 200) {
            const data = JSON.parse(xhrPrevious.responseText);
            populatePreviousOrdersTable(data); // Function to populate the previous orders table
        } else {
            console.error('Request failed. Status:', xhrPrevious.status);
        }
    };
    xhrPrevious.send();
});



function populatePreviousOrdersTable(data) {
    const tableBody = document.getElementById('previousOrders').getElementsByTagName('tbody')[0];

    // Clear existing table rows
    tableBody.innerHTML = '';

    // Check if data is an array
    if (Array.isArray(data)) {
        // Iterate through the data and populate the table
        data.forEach(function (rowData) {
            const row = document.createElement('tr');

            // Create and populate cells
            const productIdCell = document.createElement('td');
            productIdCell.textContent = rowData.ProductID;

            const productNameCell = document.createElement('td');
            productNameCell.textContent = rowData.ProductName;

            const priceCell = document.createElement('td');
            priceCell.textContent = rowData.ProductPrice;

            const quantityCell = document.createElement('td');
            quantityCell.textContent = rowData.Quantity;

            // Append cells to the row
            row.appendChild(productIdCell);
            row.appendChild(productNameCell);
            row.appendChild(priceCell);
            row.appendChild(quantityCell);

            // Append row to the table body
            tableBody.appendChild(row);
        });
    } else {
        // If data is not an array, log an error
        console.error('Data is not in the expected format.');
    }
}









document.addEventListener('DOMContentLoaded', function () {
    // Make AJAX request when the page is loaded
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../model/getTodaysOrders.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            populateTable(data); // For testing purposes
        } else {
            alert("data hasn't arrived");
            console.error('Request failed. Status:', xhr.status);
        }
    };
    xhr.send();
});


function populateTable(data) {
    const tableBody = document.getElementById('todaysOrder').getElementsByTagName('tbody')[0];

    // Clear existing table rows
    tableBody.innerHTML = '';

    // Check if data is an array
    if (Array.isArray(data)) {
        // Iterate through the data and populate the table
        data.forEach(function (rowData) {
            const row = document.createElement('tr');

            // Create and populate cells
            const productIdCell = document.createElement('td');
            productIdCell.textContent = rowData.ProductID;

            const productNameCell = document.createElement('td');
            productNameCell.textContent = rowData.ProductName;

            const priceCell = document.createElement('td');
            priceCell.textContent = rowData.ProductPrice;

            const quantityCell = document.createElement('td');
            quantityCell.textContent = rowData.Quantity;

            // Append cells to the row
            row.appendChild(productIdCell);
            row.appendChild(productNameCell);
            row.appendChild(priceCell);
            row.appendChild(quantityCell);

            // Append row to the table body
            tableBody.appendChild(row);
        });
    } else {
        // If data is not an array, log an error
        console.error('Data is not in the expected format.');
    }
}

















const qrCodeLink = document.getElementById('qrCodeLink');
const homeLink = document.getElementById('homeLink');
const firstRow = document.getElementById('firstRow');

// Add event listener to QR code link
qrCodeLink.addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the default behavior of the link
    firstRow.style.display = 'block'; // Show the first row
});

// Add event listener to Home link
homeLink.addEventListener('click', function (event) {
    event.preventDefault(); // Prevent the default behavior of the link
    firstRow.style.display = 'none'; // Hide the first row
});


// Calculate and display total price
function calculateTotalPrice() {
    let totalPrice = 0;
    const rows = document.querySelectorAll('#todaysOrder tbody tr');

    rows.forEach(function (row) {
        const price = parseFloat(row.querySelector('td:nth-child(3)').textContent);
        const quantity = parseInt(row.querySelector('td:nth-child(4)').textContent);
        totalPrice += price * quantity;
    });

    document.getElementById('totalPrice').textContent = 'Total: $' + totalPrice.toFixed(2);
}

// Add event listener for changes in quantity
document.addEventListener('input', function (event) {
    if (event.target && event.target.matches('#todaysOrder tbody tr td:nth-child(4) input')) {
        calculateTotalPrice();
    }
});

// Add event listener for page load
window.addEventListener('load', function () {
    calculateTotalPrice(); // Calculate total price when the page loads
});