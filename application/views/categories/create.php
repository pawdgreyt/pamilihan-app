<br>
<div class="row">
<h2><?= $title; ?></h2>

<?php 
    echo validation_errors();
?>

<?php echo form_open_multipart('categories/create'); ?>
    <div class="form-group">   
        <label>Name</label>
        <input type="text" class="form-control" name="category" placeholder="Enter Category"> 
    </div>
    <button type="submit" class="btn btn-outline-dark mt-2">Submit</button>
</form>
</div>