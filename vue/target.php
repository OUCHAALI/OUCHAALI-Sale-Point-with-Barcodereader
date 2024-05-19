
<?php include 'header.php';?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php include 'toolBar.php' ?>

            <!-- ======================= Cards ================== -->
            <div class="cardBox" style="    padding: 30px;display: grid;grid-template-columns: repeat(4, 1fr);justify-items: right;">
                <div class="form-check form-check-inline">
                <input checked  id="r1" class="form-check-input" type="radio" name="inlineRadioOptions" value="option1"style="height: 36px;width: 55px;background-color: slateblue;">
                <label class="form-check-label" for="inlineRadio1">Clients comes weekly then stoped</label>
                </div>
                <div class="form-check form-check-inline">
                <input  id="r2" class="form-check-input" type="radio" name="inlineRadioOptions" value="option2"style="height: 36px;width: 55px;background-color: slateblue;">
                <label class="form-check-label" for="inlineRadio2">Clients comes monthelly then stoped</label>
                </div>
            </div>

            <div class="container mb-4">
                <div class="col" id="week" style="display: block;">
                    <div class="card-header">
                        <h2>Clients comes weekly then stopped</h2>
                    </div>
                    <table class="table table-sm" id="weekTable">
                        <thead>
                            <tr>
                                <th>Checkbox</th>
                                <th>Client ID</th>
                                <th>Client Name</th>
                                <th>Phone number</th>
                                <th>Clinet Email</th>
                                <th>lastOrder Date</th>
                            </tr>
                        </thead>
                        <tbody>

                    </tbody>
                    </table>
                </div>
                <div class="col" id="month" style="display: none;">
                    <div class="card-header">
                        <h2>Clients comes monthelly then stopped</h2>
                    </div>
                    <table class="table table-sm" id="monthTable">
                        <thead>
                            <tr>
                                <th>Checkbox</th>
                                <th>Client ID</th>
                                <th>Client Name</th>
                                <th>Phone number</th>
                                <th>Clinet Email</th>
                                <th>lastOrder Date</th>
                            </tr>
                        </thead>
                        <tbody>

                    </tbody>
                    </table>
                    </table>
                </div>
                <div class="col" style="margin-top: 50px;" id="forClinets">
                    <div class="card-header">
                        <h4>the most ordered products for these clients</h4>
                    </div>
                    <table class="table table-sm" id="pTable">
                        <thead>
                            <tr>
                                <th>Checkbox</th>
                                <th>ClientID</th>
                                <th>Client name</th>
                                <th>ProductID</th>
                                <th>ProductName</th>
                                <th>TotalQuantity Ordered</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <button style="padding: 2px;background-color: #2a2185;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Launch Modal
                </button>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Info about the pack</h5>
                            <button style="background: tomato;width: 2pc;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form id="packform" action="../model/mailing/traitment.php" method="POST">
                            <label for="email">Client Email</label>
                            <input type="text" id="email" name="email" placeholder="test@gmail.com">

                            <label for="packname">Pack</label>
                            <ol id="pack">
                            </ol>
                            <label for="price">Price before discount</label>
                            <input type="number" id="priceBefore" name="priceBefore" name="price" readonly>

                            <label for="discount">Discount</label>
                            <select id="discount" name="discount">
                                <option value="5">5 %</option>
                                <option value="10">10 %</option>
                                <option value="20">20 %</option>
                            </select>
                            <label for="price">Price after discount</label>
                            <input type="number" id="priceAfter" name="priceAfter" name="price" readonly>
                            <div class="modal-footer">
                                <button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="sendEmailBtn" class="btn btn-primary">Send the email</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

        


            


        </div>
    </div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add an event listener to the "Launch Modal" button
    var launchModalButton = document.querySelector('.btn-primary[data-target="#exampleModal"]');
    launchModalButton.addEventListener('click', function() {
        // Retrieve the values from the attachCheckboxListeners() function
        var clientId = null;
        var checkedProductIds = [];
        var totalpackprice = 0;
        var EmailAddress = null;

        var checkboxes = document.querySelectorAll('#pTable .select-checkbox');
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                var row = checkbox.closest('tr');
                if (!clientId && !EmailAddress) {
                    clientId = parseInt(row.querySelector('td:nth-child(2)').textContent.trim());
                    EmailAddress = row.querySelector('td:nth-child(8)').textContent.trim();
                }
                var productId = row.querySelector('td:nth-child(5)').textContent.trim();
                checkedProductIds.push(productId);
                totalpackprice += parseFloat(row.querySelector('td:nth-child(7)').textContent.trim());
            }
        });

        // Populate the form fields inside the modal with the retrieved values
        var emailInput = document.getElementById('email');
        var packList = document.getElementById('pack');
        var priceInput = document.getElementById('priceBefore');
        var discountSelect = document.getElementById('discount');
        var priceAfterInput = document.getElementById('priceAfter'); // Added this line

        // Add event for discount calculation
        discountSelect.addEventListener('change', function () {
            // Get the selected discount percentage
            const selectedDiscount = parseFloat(this.value);

            // Get the price before discount
            const priceBefore = parseFloat(priceInput.value);

            // Calculate the price after discount
            const discountedPrice = priceBefore - (priceBefore * (selectedDiscount / 100));

            // Update the price after discount input value
            priceAfterInput.value = discountedPrice.toFixed(2); // Round to 2 decimal places
        });

        // Assuming you want to populate email with a default value
        emailInput.value = EmailAddress; // Set the default value to an empty string
        // Populate the pack select input
        // Clear previous options
        packList.innerHTML = '';
        // Add new options based on the checkedProductIds
        checkedProductIds.forEach(function(productId) {
        var listItem = document.createElement('li');
        listItem.textContent = productId;
        packList.appendChild(listItem);
    });

        // Assuming you want to set price and discount to default values
        priceInput.value = totalpackprice;
        discountSelect.value = '5'; // Set the default value for discount
    });
});


//radio button display and block display
document.addEventListener("DOMContentLoaded", function () {
    // Get radio buttons
    var radio1 = document.getElementById("r1");
    var radio2 = document.getElementById("r2");

    // Get div containers
    var weekDiv = document.getElementById("week");
    var monthDiv = document.getElementById("month");

    // Add event listeners to radio buttons
    radio1.addEventListener("change", function () {
        if (radio1.checked) {
            weekDiv.style.display = "block";
            monthDiv.style.display = "none";
            var tableBody = document.getElementById("forClinets").getElementsByTagName("tbody")[0];
            tableBody.innerHTML = "";
        }
    });

    radio2.addEventListener("change", function () {
        if (radio2.checked) {
            weekDiv.style.display = "none";
            monthDiv.style.display = "block";
            var tableBody = document.getElementById("forClinets").getElementsByTagName("tbody")[0];
            tableBody.innerHTML = "";
        }
    });
});


//populate the table with clients with a Month of absence
document.addEventListener('DOMContentLoaded', function() {
    var xhr = new XMLHttpRequest();

    xhr.open('POST', '../model/getClinetsMonth.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var clients = JSON.parse(xhr.responseText);
                if (clients && clients.length > 0) {
                    // Populate the table with the retrieved product details
                    var tableBody = document.getElementById('monthTable').getElementsByTagName('tbody')[0];
                    // Clear existing rows
                    tableBody.innerHTML = '';
                    // Add new rows with product details
                    clients.forEach(function(client) {
                        var newRow = '<tr>';
                        newRow += '<td><input class="select-checkbox" type="radio" name="r2"></td>';
                        newRow += '<td>' + client.ClientID + '</td>';
                        newRow += '<td>' + client.ClientName + '</td>';
                        newRow += '<td>' + client.Phone + '</td>';
                        newRow += '<td>' + client.Email + '</td>';
                        newRow += '<td>' + client.LastOrderDate + '</td>';
                        newRow += '</tr>';
                        tableBody.innerHTML += newRow;
                    });

                    // Select checkboxes and attach event listener
                    var checkboxes = document.querySelectorAll('#monthTable .select-checkbox');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.addEventListener('change', function() {
                            var checkedIds = [];
                            checkboxes.forEach(function(checkbox) {
                                if (checkbox.checked) {
                                    var row = checkbox.closest('tr');
                                    var idCell = row.querySelector('td:nth-child(2)');
                                    var id = parseInt(idCell.textContent.trim(), 10);
                                    checkedIds.push(id);
                                }
                            });
                            // Send AJAX request to update the database
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '../model/getClientsProductsM.php', true);
                            xhr.setRequestHeader('Content-Type', 'application/json'); // Change content type
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        var products = JSON.parse(xhr.responseText);
                                        if (products && products.length > 0) {
                                            var tableBody = document.getElementById("pTable").getElementsByTagName("tbody")[0];
                                            tableBody.innerHTML = "";
                                            products.forEach(function(product) {
                                                var newRow = '<tr>';
                                                newRow += '<td><input class="select-checkbox" type="checkbox"></td>';
                                                newRow += '<td>' + product.ClientID + '</td>';
                                                newRow += '<td>' + product.ClientName + '</td>';
                                                newRow += '<td>' + product.ProductID + '</td>';
                                                newRow += '<td>' + product.ProductName + '</td>';
                                                newRow += '<td>' + product.TotalQuantityOrdered + '</td>';
                                                newRow += '<td hidden>' + product.UnitPrice + '</td>';
                                                newRow += '<td hidden>' + product.Email + '</td>';
                                                newRow += '</tr>';
                                                tableBody.innerHTML += newRow;
                                            });
                                            // attachCheckboxListeners();
                                        } else {
                                            var tableBody = document.getElementById("forClinets").getElementsByTagName("tbody")[0];
                                            tableBody.innerHTML = "";
                                            //lert("No products found for that client.");
                                        }
                                    } else {
                                        alert('Error fetching products.');
                                    }
                                }
                            };
                            xhr.send(JSON.stringify({ clientIDs: checkedIds })); // Send checked IDs as JSON
                        });
                    });
                } else {
                    alert('No clients found.');
                }
            } else {
                alert('Error fetching clients.');
            }
        }
    };

    xhr.send();
});



//populate the table with clients with a week of absence
document.addEventListener('DOMContentLoaded', function() {
    var xhr = new XMLHttpRequest();

    xhr.open('POST', '../model/getClinetsWeek.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var clients = JSON.parse(xhr.responseText);
                if (clients && clients.length > 0) {
                    // Populate the table with the retrieved product details
                    var tableBody = document.getElementById('weekTable').getElementsByTagName('tbody')[0];
                    // Clear existing rows
                    tableBody.innerHTML = '';
                    // Add new rows with product details
                    clients.forEach(function(client) {
                        var newRow = '<tr>';
                        newRow += '<td><input class="select-checkbox" type="radio" name="r1"></td>';
                        newRow += '<td>' + client.ClientID + '</td>';
                        newRow += '<td>' + client.ClientName + '</td>';
                        newRow += '<td>' + client.Phone + '</td>';
                        newRow += '<td>' + client.Email + '</td>';
                        newRow += '<td>' + client.LastOrderDate + '</td>';
                        newRow += '</tr>';
                        tableBody.innerHTML += newRow;
                    });

                    // Select checkboxes and attach event listener
                    var checkboxes = document.querySelectorAll('#weekTable .select-checkbox');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.addEventListener('change', function() {
                            var checkedIds = [];
                            checkboxes.forEach(function(checkbox) {
                                if (checkbox.checked) {
                                    var row = checkbox.closest('tr');
                                    var idCell = row.querySelector('td:nth-child(2)');
                                    var id = parseInt(idCell.textContent.trim(), 10);
                                    checkedIds.push(id);
                                }
                            });
                            // Send AJAX request to update the database
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '../model/getClientsProductsW.php', true);
                            xhr.setRequestHeader('Content-Type', 'application/json'); // Change content type
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        var products = JSON.parse(xhr.responseText);
                                        if (products && products.length > 0) {
                                            var tableBody = document.getElementById("pTable").getElementsByTagName("tbody")[0];
                                            tableBody.innerHTML = "";
                                            products.forEach(function(product) {
                                                var newRow = '<tr>';
                                                newRow += '<td><input class="select-checkbox" type="checkbox"></td>';
                                                newRow += '<td>' + product.ClientID + '</td>';
                                                newRow += '<td>' + product.ClientName + '</td>';
                                                newRow += '<td>' + product.ProductID + '</td>';
                                                newRow += '<td>' + product.ProductName + '</td>';
                                                newRow += '<td>' + product.TotalQuantityOrdered + '</td>';
                                                newRow += '<td hidden>' + product.UnitPrice + '</td>';
                                                newRow += '<td hidden>' + product.Email + '</td>';
                                                newRow += '</tr>';
                                                tableBody.innerHTML += newRow;
                                            });
                                            // attachCheckboxListeners();
                                        } else {
                                            var tableBody = document.getElementById("forClinets").getElementsByTagName("tbody")[0];
                                            tableBody.innerHTML = "";
                                            //lert("No products found for that client.");
                                        }
                                    } else {
                                        alert('Error fetching products.');
                                    }
                                }
                            };
                            xhr.send(JSON.stringify({ clientIDs: checkedIds })); // Send checked IDs as JSON
                        });
                    });
                } else {
                    alert('No clients found.');
                }
            } else {
                alert('Error fetching clients.');
            }
        }
    };

    xhr.send();
});


//send email button
document.getElementById('sendEmailBtn').addEventListener('click', function() {
    var xhr = new XMLHttpRequest();
    var packList = document.getElementById('pack');
    var selectedOptions = [];

    // Get selected pack items
    var packItems = packList.getElementsByTagName('li');
    for (var i = 0; i < packItems.length; i++) {
        selectedOptions.push(packItems[i].textContent);
    }

    var formData = new FormData(document.getElementById('packform'));
    formData.append('selectedPacks', JSON.stringify(selectedOptions));

    xhr.open('POST', '../model/mailing/traitment.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Request was successful, do something if needed
                alert('Email sent successfully!');
            } else {
                // Request failed, handle the error
                alert('Failed to send email');
            }
        }
    };
    xhr.send(formData);
});


</script>



    <?php include 'footer.php';?>