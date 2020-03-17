<?php require_once "web/header.php"; ?>
    <div style="text-align: right; margin: 20px 0px 10px;">
        <a id="btnAddAction" href="index.php?action=car-add"><img src="web/image/icon-add.png" />Add Car</a>
    </div>
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th><strong>Car Name</strong></th>
                    <th><strong>Car Built</strong></th>
					<th><strong>Car Charge </strong></th>
                    <th><strong>Action</strong></th>

                </tr>
            </thead>
            <tbody>
                    <?php
                    if (! empty($result)) {
                        foreach ($result as $k => $v) {
                            ?>
          <tr>
                    <td><?php echo $result[$k]["car_name"]; ?></td>
                    <td><?php echo $result[$k]["car_built"]; ?></td>
					<td><?php echo $result[$k]["charge"]; ?></td>
                    <td><a class="btnEditAction"
                        href="index.php?action=car-edit&id=<?php echo $result[$k]["car_id"]; ?>">
                        <img src="web/image/icon-edit.png" />
                        </a>
                        <a class="btnDeleteAction" 
                        href="index.php?action=car-delete&id=<?php echo $result[$k]["car_id"]; ?>">
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