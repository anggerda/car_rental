<?php require_once "web/header.php"; ?>
    <div style="text-align: right; margin: 20px 0px 10px;">
        <a id="btnAddAction" href="index.php?action=order-add"><img src="web/image/icon-add.png" />Add Order</a>
    </div>
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1" class="order_table">
            <thead>
                <tr>
                    <th><strong>Date</strong></th>
					<th><strong>Subtotal</strong></th>
					<th><strong>Total Discount</strong></th>
					<th><strong>Total</strong></th>
                    <th><strong>Action</strong></th>

                </tr>
            </thead>
            <tbody>
                    <?php
                    if (! empty($result)) {
                        foreach ($result as $k => $v) {
                            ?>
          <tr>
					<td><?php 
                    $order_date = "";
                    if(!empty($result[$k]["order_date"])) {
                        $order_date = strtotime($result[$k]["order_date"]);
                        $order_date = date("m-d-Y", $order_date);
                    }
                    echo $order_date; ?></td>
                    <td><?php echo $result[$k]["subtotal"]; ?></td>
					<td><?php echo (float) $result[$k]["discount1"]+(float) $result[$k]["discount2"]+(float) $result[$k]["discount3"]; ?></td>
					<td><?php echo $result[$k]["total"]; ?></td>
                    <td><a class="btnEditAction"
                        href="index.php?action=order-edit&date=<?php echo $result[$k]["order_id"]; ?>">
                        <img src="web/image/icon-edit.png" />
                        </a>
                        <a class="btnDeleteAction" 
                        href="index.php?action=order-delete&date=<?php echo $result[$k]["order_id"]; ?>">
                        <img src="web/image/icon-delete.png" />
                        </a>
                    </td>
                </tr>
                    <?php
                        }
                    }
                    ?>
                
            
            
            <tbody>
        
        </table>
    </div>
</body>
</html>