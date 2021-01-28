

<div class="col-md-8">
    <table class="table table-hover" id="data-table">
        <thead>
        <tr>
            <td>Name</td>
            <td>Price</td>
            <td>Date</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>


        <?php foreach ($arguments as $row) { ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['price']; ?></td>
                <td><?= $row['creation_date']; ?></td>

                <td>

                    <a href="delete.php?action=service&id=<?= $row['id']; ?>" class="badge badge-danger p-2">Delete</a>
                    <!--                            <a href="ServiceController.php?delete=--><?//= $row['id']; ?><!--" class="badge badge-danger p-2">Delete</a>-->
                    <a href="edit.php?id=<?= $row['id']; ?>" class="badge badge-success p-2" >Edit</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>



</html>

