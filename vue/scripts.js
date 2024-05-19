document.addEventListener('DOMContentLoaded', function () {
    const codeInput = document.getElementById('productCode');

    // Add an event listener to listen for changes in the input value
    codeInput.addEventListener('change', function () {
        var xhr = new XMLHttpRequest();
        var codeValue = codeInput.value; // Get the value of the input field

        xhr.open('POST', '../model/fetch.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var productData = JSON.parse(xhr.responseText);
                    if (productData) {
                        // Populate the form fields with the retrieved product details
                        document.getElementById('productName').value = productData.ProductName;
                        document.getElementById('description').value = productData.Description;
                        document.getElementById('quantity').value = productData.QuantityOnHand;
                        document.getElementById('price').value = productData.UnitPrice;
                        document.getElementById('block').value = productData.block_id;
                        document.getElementById('roof').value = productData.roof_id;
                    } else {
                        // Clear the form fields if no product is found
                        document.getElementById('productName').value = '';
                        document.getElementById('description').value = '';
                        document.getElementById('quantity').value = '';
                        document.getElementById('price').value = '';
                        document.getElementById('block').value = '';
                        document.getElementById('roof').value = '';
                        alert("Product not found. Please fill the form with the new information.");
                    }
                } else {
                    // Handle AJAX error
                    alert('Error fetching product details.');
                }
            }
        };

        // Send the code value as data
        xhr.send('code=' + encodeURIComponent(codeValue));
    });
});


document.querySelector('button[name="add"]').addEventListener('click', function () {
    // Get the form input values
    var code = document.getElementById('productCode').value;
    var productName = document.getElementById('productName').value;
    var description = document.getElementById('description').value;
    var quantity = document.getElementById('quantity').value;
    var price = document.getElementById('price').value;
    var block = document.getElementById('block').value;
    var roof = document.getElementById('roof').value;

    // Send an AJAX request to insert product data
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../model/insert.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Handle successful insertion
                    alert(response.success);
                    // Optionally, you can reset the form after successful insertion
                    document.getElementById('productForm').reset();
                } else {
                    // Handle insertion error
                    alert(response.error);
                }
            } else {
                // Handle AJAX error
                alert('Error inserting product.');
            }
        }
    };

    // Construct the data to send
    var data = 'code=' + encodeURIComponent(code) +
        '&productName=' + encodeURIComponent(productName) +
        '&description=' + encodeURIComponent(description) +
        '&quantity=' + encodeURIComponent(quantity) +
        '&price=' + encodeURIComponent(price) +
        '&block=' + encodeURIComponent(block) +
        '&roof=' + encodeURIComponent(roof);

    xhr.send(data);
});


document.querySelector('button[name="update"]').addEventListener('click', function () {
    // Get the form input values
    var code = document.getElementById('productCode').value;
    var productName = document.getElementById('productName').value;
    var description = document.getElementById('description').value;
    var quantity = document.getElementById('quantity').value;
    var price = document.getElementById('price').value;
    var block = document.getElementById('block').value;
    var roof = document.getElementById('roof').value;

    // Send an AJAX request to update product data
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../model/update.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Handle successful update
                    alert(response.success);
                    // Optionally, you can reset the form after successful update
                    document.getElementById('productForm').reset();
                } else {
                    // Handle update error
                    alert(response.error);
                }
            } else {
                // Handle AJAX error
                alert('Error updating product.');
            }
        }
    };

    // Construct the data to send
    var data = 'code=' + encodeURIComponent(code) +
        '&productName=' + encodeURIComponent(productName) +
        '&description=' + encodeURIComponent(description) +
        '&quantity=' + encodeURIComponent(quantity) +
        '&price=' + encodeURIComponent(price) +
        '&block=' + encodeURIComponent(block) +
        '&roof=' + encodeURIComponent(roof);

    xhr.send(data);
});

