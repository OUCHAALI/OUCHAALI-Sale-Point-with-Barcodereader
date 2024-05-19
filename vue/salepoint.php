
<?php
    // Get the current page filename
    $currentPage = basename($_SERVER['PHP_SELF']);
?>
<?php include 'header.php';

;?>
        <!-- ========================= Main ==================== -->
        <div class="main">
        <?php include 'toolBar.php' ?>
      

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="">
                    </div>
                    <table id="productTablee">
                        <thead>
                            <tr>
                                <th>ProductID</th>
                                <th>ProductName</th>
                                <th>ProductPrice</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <br>
                    <div class="cardHeader">
                        <h2>Recent Orders</h2>
                        <label id="total"></label>
                        <a href="#" class="btn" id="printBillLink">Print the bill</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>ProductID</td>
                                <td>ProductName</td>
                                <td>ProductPrice</td>
                                <td>Quantity</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Star Refrigerator</td>
                                <td>$1200</td>
                                <td>Paid</td>
                                <td><span class="status delivered">Delivered</span></td>
                            </tr>
                            </tr>

                            <tr>
                                <td>Addidas Shoes</td>
                                <td>$620</td>
                                <td>Due</td>
                                <td><span class="status inProgress">In Progress</span></td>
                            </tr>

                            <tr>
                                <td>Star Refrigerator</td>
                                <td>$1200</td>
                                <td>Paid</td>
                                <td><span class="status delivered">Delivered</span></td>
                            </tr>

                            <tr>
                                <td>Dell Laptop</td>
                                <td>$110</td>
                                <td>Due</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>

                            <tr>
                                <td>Apple Watch</td>
                                <td>$1200</td>
                                <td>Paid</td>
                                <td><span class="status return">Return</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Add your product</h2>
                    </div>
                    <form id="productForm" action="" method="POST">
                                <label for="productCode">Product Code</label>
                                <input type="text" id="productCode" name="productCode" placeholder="Enter the product code">
                                <input type="number" id="code" name="code" hidden>
                                <label for="productName">Product Name</label>
                                <input type="text" id="productName" name="productName" placeholder="Enter the product name" disabled>

                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="2" placeholder="Enter the description for your product" disabled></textarea>
                                
                                <label for="quantity">QuantityOnHand</label>
                                <input type="number" id="quantityOnHand" name="quantity" min="1" placeholder="Quantity On hand" disabled>

                                <label for="DesiredQuantity">DesiredQuantity</label>
                                <input type="number" id="DesiredQuantity" name="DesiredQuantity" min="0" step="1" placeholder="Enter the quantity desired">
                                
                                <label for="price">Price</label>
                                <input type="number" id="price" name="price" min="0" step="0.01" placeholder="Enter the price" disabled>
                                
                                <label for="price">Loyelty code</label>
                                <input type="number" id="lcode" name="lcode" min="0" placeholder="scan the Client QR" >
                                <label for="ClientEmail">Client Email</label>
                                <input type="text" id="clientEmail" name="clientEmail" placeholder="Email" disabled>

                                <br/><br/>
                                <button type="button"  name="add" onclick="addProduct()">Add</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
<script>

document.addEventListener('DOMContentLoaded', function() {
    // Add an event listener to the "Print Bill" link
    document.getElementById('printBillLink').addEventListener('click', function() {
        // Get the table body
        var tableBody = document.getElementById('productTablee').getElementsByTagName('tbody')[0];
        
        // Check if there are any rows in the table
        if (tableBody.rows.length > 0) {
            // Collect product IDs and quantities
            var productRows = document.querySelectorAll('#productTablee tbody tr');
            var productsToUpdate = [];
            var lcode = document.getElementById('lcode').value;
            console.log(lcode);
            productRows.forEach(function(row) {
                var productId = row.cells[0].textContent;
                var price = row.cells[2].textContent.trim(); // Ensure to trim any whitespace
                var quantity = row.cells[3].textContent;
                // Include lcode in the product object
                productsToUpdate.push({ productId: productId, lcode: lcode, price: price, quantity: quantity });
            });

            // Send AJAX request to update the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../model/updateQuantity.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle success response
                        alert('the order placed successfully!');
                        // Clear the productTablee content
                        var productTableBody = document.getElementById('productTablee').getElementsByTagName('tbody')[0];
                        productTableBody.innerHTML = '';
                        var productForm = document.getElementById('productForm');
                        // Reset the form
                        productForm.reset();
                        // Reset the total label
                        document.getElementById('total').textContent = 'Total: 0.00 DH';
                    } else {
                        // Handle error response
                        alert('Error updating product quantities.');
                    }
                }
            };
            xhr.send(JSON.stringify(productsToUpdate));
        } else {
            // If no rows, alert the user to add products to the bill
            alert("Add products to the bill first.");
        }
    });
});







    // Get references to the quantity and desired quantity input fields
    const quantityInput = document.getElementById('quantityOnHand');
     const desiredQuantityInput = document.getElementById('DesiredQuantity');
    
        // Add an event listener to the desired quantity input field
        
        desiredQuantityInput.addEventListener('input', function() {
        // Convert the values to numbers
        const quantity = parseInt(quantityInput.value, 10);
        const desiredQuantity = parseInt(desiredQuantityInput.value, 10);
        
        // Check if the desired quantity is greater than the quantity on hand
        if (desiredQuantity > quantity) {
            // If it is, alert the user and clear the input field
            alert('Desired quantity cannot exceed quantity on hand.');
            desiredQuantityInput.value = '';
        }
    });


document.addEventListener('DOMContentLoaded', function() {
    const loyaltyCodeInput = document.getElementById('lcode');
    
    // Add an event listener to listen for changes in the input value
    loyaltyCodeInput.addEventListener('change', function() {
        var xhr = new XMLHttpRequest();
        var loyaltyCodeValue = loyaltyCodeInput.value; // Get the value of the input field

        xhr.open('POST', '../model/getClient.php', true); // Specify the path to your server script
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var clientData = JSON.parse(xhr.responseText);
                    if (clientData && clientData.Email !== undefined) {
                        // Populate the form fields with the retrieved client details
                        document.getElementById('clientEmail').value = clientData.Email;
                        // Add other fields as needed
                    } else {
                        // Clear the form fields if no client is found
                        document.getElementById('clientEmail').value = '';
                        document.getElementById('lcode').value = '';
                        // Clear other fields as needed
                        alert("Client not found");
                    }
                } else {
                    // Handle AJAX error
                    alert('Error fetching client details.');
                }
            }
        };

        // Send the loyalty code value as data
        xhr.send('loyaltyCode=' + encodeURIComponent(loyaltyCodeValue));
    });
});



document.addEventListener('DOMContentLoaded', function() {
    const codeInput = document.getElementById('productCode');
    
    // Add an event listener to listen for changes in the input value
    codeInput.addEventListener('change', function() {
        var xhr = new XMLHttpRequest();
        var codeValue = codeInput.value; // Get the value of the input field

        xhr.open('POST', '../model/fetch.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var productData = JSON.parse(xhr.responseText);
                    if (productData) {
                        // Populate the form fields with the retrieved product details
                        document.getElementById('code').value = productData.ProductID;
                        document.getElementById('productName').value = productData.ProductName;
                        document.getElementById('description').value = productData.Description;
                        document.getElementById('quantityOnHand').value = productData.QuantityOnHand;
                        document.getElementById('price').value = productData.UnitPrice;
                        document.getElementById('block').value = productData.block_id;
                        document.getElementById('roof').value = productData.roof_id;
                    } else {
                        // Clear the form fields if no product is found
                        var productForm = document.getElementById('productForm');
                        // Reset the form
                        productForm.reset();
                        alert("Product not found. Please fill Add it as a new product.");
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

var totalPrice = 0;

function addProduct() {
    // Get form values
    var productCode = document.getElementById('code').value;
    var productName = document.getElementById('productName').value;
    var quantity = document.getElementById('DesiredQuantity').value;
    var price = document.getElementById('price').value;

    // Check if all fields are filled
    if (productCode && productName && quantity && price) {
        var table = document.getElementById('productTablee').getElementsByTagName('tbody')[0];
        totalPrice += parseFloat(price) * parseInt(quantity); // Corrected line

        // Create a new row
        var newRow = table.insertRow(table.rows.length);

        // Insert cells into the new row
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);

        // Assign values to cells
        cell1.innerHTML = productCode;
        cell2.innerHTML = productName;
        cell3.innerHTML = price;
        cell4.innerHTML = quantity;

        // Update total label
        document.getElementById('total').textContent = 'Total: ' + totalPrice.toFixed(2)+ ' DH';

        // Clear form fields
        var productForm = document.getElementById('productForm');
        productForm.reset();
    } else {
        alert('Please fill all fields');
    }
}


</script>


    <?php include 'footer.php';?>