<?php
    // incluir a lib fo facebook
    require_once 'fbapi/facebook.php';

    // Cria a instancia da aplicacao, informando o appid e o secret
    $facebook = new Facebook(array(
      'appId'  => '431761743539156',
      'secret' => '456e81d9dd157504db2b37945c530b9d',
    ));

    // obtem o id do usuario
    $user = $facebook->getUser();

    if ($user) 
    { // usuario logado
        try 
        {
            // Obtem dados do usuario logado
            $user_profile = $facebook->api('/me');

            // exibe foto do usuario logado
            echo "<img src=\"https://graph.facebook.com/$user/picture\">";

            // printa os dados do profile do usuario logado
            print_r($user_profile);

        } 
        catch (FacebookApiException $e) 
        {
            error_log($e);
            $user = null;
        }
    } 
    else 
    {
        // usuario nao logado, solicitar autenticacao
        $loginUrl = $facebook->getLoginUrl();
        echo "<a href=\"$loginUrl\">Facebook Login</a><br />";
        echo "<strong><em>Voc&ecirc; n&atilde;o esta conectado..</em></strong>";
    }
?>