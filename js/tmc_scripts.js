document.addEventListener("DOMContentLoaded", function () {
  var oldDate = 2015;
  var gASense =
    '<div class="sense"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!-- TwisterMc Responsive --><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8716721475579600" data-ad-slot="7195957938" data-ad-format="auto"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></div>';
  if (
    typeof postDate !== "undefined" &&
    postDate <= oldDate &&
    typeof showSense !== "undefined" &&
    showSense == 1
  ) {
    var header = document.getElementById("header");
    if (header) header.insertAdjacentHTML("afterend", gASense);
  }
  var footer = document.getElementById("footer");
  if (footer) footer.insertAdjacentHTML("beforebegin", gASense);
  var sh = document.querySelector(".post-sharrre");
  if (sh) sh.insertAdjacentHTML("afterend", gASense);
});
