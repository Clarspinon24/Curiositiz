// sidebar
var resizing = false;

var topNavigation = $('.cd-top-nav');
var sidebar = $('.cd-side-nav');
var searchForm = $('.cd-search');
var header = $('.cd-main-header');

function checkMQ() {
    return window.getComputedStyle(document.querySelector('body'), '::before').getPropertyValue('content').replace(/"/g, '').replace(/'/g, '');
}

moveNavigation();

$(window).on('resize', function () {
    if (!resizing) {
        window.requestAnimationFrame(moveNavigation);
        resizing = true;
    }
});

function moveNavigation() {
    var mq = checkMQ();

    if (mq === 'mobile' && topNavigation.parents('.cd-side-nav').length === 0) {
        detachElements();
        topNavigation.appendTo(sidebar);
        searchForm.prependTo(sidebar);
    } else if ((mq === 'tablet' || mq === 'desktop') && topNavigation.parents('.cd-side-nav').length > 0) {
        detachElements();
        searchForm.insertAfter(header.find('.cd-logo'));
        topNavigation.appendTo(header.find('.cd-nav'));
    }
    resizing = false;
}

function detachElements() {
    topNavigation.detach();
    searchForm.detach();
}