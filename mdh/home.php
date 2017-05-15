<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE HTML>
<!--
    Future Imperfect by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>Home - Mundo DongHua</title>
        <link href='https://www.redditstatic.com/favicon.ico' rel='shortcut icon' type='image/x-icon'>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    </head>
    <body>

        <!-- Wrapper -->
            <div id="wrapper">

                <!-- Header -->
                    <header id="header">
                        <h1><a href="index.php">Mundo DongHua</a></h1>
                        <nav class="links">
                            <ul>
                                <li><a href="donghua.php">DongHua</a></li>
                                <li><a href="noticias.php">Noticias</a></li>
                                <li><a href="#">Staff</a></li>
                                <li><a href="#">Sugerencias</a></li>
                                <li><a href="#">Apoyame</a></li>
                            </ul>
                        </nav>
                        <nav class="main">
                            <ul>
                                <li class="search">
                                    <a class="fa-search" href="#search">Search</a>
                                    <form id="search" method="get" action="#">
                                        <input type="text" name="query" placeholder="Search" />
                                    </form>
                                </li>
                                <li class="menu">
                                    <a class="fa-bars" href="#menu">Menu</a>
                                </li>
                            </ul>
                        </nav>
                    </header>

                <!-- Menu -->
                    <section id="menu">

                        <!-- Search -->
                            <section>
                                <form class="search" method="get" action="#">
                                    <input type="text" name="query" placeholder="Search" />
                                </form>
                            </section>

                        <!-- Links -->
                            <section>
                                <ul class="links">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
								<i class="caret"><?php echo $row['userName']; ?> </i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                       </ul>
                            </section>

                    </section>

                <!-- Main -->
                    <div id="main">

                        
                    </div>

                <!-- Sidebar -->
                    <section id="sidebar">

                        <!-- Intro -->
                            <section id="intro">
                                <a href="#" class="logo"><img src="images/logo.jpg" alt="" /></a>
                                <header>
                                    <h2>Mundo DongHua</h2>
                                    <!--<p>Another fine responsive site template by <a href="http://html5up.net">HTML5 UP</a></p>-->
                                </header>
                            </section>

                        <!-- Mini Posts -->
                            <section>
                                <div class="mini-posts">

                                    <!-- Mini Post -->
                                        <article class="mini-post">
                                            <header>
                                                <h3><a href="#">Vitae sed condimentum</a></h3>
                                                <time class="published" datetime="2015-10-20">October 20, 2015</time>
                                                <a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
                                            </header>
                                            <a href="#" class="image"><img src="images/pic04.jpg" alt="" /></a>
                                        </article>

                                    <!-- Mini Post -->
                                        <article class="mini-post">
                                            <header>
                                                <h3><a href="#">Rutrum neque accumsan</a></h3>
                                                <time class="published" datetime="2015-10-19">October 19, 2015</time>
                                                <a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
                                            </header>
                                            <a href="#" class="image"><img src="images/pic05.jpg" alt="" /></a>
                                        </article>

                                    <!-- Mini Post -->
                                        <article class="mini-post">
                                            <header>
                                                <h3><a href="#">Odio congue mattis</a></h3>
                                                <time class="published" datetime="2015-10-18">October 18, 2015</time>
                                                <a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
                                            </header>
                                            <a href="#" class="image"><img src="images/pic06.jpg" alt="" /></a>
                                        </article>

                                    <!-- Mini Post -->
                                        <article class="mini-post">
                                            <header>
                                                <h3><a href="#">Enim nisl veroeros</a></h3>
                                                <time class="published" datetime="2015-10-17">October 17, 2015</time>
                                                <a href="#" class="author"><img src="images/avatar.jpg" alt="" /></a>
                                            </header>
                                            <a href="#" class="image"><img src="images/pic07.jpg" alt="" /></a>
                                        </article>

                                </div>
                            </section>

                        <!-- Posts List -->
                            <section>
                                <ul class="posts">
                                    <li>
                                        <article>
                                            <header>
                                                <h3><a href="#">Lorem ipsum fermentum ut nisl vitae</a></h3>
                                                <time class="published" datetime="2015-10-20">October 20, 2015</time>
                                            </header>
                                            <a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
                                        </article>
                                    </li>
                                    <li>
                                        <article>
                                            <header>
                                                <h3><a href="#">Convallis maximus nisl mattis nunc id lorem</a></h3>
                                                <time class="published" datetime="2015-10-15">October 15, 2015</time>
                                            </header>
                                            <a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>
                                        </article>
                                    </li>
                                    <li>
                                        <article>
                                            <header>
                                                <h3><a href="#">Euismod amet placerat vivamus porttitor</a></h3>
                                                <time class="published" datetime="2015-10-10">October 10, 2015</time>
                                            </header>
                                            <a href="#" class="image"><img src="images/pic10.jpg" alt="" /></a>
                                        </article>
                                    </li>
                                    <li>
                                        <article>
                                            <header>
                                                <h3><a href="#">Magna enim accumsan tortor cursus ultricies</a></h3>
                                                <time class="published" datetime="2015-10-08">October 8, 2015</time>
                                            </header>
                                            <a href="#" class="image"><img src="images/pic11.jpg" alt="" /></a>
                                        </article>
                                    </li>
                                    <li>
                                        <article>
                                            <header>
                                                <h3><a href="#">Congue ullam corper lorem ipsum dolor</a></h3>
                                                <time class="published" datetime="2015-10-06">October 7, 2015</time>
                                            </header>
                                            <a href="#" class="image"><img src="images/pic12.jpg" alt="" /></a>
                                        </article>
                                    </li>
                                </ul>
                            </section>

                        <!-- About -->
                            <section class="blurb">
                                <h2>About</h2>
                                <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod amet placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at phasellus sed ultricies.</p>
                                <ul class="actions">
                                    <li><a href="#" class="button">Learn More</a></li>
                                </ul>
                            </section>

                        <!-- Footer -->
                            <section id="footer">
                                <ul class="icons">
                                    <li><a href="#" class="fa-twitter"><span class="label">Twitter</span></a></li>
                                    <li><a href="#" class="fa-facebook"><span class="label">Facebook</span></a></li>
                                    <li><a href="#" class="fa-instagram"><span class="label">Instagram</span></a></li>
                                    <li><a href="#" class="fa-rss"><span class="label">RSS</span></a></li>
                                    <li><a href="#" class="fa-envelope"><span class="label">Email</span></a></li>
                                </ul>
                                <p class="copyright">&copy; Untitled. Design: <a href="http://html5up.net">HTML5 UP</a>. Images: <a href="http://unsplash.com">Unsplash</a>.</p>
                            </section>

                    </section>

            </div>

        <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/util.js"></script>
            <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
            <script src="assets/js/main.js"></script>

    </body>
</html>