
<div class="container">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Име</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($arguments['categories'] as $row) { ?>
            <tr>
                <td><?= $row['categoryName']; ?></td>
                <td>

                    <a href="category_delete?id=<?= $row['id']; ?>" class="badge badge-danger p-2">Изтрий</a>
                    <!--                            <a href="InvoiceController.php?delete=--><?//= $row['id']; ?><!--" class="badge badge-danger p-2">Delete</a>-->
                    <a href="category_update?id=<?= $row['id']; ?>" class="badge badge-success p-2" >Редактиране</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="col-md-10">
        <div class="float-right">
            <a href="category_create" class="btn btn-primary">Добави</a>
        </div>

    </div>


