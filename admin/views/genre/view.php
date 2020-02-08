<?PHP require(ROOT. '/admin/views/Header.php'); ?>

<div class="container">
    <div class="py-5 text-center">
        <h2>Update form</h2>
        <p class="lead">You can change or delete this genre</p>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form action="/genre/update" method="post">
                <input type="hidden" name="genre_id" value="<?=$data['genre_id']?>">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="genre_title" value="<?=$data['genre_title']?>" required>
                </div>
                <hr class="mb-4">

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <button class="center btn btn-primary btn-md btn-block" type="submit">Update</button>
                    </div>
                    <div class="col-sm-3">
                        <a style="color: white; text-decoration: none;" href="/genre/delete/<?=$data['genre_id']?>">
                            <button onclick="return checkDelete();" class="center btn btn-danger btn-md btn-block" type="button">Delete</button>
                        </a>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function checkDelete() {
        if (confirm("Are you sure?")) {
            return true;
        } else {
            return false;
        }
    }
</script>

<?PHP require(ROOT. '/admin/views/Footer.php'); ?>
