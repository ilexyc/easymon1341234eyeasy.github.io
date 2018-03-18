<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>FunCash Админ</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="/templates/admin/vendor/css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="/templates/admin/vendor/css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="/templates/admin/vendor/css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="/templates/admin/vendor/css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="/templates/admin/vendor/css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="/templates/admin/vendor/css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="/templates/admin/vendor/css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="/templates/admin/dist/css/style.css">


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="brand clearfix">
    <a href="/admin" class="navbar-brand">Панель администратора</a>
    <span class="menu-btn"><i class="fa fa-bars"></i></span>
</div>

<div class="ts-main-content">
    <nav class="ts-sidebar">
        <ul class="ts-sidebar-menu">

            <li class="ts-label">Страницы</li>

            <li <?php if ($index) { ?> class="open" <?php } ?>>
                <a href="/admin"><i class="fa fa-dashboard"></i> Статистика</a>
            </li>
			
			<li <?php if ($tickets) { ?> class="open" <?php } ?>>
                <a href="/admin/tickets"><i class="fa fa-ticket"></i> Билеты</a>
            </li>

            <li <?php if ($cases) { ?> class="open" <?php } ?>>
                <a href="/admin/cases"><i class="fa fa-shopping-cart"></i> Кейсы</a>
            </li>

            <li <?php if ($items) { ?> class="open" <?php } ?>>
                <a href="/admin/items"><i class="fa fa-bars"></i> Вещи</a>
            </li>

            <li <?php if ($transactions) { ?> class="open" <?php } ?>>
                <a href="/admin/transactions"><i class="fa fa-ruble"></i> Транзакции</a>
            </li>

            <li <?php if ($users) { ?> class="open" <?php } ?>>
                <a href="/admin/users"><i class="fa fa-users"></i> Пользователи</a>
            </li>

            <li <?php if ($digitals) { ?> class="open" <?php } ?>>
                <a href="/admin/digitals"><i class="fa fa-gift"></i> Цифровые вещи</a>
            </li>

            <li <?php if ($send) { ?> class="open" <?php } ?>>
                <a href="/admin/send"><i class="fa fa-send"></i> Вещи для отправки</a>
            </li>

            <li <?php if ($withdraws) { ?> class="open" <?php } ?>>
                <a href="/admin/withdraws"><i class="fa fa-money"></i>  Вывод средств(<?= $this->helper->getNowWithdraws() ?>руб.)</a>
            </li>


        </ul>
    </nav>

    <div class="content-wrapper">
        <div class="container-fluid">

            
    <div class="row">
    <div class="col-md-12">

    <h2 class="page-title">Вещи для отправки</h2>

    <div class="alert alert-success" style="display: none">
        <strong>Успешно!</strong> Indicates a successful or positive action.
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Таблица вещей</div>
        <div class="panel-body">
            <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Пользователь</th>
                    <th>Имя получателя</th>
                    <th>Телефон</th>
                    <th>Почта</th>
                    <th>Адрес</th>
                    <th>Изображение гифта</th>
                    <th>Название гифта</th>
                    <th>Код</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($send as $element) { ?>
                    <tr <?php if (!$element->gift_code) { ?> class="element-<?= $element->id ?> danger" <?php } else { ?> class="element-<?= $element->id ?> success" <?php } ?>>
                        <td><?= $element->id ?></td>
                        <td><a href="/profile/<?= $element->user_id ?>" target="_blank"><?= $this->helper->getUserInfo($element->user_id)->name ?></a> / <a href="https://vk.com/id<?= $this->helper->getUserInfo($element->user_id)->uid ?>" target="_blank">VK</a></td>
                        <td><?php if ($element->name) { ?> <?= $element->name ?> <?php } else { ?> Предмет продан <?php } ?></td>
                        <td><?php if ($element->telephone) { ?> <?= $element->telephone ?> <?php } else { ?> Продан <?php } ?></td>
                        <td><?= $element->email ?></td>
                        <td><?php if ($element->address) { ?> <?= $element->address ?> <?php } else { ?> Предмет продан <?php } ?></td>
                        <td><img src="<?= $element->gift_image ?>" style="width: 50px;"></td>
                        <td><?= $element->gift_name ?></td>
                        <td><?php if ($element->gift_code) { ?> <?= $element->gift_code ?> <?php } else { ?> Предмет продан <?php } ?></td>
                        <td><input type="text" class="form-control" id="status" value="<?= $element->status ?>"></td>
                        <td><?= $this->helper->unixToString('%d %b %Y, %H:%I', $element->time) ?></td>
                        <td><button type="button" class="btn btn-danger" onclick="Functions.DeleteDigital(<?= $digital->id ?>)">Удалить</button></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>


        </div>
    </div>


        </div>
    </div>
</div>

<!-- Loading Scripts -->
<script src="/templates/admin/vendor/js/jquery.min.js"></script>
<script src="/templates/admin/vendor/js/bootstrap.min.js"></script>
<script src="/templates/admin/vendor/js/jquery.dataTables.min.js"></script>
<script src="/templates/admin/vendor/js/dataTables.bootstrap.min.js"></script>
<script src="/templates/admin/vendor/js/bootstrap-select.js"></script>
<script src="/templates/admin/vendor/js/main.js"></script>
<script src="/templates/admin/dist/js/core.min.js"></script>


</body>

</html>