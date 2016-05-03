<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

	// ACTIVATION ITEMS
    'newUsername'		=> ':username',
    'newUserEmail'		=> ':email',
    'newUserWelcome'	=> 'Bienvenido :username',
	'attempsUsed'		=> 'Usted tiene :remaining intentos restantes',
	'attempsDepleted'   => 'Intento de activación :attempts veces',
	'sentEmail'			=> 'Hemos enviado un E-mail a :email',
	'clickInEmail'		=> 'Por favor, haga clic en el enlace en él para activar su cuenta',
	'anEmailWasSent'	=> 'Un correo electrónico fue enviado a :email el :date',
	'clickHereResend'	=> 'Haga clic aquí para volver a enviar el E-mail de activación',
	'successActivated'	=> 'Felicitaciones, su cuenta ha sido activada',
	'unsuccessful'		=> 'Su cuenta no se pudo activar; inténtelo de nuevo',
	'notCreated'		=> 'Su cuenta no se ha podido crear; inténtelo de nuevo',
	'tooManyEmails'		=> 'Demasiados correos de activación han sido enviados a :email',
	'welcome-activate'	=> 'Por favor Active su cuenta.',
	'login_link_another'=> '&nbsp;&nbsp;Inicia sesión con otra cuenta',
	'loggedOutLocked'	=> 'Inténtelo de nuevo con una dirección de correo electrónico diferente',
	'tryAnother'		=> 'Iniciar sesión con un E-mail diferente',

	// LABELS
	'whoops'			=> 'Ups!',
	'someProblems'		=> 'Hubo algunos problemas con su entrada.',
	'email'				=> 'Dirección de E-mail',
	'password'			=> 'Contraseña',
	'rememberMe'		=> '&nbsp;&nbsp;Recuérdame',
	'login'				=> 'Ingrese para iniciar la sesión',
	'forgot_icon'		=> 'unlock-alt',
	'forgot'			=> '&nbsp;&nbsp;&nbsp;&nbsp;Olvidé mi contraseña',
	'forgot_message'	=> 'Problemas con la contraseña?',
	'name'				=> 'Username',
	'first_name'		=> 'Nombre',
	'last_name'			=> 'Apellido',
	'confirmPassword'	=> 'Confirmación de Contraseña',
	'register_icon'		=> 'user-plus',
	'register'			=> '&nbsp;Registrar un nuevo usuario',
	'register_submit'	=> '&nbsp;Registrar',
	'login-button'		=> '&nbsp;Ingresar',

	// PLACEHOLDERS
	'ph_name'			=> 'Nombre de Usuario',
	'ph_email'			=> 'E-mail',
	'ph_firstname'		=> 'Nombre',
	'ph_lastname'		=> 'Apellido',
	'ph_password'		=> 'Contraseña',
	'ph_password_conf'	=> 'Confirmación de Contraseña',

	// USER FLASH MESSAGES
	'sendResetLink'		=> 'Enviar link para recordar la contraseña',
	'resetPassword'		=> 'Restablecer la contraseña',
	'loggedIn'			=> 'Usted ingreso en el sistema!',
	'loggedOut'			=> 'Salida correcta del sistema',
    'failed' 			=> 'Estos datos no coinciden con nuestros registros',
    'throttle' 			=> 'Demasiados intentos de conexión. Por favor, inténtelo de :seconds segundos',

	// EMAIL LINKS
	'pleaseActivate'	=> 'Por favor Active su cuenta.',
	'clickHereReset'	=> 'Haga clic aquí para restablecer su contraseña: ',
	'clickHereActivate'	=> 'Haga clic aquí para activar su cuenta: ',

	// REGISTER FOOTER PAGE LABEL
	'login_link_icon'	=> 'user',
	'login_link'		=> '&nbsp;&nbsp;&nbsp;Ya tengo una cuenta',

];

/*
{{ Lang::get('auth.tooManyEmails',
	['email' => $email] ) }}
//*/