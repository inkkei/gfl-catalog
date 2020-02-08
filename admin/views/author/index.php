<?PHP require(ROOT. '/admin/views/Header.php');
$i = 1;?>

<div class="container mt-5">
    <form action="/author/create-form/">
        <button class="btn btn-info">Add an item</button>
    </form>
    <div class="col-sm-6">
    <table class="table table-bordered table-hover mt-2" id="table">

        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Author(s)</th>
        </tr>
        </thead>
        <tbody id="myTable">

        <?php foreach ($data as $id => $value):?>

            <tr>
                <td><?=$i;?></td>
                <td><a href="/author/<?=$id?>"><?=$value?></a></td>
            </tr>
        <?php $i++;?>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>
</div>


<?PHP require(ROOT.'/admin/views/Footer.php'); ?>
