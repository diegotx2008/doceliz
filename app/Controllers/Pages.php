<?php


//Não é preciso instanciar a classe porque ela já herda os métodos do objeto/classe Core
class Pages extends Core{


    public function Index()
    {
        $viewData = [
            'tituloPagina' => 'Página Inicial'
        ];
        $this->view('/app/View/index.php', $viewData);
    }
}