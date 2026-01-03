/*
	post-formats.js
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
	Copyright: (c) 2013 Jermaine Maree, http://jermainemaree.com
*/

document.addEventListener("DOMContentLoaded", function () {
  function hide_statuses() {
    var selectors = [
      "audio",
      "aside",
      "chat",
      "gallery",
      "image",
      "link",
      "quote",
      "status",
      "video",
    ];
    selectors.forEach(function (s) {
      var el = document.getElementById("format-" + s);
      if (el) el.style.display = "none";
    });
  }

  if (document.getElementById("post-formats-select")) {
    hide_statuses();

    var post_formats = [
      "audio",
      "aside",
      "chat",
      "gallery",
      "image",
      "link",
      "quote",
      "status",
      "video",
    ];

    var selected = document.querySelector("input[name='post_format']:checked");
    if (selected && post_formats.indexOf(selected.value) !== -1) {
      var el = document.getElementById("format-" + selected.value);
      if (el) el.style.display = "block";
    }

    var radios = document.querySelectorAll("input[name='post_format']:radio");
    radios.forEach(function (r) {
      r.addEventListener("change", function () {
        hide_statuses();
        if (post_formats.indexOf(this.value) !== -1) {
          var el = document.getElementById("format-" + this.value);
          if (el) el.style.display = "block";
        }
      });
    });
  }
});
