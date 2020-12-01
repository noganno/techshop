<?php



namespace soft\i18n;



use kartik\helpers\Html;

use Yii;

use yii\i18n\Formatter;



class SFormatter extends Formatter

{



    public function asStatus($value)

    {

        switch ($value) {
            case 1:
                return "<span class='badge badge-primary'>" . Yii::t('app', 'Active') . "</span>";
                break;
            case 0:
                return "<span class='badge badge-danger'>" . Yii::t('app', 'Inactive') . "</span>";
                break;
            default:
                return $value;
                break;
        }
    }



    public function asDollar($value)
    {
        return $this->asDecimal($value, 1) . "$";
    }


    public function asSum($value)
    {
        if($value == null){
            return  "";
        }
        return $this->asInteger($value) . " " . Yii::t('app', "sum");
    }



    public function asLittleImage($value, $width = '150px')

    {

        $options['width'] = $width;

        return $this->asImage($value, $options);

    }



    public function asBool($value, $text1 = 'Yes', $text2 = 'No')

    {

        if ($value) {

            return Html::badge($text1, ['class' => 'badge-primary']);

        } else {

            return Html::badge($text2, ['class' => 'badge-danger']);

        }

    }

    public function asShortText($value, $length=150, $end = " ...")
    {
        $text = strip_tags($value);
        if (strlen($text) < $length){
            return $text;
        }
        return substr(strip_tags($text), 0, $length) . $end;
    }

    /**
     * @param $value timestapm
     **/
    public function asDateUz($value=null)
    {
        if ($value == null){
            return null;
        }
        $month = Yii::t('app', date('M', $value));

        return date('d', $value)."-".$month."-".date('Y', $value);
    }

    /**
     * @param $value timestapm
     **/
    public function asFullDateUz($value=null)
    {
        if ($value == null){
            return null;
        }
        $month =  $this->fullMonthName( date('m', $value));
        return date('d', $value)."-".$month."-".date('Y', $value);
    }

    /**
     * @param $value timestapm
     **/
    public function asTimeUz($value=null)
    {
        if ($value == null){
            return null;
        }

        return date('H:i', $value);
    }

    /**
     * @param $value timestapm
     **/
    public function asDateTimeUz($value=null)
    {
        if ($value == null){
            return null;
        }

        return $this->asDateUz($value)." ".$this->asTimeUz($value);
    }

    /**
     * @param $value timestapm
     **/
    public function asFullDateTimeUz($value=null)
    {
        if ($value == null){
            return null;
        }

        return $this->asFullDateUz($value)." ".$this->asTimeUz($value);
    }
    
    /**
    * @param string $value phone number, like "+998911234567", or "911234567", or "998911234567"
    * @return string phone number with operator code, like "911234567"
    */
    
    public function asShortPhoneNumber($value)
    {
        
        
        $phoneNumber = str_replace( '+', "", $value);

        if (strlen($phoneNumber) == 12){
            $phoneNumber = substr( $phoneNumber, 3);
        }  
        return $phoneNumber;
    }

    public function fullMonthName($monthNumber=0)
    {
        switch ($monthNumber){

            case '01' : return Yii::t('app', 'January');
                case '02' : return Yii::t('app', 'February');
            case '03' : return Yii::t('app', 'March');
            case '04' : return Yii::t('app', 'April');
            case '05' : return Yii::t('app', 'May');
            case '06' : return Yii::t('app', 'June');
            case '07' : return Yii::t('app', 'July');
            case '08' : return Yii::t('app', 'August');
            case '09' : return Yii::t('app', 'September');
            case '10' : return Yii::t('app', 'October');
            case '11' : return Yii::t('app', 'November');
            case '12' : return Yii::t('app', 'December');
            default: return false;


        }
    }


}



?>