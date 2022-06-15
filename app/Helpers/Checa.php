<?php 

class Checa {


    //Regex para receber apenas letras
    public static function checarNome($nome) {
        if(!preg_match('/^([áÁàÀãÃâÂéÉèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+((\s[áÁàÀãÃâÂéÉèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+)?$/',$nome)){
            return true;
        } else {
            return false;
        }
    }


    //Filtro para garantir que é um email válido
    public static function checarEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        } else{
            return false;
        }
    }


    //Função para checar se é uma data válida. O html 5 já faz esse tratamento no front. Veio como uma camada a mais
    public static function checarData($data){

        $mes = date('m', strtotime($data));
        $dia = date('d', strtotime($data));
        $ano = date('Y', strtotime($data));
        
        
        if(!checkdate($mes, $dia, $ano)){
            return true;
        } else{
            return false;
        }
    }

}


