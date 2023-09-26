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

    <?php
    session_start();

    include "system/db.php";

    if(isset($_POST['login'])){
        $login_post = $_POST['login'];
        $username=$login_post['username'];
        $password=$login_post['password'];



        if(empty($username) || empty($password)){
            $_SESSION['error'] = 'Пожалуйста заполните все поля!';
        }else{
            if($stmt=$conn->query("SELECT * from users where username='$username'")){
                if($stmt->num_rows>0){
                    $user = mysqli_fetch_array($stmt);
                    if (password_verify($password, $user['password'])) {
                        unset($_SESSION['error']);
                        $_SESSION['success'] = 'Поздравляю, вы успешно авторизованы на сайт!';
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['login_time'] = time();
                        session_set_cookie_params(60);

                        header("Location:users.php");
                    } else {
                        unset($_SESSION['success']);
                        $_SESSION['error'] = 'Авторизация не прошла удачно, неверный пароль';
                    }

                }else{
                    unset($_SESSION['success']);
                    $_SESSION['error'] = 'Авторизация не прошла удачно, неверный логин или пароль';
                }
            }



        }


    }



    // registration form accepting

    if(isset($_POST['register'])){
        $register_post = $_POST['register'];
        $username=$register_post['username'];
        $password=$register_post['password'];
        $email=$register_post['email'];
        $gender=$register_post['gender'];
        $date_bd=$register_post['date_bd'];

        if(empty($username) || empty($password) || empty($email) || empty($date_bd) || empty($gender) ){
            $_SESSION['error'] = 'Пожалуйста заполните все поля!';
        }else{
            $password=password_hash($password, PASSWORD_DEFAULT);
            $stmt=$conn->prepare("INSERT into users (username, email, gender, date_bd, password) VALUES(?,?,?,?,?)");
            if($stmt->bind_param("sssss",$username,$email,$gender,$date_bd, $password)){
                $stmt->execute();
                unset($_SESSION['error']);
                $_SESSION['success'] = 'Поздравляю, вы успешно зарегистрировались на сайт!';
            }else{
                unset($_SESSION['success']);
                $_SESSION['error'] = 'Произошла ошибка регистрации, повторите еще раз, возможно имейл или логин уже существуют!';
            }

        }


    }


    ?>


        <!-- Top content -->
        <div class="top-content">

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

            <div class="inner-bg">
                <div class="container">

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h4>Simple User Managment</h4>
                            <div class="description">
                            	<p>

                            	</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">

                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Авторизоваться</h3>
	                            		<p>Введите логин и пароль:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="/" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">Логин</label>
				                        	<input type="text" name="login[username]" placeholder="Логин..." class="form-username form-control" id="form-username">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Пароль</label>
				                        	<input type="password" name="login[password]" placeholder="Пароль..." class="form-password form-control" id="form-password">
				                        </div>
				                        <button type="submit" class="btn">Войти!</button>
				                    </form>
			                    </div>
		                    </div>


                        </div>

                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>

                        <div class="col-sm-5">

                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Зарегистрироваться</h3>
	                            		<p>Заполните все поля пожалуйста:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="/" method="post" class="registration-form">

				                        <div class="form-group">
				                        	<label class="sr-only" for="form-last-name">Логин</label>
				                        	<input type="text" name="register[username]" placeholder="Логин..." class="form-last-name form-control" id="form-last-name">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-email">Email</label>
				                        	<input type="text" name="register[email]" placeholder="Email..." class="form-email form-control" id="form-email">
				                        </div>
                                        <div class="btn-group btn-group-vertical" data-toggle="buttons">
                                            <label class="sr-only" for="form-last-name">Пол</label>
                                            <label class="btn active">
                                                <input type="radio" name='register[gender]' value="Мужской" checked><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i> <span>  Мужской</span>
                                            </label>
                                            <label class="btn">
                                                <input type="radio" name='register[gender]' value="Женский" ><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span> Женский</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-last-name">Дата рождения</label>
                                            <input type="date" name="register[date_bd]" placeholder="Дата рождения..." class="form-last-name form-control" id="form-last-name">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-last-name">Пароль</label>
                                            <input type="password" name="register[password]" placeholder="Пароль..." class="form-last-name form-control" id="form-last-name">
                                        </div>
				                        <button type="submit" class="btn">Создать аккаунт!</button>
				                    </form>
			                    </div>
                        	</div>

                        </div>
                    </div>

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
        </footer>

        <!-- Javascript -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-2.1.0.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
