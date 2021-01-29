<div class="col-md-8">
    <a href="client_create" class="btn btn-primary">Create</a>
    <table class="table table-hover" id="data-table">
        <thead>
        <tr>
            <td>Name</td>
            <td>Email</td>
            <td>Address</td>
            <td>Date</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>


        <?php foreach ($arguments['clients'] as $row) { ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['address']; ?></td>
                <td><?= $row['date']; ?></td>

                <td>

                    <a href="client_delete?id=<?= $row['id']; ?>" class="badge badge-danger p-2">Delete</a>
                    <!--                            <a href="ServiceController.php?delete=--><?//= $row['id']; ?><!--" class="badge badge-danger p-2">Delete</a>-->
                    <a href="client_update?id=<?= $row['id']; ?>" class="badge badge-success p-2" >Edit</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
