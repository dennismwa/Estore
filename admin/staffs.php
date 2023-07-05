<div class="container-fluid">
    <div class="content">
        <div class="content-header d-flex align-items-center justify-content-between">
            <h4>Staffs List</h4>
            <button class="btn btn-primary add_btn" id="btnn"><i class="fas fa-plus-circle"></i> Add Staff</button>
        </div>
        <div class="content-body">
            <div class="content-data mt-5">
                <table id="table_id" class="cell-border hover nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>FUll Names</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Department</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $serial = 1;
                            $qry = $conn->query("SELECT * FROM staff");
                            while ($row = $qry->fetch_array()) {
                                ?>
                                    <tr>
                                        <td><?php echo $serial; ?></td>
                                        <td><?php echo $row['names']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['department']; ?></td>
                                        <td><?php echo $row['salary']; ?></td>
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
        uni_modal("Staff Form", "manage_staff.php")
    })

    $('.btn-edit').click(function(){
        uni_modal("Edit Staff", "manage_staff.php?id="+$(this).attr('data-id'))
    })

    $('.btn-delete').click(function(){
        var conf = confirm("Do you really want to delete staff data")
        if (conf == true) {
            $.ajax({
                url: 'ajax.php?action=delete_staff',
                method: 'POST',
                data: {id:$(this).attr('data-id')},
                success: function(resp) {
                    if (resp == 1) {
                        alert_pop("Staff deleted successfully", "danger")
                        setTimeout(() => {
                            location.reload()
                        }, 1500);
                    }
                }
            })
        }
    })
</script>