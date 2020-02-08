<?PHP include('Header.php');?>

<div class="container">
    <div class="py-5 text-center">
        <h2>Create form</h2>
        <p class="lead">You can add a new book</p>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form action="/create" method="post">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" rows="4" required></textarea>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="author">Author</label>
                    <select class="form-control" id="author" name="author[]" multiple>
                        <?php foreach ($data['authors'] as $author_name):?>
                        <option value="<?=$author_name?>"><?=$author_name?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="genre">Genre</label>
                    <select class="form-control" id="genre" name="genre[]" multiple>
                        <?php foreach ($data['genres'] as $genre_title):?>
                        <option value="<?=$genre_title?>"><?=$genre_title?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <hr class="mb-4">

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary btn-md btn-block" type="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>


<?PHP include('Footer.php'); ?>
