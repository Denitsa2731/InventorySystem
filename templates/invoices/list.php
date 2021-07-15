<div class="container">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Date</th>
            <th>Email</th>
            <th>Address</th>
            <th>Creation Date</th>
            <th>Action</th>
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


                <th>
                    <a href="invoice_show?id=<?php echo $row['id']; ?>" class="badge badge-primary p-2">Show</a>
                    <a href="invoice_delete?id=<?php echo $row['id']; ?>" class="badge badge-danger p-2">Delete</a>
                    <a href="invoice_update?id=<?php echo $row['id']; ?>" class="badge badge-success p-2" >Edit</a>
                </th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="col-md-11">
        <div class="float-right">
            <a href="invoice_create" class="btn btn-primary">Create</a>
        </div>

</div>




