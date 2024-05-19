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
                        <h2>Products</h2>
                    </div>
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <td>ProductName</td>
                                <td>Description</td>
                                <td>UnitPrice</td>
                                <td>QuantityOnHand</td>
                                <td>RecorderLevel</td>
                                <td hidden>Block</td>
                                <td hidden>Roof</td>
                                <!-- <td hidden>Block</td>
                                <td hidden>Roof</td> -->
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
                                       <td hidden><?php echo $product['roof_id'];?></td>
                                       <td hidden><?php echo $product['block_id'];?></td>
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
                    <form id="productForm" action="" method="POST">
                                <label for="productCode">Product BarCode</label>
                                <input type="text" id="productCode" name="productCode" placeholder="Enter the product code">

                                <label for="productName">Product Name</label>
                                <input type="text" id="productName" name="productName" placeholder="Enter the product name">

                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="2" placeholder="Enter the description for your product"></textarea>
                                
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" name="quantity" min="1" placeholder="Enter the quantity">

                                <label for="price">Price</label>
                                <input type="number" id="price" name="price" min="0" step="0.01" placeholder="Enter the price">
                                
                                <label for="reorderLevel">Reorder Level</label>
                                <input type="number" id="reorderLevel" name="reorderLevel" min="0" placeholder="Enter the reorder level">


                                <label for="block">Block</label>
                                <select id="block" name="block">
                                    <option value="1">Block A</option>
                                    <option value="2">Block B</option>
                                    <option value="3">Block C</option>
                                    <option value="4">Block D</option>
                                    <option value="5">Block E</option>
                                </select>

                                <label for="roof">Roof</label>
                                <select id="roof" name="roof">
                                    <option value="1">Roof 1</option>
                                    <option value="2">Roof 2</option>
                                    <option value="3">Roof 3</option>
                                    <option value="4">Roof 4</option>
                                    <option value="5">Roof 5</option>
                                </select>
                                <br/><br/>
                                <button type="button"  name="add" style="margin:20px;">Add</button>
                                <button type="button"  name="update" style="margin:20px;">update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const table = document.getElementById("example").getElementsByTagName('tbody')[0];

    table.addEventListener("click", function(event) {
        const targetRow = event.target.closest('tr');
        if (!targetRow) return; // clicked outside of a row

        const cells = targetRow.getElementsByTagName("td");
        const productName = cells[0].innerText;
        const description = cells[1].innerText;
        const unitPrice = cells[2].innerText;
        const quantityOnHand = cells[3].innerText;
        const reorderLevel = cells[4].innerText;
        const block = cells[5].innerText;
        const roof = cells[6].innerText;

        // Populate form fields with product information
        document.getElementById('productName').value = productName;
        document.getElementById('description').value = description;
        document.getElementById('quantity').value = quantityOnHand;
        document.getElementById('price').value = unitPrice;
        document.getElementById('reorderLevel').value = reorderLevel;
        document.getElementById('block').value = block;
        document.getElementById('roof').value = roof;
    });
});

    </script>
    <script src="scripts.js"></script>
    <?php include 'footer.php';?>