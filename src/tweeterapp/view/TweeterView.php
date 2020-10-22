<?php

namespace tweeterapp\view;

class TweeterView extends \mf\view\AbstractView {
  
    /* Constructeur 
    *
    * Appelle le constructeur de la classe parent
    */
    public function __construct( $data ){
        parent::__construct($data);
    }

    /* Méthode renderHeader
     *
     *  Retourne le fragment HTML de l'entête (unique pour toutes les vues)
     */ 
    private function renderHeader(){
        return '<h1>MiniTweeTR</h1>';
    }
    
    /* Méthode renderFooter
     *
     * Retourne le fragment HTML du bas de la page (unique pour toutes les vues)
     */
    private function renderFooter(){
        return 'La super app créée en Licence Pro &copy;2019-2020';
    }

    /* Méthode renderHome
     *
     * Vue de la fonctionalité afficher tous les Tweets. 
     *  
     */
    
    private function renderHome(){

        /*
         * Retourne le fragment HTML qui affiche tous les Tweets. 
         *  
         * L'attribut $this->data contient un tableau d'objets tweet.
         * 
         */
        
        $tweets = $this->data;
        $result = '';

        foreach($tweets as $tweet) {
            $get_author = $tweet->author()->first();
            $author = $get_author->fullname;

            $router = new \mf\router\Router();
            $tweet_link = $router->urlFor('view', array('id' => $tweet->id));
            $author_link = $router->urlFor('user', array('id' => $tweet->author));
            
            $result .= <<<HTML
                <div class="tweet">
                    <a href="$tweet_link">
                        <div class="tweet-text">$tweet->text</div>
                    </a>
                    <div class="tweet-footer">
                        <span class="tweet-timestamp">$tweet->created_at</span>
                        <span class="tweet-author"><a href="$author_link">$author</a></span>
                    </div>
                </div>
            HTML;
        }
        $result = '<article class="theme-backcolor2"><h2>Les derniers Tweets</h2>' . $result . '</article>';
        return $result;
    }
  
    /* Méthode renderUeserTweets
     *
     * Vue de la fonctionalité afficher tout les Tweets d'un utilisateur donné. 
     * 
     */
     
    private function renderUserTweets(){

        /* 
         * Retourne le fragment HTML pour afficher
         * tous les Tweets d'un utilisateur donné. 
         *  
         * L'attribut $this->data contient un objet User.
         *
         */

        $tweets = $this->data;
        $result = '';

        foreach($tweets as $tweet) {
            $get_author = $tweet->author()->first();
            $author = $get_author->fullname;

            $router = new \mf\router\Router();
            $tweet_link = $router->urlFor('view', array('id' => $tweet->id));
            $author_link = $router->urlFor('user', array('id' => $tweet->author));
            
            $result .= <<<HTML
                <div class="tweet">
                    <a href="$tweet_link">
                        <div class="tweet-text">$tweet->text</div>
                    </a>
                    <div class="tweet-footer">
                        <span class="tweet-timestamp">$tweet->created_at</span>
                        <span class="tweet-author"><a href="$author_link">$author</a></span>
                    </div>
                </div>
            HTML;
        }
        $result = '<article class="theme-backcolor2"><h2>Tweets de '. $author .'</h2>' . $result . '</article>';
        return $result;
        
    }
  
    /* Méthode renderViewTweet 
     * 
     * Rréalise la vue de la fonctionnalité affichage d'un tweet
     *
     */
    
    private function renderViewTweet(){

        /* 
         * Retourne le fragment HTML qui réalise l'affichage d'un tweet 
         * en particulié 
         * 
         * L'attribut $this->data contient un objet Tweet
         *
         */

        $tweet = $this->data;

        $get_author = $tweet->author()->first();
        $author = $get_author->fullname;

        $router = new \mf\router\Router();
        $tweet_link = $router->urlFor('view', array('id' => $tweet->id));
        $author_link = $router->urlFor('user', array('id' => $tweet->author));

        $result = <<<HTML
            <article class="theme-backcolor2">
                <div class="tweet">
                    <a href="$tweet_link"><div class="tweet-text">$tweet->text</div></a>
                    <div class="tweet-footer">
                        <span class="tweet-timestamp">$tweet->created_at</span>
                        <span class="tweet-author"><a href="$author_link">$author</a></span>
                    </div>
                    <div class="tweet-footer">
                        <hr>
                        <span class="tweet-score tweet-control">$tweet->score</span>
                    </div>
                </div>
            </article>
            HTML;
        return $result;
    }



    /* Méthode renderPostTweet
     *
     * Realise la vue de régider un Tweet
     *
     */
    protected function renderPostTweet(){
        
        /* Méthode renderPostTweet
         *
         * Retourne la framgment HTML qui dessine un formulaire pour la rédaction 
         * d'un tweet, l'action (bouton de validation) du formulaire est la route "/send/"
         *
         */

        $router = new \mf\router\Router();
        $urlPost = $router->urlFor('send');

         $result = <<<HTML
            <article class="theme-backcolor2">
                <form method="POST" action="$urlPost">
                    <textarea name="tweet_content" rows="7" cols="50" required></textarea>
                    <br><br>
                    <button type="submit" name="submit">Poster le Tweet</button>
                </form>
            </article>
         HTML;
         return $result;
    }


    /* Méthode renderBody
     *
     * Retourne la framgment HTML de la balise <body> elle est appelée
     * par la méthode héritée render.
     *
     */
    
    protected function renderBody($selector){

        /*
         * voire la classe AbstractView
         * 
         */

        $header = $this->renderHeader();
        $selecteur = $this->$selector();
        $footer = $this->renderFooter();

        $html = <<<HTML
        <header class="theme-backcolor1"> ${header} </header>
        <section> ${selecteur} </section>
        <footer class="theme-backcolor1"> ${footer} </footer>
        HTML;
        return $html;
    }   
}