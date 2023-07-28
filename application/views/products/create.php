<br>
<div class="row">
    <h2><?= $title; ?></h2>

    <span style="color:red">
    <?php 
        echo validation_errors();
    ?>
    </span>
</div>

<div class="col-lg-12">
    <?php echo form_open_multipart('products/create'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title">Product Name <strong style="color:red">*</strong></label>
                <input type="text" class="form-control" name="product_name" placeholder="Product Name" required autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="title">Brand Name <strong style="color:red">*</strong></label>
                <input type="text" class="form-control" name="product_brand" placeholder="Brand Name" required autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title">Price <strong style="color:red">*</strong></label>
                <input type="number" name="product_price" class="form-control" min="1" step="0.1" placeholder="P 10,000" required autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="title">Quantity <strong style="color:red">*</strong></label>
                <input type="number" min="1" step="1" class="form-control"  name="product_qty" placeholder="10 pcs" required autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Category <strong style="color:red">*</strong></label>
                <select name="product_category" class="form-control"  required autocomplete="off">
                    <option value="" selected disabled>Select Category</option>
                    <?php foreach($product_categories as $category) : ?>
                    <option value="<?= $category['id']?>"><?= $category['category']?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="">Upload Image</label>
            <input class="form-control" type="file" id="imgInp" name="userfile">
        </div>
    </div>
    <div class="col-md-3">
            <label for="">Image Viewer</label><br>
            <img id="imageviewer" src="#" style="max-width:200px;max-height:200px;border: .5px solid black" onclick="window.open(imageviewer.src, '_blank');"/>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="body">Description <strong style="color:red">*</strong></label>
            <textarea class="form-control" name="product_description" id="editor1" cols="30" rows="5"  required autocomplete="off"></textarea>
        </div>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-outline-dark mt-2">Submit</button>
    </div>
    </form>
</div>