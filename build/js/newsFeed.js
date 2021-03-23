function LoadNews()
{
    var api = new Api();
 var posts =  api.GetNewsFeed(api.getToken());
 console.log(posts);
 posts.forEach(post => {
    add_Post_on_news_Feed(post.published.user_name+" "+post.published.user_lastname,post.date_time,post.content.text,post.content.imgs,post.post_id);
 });
  
}