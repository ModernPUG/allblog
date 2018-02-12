$('.php_tag_button').click(function(){
    var articleId = $(this).attr('data-article-id');
    $.post('/article/tag_php', {'article_id': articleId});
    $(this).hide();
});
