<div class="container-fluid">
    <div class="content">
        <div class="content-header d-flex align-items-center justify-content-between">
            <h4>Brand List</h4>
            <button class="btn btn-primary add_btn" id="btnn"><i class="fas fa-plus-circle"></i> Add Brand</button>
        </div>
        <div class="content-body">
            <div class="content-data mt-5">
                <table id="table_id" class="cell-border hover nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Brand Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $serial = 1;
                            $qry = $conn->query("SELECT * FROM brand");
                            while ($row = $qry->fetch_array()) {
                                ?>
                                    <tr>
                                        <td><?php echo $serial; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
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
        uni_modal("Brand Form", "manage_brand.php")
    })

    $('.btn-edit').click(function(){
        uni_modal("Brand Product", "manage_brand.php?id="+$(this).attr('data-id'))
    })

    $('.btn-delete').click(function(){
        var conf = confirm("Do you really want to delete brand data")
        if (conf == true) {
            $.ajax({
                url: 'ajax.php?action=delete_brand',
                method: 'POST',
                data: {id:$(this).attr('data-id')},
                success: function(resp) {
                    if (resp == 1) {
                        alert_pop("Brand deleted successfully", "danger")
                        setTimeout(() => {
                            location.reload()
                        }, 1500);
                    }
                }
            })
        }
    })
</script>