<?PHP require('Header.php'); ?>
<div class="container mt-5">
    <table class="table table-bordered table-hover mb-5" id="table"
           data-toggle="table"
           data-height="460"
           data-pagination="true"
           data-pagination-v-align="both"
           data-url="json/data1.json">

        <thead class="thead-light">
        <tr>
            <th scope="col">Book</th>
            <th scope="col">Genre</th>
            <th scope="col">Author(s)</th>
            <th scope="col">Price ($)</th>
        </tr>
        </thead>
        <tbody id="myTable">

        <?php foreach ($data as $value):?>
            <tr>
                <td><a href="view/<?=$value['book_id']?>"><?=$value['book_title']?></a></td>
                <td><?=$value['genre']?></td>
                <td><?=$value['authors']?></td>
                <td><?=$value['price']?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
</div>

<?PHP require('Footer.php'); ?>
