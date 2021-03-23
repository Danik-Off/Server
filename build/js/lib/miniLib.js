class minilib{
    //////////////////////////////////////////////////////////////
 deleteCookie(name) {
    document.cookie.split(";").forEach(function(el) {
             el = el.split("=")[0].trim();
             if(!el.indexOf(name)) {
             var date = new Date(0);
    document.cookie = el + "=; path=/; expires=" + date.toUTCString();
             }
      });
 }
///////////////////////////////////////////////////////////////////////////////
}