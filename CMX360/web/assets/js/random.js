var tamanyo_password				=	9;			// definimos el tamaño que tendrá nuestro password
var password_definitivo				=	'';


// f	unción que genera un número aleatorio entre los límites superior e inferior pasados por parámetro
function genera_aleatorio(i_numero_inferior, i_numero_superior) {
    var     i_aleatorio  =   Math.floor((Math.random() * (i_numero_superior - i_numero_inferior + 1)) + i_numero_inferior);
    return  i_aleatorio;
}
// función que genera un tipo de caracter en base al tipo que se le pasa por parámetro (mayúscula, minúscula, número, símbolo o aleatorio)
function genera_caracter(tipo_de_caracter){
    // hemos creado una lista de caracteres específica, que además no tiene algunos caracteres como la "i" mayúscula ni la "l" minúscula para evitar errores de transcripción
    var lista_de_caracteres	=	'$+=?@_23456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz';
    var caracter_generado	=	'';
    var valor_inferior		=	0;
    var valor_superior		=	0;

    switch (tipo_de_caracter){
        case 'minúscula':
            valor_inferior	=	38;
            valor_superior	=	61;
            break;
        case 'mayúscula':
            valor_inferior	=	14;
            valor_superior	=	37;
            break;
        case 'número':
            valor_inferior	=	6;
            valor_superior	=	13;
            break;
        case 'símbolo':
            valor_inferior	=	0;
            valor_superior	=	5;
            break;
        case 'aleatorio':
            valor_inferior	=	0;
            valor_superior	=	61;

    } // fin del switch

    caracter_generado	=	lista_de_caracteres.charAt(genera_aleatorio(valor_inferior, valor_superior));
    return caracter_generado;
} // fin de la función genera_caracter()


// función que guarda en una posición vacía aleatoria el caracter pasado por parámetro
function guarda_caracter_en_posicion_aleatoria(caracter_pasado_por_parametro){
    var guardado_en_posicion_vacia	=	false;
    var posicion_en_array			=	0;

    while(guardado_en_posicion_vacia	!=	true){
        posicion_en_array	=	genera_aleatorio(0, tamanyo_password-1);	// generamos un aleatorio en el rango del tamaño del password

        // el array ha sido inicializado con null en sus posiciones. Si es una posición vacía, guardamos el caracter
        if(array_caracteres[posicion_en_array] == null){
            array_caracteres[posicion_en_array]	=	caracter_pasado_por_parametro;
            guardado_en_posicion_vacia			=	true;
        }
    }
}


// función que se inicia una vez que la página se ha cargado
function generar_contrasenya() {

    // generamos los distintos tipos de caracteres y los metemos en un password_temporal
    while (letras_minusculas_conseguidas < numero_minimo_letras_minusculas) {
        caracter_temporal = genera_caracter('minúscula');
        guarda_caracter_en_posicion_aleatoria(caracter_temporal);
        letras_minusculas_conseguidas++;
        caracteres_conseguidos++;
    }

    while (letras_mayusculas_conseguidas < numero_minimo_letras_mayusculas) {
        caracter_temporal = genera_caracter('mayúscula');
        guarda_caracter_en_posicion_aleatoria(caracter_temporal);
        letras_mayusculas_conseguidas++;
        caracteres_conseguidos++;
    }

    while (numeros_conseguidos < numero_minimo_numeros) {
        caracter_temporal = genera_caracter('número');
        guarda_caracter_en_posicion_aleatoria(caracter_temporal);
        numeros_conseguidos++;
        caracteres_conseguidos++;
    }

    while (simbolos_conseguidos < numero_minimo_simbolos) {
        caracter_temporal = genera_caracter('símbolo');
        guarda_caracter_en_posicion_aleatoria(caracter_temporal);
        simbolos_conseguidos++;
        caracteres_conseguidos++;
    }

    // si no hemos generado todos los caracteres que necesitamos, de forma aleatoria añadimos los que nos falten
    // hasta llegar al tamaño de password que nos interesa
    while (caracteres_conseguidos < tamanyo_password) {
        caracter_temporal = genera_caracter('aleatorio');
        guarda_caracter_en_posicion_aleatoria(caracter_temporal);
        caracteres_conseguidos++;
    }

    // ahora pasamos el contenido del array a la variable password_definitivo
    for (var i = 0; i < array_caracteres.length; i++) {
        password_definitivo = password_definitivo + array_caracteres[i];
    }

    // indicamos los parámetros con los que hemos generado la contraseña

    // y ahora simplemente lo mostramos por pantalla
    console.log(password_definitivo);
}

    // e indicamos que al recargar la página se generará uno nuevo