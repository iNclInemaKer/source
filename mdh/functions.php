<?php 
    require_once 'dbconfig.php';
    class News
    {
        public function fetchNews( $conn )
        {

            $request = $conn->prepare(" SELECT news_id, news_title, news_short_description, news_author, news_published_on FROM info_news ORDER BY news_published_on DESC ");
            return $request->execute() ? $request->fetchAll() : false; 
        }


        public function getAnArticle( $id_article, $conn )
        {

            $request =  $conn->prepare(" SELECT news_id,  news_title, news_full_content, news_author, news_published_on FROM info_news  WHERE news_id = ? ");
            return $request->execute(array($id_article)) ? $request->fetchAll() : false; 
        }


        public function getOtherArticles( $differ_id, $conn )
        {
            $request =  $conn->prepare(" SELECT news_id,  news_title, news_short_description, news_full_content, news_author, news_published_on FROM info_news  WHERE news_id != ? ");
            return $request->execute(array($differ_id)) ? $request->fetchAll() : false; 
        }
    }
?>