
function openPage(namePage)//открытие нового окна 
{
    var Pagetitle =document.getElementById("pageTitle");
    var MainBox = document.getElementById("ConteinerForPages");
switch(namePage){
    case "main":
        Pagetitle.innerHTML ="поиск";
        path =window.location.origin+"/html/find.html";   
        jQuery.get(path, function(data) {
            console.log("ok");
            MainBox.innerHTML = data;
        });
        break;
//////////////////////////////////////////////////////////////////////
case "news":
    Pagetitle.innerHTML ="Новости";
    path =window.location.origin+"/html/NewsFeed.html";   
    jQuery.get(path, function(data) {
        console.log("ok");
        MainBox.innerHTML = data;
        LoadNews();
    });
break;
////////////////////////////////////////////////////////////////////// 
case "dialogs":
        Pagetitle.innerHTML ="Сообщения";
        path =window.location.origin+"/html/dialogs.html";   
        jQuery.get(path, function(data) {
            console.log("ok");
            MainBox.innerHTML = data;
        });   
        
break;  
/////////////////////////////////////////////////////////////////////
case "friends":
        Pagetitle.innerHTML ="Друзья";
        path =window.location.origin+"/html/friends.html";   
        jQuery.get(path, function(data) {
            console.log("ok");
            MainBox.innerHTML = data;
        });
break;
////////////////////////////////////////////////////////////////////// 
case "video"://Видео оставить на потом 
    path =window.location.origin+"/html/friends.html";   
    jQuery.get(path, function(data) {
        console.log("ok");
        MainBox.innerHTML = data;
    });
break;
/////////////////////////////////////////////////////////////////////  
case "music":
                Pagetitle.innerHTML ="Музыка";
                path =window.location.origin+"/html/music.html";   
                jQuery.get(path, function(data) {
                    console.log("ok");
                    MainBox.innerHTML = data;
                });
break;    
/////////////////////////////////////////////////////////////////////
case "find":
                Pagetitle.innerHTML ="поиск";
                path =window.location.origin+"/html/find.html";   
                jQuery.get(path, function(data) {
                    console.log("ok");
                    MainBox.innerHTML = data;
                });
break;     
}
}
////////////////////////////////////////////////////////////  
 function autoload()
{
   try{
    openPage("main");
   }catch{

   }
}
////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////
function GoToAuth()
{
    document.location.replace("/login.html");
}
function onopen() {
    
   
    var a = new Api();
  if( a.checkToken()){//смотрим есть ли токен если да то загружаем страницу если нет то предлагаем авторизоваться
    
    document.getElementById("rightpanel1").style.visibility = "hidden";
    document.getElementById("rightpanel2").style.visibility = "visible";
    autoload();
  }
  else{
    document.getElementById("rightpanel2").style.visibility = "hidden";
    document.getElementById("rightpanel1").style.visibility = "visible";
  }
}