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
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>        

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Recent Orders</h2>
                        <a href="#" class="btn">View All</a>
                    </div>

                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <td>ProductName</td>
                                <td>Description</td>
                                <td>UnitPrice</td>
                                <td>QuantityOnHand</td>
                                <td>RecorderLevel</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                           $products = getProduct();
                           if (!empty($products) && is_array($products)) {
                               foreach ($products as $product) {
                           ?>
                                   <tr>
                                       <td><?php echo $product['ProductName']; ?></td>
                                       <td><?php echo $product['Description']; ?></td>
                                       <td><?php echo $product['UnitPrice']; ?></td>
                                       <td><?php echo $product['QuantityOnHand']; ?></td>
                                       <td>
                                           <?php
                                           if ($product['ReorderLevel'] < 10) {
                                               echo "<span class='status return'>" . $product['ReorderLevel'] . "</span>";
                                           } else {
                                               echo $product['ReorderLevel'];
                                           }
                                           ?>
                                       </td>
                                   </tr>
                           <?php
                               }
                           } else {
                               echo "<tr><td colspan='5'><h3>No Products Found</h3></td></tr>";
                           }
                           ?>                           
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Add your product</h2>
                    </div>
                    <form action="../model/addProduct.php" method="POST">
                                <label for="productName">Product Name</label>
                                <input type="text" id="productName" name="productName" placeholder="Enter the product name">

                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="2" placeholder="Enter the description for your product"></textarea>
                                
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" name="quantity" min="1" placeholder="Enter the quantity">

                                <label for="price">Price</label>
                                <input type="number" id="price" name="price" min="0" step="0.01" placeholder="Enter the price">

                                <label for="block">Block</label>
                                <select id="block" name="block">
                                    <option value="1">Block A</option>
                                    <option value="2">Block B</option>
                                    <option value="3">Block C</option>
                                </select>

                                <label for="roof">Roof</label>
                                <select id="roof" name="roof">
                                    <option value="1">Roof 1</option>
                                    <option value="2">Roof 2</option>
                                    <option value="3">Roof 3</option>
                                </select><br/><br/>


                                <button type="submit">Add</button>
                                <?php
                                    if (!empty($_SESSION['message']['text'])) {
                                        ?>
                                        <div id="message" class="alert <?= $_SESSION['message']['type'] ?>">
                                            <?= $_SESSION['message']['text'] ?>
                                        </div>
                                        <script>
                                            setTimeout(function() {
                                                var messageDiv = document.getElementById('message');
                                                if (messageDiv) {
                                                    messageDiv.style.display = 'none';
                                                }
                                            }, 5000); // 5000 milliseconds = 5 seconds
                                        </script>
                                        <?php
                                        // Clear the message after displaying it
                                        unset($_SESSION['message']);
                                    }
                                    ?>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php include 'footer.php';?>
