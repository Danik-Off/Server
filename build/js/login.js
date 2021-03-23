function Click_loginBut(){
    document.getElementById("loginpanel").style.visibility = "hidden";
    document.getElementById("loadpanel").style.visibility = "visible";
    
 var a = new Api();
 var login =document.getElementById("inputLogin").value;
 var password =document.getElementById("inputPassword").value;
 console.log(login+password);
 try{
 if("ok" == a.login(login,password)){
setTimeout(() => {document.location.replace("/");}, 500);
 }
}
 catch{
    document.getElementById("loginpanel").style.visibility = "visible";
    document.getElementById("loadpanel").style.visibility = "hidden";
 }
 

 
 
}
