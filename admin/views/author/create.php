<?PHP require(ROOT. '/admin/views/Header.php'); ?>

<div class="container">
    <div class="py-5 text-center">
        <h2>Create form</h2>
        <p class="lead">You can add new author</p>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form action="/author/create" method="post">
                <div class="mb-3">
                    <label for="title">Author name</label>
                    <input type="text" class="form-control" name="author_name" required>
                </div>
                <hr class="mb-4">

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <button class="center btn btn-primary btn-md btn-block" type="submit">Create</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<?PHP require(ROOT. '/admin/views/Footer.php'); ?>
