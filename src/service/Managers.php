<?php


namespace App\Service;


use Cocur\Slugify\Slugify;

class Managers
{
    // Stores the visitor's Cart ID
    private static $_mCartId;
    // Private constructor to prevent direct creation of object
    public static $mOrderStatusOptions = array ('placer',    // 0
        'vérifier',  // 1
        'terminé', // 2
        'annulé'); // 3
    // Defines product display options
    public static $mProductDisplayOptions = array (0 =>'Default',       // 0
        1 =>'produits en vedettes',    // 1
        2 =>'Nouveaux produits', // 2
        3=>'On Both');      // 3

    /* This will be called by GetCartId to ensure we have the
visitor's cart ID in the visitor's session in case
$_mCartID has no value set */
    public static function SetCartId()
    {
// If the cart ID hasn't already been set ...
        if (self::$_mCartId == '')
        {
// If the visitor's cart ID is in the session, get it from there
            if (isset ($_SESSION['cart_id']))
            {
                self::$_mCartId = $_SESSION['cart_id'];
            }
// If not, check whether the cart ID was saved as a
            elseif (isset ($_COOKIE['cart_id']))
            {
// Save the cart ID from the cookie
                self::$_mCartId = $_COOKIE['cart_id'];
                $_SESSION['cart_id'] = self::$_mCartId;
// Regenerate cookie to be valid for 7 days (604800 seconds)
                setcookie('cart_id', self::$_mCartId, time() + 604800);
            }
            else
            {
                /* Generate cart id and save it to the $_mCartId class member,
                the session and a cookie (on subsequent requests $_mCartId
                will be populated from the session) */
                self::$_mCartId = md5(uniqid(random_int(1,10), true));
// Store cart id in session
                $_SESSION['cart_id'] = self::$_mCartId;
// Cookie will be valid for 7 days (604800 seconds)
                setcookie('cart_id', self::$_mCartId, time() + 604800);
            }
        }
    }
// Returns the current visitor's card id

    /**
     * @return mixed
     */
    public static function GetCartId()
    {
// Ensure we have a cart id for the current visitor
        if (!isset (self::$_mCartId))
            self::SetCartId();
        return self::$_mCartId;
    }
    public function slugify($string):string
    {
        $slugify=new Slugify(['regexp' => '/([^A-Za-z0-9]|-)+/']);

        $slugify->activateRuleSet('french');
        return $slugify->slugify($string);

    }
    /***************************************************************************************/
    /* PAGINATION
/***************************************************************************************/


    /**
     * @param $query
     * @param int $per_page
     * @param $get_page
     * @param int $page
     * @param string $url
     * @return array
     */
    public  function pagination($query, $get_page, $url, $page = 1, $per_page = 1): array
    {



        $total = (int)count($query);

        $adjacents = 2;

        $prevlabel = "Precédente";
        $nextlabel = "Suivante";
        $lastlabel = "Dernière";

        $page = ($page === 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;

        $lastpage = ceil($total / $per_page);


        $lpm1 = $lastpage - 1;
        return array('lastpage'=>$lastpage,'url'=>$url,'prev'=>$prev,'next'=>$next,'prevlabel'=>$prevlabel,
            'nextlabel'=>$nextlabel,'lastlabel'=>$lastlabel,'start'=>$start,'lpm1'=>$lpm1,'adjacents'=>$adjacents,'page'=>$page,
            'get_page'=>$get_page,'total'=>$total);


    }
    /**
     * @param $elem
     * @param $array
     * @return bool
     */
    public function in_multiarray($elem, $array):bool
    {
        while(current($array)!==false){
            if(current($array)===$elem){
                return true;
            }elseif (is_array(current($array))){
                if($this->in_multiarray($elem,current($array))){
                    return true;

                }
            }
            next($array);

        }
        return false;

    }

    /**
     * @param $contenu
     * @param $length
     * @return bool|string
     * la methode limitContenu nous permet de limiter le contenu d'une page
     */
    public function LimitContenu($contenu,$length){
        $ch2=substr($contenu,0 , $length)  ;
        $debut=strrpos($ch2,' ');
        $debut=substr($ch2,0,$debut).'[...]';
        return $debut;
    }

}