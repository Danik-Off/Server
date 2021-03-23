///////////////////////////////////////////////////////////
////////////////////Lamp Api ver:0.0.1/////////////////////
///////////////////////////////////////////////////////////
function Getmethod(method,data){
    var host ="https://localhost/"
    var xhr = new XMLHttpRequest();
   
    xhr.open('GET', host+"OpenApi.php?method="+method+'&'+data, false);
    xhr.send();
    if (xhr.status != 200) {
      // обработать ошибку
      alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
    } else {
      // вывести результат
      return( xhr.responseText ); // responseText -- текст ответа.
    }
}
function GetMethodWithToken(token,method,data){
  var host ="https://localhost/"
  var xhr = new XMLHttpRequest();
  var s = host+"OpenApi.php?token="+token+'&method='+method+'&'+data;
  console.log(s);
  xhr.open('GET', s, false);
  xhr.send();

  if (xhr.status != 200) {
    // обработать ошибку
    alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
  } else {
    // вывести результат
    return( xhr.responseText ); // responseText -- текст ответа.
  }
}

class Api{
#token;
constructor(){
  this.getToken();
}

getToken(){
  var results = document.cookie.match ( '(^|;) ?token=([^;]*)(;|$)' );
 
  if ( results )
    return ( unescape ( results[2] ) );
  else
    return undefined;
}

login(login,password){

 var json = Getmethod( "login","login="+login+"&password="+password);
    var js =JSON.parse(json); 
   if(js.token!=undefined){
 document.cookie = "token="+js.token+"; path=/"; return "ok";}else{ return "no";}

}
checkToken(){
  if(this.getToken()==undefined){
return false;
  }else{
return true;
  }

}
///////////////////////////////////////////////////////////////////////////////////////////////
//newsEditor
GetNewsFeed(token)
{
  var json = GetMethodWithToken( token,"news.getNews");
  var js =JSON.parse(json); 
  console.log(js);
  
  if(js.answer =="701"){new minilib().deleteCookie("token");}
  if(js.answer =="602")
  {
    return js.res;
  }
  
}
/////////////////////////////////////////////////////////////////////////////////////////////////////


}