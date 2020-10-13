<?php

namespace tweeterapp\control;

/* Classe TweeterController :
 *  
 * RÃ©alise les algorithmes des fonctionnalitÃ©s suivantes: 
 *
 *  - afficher la liste des Tweets 
 *  - afficher un Tweet
 *  - afficher les tweet d'un utilisateur 
 *  - afficher la le formulaire pour poster un Tweet
 *  - afficher la liste des utilisateurs suivis 
 *  - Ã©valuer un Tweet
 *  - suivre un utilisateur
 *   
 */

class TweeterController extends \mf\control\AbstractController {


    /* Constructeur :
     * 
     * Appelle le constructeur parent
     *
     * c.f. la classe \mf\control\AbstractController
     * 
     */
    
    public function __construct(){
        parent::__construct();
    }


    /* MÃ©thode viewHome : 
     * 
     * RÃ©alise la fonctionnalitÃ© : afficher la liste de Tweet
     * 
     */
    
    public function viewHome(){

        /* Algorithme :
         *  
         *  1 RÃ©cupÃ©rer tout les tweet en utilisant le modÃ¨le Tweet
         *  2 Parcourir le rÃ©sultat 
         *      afficher le text du tweet, l'auteur et la date de crÃ©ation
         *  3 Retourner un block HTML qui met en forme la liste
         * 
         */
        $tweets = \tweeterapp\model\Tweet::select()->get();
        $result = '';
        foreach($tweets as $t) {

            $get_author = $t->author()->first();
            $author = $get_author->fullname;
            
            $result .= <<<HTML
            <div>
                <div>
                $t->text
                </div>
                <div>
                Posté le : $t->created_at par $author
                </div>
            </div>
            <hr>
            HTML;
        }
        return $result;
    }


    /* MÃ©thode viewTweet : 
     *  
     * RÃ©alise la fonctionnalitÃ© afficher un Tweet
     *
     */
    
    public function viewTweet(){

        /* Algorithme : 
         *  
         *  1 L'identifiant du Tweet en question est passÃ© en paramÃ¨tre (id) 
         *      d'une requÃªte GET 
         *  2 RÃ©cupÃ©rer le Tweet depuis le modÃ¨le Tweet
         *  3 Afficher toutes les informations du tweet 
         *      (text, auteur, date, score)
         *  4 Retourner un block HTML qui met en forme le Tweet
         * 
         *  Erreurs possibles : (*** Ã  implanter ultÃ©rieurement ***)
         *    - pas de paramÃ¨tre dans la requÃªte
         *    - le paramÃ¨tre passÃ© ne correspond pas a un identifiant existant
         *    - le paramÃ¨tre passÃ© n'est pas un entier 
         * 
         */

    }


    /* MÃ©thode viewUserTweets :
     *
     * RÃ©alise la fonctionnalitÃ© afficher les tweet d'un utilisateur
     *
     */
    
    public function viewUserTweets(){

        /*
         *
         *  1 L'identifiant de l'utilisateur en question est passÃ© en 
         *      paramÃ¨tre (id) d'une requÃªte GET 
         *  2 RÃ©cupÃ©rer l'utilisateur et ses Tweets depuis le modÃ¨le 
         *      Tweet et User
         *  3 Afficher les informations de l'utilisateur 
         *      (non, login, nombre de suiveurs) 
         *  4 Afficher ses Tweets (text, auteur, date)
         *  5 Retourner un block HTML qui met en forme la liste
         *
         *  Erreurs possibles : (*** Ã  implanter ultÃ©rieurement ***)
         *    - pas de paramÃ¨tre dans la requÃªte
         *    - le paramÃ¨tre passÃ© ne correspond pas a un identifiant existant
         *    - le paramÃ¨tre passÃ© n'est pas un entier 
         * 
         */
        
    }
}