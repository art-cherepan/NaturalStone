<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!doctype html>
<html lang="en">
<head>
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
		<title>Главная страница</title>
	</head>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-center">
                <h1>Добавление товара</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3 alert alert-success">
            <form action="/NaturalStone/services/addProduct.php" method="post" name="add_product"
                  enctype="multipart/form-data">
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputNameProduct">Введите наименование товара</label>
                    <input type="text" name="name_product" class="form-control" id="inputNameProduct"
                           placeholder="Наименование товара">
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="textareaDescriptionProduct">Введите описание товара</label>
                    <textarea name="description_product" class="form-control" id="textareaDescriptionProduct"
                              rows="3"></textarea>
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputPriceProduct">Введите цену товара</label>
                    <input type="number" min="1" step="any" name="price_product" class="form-control"
                           id="inputPriceProduct"
                           placeholder="Цена товара">
                </div>
                <div class="form-group pb-2">
                    <div class="pb-1">
                        <label for="imgProduct">Выберите фото товара</label>
                    </div>
                    <input type="file" class="form-control-file" name="img_product" id="imgProduct">
                </div>
                <div class="form-group pt-3">
                    <button class="btn btn-primary" type="submit">Добавить товар</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-center">
                <h1>Добавление услуги</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3 alert alert-success">
            <form action="/NaturalStone/services/addService.php" method="post" name="add_service"
                  enctype="multipart/form-data">
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputNameService">Введите наименование услуги</label>
                    <input type="text" name="name_service" class="form-control" id="inputNameService"
                           placeholder="Наименование услуги">
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="textareaDescriptionService">Введите описание услуги</label>
                    <textarea name="description_service" class="form-control" id="textareaDescriptionService"
                              rows="3"></textarea>
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputPriceService">Введите цену услуги</label>
                    <input type="number" min="1" step="any" name="price_service" class="form-control"
                           id="inputPriceService"
                           placeholder="Цена услуги">
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputDurationService">Введите единицу измерения</label>
                    <input type="text" name="measure_service" class="form-control"
                           id="inputMeasureService" placeholder="Единица измерения для услуги">
                </div>
                <div class="form-group pb-2">
                    <div class="pb-1">
                        <label for="imgService">Выберите фото услуги</label>
                    </div>
                    <input type="file" class="form-control-file" name="img_service" id="imgService">
                </div>
                <div class="form-group pt-3">
                    <button class="btn btn-primary" type="submit">Добавить услугу</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-center">
                <h1>Редактирование товара</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3 alert alert-success">
            <form action="/NaturalStone/services/editProduct.php" name="edit_product_form" method="post">
                <div class="form-group">
                    <label class="pb-1" for="selectEditProduct">Выберите товар</label>
                    <select name="edit_product_select" class="form-control" id="selectEditProduct">
                        <?php foreach ($this->data['products'] as $product) { ?>
                            <option value="<?php echo $product->getId() . '&&&' . $product->getName() . '&&&' . $product->getPrice() . '&&&' . $product->getDescription() . '&&&' . $product->getPath(); ?>"><?php echo $product->getName(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group pt-3">
                    <button class="btn btn-primary" type="submit">Ок</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-center">
                <h1>Редактирование услуги</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3 alert alert-success">
            <form action="/NaturalStone/services/editService.php" name="edit_service_form" method="post">
                <div class="form-group">
                    <label class="pb-1" for="selectEditService">Выберите услугу</label>
                    <select name="edit_service_select" class="form-control" id="selectEditService">
                        <?php foreach ($this->data['services'] as $service) { ?>
                            <option value="<?php echo $service->getId() . '&&&' . $service->getName() . '&&&' . $service->getPrice() . '&&&' . $service->getDescription() . '&&&' . $service->getPath() . '&&&' . $service->getDuration(); ?>"><?php echo $service->getName(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group pt-3">
                    <button class="btn btn-primary" type="submit">Ок</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-center">
                <h1>Удаление товара</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3 alert alert-success">
            <form action="/NaturalStone/services/deleteProduct.php" name="delete_product_form" method="post">
                <div class="form-group">
                    <label class="pb-1" for="selectDeleteProduct">Выберите товар</label>
                    <select name="delete_product_select" class="form-control" id="selectDeleteProduct">
                        <?php foreach ($this->data['products'] as $product) { ?>
                            <option value="<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group pt-3">
                    <button class="btn btn-primary" type="submit">Ок</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-center">
                <h1>Удаление услуги</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3 alert alert-success">
            <form action="/NaturalStone/services/deleteService.php" name="delete_service_form" method="post">
                <div class="form-group">
                    <label class="pb-1" for="selectDeleteService">Выберите услугу</label>
                    <select name="delete_service_select" class="form-control" id="selectDeleteService">
                        <?php foreach ($this->data['services'] as $service) { ?>
                            <option value="<?php echo $service->getId(); ?>"><?php echo $service->getName(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group pt-3">
                    <button class="btn btn-primary" type="submit">Ок</button>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>