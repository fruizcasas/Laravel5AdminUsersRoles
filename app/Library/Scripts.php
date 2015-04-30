<?php namespace App\Library;


use App;


class Scripts
{

    static public function Select2($items)
    {
        $result = '';
        $result .= '<script src="'.asset('/select2/js/select2.min.js').'"></script>'.PHP_EOL;
        $result .= '<script src="'.asset('/select2/js/i18n/'.App::getLocale().'.js').'"></script>'.PHP_EOL;
        $result .= '<script type="text/javascript">'.PHP_EOL;

         foreach ($items as $key => $placeholder) {
             $result .=
                 "  $('#$key').select2({" .PHP_EOL.
                 "       placeholder: '$placeholder'," .PHP_EOL.
                 "       language: '" . App::getLocale() . "'" .PHP_EOL.
                 "   });".PHP_EOL;
         }
        $result .= '</script>'.PHP_EOL;

        return $result;
    }

    static public function Datepicker($items)
    {
        $result = '';
        $result .= '<script src="'.asset('/datepicker/js/bootstrap-datepicker.js').'"></script>'.PHP_EOL;
        $result .= '<script src="'.asset('/datepicker/js/locales/bootstrap-datepicker.'. App::getLocale() . '.js').'" charset="UTF-8"></script>'.PHP_EOL;
        $result .= '<script type="text/javascript">'.PHP_EOL;

        foreach ($items as $item) {
            $result .=
                "  $('#$item').datepicker({" .PHP_EOL.
                "       language: '" . App::getLocale() . "'," .PHP_EOL.
                "       format: 'yyyy-mm-dd'" .PHP_EOL.
                "   });".PHP_EOL;
        }
        $result .= '</script>'.PHP_EOL;

        return $result;
    }

}