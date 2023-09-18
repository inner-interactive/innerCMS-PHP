jQuery(function(){
	
	
    var article = $('.faq .article');  
    article.addClass('faqhide');  
    article.find('.a').slideUp(100);  

    $('.faq .article .trigger').click(function(){  
        var myArticle = $(this).parents('.article:first');  
        if(myArticle.hasClass('faqhide')){  
            article.addClass('faqhide').removeClass('show'); // 아코디언 효과를 원치 않으면 이 라인을 지우세요  
            article.find('.a').slideUp(100); // 아코디언 효과를 원치 않으면 이 라인을 지우세요  
            myArticle.removeClass('faqhide').addClass('show');  
            myArticle.find('.a').slideDown(100);  

        } else {  
            myArticle.removeClass('show').addClass('faqhide');  
            myArticle.find('.a').slideUp(100);  

        }  

    });  


    $('.faq .hgroup .trigger').click(function(){  
        var hidden = $('.faq .article.faqhide').length;  
        if(hidden > 0){  
            article.removeClass('faqhide').addClass('show');  
            article.find('.a').slideDown(100);  

        } else {  
            article.removeClass('show').addClass('faqhide');  
            article.find('.a').slideUp(100);  
        }  

    });  
       

});  

