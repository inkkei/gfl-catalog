<?PHP include('Header.php');
$genres = $data['genres'];
$authors = $data['authors'];
$data = $data['info'];
?>

<div class="container">
    <div class="py-5 text-center">
        <h2>Update form</h2>
        <p class="lead">You can change information of this book</p>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form action="/update" method="post">
                <input type="hidden" name="id" value="<?=$data['book_id']?>">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="book_title" value="<?=$data['book_title']?>" required>
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" rows="4"  required><?=$data['description']?></textarea>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" value="<?=$data['price']?>" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="author">Author</label>
                   <p>Now: |
                       <?php foreach ($data['authors'] as $currentAuthor):?>
                       <?=$currentAuthor?> |
                       <?php endforeach; ?>
                   </p>
                    <select class="form-control" id="author" name="author[]" multiple>
                        <?php foreach ($authors as $author_name):?>
                            <?php if (in_array($author_name, $data['authors'])):?>
                                <option selected value="<?=$author_name?>"><?=$author_name?></option>
                            <?php endif;?>
                            <?php if (!in_array($author_name, $data['authors'])):?>
                                <option value="<?=$author_name?>"><?=$author_name?></option>
                            <?php endif;?>

                        <?php endforeach;?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="genre">Genre</label>
                    <select class="form-control" id="genre" name="genre[]" multiple>
                        <?php foreach ($genres as $genre_title ):?>
                            <?php if (in_array($genre_title, $data['genre'])):?>
                                <option selected value="<?=$genre_title?>"><?=$genre_title?></option>
                            <?php endif;?>
                            <?php if (!in_array($genre_title, $data['genre'])):?>
                                <option value="<?=$genre_title?>"><?=$genre_title?></option>
                            <?php endif;?>

                        <?php endforeach;?>
                    </select>
                </div>
                <hr class="mb-4">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <button class="center btn btn-primary btn-md btn-block" type="submit">Update</button>
                    </div>
                    <div class="col-sm-3">
                        <a style="color: white; text-decoration: none;" href="/delete/<?=$data['book_id']?>">
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

<?PHP include('Footer.php'); ?>
