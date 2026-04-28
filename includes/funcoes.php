<?php 

    function statusTexto($status){

        switch($status){
            case 1: return "Pendente";
            case 2: return "Em endamento";
            case 3: return "Finalizado";
            case 4: return "Canselada";
            case 5: return "Recusada";
            default: return "Desconhecido";

        }

    }

?>