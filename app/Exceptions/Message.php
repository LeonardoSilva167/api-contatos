<?php

namespace App\Exceptions;

use Exception;

class Message extends Exception
{
    const MSG_NENHUM_REGISTRO_ENCONTRADO = 'Nenhum registro encontrado.';
    const AVISO = 'WARNING';
    const SUCESSO = 'SUCCESS';
    const ERRO = 'ERROR';
    
    const MSG_INSERIDO_SUCESSO = 'Inserido com sucesso!';
    const MSG_ALTERADO_SUCESSO = 'Alterado com sucesso!';
    const MSG_REMOVIDO_SUCESSO = 'Removido com sucesso!';
    const MSG_ALGO_ERRADO = 'Algo deu errado, por favor tente novamente!';
    
}