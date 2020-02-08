<?PHP require(ROOT. '/admin/views/Header.php');?>

<form action="/genre/create-form/">
    <button class="btn btn-info ml-4">Add an item</button>
</form>


<div class="grid-container">
    <?php foreach ($data as $id => $value):?>
       <div><a href="/genre/<?=$id?>"><?=$value?></a></div>
    <?php endforeach; ?>
</div>

<style>
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto auto auto;
        grid-gap: 10px;
        padding: 15px;
    }
    .grid-container > div {
        background-color: rgb(148, 207, 59);
        text-align: center;
        padding: 20px 0;
        font-size: 24px;
    }
    .grid-container > div:hover {
        background-color: rgb(185, 255, 70);
        cursor: pointer;
    }
    .grid-container > div > a{
        text-decoration: none;
        color: rgba(18, 18, 18, 0.75);
    }

</style>


<?PHP require(ROOT.'/admin/views/Footer.php'); ?>
