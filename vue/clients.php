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
                        <h2>Clients</h2>
                    </div>
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ClientID</th>
                                <th>Client Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $clients = getClients();
                            if (!empty($clients) && is_array($clients)) {
                                foreach ($clients as $client) {
                            ?>
                                    <tr>
                                    <td><?php echo $client['ClientID']; ?></td>
                                    <td><?php echo $client['ClientName']; ?></td>
                                        <td><?php echo $client['Email']; ?></td>
                                        <td><?php echo $client['Phone']; ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='3'><h3>No Clients Found</h3></td></tr>";
                            }
                            ?>                           
                        </tbody>
                    </table>

                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                    </div>
                    <h2>Add new client</h2>
                    <form id="clientForm" action="" method="POST">
                        <label for="clientID">ClientID</label>
                        <input type="number" id="clientID" name="clientID" placeholder="ClientID" disabled>

                        <label for="clientName">Client Name</label>
                        <input type="text" id="clientName" name="clientName" placeholder="Enter the client name">

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter the client's email">

                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter the client's phone number">
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
            var clientID = document.getElementById('clientID').value;
            var clientName = document.getElementById('clientName').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;

            // Send an AJAX request to update client data
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../model/updateClient.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Handle successful update
                            alert(response.success);
                            // Optionally, you can reset the form after successful update
                            document.getElementById('clientForm').reset();
                        } else {
                            // Handle update error
                            alert(response.error);
                        }
                    } else {
                        // Handle AJAX error
                        alert('Error updating client.');
                    }
                }
            };

            // Construct the data to send
            var data = 'clientID=' + encodeURIComponent(clientID) +
                '&clientName=' + encodeURIComponent(clientName) +
                '&email=' + encodeURIComponent(email) +
                '&phone=' + encodeURIComponent(phone);

            xhr.send(data);
        });





        document.querySelector('button[name="add"]').addEventListener('click', function () {
        // Get the form input values
        var clientName = document.getElementById('clientName').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;

        // Send an AJAX request to insert client data
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../model/addClient.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Handle successful insertion
                        alert(response.success);
                        // Optionally, you can reset the form after successful insertion
                        document.getElementById('clientForm').reset();
                    } else {
                        // Handle insertion error
                        alert(response.error);
                    }
                } else {
                    // Handle AJAX error
                    alert('Error adding client.');
                }
            }
        };

        // Construct the data to send
        var data = 'clientName=' + encodeURIComponent(clientName) +
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
                const clientID = cells[0].innerText;
                const clientName = cells[1].innerText;
                const email = cells[2].innerText;
                const phone = cells[3].innerText;

                // Populate form fields with client information
                document.getElementById('clientID').value = clientID;
                document.getElementById("clientName").value = clientName;
                document.getElementById("email").value = email;
                document.getElementById("phone").value = phone;
            });
        });


    </script>

    <?php include 'footer.php';?>