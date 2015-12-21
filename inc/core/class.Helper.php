<?
/*
This class defines helper functions for view files
*/

class Helper {
    public static function formatDate($dateInput = null, $formatInput = null) {
        $date = new DateTime($dateInput);
        switch($formatInput) {
            case 'day':
                $format = 'M jS, Y';
                break;
            case 'compact':
                $format = 'm/d/Y';
                break;
            case 'small':
                $format = 'M j g:i:sa';
                break;
            case 'full':
                $format = 'F jS, Y @ g:i:sa T';
                break;
            default:
                $format = 'F jS, Y @ g:i:sa';
                break;
        }
        return $date->format($format);
    }
}