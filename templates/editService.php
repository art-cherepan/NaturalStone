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
    <title>Редактирование услуги</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="d-flex justify-content-center">
                <h1>Редактирование услуги <?php echo $this->data['serviceFields'][1]; ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3 alert alert-success">
            <form action="/NaturalStone/services/changeService.php" method="post">
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputIdService">Идентификатор услуги</label>
                    <input type="text" name="id" class="form-control" id="inputIdService"
                           placeholder="Идентификатор услуги" value="<?php echo $this->data['serviceFields'][0]; ?>">
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputNameService">Наименоание услуги</label>
                    <input type="text" name="name" class="form-control" id="inputNameService"
                           placeholder="Наименование услуги" value="<?php echo $this->data['serviceFields'][1]; ?>">
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputPriceService">Цена услуги</label>
                    <input type="number" min="1" step="any" name="price" class="form-control" id="inputPriceService"
                           placeholder="Цена услуги" value="<?php echo $this->data['serviceFields'][2]; ?>">
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="textareaDescriptionService">Описание услуги</label>
                    <textarea name="description" class="form-control" id="textareaDescriptionService"
                              rows="3"><?php echo $this->data['serviceFields'][3]; ?></textarea>
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputDurationService">Продолжительность оказания услуги (в днях)</label>
                    <input type="number" min="1" step="any" name="duration" class="form-control" id="inputDurationService"
                           placeholder="Продолжительность услуги" value="<?php echo $this->data['serviceFields'][5]; ?>">
                </div>
                <div class="form-group pb-2">
                    <div class="pb-1">
                        <label for="imgService">Выберите фото товара</label>
                    </div>
                    <input type="file" class="form-control-file" name="img_service" id="imgService">
                </div>
                <div class="form-group pt-3">
                    <button class="btn btn-primary" type="submit">Изменить услугу</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>