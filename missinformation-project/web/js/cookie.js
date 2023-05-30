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
    let oldValue = getCookie(id + '-source') === "true" ? true : false;
    let value = !oldValue;
    console.log(value, oldValue, typeof value, typeof oldValue);
    setCookie(id + '-source', value + "");
    let button = document.getElementById('toggleButton');
    if (button) {
        button.textContent = value ? "Unblock Source" : "Block Source";
       
    }
}

function seeCookie(id) {
    console.log(getCookie(id) === "true" ? true : false);
}

function hideSource(id) 
{
    let cookieValue = getCookie(id + '-source') === "true" ? true : false;
    
    while(cookieValue == true)
    {
        if(confirm("The source is blocked, Unblocked it with Si, otherwhise you will be redirect with no") == true)
        {
            setCookie(id + '-source', value + "");
        }
        else
        {
            window.location.replace("http://localhost:8080/index.php?r=site%2Fcalculate-source");
        }
    }
    
    
}