<?php
/**     
 * Author: skonealone <skonealone@gmail.com>
 * Date: 4/16/2018
 *
 * */       
            
$dt = "2015-04-12"; 

            
    $row = createSuperMagicSquare($dt);

print_r($row);
            

    /**     
     * Srinivasa Ramanujan --> "The man who knew infinity" [ https://en.wikipedia.org/wiki/Srinivasa_Ramanujan ] 
     * This function use Srinivasa Ramanujan magic-square (2x2) formula to calculate Special Occasion Date
     *      
     * Ref: 
     *      http://www.math.mcgill.ca/styan/Beamer3-18jan12-opt.pdf
     *      https://en.wikipedia.org/wiki/Magic_square
     *      
     * Take valid string date and return 2x2 rows in array along with sum scope of each row
     *  
     * @param string $dt
     * @return array  $magicRow
     *
     **/
    function createSuperMagicSquare($dt) {

        $magicRows = array();
        
        if(isDate($dt)) {
        
            $dd = date("j", strtotime($dt));
            $mm = date("n", strtotime($dt));
            $year = date("Y", strtotime($dt));

            $y1 = substr($year, 0, 2);
            $y2 = substr($year, 2, 4);

            // Formula Start....... 
            $magicRows[0]['row'] = array($dd, $mm, $y1, $y2);
            $magicRows[0]['scope'] = array_sum($magicRows[0]['row']);

            $magicRows[1]['row'] = array($y2 + 1, $y1 - 1, $mm - 3 , $dd + 3);
            $magicRows[1]['scope'] = array_sum($magicRows[1]['row']);

            $magicRows[2]['row'] = array($mm - 2, $dd + 2, $y2 + 2 , $y1 - 2);
            $magicRows[2]['scope'] = array_sum($magicRows[2]['row']);

            $magicRows[3]['row'] = array($y1 + 1, $y2 - 1, $dd + 1 , $mm - 1);
            $magicRows[3]['scope'] = array_sum($magicRows[3]['row']);

            // Formula End...........
        }
        return $magicRows;
    }

    /**
     * Check valid date
     * Ref: http://php.net/manual/en/function.date-create-from-format.php
     **/
    function isDate($dt, $format = "Y-m-d") {
        date_default_timezone_set('UTC');
        $d = DateTime::createFromFormat($format, $dt);
        return $d && $d->format($format) === $dt;

    }
