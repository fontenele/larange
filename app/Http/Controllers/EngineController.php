<?php namespace App\Http\Controllers;


class EngineController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    public function view($module, $template = null) {
        $html = implode('/', explode('|', $module));
        if($template) {
            $html.= "/{$template}";
        }

        if(view()->exists($html)) {
            return view($html);
        }

        return '<div>Template ' . $html . ' dont exists!</div>';
    }

    public function js($module, $file = null) {
        header("Content-type: text/javascript");

        $module = implode('/', explode('|', $module));
        $js = public_path() . "/js/controllers/{$module}";

        if($file) {
            $js.= "/{$file}";
        }

        if(file_exists($js)) {
            print file_get_contents($js);
        } else {
            echo 'console.log("JS file ' . $js . ' dont exists!")';
        }
        exit(0);
    }


}