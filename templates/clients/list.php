
<div class="container">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($arguments['clients'] as $row) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['date']; ?></td>

                <th>

                    <a href="client_delete?id=<?= $row['id']; ?>" class="badge badge-danger p-2">Delete</a>
                    <!--                            <a href="ServiceController.php?delete=--><?//= $row['id']; ?><!--" class="badge badge-danger p-2">Delete</a>-->
                    <a href="client_update?id=<?= $row['id']; ?>" class="badge badge-success p-2" >Edit</a>
                </th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="col-md-11">
        <div class="float-right">
        <a href="client_create" class="btn btn-primary">Create</a>
        </div>
</div>
