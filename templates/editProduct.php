<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/NaturalStone/css/bootstrap.min.css">
    <!--собственные стили-->
    <link rel="stylesheet" href="/NaturalStone/css/styles.css">
    <!-- Bootstrap JS + Popper JS -->
    <script defer src="/NaturalStone/js/bootstrap.bundle.min.js"></script>
    <title>Редактирование товара</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-center">
                <h1>Редактирование товара <?php echo $this->data['productFields'][1]; ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3 alert alert-success">
            <form action="/NaturalStone/services/changeProduct.php" method="post">
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputIdProduct">Идентификатор товара</label>
                    <input type="text" name="id" class="form-control" id="inputIdProduct"
                           placeholder="Идентификатор товара" value="<?php echo $this->data['productFields'][0]; ?>">
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputNameProduct">Наименоание товара</label>
                    <input type="text" name="name" class="form-control" id="inputNameProduct"
                           placeholder="Наименование товара" value="<?php echo $this->data['productFields'][1]; ?>">
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputPriceProduct">Цена товара</label>
                    <input type="number" min="1" step="any" name="price" class="form-control" id="inputPriceProduct"
                           placeholder="Цена товара" value="<?php echo $this->data['productFields'][2]; ?>">
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="textareaDescriptionProduct">Описание товара</label>
                    <textarea name="description" class="form-control" id="textareaDescriptionProduct"
                              rows="3"><?php echo $this->data['productFields'][3]; ?></textarea>
                </div>
                <div class="form-group pb-2">
                    <div class="pb-1">
                        <label for="imgProduct">Выберите фото товара</label>
                    </div>
                    <input type="file" class="form-control-file" name="img_product" id="imgProduct">
                </div>
                <div class="form-group pt-3">
                    <button class="btn btn-primary" type="submit">Изменить товар</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>