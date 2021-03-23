function Create_Post(name,time,text,imgs,p_id)//<img src="./src/LampIcon.png"/> потом дававить изображения
{
    var shablon =  '<div class="wrapper_post"><div class="post"> <div class="post_header" > <div class="madeBy"><img/><div><h1>'+name+'</h1>'+
        '<h2>'+time+'</h2>'+
  '  </div>'+
    '</div></div>'+
    '<div class="content"><p class="text">'+text+
'</p>'+
'<div class="imgs" id="container" >'+imgs+'</div>'+
'</div>'+
'<div class="post_footer"><button class="like"></button></div>'+
'</div></div>';
return shablon;

}
function add_Post_on_news_Feed(made_name_and_lastname,date,text="",img = [],post_id){
    var NewsPage = document.getElementById("NewsFeed");

    if(text==""){
    if(text.length>250){
        var text1 = text.slice(0,250);
        if (text1.length < text.length) {
        text1 += '...<a href=""onclick>Читать далее</a>';
        }
        text =text1;
      }}
      var imgshtml ="";
      var i=0;
      img.forEach(im=>{
        i= i+1;
 imgshtml =imgshtml+  "<img class='item' id =img"+post_id+i+" src='"+im+"'/>"});
    NewsPage.insertAdjacentHTML("beforeEnd", Create_Post(made_name_and_lastname,date,text,imgshtml,post_id));
    col(post_id,i);
}
function col(post_id,count)
{

  if(count==1){
    var c =0;
   while(c!=count){
    c=c+1;
    var imgkey = 'img'+post_id+c;
      document.getElementById(imgkey).style = 'height:350px';

   }
}
if(count==2)
{
  var c =0;
   while(c!=count){
    c=c+1;
    var imgkey = 'img'+post_id+c;
      document.getElementById(imgkey).style = 'max-height:350px;width: 50%;';

   }
  }

}

