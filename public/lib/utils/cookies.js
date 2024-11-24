

function setCookie(nome, valor, diasParaExpirar) {

    // Cria uma data de expiração
    var dataExpiracao = new Date();
    dataExpiracao.setTime(dataExpiracao.getTime() + (diasParaExpirar * 24 * 60 * 60 * 1000));

    // Codifica o valor do cookie para garantir que ele seja seguro
    valor = encodeURIComponent(valor);

    // Cria a string do cookie
    var cookie = nome + "=" + valor + ";expires=" + dataExpiracao.toUTCString();

    // Define o cookie
    document.cookie = cookie;
}


function getCookie(cookieName) {
    // Split the cookies string into an array of individual cookies
    var cookies = document.cookie.split(';');

    // Iterate through the cookies to find the one with the specified name
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim(); // Remove whitespace
        // Check if the cookie starts with the desired name
        if (cookie.startsWith(cookieName + '=')) {
            // Extract and return the cookie value
            return cookie.substring(cookieName.length + 1); // Add 1 to skip the '=' character
        }
    }
    // Return null if the cookie was not found
    return null;
}