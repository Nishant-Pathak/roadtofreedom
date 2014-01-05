function resizeAndPositionTemple(wh,ht) {
    var newTop = (340/774)*(ht);
    var newLeft = (700/1600)*(wh);
    var newWidth = (188/1600)*(wh);
    var newHeight = (73/724)*(ht-'50');
    $("#temple_book").css({top: newTop,left: newLeft,width:newWidth,height:newHeight});   
    $('.panel-articles').css({height:ht-'80'});
    $('.well').css({height:ht-'200'});
    $('.selection-div').css({height:ht-'200'});
}

function resizeSlidePanel(wh,ht) {
    $('.panel-articles').css({height:ht-'40'});
    $('.well').css({height:ht-'200'});
    $('.selection-div').css({height:ht-'200'});
}
function resizeAndPositionTransparentImage(wh,ht) {
    $("#transparentImage").css({width:wh,height:ht});   
}
