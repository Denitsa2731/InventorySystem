<div class="col-md-8">
    <a href="service_create" class="btn btn-primary">Create</a>
    <table class="table table-hover" id="data-table">
        <thead>
        <tr>
            <td>Name</td>
            <td>Price</td>
            <td>Date</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($arguments['services'] as $row) { ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['price']; ?></td>
                <td><?= $row['creation_date']; ?></td>
                <td>

                    <a href="service_delete?id=<?= $row['id']; ?>" class="badge badge-danger p-2">Delete</a>
                    <!--                            <a href="InvoiceController.php?delete=--><?//= $row['id']; ?><!--" class="badge badge-danger p-2">Delete</a>-->
                    <a href="service_update?id=<?= $row['id']; ?>" class="badge badge-success p-2" >Edit</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>


</body>



</html>
