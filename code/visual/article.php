<?php
$articleName = explode("articles/",$uri);
$CONTROLLER = new controller_article();
$ARTICLE = $CONTROLLER->getArticleByName($articleName[1]);

if($ARTICLE['title']=="")
{
    $ARTICLE['title'] = "Nie znaleziono artykułu";
    $ARTICLE['HTMLcontent'] = "Nie znaleziono artykułu o podanej nazwie, prawdopodobnie wystąpiła literówka w adresie. Miłego dnia ;)";
    $ARTICLE['author'] = "Nie znaleziono :/";
    $ARTICLE['date'] = date("d m Y");
}
?>
<nav class="section-navigation-big outer-shadow">
     <a href="<?php echo $_PREFIX; ?>/" class="section-navigation-heading">
         <img src="../img/cms/koziolek.png" alt="logo">
         <h1>KK-Tournament</h1>
     </a>
</nav>

<article class="article outer-shadow">
    <h2><?php echo $ARTICLE['title'];?></h2>
    <?php echo $ARTICLE['HTMLcontent'];?>
    <section class="article-bottom">
        <div>
            <p class="article-author"><?php echo $ARTICLE['author'];?></p>
            <p class="article-data"><?php echo $ARTICLE['date'];?></p>
        </div>
       <a href="<?php echo $_PREFIX; ?>/" class="link-as-button">Powrót</a>

    </section>
    
</article>