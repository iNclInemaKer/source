<?php 
require_once 'dbconfig.php';
require_once 'functions.php';
session_start();
require_once 'class.user.php';
$user_noticias = new USER();

if(!$user_noticias->is_logged_in())
{
    $user_noticias->redirect('index.php');
}

$stmt = $user_noticias->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
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
                                <li><a href="#">DongHua</a></li>
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
                                    <li>
                                        <a href="#">
                                            <h3>Lorem ipsum</h3>
                                            <p>Feugiat tempus veroeros dolor</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <h3>Dolor sit amet</h3>
                                            <p>Sed vitae justo condimentum</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <h3>Feugiat veroeros</h3>
                                            <p>Phasellus sed ultricies mi congue</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <h3>Etiam sed consequat</h3>
                                            <p>Porta lectus amet ultricies</p>
                                        </a>
                                    </li>
                                </ul>
                            </section>

                        <!-- Actions -->
                            <section>
                                <ul class="actions vertical">
                                    <li><a href="#" class="button big fit">Log In</a></li>
                                </ul>
                            </section>

                    </section>

                <!-- Main -->
                    <div id="main">

                        <!-- Post -->

                            <div class="container">

        <div class="welcome">
            <h1>Latest news</h1>
            <p>Welcome to the demo news site. <em>We never stop until you are aware.</em></p>
            <a href="noticias.php">return to home page</a>
        </div>

        <div class="news-box">

            <div class="news">
                <?php
                    // get the database handler
                    //$dbh = dbConnection(); // function created in dbconnect, remember?
                    $database = new Database();
                    $dbh = $database->dbConnection();
                    $id_article = (int)$_GET['newsid'];

                    if ( !empty($id_article) && $id_article > 0) {
                        // Fecth news
                        $fnews = new News();
                        //$news = $fnews->fetchNews($dbh);
                        $article = $fnews->getAnArticle( $id_article, $dbh );
                        $article = $article[0];
                    }else{
                        $article = false;
                        echo "<strong>Wrong article!</strong>";
                    }
                    $fnews = new News();
                    $other_articles = $fnews->getOtherArticles( $id_article, $dbh );

                ?>

                <?php if ( $article && !empty($article) ) :?>

                <h2><?= stripslashes($article['news_title']) ?></h2>
                <span>published on <?= date("M, jS  Y, H:i", $article['news_published_on']) ?> by <?= stripslashes($article['news_author']) ?></span>
                <div>
                    <?= stripslashes($article['news_full_content']) ?>
                </div>
            <?php else:?>

                <?php endif?>
            </div>

            <hr>
            <h1>Other articles</h1>
            <div class="similar-posts">
                <?php if ( $other_articles && !empty($other_articles) ) :?>

                <?php foreach ($other_articles as $key => $article) :?>
                <h2><a href="read-news.php?newsid=<?= $article['news_id'] ?>"><?= stripslashes($article['news_title']) ?></a></h2>
                <p><?= stripslashes($article['news_short_description']) ?></p>
                <span>published on <?= date("M, jS  Y, H:i", $article['news_published_on']) ?> by <?= stripslashes($article['news_author']) ?></span>
                <?php endforeach?>

                <?php endif?>

            </div>

        </div>

        <div class="footer">
            phpocean.com Â© <?= date("Y") ?> - all rights reserved.
        </div>

     </div>

                        <!-- Post -->
                        <!--
                            <article class="post">
                                <header>
                                    <div class="title">
                                        <h2><a href="#">Elements</a></h2>
                                        <p>Lorem ipsum dolor amet nullam consequat etiam feugiat</p>
                                    </div>
                                    <div class="meta">
                                        <time class="published" datetime="2015-10-18">October 18, 2015</time>
                                        <a href="#" class="author"><span class="name">Jane Doe</span><img src="images/avatar.jpg" alt="" /></a>
                                    </div>
                                </header>

                                <section>
                                    <h3>Text</h3>
                                    <p>This is <b>bold</b> and this is <strong>strong</strong>. This is <i>italic</i> and this is <em>emphasized</em>.
                                    This is <sup>superscript</sup> text and this is <sub>subscript</sub> text.
                                    This is <u>underlined</u> and this is code: <code>for (;;) { ... }</code>. Finally, <a href="#">this is a link</a>.</p>
                                    <hr />
                                    <p>Nunc lacinia ante nunc ac lobortis. Interdum adipiscing gravida odio porttitor sem non mi integer non faucibus ornare mi ut ante amet placerat aliquet. Volutpat eu sed ante lacinia sapien lorem accumsan varius montes viverra nibh in adipiscing blandit tempus accumsan.</p>
                                    <hr />
                                    <h2>Heading Level 2</h2>
                                    <h3>Heading Level 3</h3>
                                    <h4>Heading Level 4</h4>
                                    <hr />
                                    <h4>Blockquote</h4>
                                    <blockquote>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan faucibus. Vestibulum ante ipsum primis in faucibus lorem ipsum dolor sit amet nullam adipiscing eu felis.</blockquote>
                                    <h4>Preformatted</h4>
                                    <pre><code>i = 0;

while (!deck.isInOrder()) {
  print 'Iteration ' + i;
  deck.shuffle();
  i++;
}

print 'It took ' + i + ' iterations to sort the deck.';</code></pre>
                                </section>

                                <section>
                                    <h3>Lists</h3>
                                    <div class="row">
                                        <div class="6u 12u$(medium)">
                                            <h4>Unordered</h4>
                                            <ul>
                                                <li>Dolor pulvinar etiam.</li>
                                                <li>Sagittis adipiscing.</li>
                                                <li>Felis enim feugiat.</li>
                                            </ul>
                                            <h4>Alternate</h4>
                                            <ul class="alt">
                                                <li>Dolor pulvinar etiam.</li>
                                                <li>Sagittis adipiscing.</li>
                                                <li>Felis enim feugiat.</li>
                                            </ul>
                                        </div>
                                        <div class="6u$ 12u$(medium)">
                                            <h4>Ordered</h4>
                                            <ol>
                                                <li>Dolor pulvinar etiam.</li>
                                                <li>Etiam vel felis viverra.</li>
                                                <li>Felis enim feugiat.</li>
                                                <li>Dolor pulvinar etiam.</li>
                                                <li>Etiam vel felis lorem.</li>
                                                <li>Felis enim et feugiat.</li>
                                            </ol>
                                            <h4>Icons</h4>
                                            <ul class="icons">
                                                <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                                                <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                                                <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                                                <li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h3>Actions</h3>
                                    <div class="row">
                                        <div class="6u 12u$(medium)">
                                            <ul class="actions">
                                                <li><a href="#" class="button">Default</a></li>
                                                <li><a href="#" class="button">Default</a></li>
                                                <li><a href="#" class="button">Default</a></li>
                                            </ul>
                                            <ul class="actions small">
                                                <li><a href="#" class="button small">Small</a></li>
                                                <li><a href="#" class="button small">Small</a></li>
                                                <li><a href="#" class="button small">Small</a></li>
                                            </ul>
                                            <ul class="actions vertical">
                                                <li><a href="#" class="button">Default</a></li>
                                                <li><a href="#" class="button">Default</a></li>
                                                <li><a href="#" class="button">Default</a></li>
                                            </ul>
                                            <ul class="actions vertical small">
                                                <li><a href="#" class="button small">Small</a></li>
                                                <li><a href="#" class="button small">Small</a></li>
                                                <li><a href="#" class="button small">Small</a></li>
                                            </ul>
                                        </div>
                                        <div class="6u 12u$(medium)">
                                            <ul class="actions vertical">
                                                <li><a href="#" class="button fit">Default</a></li>
                                                <li><a href="#" class="button fit">Default</a></li>
                                            </ul>
                                            <ul class="actions vertical small">
                                                <li><a href="#" class="button small fit">Small</a></li>
                                                <li><a href="#" class="button small fit">Small</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <h3>Table</h3>
                                    <h4>Default</h4>
                                    <div class="table-wrapper">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Item One</td>
                                                    <td>Ante turpis integer aliquet porttitor.</td>
                                                    <td>29.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Item Two</td>
                                                    <td>Vis ac commodo adipiscing arcu aliquet.</td>
                                                    <td>19.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Item Three</td>
                                                    <td> Morbi faucibus arcu accumsan lorem.</td>
                                                    <td>29.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Item Four</td>
                                                    <td>Vitae integer tempus condimentum.</td>
                                                    <td>19.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Item Five</td>
                                                    <td>Ante turpis integer aliquet porttitor.</td>
                                                    <td>29.99</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td>100.00</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <h4>Alternate</h4>
                                    <div class="table-wrapper">
                                        <table class="alt">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Item One</td>
                                                    <td>Ante turpis integer aliquet porttitor.</td>
                                                    <td>29.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Item Two</td>
                                                    <td>Vis ac commodo adipiscing arcu aliquet.</td>
                                                    <td>19.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Item Three</td>
                                                    <td> Morbi faucibus arcu accumsan lorem.</td>
                                                    <td>29.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Item Four</td>
                                                    <td>Vitae integer tempus condimentum.</td>
                                                    <td>19.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Item Five</td>
                                                    <td>Ante turpis integer aliquet porttitor.</td>
                                                    <td>29.99</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td>100.00</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </section>

                                <section>
                                    <h3>Buttons</h3>
                                    <ul class="actions">
                                        <li><a href="#" class="button big">Big</a></li>
                                        <li><a href="#" class="button">Default</a></li>
                                        <li><a href="#" class="button small">Small</a></li>
                                    </ul>
                                    <ul class="actions fit">
                                        <li><a href="#" class="button fit">Fit</a></li>
                                        <li><a href="#" class="button fit">Fit</a></li>
                                        <li><a href="#" class="button fit">Fit</a></li>
                                    </ul>
                                    <ul class="actions fit small">
                                        <li><a href="#" class="button fit small">Fit + Small</a></li>
                                        <li><a href="#" class="button fit small">Fit + Small</a></li>
                                        <li><a href="#" class="button fit small">Fit + Small</a></li>
                                    </ul>
                                    <ul class="actions">
                                        <li><a href="#" class="button icon fa-download">Icon</a></li>
                                        <li><a href="#" class="button icon fa-upload">Icon</a></li>
                                        <li><a href="#" class="button icon fa-save">Icon</a></li>
                                    </ul>
                                    <ul class="actions">
                                        <li><span class="button disabled">Disabled</span></li>
                                        <li><span class="button disabled icon fa-download">Disabled</span></li>
                                    </ul>
                                </section>

                                <section>
                                    <h3>Form</h3>
                                    <form method="post" action="#">
                                        <div class="row uniform">
                                            <div class="6u 12u$(xsmall)">
                                                <input type="text" name="demo-name" id="demo-name" value="" placeholder="Name" />
                                            </div>
                                            <div class="6u$ 12u$(xsmall)">
                                                <input type="email" name="demo-email" id="demo-email" value="" placeholder="Email" />
                                            </div>
                                            <div class="12u$">
                                                <div class="select-wrapper">
                                                    <select name="demo-category" id="demo-category">
                                                        <option value="">- Category -</option>
                                                        <option value="1">Manufacturing</option>
                                                        <option value="1">Shipping</option>
                                                        <option value="1">Administration</option>
                                                        <option value="1">Human Resources</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="4u 12u$(small)">
                                                <input type="radio" id="demo-priority-low" name="demo-priority" checked>
                                                <label for="demo-priority-low">Low</label>
                                            </div>
                                            <div class="4u 12u$(small)">
                                                <input type="radio" id="demo-priority-normal" name="demo-priority">
                                                <label for="demo-priority-normal">Normal</label>
                                            </div>
                                            <div class="4u$ 12u$(small)">
                                                <input type="radio" id="demo-priority-high" name="demo-priority">
                                                <label for="demo-priority-high">High</label>
                                            </div>
                                            <div class="6u 12u$(small)">
                                                <input type="checkbox" id="demo-copy" name="demo-copy">
                                                <label for="demo-copy">Email me a copy</label>
                                            </div>
                                            <div class="6u$ 12u$(small)">
                                                <input type="checkbox" id="demo-human" name="demo-human" checked>
                                                <label for="demo-human">Not a robot</label>
                                            </div>
                                            <div class="12u$">
                                                <textarea name="demo-message" id="demo-message" placeholder="Enter your message" rows="6"></textarea>
                                            </div>
                                            <div class="12u$">
                                                <ul class="actions">
                                                    <li><input type="submit" value="Send Message" /></li>
                                                    <li><input type="reset" value="Reset" /></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                </section>

                                <section>
                                    <h3>Image</h3>
                                    <h4>Fit</h4>
                                    <div class="box alt">
                                        <div class="row uniform">
                                            <div class="12u$"><span class="image fit"><img src="images/pic02.jpg" alt="" /></span></div>
                                            <div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
                                            <div class="4u"><span class="image fit"><img src="images/pic05.jpg" alt="" /></span></div>
                                            <div class="4u$"><span class="image fit"><img src="images/pic06.jpg" alt="" /></span></div>
                                            <div class="4u"><span class="image fit"><img src="images/pic06.jpg" alt="" /></span></div>
                                            <div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
                                            <div class="4u$"><span class="image fit"><img src="images/pic05.jpg" alt="" /></span></div>
                                            <div class="4u"><span class="image fit"><img src="images/pic05.jpg" alt="" /></span></div>
                                            <div class="4u"><span class="image fit"><img src="images/pic06.jpg" alt="" /></span></div>
                                            <div class="4u$"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
                                        </div>
                                    </div>
                                    <h4>Left &amp; Right</h4>
                                    <p><span class="image left"><img src="images/pic07.jpg" alt="" /></span>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent.</p>
                                    <p><span class="image right"><img src="images/pic04.jpg" alt="" /></span>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent.</p>
                                </section>

                            </article>
                        -->

                        <!-- Pagination -->
                            <ul class="actions pagination">
                                <li><a href="" class="disabled button big previous">Previous Page</a></li>
                                <li><a href="#" class="button big next">Next Page</a></li>
                            </ul>

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