


<div class="col-md-8">
    <table class="table table-hover" id="data-table">
        <thead>
        <tr>
            <td>Name</td>
            <td>Number</td>
            <td>Date</td>
            <td>Email</td>
            <td>Address</td>
            <td>Date</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($arguments as $row) { ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['number']; ?></td>
                <td><?= $row['date']; ?></td>
                <td><?= $row['client_email']; ?></td>
                <td><?= $row['client_address']; ?></td>
                <td><?= $row['date']; ?></td>


                <td>

                    <a href="delete.php?action=invoices&id=<?= $row['id']; ?>" class="badge badge-danger p-2">Delete</a>
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