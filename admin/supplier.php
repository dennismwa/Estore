<div class="container-fluid">
    <div class="content">
        <div class="content-header d-flex align-items-center justify-content-between">
            <h4>Supplier List</h4>
            <button class="btn btn-primary add_btn" id="btnn"><i class="fas fa-plus-circle"></i> Add Supplier</button>
        </div>
        <div class="content-body">
            <div class="content-data mt-5">
                <table id="table_id" class="cell-border hover nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Supplier Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $serial = 1;
                            $qry = $conn->query("SELECT * FROM supplier");
                            while ($row = $qry->fetch_array()) {
                                ?>
                                    <tr>
                                        <td><?php echo $serial; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-edit" id="btnn" data-id="<?php echo $row['id']; ?>"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger btn-delete" id="btnn" data-id="<?php echo $row['id']; ?>"><i class="fas fa-trash-alt"></i></button>
                                        </td>
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