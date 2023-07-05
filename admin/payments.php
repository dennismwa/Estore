<div class="container-fluid">
    <div class="content">
        <div class="content-header d-flex align-items-center justify-content-between">
            <h4>Payments List</h4>
        </div>
        <div class="content-body">
            <div class="content-data mt-5">
                <table id="table_id" class="cell-border hover nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order No.</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                            <th>Date Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $serial = 1;
                            $qry = $conn->query("SELECT * FROM payments");
                            while ($row = $qry->fetch_array()) {
                                ?>
                                    <tr>
                                        <td><?php echo $serial; ?></td>
                                        <td><?php echo $row['order_no']; ?></td>
                                        <td><?php echo $row['payment_method']; ?></td>
                                        <td><?php echo "KES".number_format($row['amount'], 2); ?></td>
                                        <td><?php echo date("d M, Y", strtotime($row['date_paid'])); ?></td>
                                    </tr>
                                <?php

                                $serial++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $('.add_btn').click(function(){
        uni_modal("Supplier Form", "manage_supplier.php")
    })

    $('.btn-edit').click(function(){
        uni_modal("Edit Supplier", "manage_supplier.php?id="+$(this).attr('data-id'))
    })

    $('.btn-delete').click(function(){
        var conf = confirm("Do you really want to delete supplier data")
        if (conf == true) {
            $.ajax({
                url: 'ajax.php?action=delete_supplier',
                method: 'POST',
                data: {id:$(this).attr('data-id')},
                success: function(resp) {
                    if (resp == 1) {
                        alert_pop("Supplier deleted successfully", "danger")
                        setTimeout(() => {
                            location.reload()
                        }, 1500);
                    }
                }
            })
        }
    })
</script>