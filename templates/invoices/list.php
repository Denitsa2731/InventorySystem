<div class="col-md-8">
    <a href="invoice_create" class="btn btn-primary">Create</a>
    <table class="table table-hover" id="data-table">
        <thead>
        <tr>
            <td>Name</td>
            <td>Number</td>
            <td>Date</td>
            <td>Email</td>
            <td>Address</td>
            <td>Creation Date</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($arguments['invoices'] as $row) { ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['number']; ?></td>
                <td><?= $row['date']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['address']; ?></td>
                <td><?= $row['creation_date']; ?></td>


                <td>

                    <a href="invoice_delete?id=<?= $row['id']; ?>" class="badge badge-danger p-2">Delete</a>
                    <!--                            <a href="InvoiceController.php?delete=--><?//= $row['id']; ?><!--" class="badge badge-danger p-2">Delete</a>-->
                    <a href="invoice_update?id=<?= $row['id']; ?>" class="badge badge-success p-2" >Edit</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>


</body>



</html>