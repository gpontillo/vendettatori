function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(cName, cValue, expDays = 30) {
    let date = new Date();
    date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
}

function toggleSource(id) {
    let oldValue = getCookie(id + '-source') === "true";
    let value = !oldValue;
    console.log(value, oldValue, typeof value, typeof oldValue);
    setCookie(id + '-source', value + "");
    let button = document.getElementById('toggleButton');
    if (button) {
        button.textContent = value ? "Unblock Source" : "Block Source";
       
    }
}

function seeCookie(id) {
    console.log(getCookie(id) === "true");
}

function unblockForNews(id) {
    setCookie(id + '-source', "false");
    let newsPage = document.getElementById('newsdiv');
    let alertBlock = document.getElementById('alertblock');
    alertBlock.style="display: none !important;";
    newsPage.style="display: block !important;";
}