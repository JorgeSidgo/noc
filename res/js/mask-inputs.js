$(document).ready(function(){
	$('.dui').mask('00000000-0');
	$('.fecha').mask('0000-00-00');
	$('.telefono').mask('0000-0000');
        $('.anio').mask('0000');
        //El de correo es necesario para no admitir tildes o diéresis, etc.
        $('.correoElectronico').mask("A", {translation: {
		"A": { pattern: /[\w@\-.+]/, recursive: true }
	}
});
});