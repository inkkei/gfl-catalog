<?PHP include('Header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h3><?=$data['book_title']?> <small class="text-muted"><?=$data['authors']?></small></h3>
            <p><b>Genre: </b><i><?=$data['genre']?></i></p>
            <p><b>Description: </b><?=$data['description']?></p>
            <p><b>Price: </b><?=$data['price']?>$</p>
            <p><div id="form_result"></div></p>
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-3" style="border-left:1px solid #A9A9A9">
            <h4 class="text-muted">Do you want to buy this book?</h4>
            <form action="" method="post" id="form">
                <div class="mb-3">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="author">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="genre">Qty</label>
                    <input type="number" class="form-control" id="qty" name="qty" required>
                </div>
                <hr class="mb-4">

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary btn-md btn-block" type="submit" id="btn">Buy now</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    
    $('#form').submit(function() {
        let info = {};
        info.name = $('#name').val();
        info.address = $('#address').val();
        info.qty = $('#qty').val();

        let data = JSON.stringify(info);
        
        $.ajax({
            url: '/order',
            type: 'post',
            data: "data="+data,
            success: function(result) {
                alert('Your order is accepted');
            }
        });
    });
        
    
    

</script>



<?PHP include('Footer.php'); ?>
