<?php

// namespace App\Libraries;



class Router{

   private $routerController   = 'Pages';
   private $routerMethod       = 'index';
   private $routerParameter        = [];


    public function __construct()
    {
        /**==============================================
         **              FUNCTION construtora
         *?  Faz a chamada da Url para iniciar a validação das rotas?
         *@param $routerUrl - recebe a url e verifica se está vazia, caso esteja
         atribui ao indice 0 do vetor na variável $routerUrl
        
         *=============================================**/
        $routerUrl = $this->getUrl() ? $this->getUrl() : [0];


        /**======================
         *
         *@param $routerController - No bloco abaixo é realizada uma verificação a fim de identificar se o arquivo existe no diretório designado, caso existir o $routerController irá receber o indice em seu vetor.
         *========================**/

         if(file_exists('/app/Controllers/'.ucwords($routerUrl[0]).'.php')):
            $this->routerController = ucwords($routerUrl[0]);
            unset($routerUrl[0]);
         endif;

        // Chamando o arquivo PHP do controller
         require_once(URL_RAIZ.'app/Controllers/'.$this->routerController.'.php');
         
        // Instanciando o Controller para poder retornar ao valor default
        $this->routerController = new $this->routerController;

        /* 
        @param $routerMethod - No bloco abaixo é verificado se o Método existe no diretório designado
        */ 

        if(isset($routerUrl[1])):
            if(method_exists($this->routerController, $routerUrl[1])):
                $this->routerMethod = $routerUrl[1];
                unset($routerUrl[1]);
            endif;
        endif;

        // Verifica se existe indereço na URL, caso exista retorna um array com os valores passados nele senão retorna um array vazio
        //@param array_values() retorna todos os valores de um array
        $this->$routerParameter = $routerUrl ? array_values($routerUrl) : [];

        // call_user_func_array - Realiza a chamada de uma função com os parâmetros passados
        call_user_func_array([$this->routerController, $this->routerMethod], $this->routerParameter);


    }

    private function getUrl()
    {
         //o filtro FILTER_SANITIZE_URL remove todos os caracteres ilegais de uma URL
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
         //verifica se a url existe
        if(isset($url)):
        //trim — Retira espaço no ínicio e final de uma string
        //rtrim — Retira espaço em branco (ou outros caracteres) do final da string            
        //explode — Divide uma string em strings, retorna um array             
            $url = trim(rtrim($url, '/'));
            $url = explode('/',$url);
            return $url;

        endif;
    }
}