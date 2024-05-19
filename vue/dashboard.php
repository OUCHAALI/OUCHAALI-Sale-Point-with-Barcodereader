
<?php include 'header.php';?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php include 'toolBar.php' ?>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers" id ="clientnumber"></div>
                        <div class="cardName">Total loyal clinets</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers" id ="sales"></div>
                        <div class="cardName">Orders</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="storefront-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers" id="torders"></div>
                        <div class="cardName">today's orders</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="today-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers" id="morders">$7,842</div>
                        <div class="cardName">Month orders</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="calendar-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Recent Orders</h2>
                        <a href="#" class="btn">View All</a>
                    </div>
                    <table style="margin-top: -215px;" id="recent-orders">
                        <thead>
                            <tr>
                                <td>ProductName</td>
                                <td>Price</td>
                                <td>quantity</td>
                                <td>Date</td>
                            </tr>
                        </thead>

                        <tbody>
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

                            <tr>
                                <td>Addidas Shoes</td>
                                <td>$620</td>
                                <td>Due</td>
                                <td><span class="status inProgress">In Progress</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Recent Customers</h2>
                    </div>

                    <table id="recent-clients">
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer01.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David <br> <span>Italy</span></h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="assets/imgs/customer02.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amit <br> <span>India</span></h4>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>

document.addEventListener('DOMContentLoaded', function () {
    // Make AJAX request when the page is loaded
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../model/dashboard/getLastclients.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            recClients(data); // For testing purposes
        } else {
            alert("data hasn't arrived");
            console.error('Request failed. Status:', xhr.status);
        }
    };
    xhr.send();
});


function recClients(data) {
    const tableBody = document.getElementById('recent-clients');

    // Clear existing table rows
    tableBody.innerHTML = '';

    // Check if data is an array
    if (Array.isArray(data)) {
        // Iterate through the data and populate the table
        data.forEach(function (rowData) {
            const row = document.createElement('tr');

            // Create and populate cells
            const td1 = document.createElement('td');
            const div1 = document.createElement('div');
            div1.classList.add('imgBx');
            td1.width = '60px';
            div1.innerHTML = '<img src="../public/images/me.png" alt="">';
            td1.appendChild(div1);

            const td2 = document.createElement('td');
            const h4 = document.createElement('h6');
            h4.textContent = rowData.Name;
            const span = document.createElement('span');
            span.classList.add('text-success');
            span.textContent = rowData.Email;
            h4.appendChild(document.createElement('br'));
            h4.appendChild(span);
            td2.appendChild(h4);

            // Append cells to the row
            row.appendChild(td1);
            row.appendChild(td2);

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
    xhr.open('GET', '../model/dashboard/getLastorders.php', true);
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
    const tableBody = document.getElementById('recent-orders').getElementsByTagName('tbody')[0];

    // Clear existing table rows
    tableBody.innerHTML = '';

    // Check if data is an array
    if (Array.isArray(data)) {
        // Iterate through the data and populate the table
        data.forEach(function (rowData) {
            const row = document.createElement('tr');

            // Create and populate cells
            const productNameCell = document.createElement('td');
            productNameCell.textContent = rowData.ProductName;

            const priceCell = document.createElement('td');
            priceCell.textContent = rowData.ProductPrice;

            const quantityCell = document.createElement('td');
            quantityCell.textContent = rowData.Quantity;

            const dateCell = document.createElement('td');
            dateCell.textContent = rowData.OrderDate;

            // Append cells to the row
            row.appendChild(productNameCell);
            row.appendChild(priceCell);
            row.appendChild(quantityCell);
            row.appendChild(dateCell);

            // Append row to the table body
            tableBody.appendChild(row);
        });
    } else {
        // If data is not an array, log an error
        console.error('Data is not in the expected format.');
    }
}



    fetch('../model/dashboard/countClients.php')
        .then(response => response.json())
        .then(data => {
            // Update the card with the client count
            document.getElementById('clientnumber').textContent = data.client_count;
        })
    .catch(error => console.error('Error fetching client count:', error));

    fetch('../model/dashboard/getSales.php')
        .then(response => response.json())
        .then(data => {
            // Update the card with the client count
            document.getElementById('sales').textContent = data.count_orders;
        })
    .catch(error => console.error('Error fetching client count:', error));

    fetch('../model/dashboard/todaysOrders.php')
        .then(response => response.json())
        .then(data => {
            // Update the card with the client count
            document.getElementById('torders').textContent = data.count_today_orders;
        })
    .catch(error => console.error('Error fetching client count:', error));

    fetch('../model/dashboard/monthOrders.php')
        .then(response => response.json())
        .then(data => {
            // Update the card with the client count
            document.getElementById('morders').textContent = data.count_this_month_orders;
        })
    .catch(error => console.error('Error fetching client count:', error));
</script>



    <?php include 'footer.php';?>