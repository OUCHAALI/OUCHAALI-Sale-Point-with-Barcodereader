<?php include 'header.php';

;?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="../public/images/me.png" alt="">
                </div>
            </div>        

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="">
                        <h2>My suppliers</h2>
                    </div>
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Supplier ID</th>
                                <th>Supplier Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $Suppliers = getSuppliers();
                            if (!empty($Suppliers) && is_array($Suppliers)) {
                                foreach ($Suppliers as $supplier) {
                            ?>
                                    <tr>
                                    <td><?php echo $supplier['supplier_id']; ?></td>
                                    <td><?php echo $supplier['supplier_name']; ?></td>
                                        <td><?php echo $supplier['phone']; ?></td>
                                        <td><?php echo $supplier['email']; ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='3'><h3>No Suppliers Found</h3></td></tr>";
                            }
                            ?>                           
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                    </div>
                    <h2>Add new Supplier</h2>
                    <form id="supplierform" action="" method="POST">
                        <label for="supplierID">supplierID</label>
                        <input type="number" id="supplierID" name="supplierID" placeholder="supplierID" disabled>

                        <label for="supplierName">Supplier Name</label>
                        <input type="text" id="supplierName" name="supplierName" placeholder="Enter the supplier name">

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter the supplier email">

                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter the suppler's phone number">
                        <br><br>
                        <button type="button"  name="add" style="margin:20px;">New</button>
                        <button type="button"  name="update" style="margin:20px;">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
    document.querySelector('button[name="update"]').addEventListener('click', function () {
            // Get the form input values
            var supplierID = document.getElementById('supplierID').value;
            var supplierName = document.getElementById('supplierName').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;

            // Send an AJAX request to update supplier data
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../model/updateSupplier.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Handle successful update
                            alert(response.success);
                            // Optionally, you can reset the form after successful update
                            document.getElementById('supplierform').reset();
                        } else {
                            // Handle update error
                            alert(response.error);
                        }
                    } else {
                        // Handle AJAX error
                        alert('Error updating supplier.');
                    }
                }
            };

            // Construct the data to send
            var data = 'supplierID=' + encodeURIComponent(supplierID) +
                '&supplierName=' + encodeURIComponent(supplierName) +
                '&email=' + encodeURIComponent(email) +
                '&phone=' + encodeURIComponent(phone);

            xhr.send(data);
        });





        document.querySelector('button[name="add"]').addEventListener('click', function () {
        // Get the form input values
        var supplierName = document.getElementById('supplierName').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;

        // Send an AJAX request to insert supplier data
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../model/addSupplier.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Handle successful insertion
                        alert(response.success);
                        // Optionally, you can reset the form after successful insertion
                        document.getElementById('supplierform').reset();
                    } else {
                        // Handle insertion error
                        alert(response.error);
                    }
                } else {
                    // Handle AJAX error
                    alert('Error adding supplier.');
                }
            }
        };

        // Construct the data to send
        var data = 'supplierName=' + encodeURIComponent(supplierName) +
            '&email=' + encodeURIComponent(email) +
            '&phone=' + encodeURIComponent(phone);

        xhr.send(data);
    });




            document.addEventListener("DOMContentLoaded", function() {
            const table = document.getElementById("example").getElementsByTagName('tbody')[0];

            table.addEventListener("click", function(event) {
                const targetRow = event.target.closest('tr');
                if (!targetRow) return; // clicked outside of a row

                const cells = targetRow.getElementsByTagName("td");
                const supplierID = cells[0].innerText;
                const supplierName = cells[1].innerText;
                const email = cells[2].innerText;
                const phone = cells[3].innerText;

                // Populate form fields with supplier information
                document.getElementById('supplierID').value = supplierID;
                document.getElementById("supplierName").value = supplierName;
                document.getElementById("email").value = email;
                document.getElementById("phone").value = phone;
            });
        });


    </script>

    <?php include 'footer.php';?>