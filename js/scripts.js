/*
	scripts.js

	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html

	Copyright: (c) 2013 Alexander "Alx" Agnarson, http://alxmedia.se
	Modernized: 2025 Thomas McMahon
*/

// Vanilla JS replacement for former jQuery functionality
(function () {
  "use strict";

  /* Helpers: fadeIn / fadeOut / fadeToggle */
  function fadeOut(el, duration = 250) {
    el.style.transition = `opacity ${duration}ms`;
    el.style.opacity = 1;
    requestAnimationFrame(function () {
      el.style.opacity = 0;
    });
    setTimeout(function () {
      el.style.display = "none";
      el.style.transition = "";
      el.style.opacity = "";
    }, duration);
  }

  function fadeIn(el, duration = 250, display = "block") {
    el.style.display = display;
    el.style.opacity = 0;
    el.style.transition = `opacity ${duration}ms`;
    requestAnimationFrame(function () {
      el.style.opacity = 1;
    });
    setTimeout(function () {
      el.style.transition = "";
      el.style.opacity = "";
    }, duration);
  }

  function fadeToggle(el, duration = 250) {
    if (window.getComputedStyle(el).display === "none") {
      fadeIn(el, duration);
    } else {
      fadeOut(el, duration);
    }
  }

  function qsAll(selector, scope) {
    return Array.prototype.slice.call(
      (scope || document).querySelectorAll(selector)
    );
  }

  function delegateClick(selector, handler) {
    qsAll(selector).forEach(function (el) {
      el.addEventListener("click", handler);
    });
  }

  /*  Toggle header search */
  delegateClick(".toggle-search", function (e) {
    e.preventDefault();
    var toggles = qsAll(".toggle-search");
    toggles.forEach(function (t) {
      t.classList.toggle("active");
    });

    var expand = document.querySelector(".search-expand");
    if (expand) {
      fadeToggle(expand, 250);
      setTimeout(function () {
        var input = expand.querySelector("input");
        if (input) input.focus();
      }, 300);
    }
  });

  /*  Scroll to top */
  var backToTop = document.querySelector(".back-to-top, #back-to-top");
  if (backToTop) {
    backToTop.addEventListener("click", function (e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  /*  Tabs widget */
  (function () {
    var tabsNavs = qsAll(".alx-tabs-nav");
    tabsNavs.forEach(function (nav) {
      var tabsContainer = nav.nextElementSibling;
      var tabItems = nav.querySelectorAll("li");

      // Hide all .alx-tab children and show the target
      if (tabsContainer) {
        qsAll(".alx-tab", tabsContainer).forEach(function (t) {
          t.style.display = "none";
        });
        var firstHref = nav.querySelector("a")
          ? nav.querySelector("a").getAttribute("href")
          : null;
        if (firstHref) {
          var showEl = tabsContainer.querySelector(firstHref);
          if (showEl) showEl.style.display = "block";
        }
      }

      if (tabItems.length) tabItems[0].classList.add("active");

      tabItems.forEach(function (li) {
        li.addEventListener("click", function (e) {
          e.preventDefault();
          Array.prototype.forEach.call(li.parentNode.children, function (s) {
            s.classList.remove("active");
          });
          li.classList.add("active");

          if (tabsContainer) {
            qsAll(".alx-tab", tabsContainer).forEach(function (t) {
              t.style.display = "none";
            });
            var target = li.querySelector("a")
              ? li.querySelector("a").getAttribute("href")
              : null;
            if (target) {
              var showEl = tabsContainer.querySelector(target);
              if (showEl) fadeIn(showEl, 250, "block");
            }
          }
        });
      });

      // trigger initial click depending on hash
      var hash = window.location.hash;
      if (hash) {
        var anchor = nav.querySelector('a[href="' + hash + '"]');
        if (anchor) anchor.parentElement && anchor.parentElement.click();
      } else if (tabItems.length) {
        // already initialized first item as active
      }
    });
  })();

  /*  Comments / pingbacks tabs */
  delegateClick(".comment-tabs li", function (e) {
    e.preventDefault();
    var items = qsAll(".comment-tabs li");
    items.forEach(function (it) {
      it.classList.remove("active");
    });
    this.classList.add("active");
    qsAll(".comment-tab").forEach(function (ct) {
      ct.style.display = "none";
    });
    var anchor = this.querySelector("a");
    var target = anchor ? anchor.getAttribute("href") : null;
    if (target) {
      var showEl = document.querySelector(target);
      if (showEl) fadeIn(showEl, 250, "block");
    }
    return false;
  });

  /*  Sidebar collapse */
  document.body.classList.add("s1-collapse");
  document.body.classList.add("s2-collapse");

  delegateClick(".s1 .sidebar-toggle", function (e) {
    document.body.classList.toggle("s1-collapse");
    document.body.classList.toggle("s1-expand");
    if (document.body.classList.contains("s2-expand")) {
      document.body.classList.toggle("s2-expand");
      document.body.classList.toggle("s2-collapse");
    }
  });

  delegateClick(".s2 .sidebar-toggle", function (e) {
    document.body.classList.toggle("s2-collapse");
    document.body.classList.toggle("s2-expand");
    if (document.body.classList.contains("s1-expand")) {
      document.body.classList.toggle("s1-expand");
      document.body.classList.toggle("s1-collapse");
    }
  });

  /*  Mobile menu smooth toggle height */
  delegateClick(".nav-toggle", function (e) {
    e.preventDefault();
    var parent = this.parentElement;
    var content = parent.querySelector(".nav-wrap .nav");
    slide(content);
  });

  function slide(content) {
    if (!content) return;
    var wrapper = content.parentElement;
    var contentHeight = content.scrollHeight;
    var wrapperHeight = wrapper.clientHeight;

    wrapper.classList.toggle("expand");
    if (wrapper.classList.contains("expand")) {
      wrapper.classList.add("transition");
      setTimeout(function () {
        wrapper.style.height = contentHeight + "px";
      }, 10);
    } else {
      wrapper.classList.add("transition");
      setTimeout(function () {
        wrapper.style.height = "0";
      }, 10);
    }

    var transitionEndHandler = function () {
      if (wrapper.classList.contains("expand")) {
        wrapper.classList.remove("transition");
        wrapper.style.height = "auto";
      } else {
        wrapper.classList.remove("transition");
        wrapper.style.height = "";
      }
      wrapper.removeEventListener("transitionend", transitionEndHandler);
    };

    wrapper.addEventListener("transitionend", transitionEndHandler);
  }
})();
