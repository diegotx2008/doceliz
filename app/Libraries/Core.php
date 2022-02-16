<?php

// Controllador base que carrega os models e views

class Core{

    // carrega os models
    public function model($model)
    {
        // requere o arquivo model
        require_once '../../app/Models/'.$model.'.php';
        //instancia o model
        return new $model;
    }

    //carrega as views
    public function view($view, $dados =[])
    {
        $viewFile = ('../View/'.$view.'.php');

        if(file_exists($viewFile)):
            //chama a view se ela existir
            require_once $viewFile;
        else:
            die('Arquivo de view não encontrado');
        endif;
    }
}