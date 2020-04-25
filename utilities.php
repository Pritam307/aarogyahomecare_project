<?php


function generateToken( $formName )
{
    $secretKey = '06IBTDfIxcKFVfWDmZO/z6mMZv4kHOU/WoBlDfkWuUg=';
    if ( !session_id() ) {
        session_start();
    }
    $sessionId = session_id();

    return sha1( $formName.$sessionId.$secretKey );
}

function checkToken( $token, $formName )
{
    return $token === generateToken( $formName );
}

?>
