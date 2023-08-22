jQuery(document).ready(function($){

    // Replace 'a' tags with 'span' tags inside elements with the class 'ct-header-cart'
    $('.ct-header-cart a').each(function() {
        var $thisLink = $(this);
        var linkText = $thisLink.text();
        var newSpan = $('<span>').text(linkText);
        $thisLink.replaceWith(newSpan);
    });  
});
