
<div class="container">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Име на клиента</th>
            <th>Адрес на клиента</th>
            <th>Номер на клиента</th>
            <th>Брутна сума</th>
            <th>ДДС</th>
            <th>Нетна сума</th>
            <th>Отстъпка</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($arguments['orders'] as $row) { ?>
            <tr>
                <td><?= $row['customerName']; ?></td>
                <td><?= $row['customerAddress']; ?></td>
                <td><?= $row['customerPhone']; ?></td>
                <td><?= $row['grossAmount']; ?></td>
                <td><?= $row['vat']; ?></td>
                <td><?= $row['netAmount']; ?></td>
                <td><?= $row['discount']; ?></td>
                <td>
<!--                    <a href="order_show?id=--><?php //echo $row['id']; ?><!--" class="badge badge-primary p-2">Show</a>-->
                    <a href="order_update?id=<?= $row['id']; ?>" class="badge badge-success p-2" >Редактирай</a>
                    <a href="order_delete?id=<?= $row['id']; ?>" class="badge badge-danger p-2">Изтрий</a>
                    <!--                            <a href="InvoiceController.php?delete=--><?//= $row['id']; ?><!--" class="badge badge-danger p-2">Delete</a>-->

                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="col-md-10">
        <div class="float-right">
            <a href="order_create" class="btn btn-primary">Добави</a>
        </div>

    </div>


