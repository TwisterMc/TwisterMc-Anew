jQuery(document).ready(function() {
    var oldDate = 2015;
    var $gASense = '<div class="sense"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!-- TwisterMc Responsive --><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8716721475579600" data-ad-slot="7195957938" data-ad-format="auto"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></div>';
    if (postDate <= oldDate && showSense == 1) {
        jQuery( "#header" ).after( $gASense );
    }
    jQuery( "#footer" ).before( $gASense);
    jQuery( ".post-sharrre").after( $gASense );
});