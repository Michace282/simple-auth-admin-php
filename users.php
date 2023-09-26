<?php
session_start();
if( !isset( $_SESSION['user_id'] ) || time() - $_SESSION['login_time'] > 600)
{
    header("Location:index.php");
} else {
    include "system/db.php";
    if(isset($_GET['delete'])){
        $stmt=$conn->prepare("DELETE FROM users WHERE id = ?");
        if($stmt->bind_param("s",$_GET['delete'])){
            $stmt->execute();
            unset($_SESSION['error']);
            $_SESSION['success'] = 'Поздравляю, вы успешно удалилм пользолвателя!';
        }else{
            unset($_SESSION['success']);
            $_SESSION['error'] = 'Произошла ошибка при удалении пользователя, повторите еще раз';
        }
    }
    $users=$conn->query("SELECT u.*, ((YEAR(CURRENT_DATE)-YEAR(u.date_bd))-(RIGHT(CURRENT_DATE,5)<RIGHT(u.date_bd,5))) AS `age` from users u where id != {$_SESSION['user_id']}");
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Simple User Managment</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>
    <?php if ($_SESSION['success']) :?>
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?=$_SESSION['success']?></strong>
        </div>
    <?php endif ?>
    <?php if ($_SESSION['error']) :?>
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?=$_SESSION['error']?></strong>
        </div>
    <?php endif ?>

    <?php unset($_SESSION['success']); ?>
    <?php unset($_SESSION['error']); ?>
    <h2>Table users</h2>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Логин</th>
                            <th>Email</th>
                            <th>Возраст</th>
                            <th>Пол</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rows = $users->fetch_all(MYSQLI_ASSOC);
                        foreach ($rows as $row) { ?>
                            <tr>
                                <td><?=$row["username"]?></td>
                                <td><?=$row["email"]?></td>
                                <td><?=$row["age"]?></td>
                                <td><?=$row["gender"]?></td>
                                <td><a href="/users.php?delete=<?=$row["id"]?>" onclick="if (confirm('Вы действительно хотите удалить пользователя?')){return true;}else{event.stopPropagation(); event.preventDefault();};" title="Удалить пользователя">
                                        Удалить
                                    </a></td>
                            </tr>
                        <? }?>


                        </tfoot>
                    </table>
                </div><!--end of .table-responsive-->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2">
                    <div class="footer-border"></div>
                    <p>Simple User Managment  @ <script>document.write(new Date().getFullYear())</script></p>
                </div>

            </div>
        </div>
    </footer> <!-- Javascript -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.1.0.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <!--[if lt IE 10]>
    <script src="assets/js/placeholder.js"></script>
    <![endif]-->

    </body>

    </html>
<?php } ?><?php
