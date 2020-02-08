<?PHP require('Header.php'); ?>


<div class="container mt-5">
    <form action="/create-form/">
        <button class="btn btn-info">Add an item</button>
    </form>

    <table class="table table-bordered table-hover mb-5" id="table">

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
                <td><a href="/edit/<?=$value['book_id']?>"><?=$value['book_title']?></a></td>
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
