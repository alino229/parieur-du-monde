<?php


namespace App\Service;


use App\Entity\CounterValue;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class Statistique
{
    /***************************************************************************************/
    /**  CONNECT PDO  **/
    private $vpage;
    private $db;
    private $file_content;

    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var Security
     */
    private $security;

    public function __construct(EntityManagerInterface $em,Security $security)
    {
        $this->em = $em;
        $this->security=$security;
    }

    /****************************************************************************************/
    /**
     * @return mixed
     */
    public function chemin()
    {
        $router = $_SERVER['QUERY_STRING'];
        $page=explode('&',$router);
        $page=$page[0];
        return $page;

    }
    public function cheminId()
    {
        $ch1=explode('/',$this->chemin());
//        $ch2=explode('&',$ch1[1]);
//        $ch3=explode('=',$ch2[2]);
//        $ch4=$ch3[1];
//        return $ch4;

    }

    public function ip()
    {
        $ip = ip2long($_SERVER['REMOTE_ADDR']);

        return $ip;

    }


    /**
     * @return bool|string
     * cette fonction nous permet de savoir exactement le nombre de
     * visite sur l'ensembre des pages du site
     */
    public function nombrevisites()
    {
        $nb_visites = file_get_contents('./stats/compteur.txt');
        $nb_visites++;

        file_put_contents('./stats/compteur.txt',$nb_visites);
        return $nb_visites;
    }

    /**
     * @param $path
     * @param $id
     * la methode nombrevistesPage nous permet d'incrémenté le  contenu des fichiers
     * qui correspond à chaque page ouvert
     */
    public function nombrevisitesPage($path, $id)
    {
        $nb_visites = file_get_contents("./stats/$path/compteur$id.txt");
        $nb_visites++;

        file_put_contents("./stats/$path/compteur$id.txt",$nb_visites);
        return $nb_visites;
    }
/*
    public function mostVisites(){
        $manager=new Manager();
        $home=$manager->home();
        $tab=$manager->countResult('SELECT * FROM home');
        for($i=0;$i<$tab;$i++){

            foreach ($home[$i] as $value){
                $tab1=array();
                $tab1[]=$this->returnVisitesPage('stats_home',$value);

                return $tab1;
            }

        }

    }*/

    /**
     * @param $path
     * @param $id
     * @return bool|string
     * la methode returnVisitePage nous retourn le nombre de visite par page
     * c'est-à-dire le contenu des fichier
     */
    public function returnVisitesPage($path, $id){
        //$nb_visites = file_get_contents("./stats/$path/compteur$id.txt");

        return $this->file_content;

    }

    /**
     * @return array
     * nombre de visites aujourd'hui ;
     *garder en mémoire les nombres de visites de chaque jour ;
     * afficher le nombre maximum de visites en un jour suivi de la mention « Établi le ...» ;
     *faire la moyenne du nombre de visites par jour.
     */
//   /* public function nombrevisiteparjour()
//    {
//        //ETAPE 1 - Affichage du nombre de visites d'aujourd'hui
//        $retour_count = 'SELECT COUNT(*) AS nbre_entrees FROM visites_jour WHERE date=CURRENT_DATE()';//On compte le nombre d'entrées pour aujourd'hui
//        $this->db->query($retour_count);//Fetch-array
//        $this->db->execute();
//        $donnees_count=$this->db->single();
//
//        // On affiche tout de suite pour pas le retaper 2 fois après
//        if ($donnees_count->nbre_entrees==0)//Si la date d'aujourd'hui n'a pas encore été enregistrée (première visite de lajournée)
//        {
//            $req = 'INSERT INTO visites_jour(visites, date) VALUES (1, CURRENT_DATE());';//On rentre la date d'aujourd'hui et on marque 1 comme nombre de visites.
//            $this->db->query($req);
//            $this->db->execute();
//
//            //On affiche une visite car c'est la première visite de la journée
//        } else {//Si la date a déjà été enregistrée
//            $retour = 'SELECT visites FROM visites_jour WHERE date=CURRENT_DATE()';//On sélectionne l'entrée qui correspond à notre date
//            $this->db->query($retour);
//            $this->db->execute();
//            $donnee = $this->db->single();
//            $visites = $donnee->visites;//Incrémentation du nombre de visites
//            $req = 'UPDATE visites_jour SET visites =:visites + 1 WHERE date=CURRENT_DATE()';
//            ///Update dans la base de données
//            $this->db->query($req);
//            $this->db->bind(':visites',$visites);
//            $this->db->execute();
//            $visites=$visites+1;
//            //Enfin, on affiche le nombre de visites d'aujourd'hui !
//            $this->db->close();
//
//        }
//
//
//        //ETAPE 2 - Record des connectés par jour
//        $retour_max = 'SELECT visites, date FROM visites_jour ORDER BY visites DESC LIMIT 0, 1';//On sélectionne
//        // l'entrée qui a le nombre visite le plus important
//        $this->db->query($retour_max);
//        $this->db->execute();
//
//        $donnees_max = $this->db->single();
//        $record_visite = $donnees_max->visites;
//
//        $record_date = $donnees_max->date;//On l'affiche ainsi que la date à laquelle le record a été établi
//        $this->db->close();
//        //ETAPE 3 - Moyenne du nombre de visites par jour
//        //Nombre de visites
//        /*(pour éviter les bugs on ne prendra pas le nombre du premier
//         exercice, mais celui-ci reste utile pour être affiché sur toutes les pages
//        car il est plus rapide, contrairement à $total_visites dont on ne se servira que pour la
//         page de stats)*/
//
//        //Nombre de jours enregistrés dans la base
//        $total_visites = 'SELECT SUM(visites) AS visites_total FROM visites_jour ';
//        $this->db->query($total_visites);
//        $this->db->execute();
//
//
//        $total_visites = $this->db->single();
//        $total_visites = $total_visites->visites_total;
//
//
//        $total_jours = 'SELECT COUNT(*) AS total_jours FROM visites_jour ';
//
//        $this->db->query($total_jours);
//        $this->db->execute();
//
//        $total_jours = $this->db->single();
//        $this->db->close();
//
//
//        $total_jours = $total_jours->total_jours;
//
//        $moyenne =(int) ($total_visites / $total_jours);//on affiche la moyenne
//        // nombre de visite  sur les 7 derniers jours
//        $visite_hebdo="SELECT SUM(visites) AS visites_hebdo FROM visites_jour LIMIT 0,7";
//        $this->db->query($visite_hebdo);
//        $this->db->execute();
//        $visite_hebdomadaire=$this->db->single()->visites_hebdo;
//        // nombre de visite  sur les 30 derniers jours
//
//        $visite_men="SELECT SUM(visites) AS visites_men FROM visites_jour LIMIT 0,30";
//        $this->db->query($visite_men);
//        $this->db->execute();
//        $visite_men=$this->db->single()->visites_men;
//        $visites = isset($visites) ? $visites : 1;
//        $this->db->close();
//
//
//        return array('moyenne' => $moyenne, 'total_jour' => $total_jours, 'total_visites' => $total_visites,
//            'record_visite' => $record_visite, 'record_date' => $record_date, 'visites' => $visites,'visite_hebdo'=>$visite_hebdomadaire,
//            'visite_men'=>$visite_men);
//    }*/

    /**
     * @return mixed
     * affichage du nombre de visiteurs connectés ;
     *affichage du record du nombre de connectés suivi de la date où il a été établi ;
     *affichage de la liste des connectés avec leurs IP et la page qu'ils visitent (il est déconseillé d'afficher les IP des visiteurs
     * publiquement, on préfèrera séparer cette partie dans le panel admin).
     */
    public function nbvisiteurconnecter()
    {
        $page = $_SERVER['PHP_SELF'];
// ip-protection in seconds
        $counter_expire = 300;


// ignore agent list
        $counter_ignore_agents = array('bot', 'bot1', 'bot3');

// ignore ip list
        $counter_ignore_ips = array('127.0.0.2', '127.0.0.3');

// get basic information
        $request = Request::createFromGlobals();
        $counter_agent = $_SERVER['HTTP_USER_AGENT'];
        $counter_ip = ($_SERVER['REMOTE_ADDR']);
        $counter_time = time();
        $ignore = false;
        $sql = $this->em->getRepository(CounterValue::class)
            ->findOne();
        $CounterValue=new CounterValue();

        // fill when empty
        if ($sql==null) {
            $CounterValue->setDayId(date("z") );
            $CounterValue->setDayValue(1 );
            $CounterValue->setYesterdayId((date("z") - 1));
            $CounterValue->setYesterdayValue(date("z") );
            $CounterValue->setWeekId(date("z") );
            $CounterValue->setWeekValue(date("z") );
            $CounterValue->setYearId(date("z") );
            $CounterValue->setYearValue(date("z") );
            $CounterValue->setYearValue(date("Y") );
            $CounterValue->setRecordValue(1 );
            $CounterValue->setRecordDate(NOW());
            $CounterValue->setAllValue(date("z") );
            $sql = "INSERT INTO `counter_values` (`id`, `day_id`, `day_value`, `yesterday_id`, `yesterday_value`, `week_id`, `week_value`, `month_id`, `month_value`, `year_id`, `year_value`, `all_value`, `record_date`, `record_value`) VALUES ('1', '" . date("z") . "',  '1', '" . (date("z") - 1) . "',  '0', '" . date("W") . "', '1', '" . date("n") . "', '1', '" . date("Y") . "',  '1',  '1',  NOW(),  '1')";


            $this->em->getRepository(CounterValue::class)
                ->findOne();
            $ignore = true;
        }

        $row= $this->db->resultset();

        $row= $row[0];


        $record_value = $row->record_value;

        $day_value = $row->day_value;
        $day_id = $row->day_id;
        $yesterday_id = $row->yesterday_id;
        $yesterday_value = $row->yesterday_value;
        $week_id = $row->week_id;
        $week_value = $row->week_value;
        $month_id = $row->month_id;
        $month_value = $row->month_value;
        $year_id = $row->year_id;
        $year_value = $row->year_value;
        $all_value = $row->all_value;
        $record_date = $row->record_date;
        // check ignore lists
        $length = sizeof($counter_ignore_agents);
        for ($i = 0; $i < $length; $i++) {
            if (substr_count($counter_agent, strtolower($counter_ignore_agents[$i]))) {
                $ignore = true;
                break;
            }
        }

        $length = sizeof($counter_ignore_ips);
        for ($i = 0; $i < $length; $i++) {
            if ($counter_ip == $counter_ignore_ips[$i]) {
                $ignore = true;
                break;
            }
        }


        // delete free ips
        if ($ignore == false) {
            $sql = "DELETE FROM counter_ips WHERE unix_timestamp(NOW())-unix_timestamp(visit) >= $counter_expire";
            $this->db->query($sql);
            $this->db->execute();
            $this->db->close();
        }

        // check for entry
        $req= "SELECT COUNT(*) FROM counter_ips WHERE ip='$counter_ip'";
        $this->db->query( $req);
        $this->db->execute();
        $counter=$this->db->fetchColumn();

        $this->db->close();


        if ($counter !=0 && $ignore == false) {
            $chemin=$this->chemin();
            $sql = "update counter_ips set visit = NOW(),page='$chemin' where ip ='$counter_ip'";
            $this->db->query($sql);
            $this->db->execute();



            if ($this->db->rowCount() != 0) {
                $ignore = true;
            }
        }

        else {
            // insert ip
            $sql = "INSERT INTO counter_ips (ip, visit,page) VALUES (:counter_ip, NOW(),:page)";
            $this->db->query($sql);
            $this->db->bind(":page", $this->chemin());
            $this->db->bind(":counter_ip", $counter_ip);
            $this->db->execute();
            $this->db->close();
        }


        // online?
        $sql = "SELECT count(*) FROM counter_ips";
        $this->db->query($sql);
        $this->db->execute();
        $online = $this->db->fetchColumn();
        $this->db->close();

        // add counter
        if ($ignore == false) {
            // yesterday
            if ($day_id == (date("z") - 1)) {
                $yesterday_value = $day_value;
            } else {
                if ($yesterday_id != (date("z") - 1)) {
                    $yesterday_value = 0;
                }
            }
            $yesterday_id = (date("z") - 1);

            // day
            if ($day_id == date("z")) {
                $day_value++;
            } else {
                $day_value = 1;
                $day_id = date("z");
            }

            // week
            if ($week_id == date("W")) {
                $week_value++;
            } else {
                $week_value = 1;
                $week_id = date("W");
            }

            // month
            if ($month_id == date("n")) {
                $month_value++;
            } else {
                $month_value = 1;
                $month_id = date("n");
            }

            // year
            if ($year_id == date("Y")) {
                $year_value++;
            } else {
                $year_value = 1;
                $year_id = date("Y");
            }

            // all
            $all_value++;

            // neuer record?
            if ($day_value > $record_value) {
                $record_value = $day_value;
                $record_date = date("Y-m-d H:i:s");
            }

            // speichern und aufräumen
            $sql = "UPDATE counter_values SET day_id = '$day_id', day_value = '$day_value', yesterday_id = '$yesterday_id', yesterday_value = '$yesterday_value', week_id = '$week_id', week_value = '$week_value', month_id = '$month_id', month_value = '$month_value', year_id = '$year_id', year_value = '$year_value', all_value = '$all_value', record_date = '$record_date', record_value = '$record_value' WHERE id = 1";
            $this->db->query($sql);
            $this->db->execute();
            $this->db->close();
        }
        return     $online;


    }

    /**
     * @return mixed
     *le record ;
     *la date à laquelle il a été établi.
     */
   /* public function record()
    {
        $f_records = fopen('stats/records.txt', 'r+');//On ouvre le fichier
        $dernierRecord = fgets($f_records);//On prend sa première ligne
        $dernierRecord = explode(' ', $dernierRecord);
        //Elle va permettre de séparer notre fichier en 2 parties :
        //Le record (0) dans $dernierRecord[0] et la date (0/0/0) dans $dernierRecord[1]
        //Ici on va avoir besoin de la variable $visiteurs_connectes de l'exercice précédent
        if ($this->nbvisiteurconnecter() > $dernierRecord[0])//Si le nombre deconnecté est plus important que le record actuel
        {
            rewind($f_records);//On "rebobine " le fichier
            $ligne = $this->nbvisiteurconnecter() . ' ' . date('d/m/Y');
            fwrite($f_records, $ligne);//On écrit la ligne sous la forme fixée au départ
            return array('record' => $this->nbvisiteurconnecter(), 'date' => date('d/m/Y'));
        } else {//sinon, on affiche le record du fichier.

            return array('record' => $dernierRecord[0], 'date' => $dernierRecord[1]);
        }
// On ferme la balise puis le fichier
        fclose($f_records);
    }*/

    /**
     * @return string
     * l'IP du visiteur ;
     *la page qu'il visite.
     */
    /*public function affichelisteconnecter()
    {

        $liste = $this->nbvisiteurconnecter();

        $req = 'SELECT ip, page FROM connectes';
        $this->db->query($req);
        $this->db->execute();
        $donnees = $this->db->single();
        while ($donnees) {
            return long2ip($donnees['ip']) . ' : ' . $donnees['page'];
        }


    }*/

    /**
     * @return string
     * vérifier que le HTTP REFERER ne vient pas d'une de vos pages pour éviter que quelqu'un arrive sur votre index alors
     * qu'il était déjà sur le site ;
     * vérifier que l'utilisateur n'a pas ouvert deux fois un lien par inadvertance en mettant un timeout de 5 minutes ;
     * sinon, enregistrer le HTTP REFERER et l'IP du visiteur dans une base de données ;
     * ce n'est pas obligatoire, mais un champ ID ne serait pas de trop pour gérer vos stats ensuite ;
     * vous aurez besoin d'un autre champ, lisez bien l'énoncé.
     */
    /*public function provenance()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {

            if (strpos(strtolower($_SERVER['HTTP_REFERER']), 'https://parieur-du-monde.000webhostapp.com/') ===
                0
            )//Si le visiteur provient d'un autre site.
            {
                $heureAffichage = time() - 60 * 5;//Le temps qu'il était il y a 5 minutes

//On sélectionne toutes les entrées ayant l'IP du visiteur pour lesquelles l'heure enregistrée est plus grande que l'heure qu'il
                //était il y a 5 minutes.
                $req = 'SELECT COUNT(*) AS nbre_entrees FROM provenance WHERE ip=\'' . ip2long($_SERVER['REMOTE_ADDR']) .
                    '\' AND UNIX_TIMESTAMP(heure) > ' . $heureAffichage;
                $this->db->query($req);
                $this->db->execute();
                $donnees = $this->db->single();
                if ($donnees['nbre_entrees'] == 0)// S'il n'y a aucune entrée qui a notre IP et qui a été enregistrée il y a 5 minutes
                {
                    $ip = ip2long($_SERVER['REMOTE_ADDR']);

                    $referer = ($_SERVER['HTTP_REFERER']);
                    $req = "INSERT INTO provenance(id, ip,http_referer, heure) VALUES ('',':ip',':referer','.CURRENT_TIMESTAMP().');";//Insérer une nouvelle entrée
                    $this->db->query($req);
                    $this->db->bind(':ip' , $ip );
                    $this->db->bind(':referer',$referer);
                    $this->db->execute();
                }
            } else {
                $provenance = 'tu proviens de mon site ';
                return $provenance;
            }
            $this->db->close();
        } else {
            $http = 'le http referer ne fonctionne pas';
            return $http;
        }
    }*/

    /**
     *
     */
   /* public function provenanceaffichageurl()
    {

        if (!empty($_GET['url'])) {
            $url = ($_GET['url']);
            $req = 'SELECT http_referer,COUNT(http_referer) AS nb_vues_tot FROM provenance WHERE
                    http_referer LIKE \'http_//' . $url . '%\' GROUP BY http_referer';
            $this->db->query($req);
            $this->db->execute();

            while ($donnees = $this->db->single())
                echo $donnees->nb_vues_tot. ' <a href="' .
                    $donnees->http_referer . '">' . $donnees->http_referer .
                    '</a><br/>';
            return array('nb_vues_total' => $donnees->nb_vues_tot, 'http_referer' => $donnees->http_referer);
        } else {
            $req = 'SELECT http_referer,COUNT(http_referer) AS nb_vues_tot FROM provenance GROUP BY
http_referer';
            $url = array();
            $this->db->query($req);
            $this->db->execute();
            while ($donnees = $this->db->single()) {
                if ($donnees->http_referer == '') {
                    $donnees->http_referer= 'URL directe';
                    echo $donnees->http_referer. $donnees->nb_vues_tot .
                        '<br/>';
                } else {
                    $referer = explode('/', $donnees->http_referer);
                    if (array_key_exists($referer[2], $url))
                        $url[$referer[2]] = $url[$referer[2]] + $donnees['nb_vues_tot'];
                    else
                        $url[$referer[2]] = $donnees->nb_vues_tot;
                }
            }
            foreach ($url as $key => $value)
                echo '<a href="admin.php?url=' . $key . '">' . $key . '</a>' .
                    $value . '<br/>';
        }
        $this->db->close();


    }*/

    /*
     *un visiteur va sur une page ;
     *si l'heure (ex : 12) et la date (ex : 2010-01-04) de l'instant où il va sur la page ne sont pas dans une entrée présente dans la
     *table, on la crée et on initialise son "Nombre de visites" à 1 ;
     *si au contraire l'entrée (date+heure du moment où il se connecte) est présente, on incrémente le nombre de visites./**
      **/
   /* public function affluence()
    {

        $heure = date('H');
        $retour_afflu = 'SELECT COUNT(*) AS maintenant FROM affluence WHERE date = CURRENT_DATE() AND heure = '
            . $heure;
        $this->db->query($retour_afflu);
        $this->db->execute();

        $donnees_afflu = $this->db->single();
        if ($donnees_afflu->maintenant == 0)//Si l'heure n'a pas encore été enregistrée
        {
            $req = 'INSERT INTO affluence(heure, date,visites) VALUES (' . $heure . ', CURRENT_DATE(), 1)';//On rentre la date et l'heure et on marque 1 comme nombre de visites.
            $this->db->query($req);
            $this->db->execute();
        } else {
            $req = 'UPDATE affluence SET visites = visites +1 WHERE date = CURRENT_DATE() AND heure = ' . $heure;
            //On rentre l'heure et la date d'aujourd'hui et on marque 1 comme nombre de
            //visites.
            $this->db->query($req);
            $this->db->execute();
        }
        $this->db->close();


    }*/

   /*
     * @return mixed
     */
    /*public function afficheaffluence()
    {

        $req = "SELECT SUM(visites) AS visites FROM affluence WHERE date != CURRENT_DATE() GROUP BY  heure 
                   ORDER BY heure ASC";
        $this->db->query($req);
        $this->db->execute();
        $dat = $this->db->single();

        $affluance = $dat->visites;
        $this->db->close();

        return $affluance;
    }*/

    /**
     * @return mixed
     */
    /*public function listUsers() {

        $req = "SELECT COUNT(*) AS Tuser FROM user";
        $this->db->query($req);
        $this->db->execute();
        $Tuser =$this->db->single();
        $Tuser=$Tuser->Tuser;
        $this->db->close();
        return $Tuser;
    }*/
}