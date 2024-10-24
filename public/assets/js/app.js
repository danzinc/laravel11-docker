!(function () {
    var e,
        t,
        a = document.querySelector(".navbar-menu").innerHTML,
        n = localStorage.getItem("language");
    function l() {
        i(null === n ? "en" : n);
        var e = document.getElementsByClassName("language");
        e &&
            Array.from(e).forEach(function (e) {
                e.addEventListener("click", function (t) {
                    i(e.getAttribute("data-lang"));
                });
            });
    }
    function i(e) {
        document.getElementById("header-lang-img") &&
            ("en" == e
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/us.svg")
                : "sp" == e
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/spain.svg")
                : "gr" == e
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/germany.svg")
                : "it" == e
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/italy.svg")
                : "ru" == e
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/russia.svg")
                : "ch" == e
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/china.svg")
                : "fr" == e
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/french.svg")
                : "ar" == e && (document.getElementById("header-lang-img").src = "assets/images/flags/ae.svg"),
            localStorage.setItem("language", e),
            null == (n = localStorage.getItem("language")) && i("en"),
            (e = new XMLHttpRequest()).open("GET", "assets/lang/" + n + ".json"),
            (e.onreadystatechange = function () {
                var e;
                4 === this.readyState &&
                    200 === this.status &&
                    Object.keys((e = JSON.parse(this.responseText))).forEach(function (t) {
                        Array.from(document.querySelectorAll("[data-key='" + t + "']")).forEach(function (a) {
                            a.textContent = e[t];
                        });
                    });
            }),
            e.send());
    }
    function s() {
        var e;
        document.querySelectorAll(".navbar-nav .collapse") &&
            Array.from((e = document.querySelectorAll(".navbar-nav .collapse"))).forEach(function (e) {
                var t = new bootstrap.Collapse(e, { toggle: !1 });
                e.addEventListener("show.bs.collapse", function (a) {
                    a.stopPropagation();
                    var a = e.parentElement.closest(".collapse");
                    a
                        ? Array.from((a = a.querySelectorAll(".collapse"))).forEach(function (e) {
                              (e = bootstrap.Collapse.getInstance(e)) !== t && e.hide();
                          })
                        : Array.from(
                              (a = (function (e) {
                                  for (var t = [], a = e.parentNode.firstChild; a; ) 1 === a.nodeType && a !== e && t.push(a), (a = a.nextSibling);
                                  return t;
                              })(e.parentElement))
                          ).forEach(function (e) {
                              2 < e.childNodes.length && e.firstElementChild.setAttribute("aria-expanded", "false"),
                                  Array.from((e = e.querySelectorAll("*[id]"))).forEach(function (e) {
                                      e.classList.remove("show"),
                                          2 < e.childNodes.length &&
                                              Array.from((e = e.querySelectorAll("ul li a"))).forEach(function (e) {
                                                  e.hasAttribute("aria-expanded") && e.setAttribute("aria-expanded", "false");
                                              });
                                  });
                          });
                }),
                    e.addEventListener("hide.bs.collapse", function (t) {
                        t.stopPropagation(),
                            Array.from((t = e.querySelectorAll(".collapse"))).forEach(function (e) {
                                (childCollapseInstance = bootstrap.Collapse.getInstance(e)).hide();
                            });
                    });
            });
    }
    function d() {
        var e,
            t = document.documentElement.getAttribute("data-layout"),
            n = sessionStorage.getItem("defaultAttribute"),
            n = JSON.parse(n);
        !n ||
            ("twocolumn" != t && "twocolumn" != n["data-layout"]) ||
            (document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = a),
            ((e = document.createElement("ul")).innerHTML = '<a href="#" class="logo"><img src="assets/images/logo-sm.png" alt="" height="22"></a>'),
            Array.from(document.getElementById("navbar-nav").querySelectorAll(".menu-link")).forEach(function (t) {
                e.className = "twocolumn-iconview";
                var a = document.createElement("li"),
                    n = t;
                n.querySelectorAll("span").forEach(function (e) {
                    e.classList.add("d-none");
                }),
                    t.parentElement.classList.contains("twocolumn-item-show") && t.classList.add("active"),
                    a.appendChild(n),
                    e.appendChild(a),
                    n.classList.contains("nav-link") && n.classList.replace("nav-link", "nav-icon"),
                    n.classList.remove("collapsed", "menu-link");
            }),
            (t = (t = "/" == location.pathname ? "index.html" : location.pathname.substring(1)).substring(t.lastIndexOf("/") + 1)) &&
                (n = document.getElementById("navbar-nav").querySelector('[href="' + t + '"]')) &&
                (t = n.closest(".collapse.menu-dropdown")) &&
                (t.classList.add("show"), t.parentElement.children[0].classList.add("active"), t.parentElement.children[0].setAttribute("aria-expanded", "true"), t.parentElement.closest(".collapse.menu-dropdown")) &&
                (t.parentElement.closest(".collapse").classList.add("show"),
                t.parentElement.closest(".collapse").previousElementSibling && t.parentElement.closest(".collapse").previousElementSibling.classList.add("active"),
                t.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown")) &&
                (t.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show"), t.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling) &&
                t.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active"),
            (document.getElementById("two-column-menu").innerHTML = e.outerHTML),
            Array.from(document.querySelector("#two-column-menu ul").querySelectorAll("li a")).forEach(function (e) {
                var t = (t = "/" == location.pathname ? "index.html" : location.pathname.substring(1)).substring(t.lastIndexOf("/") + 1);
                e.addEventListener("click", function (a) {
                    var n;
                    (t != "/" + e.getAttribute("href") || e.getAttribute("data-bs-toggle")) && document.body.classList.contains("twocolumn-panel") && document.body.classList.remove("twocolumn-panel"),
                        document.getElementById("navbar-nav").classList.remove("twocolumn-nav-hide"),
                        document.querySelector(".hamburger-icon").classList.remove("open"),
                        ((a.target && a.target.matches("a.nav-icon")) || (a.target && a.target.matches("i"))) &&
                            (null !== document.querySelector("#two-column-menu ul .nav-icon.active") && document.querySelector("#two-column-menu ul .nav-icon.active").classList.remove("active"),
                            (a.target.matches("i") ? a.target.closest("a") : a.target).classList.add("active"),
                            0 < (n = document.getElementsByClassName("twocolumn-item-show")).length && n[0].classList.remove("twocolumn-item-show"),
                            (n = (a.target.matches("i") ? a.target.closest("a") : a.target).getAttribute("href").slice(1)),
                            document.getElementById(n)) &&
                            document.getElementById(n).parentElement.classList.add("twocolumn-item-show");
                }),
                    t != "/" + e.getAttribute("href") ||
                        e.getAttribute("data-bs-toggle") ||
                        (e.classList.add("active"), document.getElementById("navbar-nav").classList.add("twocolumn-nav-hide"), document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.add("open"));
            }),
            "horizontal" !== document.documentElement.getAttribute("data-layout") &&
                ((n = new SimpleBar(document.getElementById("navbar-nav"))).getContentElement(), (t = new SimpleBar(document.getElementsByClassName("twocolumn-iconview")[0]))) &&
                t.getContentElement());
    }
    function o(e) {
        if (e) {
            var t = e.offsetTop,
                a = e.offsetLeft,
                n = e.offsetWidth,
                l = e.offsetHeight;
            if (e.offsetParent) for (; e.offsetParent; ) (t += (e = e.offsetParent).offsetTop), (a += e.offsetLeft);
            return t >= window.pageYOffset && a >= window.pageXOffset && t + l <= window.pageYOffset + window.innerHeight && a + n <= window.pageXOffset + window.innerWidth;
        }
    }
    function r() {
        ("vertical" != document.documentElement.getAttribute("data-layout") && "semibox" != document.documentElement.getAttribute("data-layout")) ||
            ((document.getElementById("two-column-menu").innerHTML = ""),
            document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = a),
            document.getElementById("scrollbar").setAttribute("data-simplebar", ""),
            document.getElementById("navbar-nav").setAttribute("data-simplebar", ""),
            document.getElementById("scrollbar").classList.add("h-100")),
            "twocolumn" == document.documentElement.getAttribute("data-layout") && (document.getElementById("scrollbar").removeAttribute("data-simplebar"), document.getElementById("scrollbar").classList.remove("h-100")),
            "horizontal" == document.documentElement.getAttribute("data-layout") && b();
    }
    function m() {
        feather.replace();
        var e = document.documentElement.clientWidth,
            e =
                (e < 1025 && 767 < e
                    ? (document.body.classList.remove("twocolumn-panel"),
                      "twocolumn" == sessionStorage.getItem("data-layout") &&
                          (document.documentElement.setAttribute("data-layout", "twocolumn"), document.getElementById("customizer-layout03") && document.getElementById("customizer-layout03").click(), d(), u(), s()),
                      "vertical" == sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", "sm"),
                      "semibox" == sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", "sm"),
                      document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.add("open"))
                    : 1025 <= e
                    ? (document.body.classList.remove("twocolumn-panel"),
                      "twocolumn" == sessionStorage.getItem("data-layout") &&
                          (document.documentElement.setAttribute("data-layout", "twocolumn"), document.getElementById("customizer-layout03") && document.getElementById("customizer-layout03").click(), d(), u(), s()),
                      "vertical" == sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", sessionStorage.getItem("data-sidebar-size")),
                      "semibox" == sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", sessionStorage.getItem("data-sidebar-size")),
                      document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.remove("open"))
                    : e <= 767 &&
                      (document.body.classList.remove("vertical-sidebar-enable"),
                      document.body.classList.add("twocolumn-panel"),
                      "twocolumn" == sessionStorage.getItem("data-layout") && (document.documentElement.setAttribute("data-layout", "vertical"), y("vertical"), s()),
                      "horizontal" != sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", "lg"),
                      document.querySelector(".hamburger-icon")) &&
                      document.querySelector(".hamburger-icon").classList.add("open"),
                document.querySelectorAll("#navbar-nav > li.nav-item"));
        Array.from(e).forEach(function (e) {
            e.addEventListener("click", c.bind(this), !1), e.addEventListener("mouseover", c.bind(this), !1);
        });
    }
    function c(e) {
        if (e.target && e.target.matches("a.nav-link span")) {
            if (0 == o(e.target.parentElement.nextElementSibling)) {
                e.target.parentElement.nextElementSibling.classList.add("dropdown-custom-right"), e.target.parentElement.parentElement.parentElement.parentElement.classList.add("dropdown-custom-right");
                var t = e.target.parentElement.nextElementSibling;
                Array.from(t.querySelectorAll(".menu-dropdown")).forEach(function (e) {
                    e.classList.add("dropdown-custom-right");
                });
            } else if (1 == o(e.target.parentElement.nextElementSibling) && 1848 <= window.innerWidth) for (var a = document.getElementsByClassName("dropdown-custom-right"); 0 < a.length; ) a[0].classList.remove("dropdown-custom-right");
        }
        if (e.target && e.target.matches("a.nav-link")) {
            if (0 == o(e.target.nextElementSibling))
                e.target.nextElementSibling.classList.add("dropdown-custom-right"),
                    e.target.parentElement.parentElement.parentElement.classList.add("dropdown-custom-right"),
                    Array.from((t = e.target.nextElementSibling).querySelectorAll(".menu-dropdown")).forEach(function (e) {
                        e.classList.add("dropdown-custom-right");
                    });
            else if (1 == o(e.target.nextElementSibling) && 1848 <= window.innerWidth) for (a = document.getElementsByClassName("dropdown-custom-right"); 0 < a.length; ) a[0].classList.remove("dropdown-custom-right");
        }
    }
    function u() {
        feather.replace();
        var e,
            t,
            a = "/" == location.pathname ? "index.html" : location.pathname.substring(1);
        (a = a.substring(a.lastIndexOf("/") + 1)) &&
            ("twocolumn-panel" == document.body.className &&
                document
                    .getElementById("two-column-menu")
                    .querySelector('[href="' + a + '"]')
                    .classList.add("active"),
            (a = document.getElementById("navbar-nav").querySelector('[href="' + a + '"]'))
                ? (a.classList.add("active"),
                  (t = ((e = a.closest(".collapse.menu-dropdown")) && e.parentElement.closest(".collapse.menu-dropdown")
                      ? (e.classList.add("show"),
                        e.parentElement.children[0].classList.add("active"),
                        e.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show"),
                        e.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown") &&
                            ((t = e.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown").getAttribute("id")),
                            e.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show"),
                            e.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.remove("twocolumn-item-show"),
                            document.getElementById("two-column-menu").querySelector('[href="#' + t + '"]')) &&
                            document
                                .getElementById("two-column-menu")
                                .querySelector('[href="#' + t + '"]')
                                .classList.add("active"),
                        e.parentElement.closest(".collapse.menu-dropdown"))
                      : (a.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show"), e)
                  ).getAttribute("id")),
                  document.getElementById("two-column-menu").querySelector('[href="#' + t + '"]') &&
                      document
                          .getElementById("two-column-menu")
                          .querySelector('[href="#' + t + '"]')
                          .classList.add("active"))
                : document.body.classList.add("twocolumn-panel"));
    }
    function g() {
        var e = "/" == location.pathname ? "index.html" : location.pathname.substring(1);
        (e = e.substring(e.lastIndexOf("/") + 1)) &&
            (e = document.getElementById("navbar-nav").querySelector('[href="' + e + '"]')) &&
            (e.classList.add("active"), (e = e.closest(".collapse.menu-dropdown"))) &&
            (e.classList.add("show"), e.parentElement.children[0].classList.add("active"), e.parentElement.children[0].setAttribute("aria-expanded", "true"), e.parentElement.closest(".collapse.menu-dropdown")) &&
            (e.parentElement.closest(".collapse").classList.add("show"),
            e.parentElement.closest(".collapse").previousElementSibling && e.parentElement.closest(".collapse").previousElementSibling.classList.add("active"),
            e.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown")) &&
            (e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show"), e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling) &&
            (e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active"), "horizontal" == document.documentElement.getAttribute("data-layout")) &&
            e.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse") &&
            e.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active");
    }
    function o(e) {
        if (e) {
            var t = e.offsetTop,
                a = e.offsetLeft,
                n = e.offsetWidth,
                l = e.offsetHeight;
            if (e.offsetParent) for (; e.offsetParent; ) (t += (e = e.offsetParent).offsetTop), (a += e.offsetLeft);
            return t >= window.pageYOffset && a >= window.pageXOffset && t + l <= window.pageYOffset + window.innerHeight && a + n <= window.pageXOffset + window.innerWidth;
        }
    }
    function b() {
        (document.getElementById("two-column-menu").innerHTML = ""),
            document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = a),
            document.getElementById("scrollbar").removeAttribute("data-simplebar"),
            document.getElementById("navbar-nav").removeAttribute("data-simplebar"),
            document.getElementById("scrollbar").classList.remove("h-100");
        var e = document.querySelectorAll("ul.navbar-nav > li.nav-item"),
            t = "",
            n = "";
        Array.from(e).forEach(function (a, l) {
            l + 1 === 7 && (n = a), 7 < l + 1 && ((t += a.outerHTML), a.remove()), l + 1 === e.length && n.insertAdjacentHTML && n.insertAdjacentHTML("afterend", "");
        });
    }
    function y(e) {
        "vertical" == e
            ? ((document.getElementById("two-column-menu").innerHTML = ""),
              document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = a),
              document.getElementById("theme-settings-offcanvas") &&
                  ((document.getElementById("sidebar-size").style.display = "block"),
                  (document.getElementById("sidebar-view").style.display = "block"),
                  (document.getElementById("sidebar-color").style.display = "block"),
                  document.getElementById("sidebar-img") && (document.getElementById("sidebar-img").style.display = "block"),
                  (document.getElementById("layout-position").style.display = "block"),
                  (document.getElementById("layout-width").style.display = "block"),
                  (document.getElementById("sidebar-visibility").style.display = "none")),
              r(),
              g(),
              E(),
              h())
            : "horizontal" == e
            ? (b(),
              document.getElementById("theme-settings-offcanvas") &&
                  ((document.getElementById("sidebar-size").style.display = "none"),
                  (document.getElementById("sidebar-view").style.display = "none"),
                  (document.getElementById("sidebar-color").style.display = "none"),
                  document.getElementById("sidebar-img") && (document.getElementById("sidebar-img").style.display = "none"),
                  (document.getElementById("layout-position").style.display = "block"),
                  (document.getElementById("layout-width").style.display = "block"),
                  (document.getElementById("sidebar-visibility").style.display = "none")),
              g())
            : "twocolumn" == e
            ? (document.getElementById("scrollbar").removeAttribute("data-simplebar"),
              document.getElementById("scrollbar").classList.remove("h-100"),
              document.getElementById("theme-settings-offcanvas") &&
                  ((document.getElementById("sidebar-size").style.display = "none"),
                  (document.getElementById("sidebar-view").style.display = "none"),
                  (document.getElementById("sidebar-color").style.display = "block"),
                  document.getElementById("sidebar-img") && (document.getElementById("sidebar-img").style.display = "block"),
                  (document.getElementById("layout-position").style.display = "none"),
                  (document.getElementById("layout-width").style.display = "none"),
                  (document.getElementById("sidebar-visibility").style.display = "none")))
            : "semibox" == e &&
              ((document.getElementById("two-column-menu").innerHTML = ""),
              document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = a),
              document.getElementById("theme-settings-offcanvas") &&
                  ((document.getElementById("sidebar-size").style.display = "block"),
                  (document.getElementById("sidebar-view").style.display = "none"),
                  (document.getElementById("sidebar-color").style.display = "block"),
                  document.getElementById("sidebar-img") && (document.getElementById("sidebar-img").style.display = "block"),
                  (document.getElementById("layout-position").style.display = "block"),
                  (document.getElementById("layout-width").style.display = "none"),
                  (document.getElementById("sidebar-visibility").style.display = "block")),
              r(),
              g(),
              E(),
              h());
    }
    function E() {
        document.getElementById("vertical-hover").addEventListener("click", function () {
            "sm-hover" === document.documentElement.getAttribute("data-sidebar-size")
                ? document.documentElement.setAttribute("data-sidebar-size", "sm-hover-active")
                : (document.documentElement.getAttribute("data-sidebar-size"), document.documentElement.setAttribute("data-sidebar-size", "sm-hover"));
        });
    }
    function p(e) {
        if (e == e) {
            switch (e["data-layout"]) {
                case "vertical":
                    T("data-layout", "vertical"), sessionStorage.setItem("data-layout", "vertical"), document.documentElement.setAttribute("data-layout", "vertical"), y("vertical"), s();
                    break;
                case "horizontal":
                    T("data-layout", "horizontal"), sessionStorage.setItem("data-layout", "horizontal"), document.documentElement.setAttribute("data-layout", "horizontal"), y("horizontal");
                    break;
                case "twocolumn":
                    T("data-layout", "twocolumn"), sessionStorage.setItem("data-layout", "twocolumn"), document.documentElement.setAttribute("data-layout", "twocolumn"), y("twocolumn");
                    break;
                case "semibox":
                    T("data-layout", "semibox"), sessionStorage.setItem("data-layout", "semibox"), document.documentElement.setAttribute("data-layout", "semibox"), y("semibox");
                    break;
                default:
                    "vertical" == sessionStorage.getItem("data-layout") && sessionStorage.getItem("data-layout")
                        ? (T("data-layout", "vertical"), sessionStorage.setItem("data-layout", "vertical"), document.documentElement.setAttribute("data-layout", "vertical"), y("vertical"), s())
                        : "horizontal" == sessionStorage.getItem("data-layout")
                        ? (T("data-layout", "horizontal"), sessionStorage.setItem("data-layout", "horizontal"), document.documentElement.setAttribute("data-layout", "horizontal"), y("horizontal"))
                        : "twocolumn" == sessionStorage.getItem("data-layout")
                        ? (T("data-layout", "twocolumn"), sessionStorage.setItem("data-layout", "twocolumn"), document.documentElement.setAttribute("data-layout", "twocolumn"), y("twocolumn"))
                        : "semibox" == sessionStorage.getItem("data-layout") && (T("data-layout", "semibox"), sessionStorage.setItem("data-layout", "semibox"), document.documentElement.setAttribute("data-layout", "semibox"), y("semibox"));
            }
            switch (e["data-topbar"]) {
                case "light":
                    T("data-topbar", "light"), sessionStorage.setItem("data-topbar", "light"), document.documentElement.setAttribute("data-topbar", "light");
                    break;
                case "dark":
                    T("data-topbar", "dark"), sessionStorage.setItem("data-topbar", "dark"), document.documentElement.setAttribute("data-topbar", "dark");
                    break;
                default:
                    "dark" == sessionStorage.getItem("data-topbar")
                        ? (T("data-topbar", "dark"), sessionStorage.setItem("data-topbar", "dark"), document.documentElement.setAttribute("data-topbar", "dark"))
                        : (T("data-topbar", "light"), sessionStorage.setItem("data-topbar", "light"), document.documentElement.setAttribute("data-topbar", "light"));
            }
            switch (
                ("hidden" === e["data-sidebar-visibility"]
                    ? (T("data-sidebar-visibility", "hidden"), sessionStorage.setItem("data-sidebar-visibility", "hidden"), document.documentElement.setAttribute("data-sidebar-visibility", "hidden"))
                    : (T("data-sidebar-visibility", "show"), sessionStorage.setItem("data-sidebar-visibility", "show"), document.documentElement.setAttribute("data-sidebar-visibility", "show")),
                e["data-layout-style"])
            ) {
                case "default":
                    T("data-layout-style", "default"), sessionStorage.setItem("data-layout-style", "default"), document.documentElement.setAttribute("data-layout-style", "default");
                    break;
                case "detached":
                    T("data-layout-style", "detached"), sessionStorage.setItem("data-layout-style", "detached"), document.documentElement.setAttribute("data-layout-style", "detached");
                    break;
                default:
                    "detached" == sessionStorage.getItem("data-layout-style")
                        ? (T("data-layout-style", "detached"), sessionStorage.setItem("data-layout-style", "detached"), document.documentElement.setAttribute("data-layout-style", "detached"))
                        : (T("data-layout-style", "default"), sessionStorage.setItem("data-layout-style", "default"), document.documentElement.setAttribute("data-layout-style", "default"));
            }
            switch (e["data-sidebar-size"]) {
                case "lg":
                    T("data-sidebar-size", "lg"), document.documentElement.setAttribute("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg");
                    break;
                case "sm":
                    T("data-sidebar-size", "sm"), document.documentElement.setAttribute("data-sidebar-size", "sm"), sessionStorage.setItem("data-sidebar-size", "sm");
                    break;
                case "md":
                    T("data-sidebar-size", "md"), document.documentElement.setAttribute("data-sidebar-size", "md"), sessionStorage.setItem("data-sidebar-size", "md");
                    break;
                case "sm-hover":
                    T("data-sidebar-size", "sm-hover"), document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover");
                    break;
                default:
                    "sm" == sessionStorage.getItem("data-sidebar-size")
                        ? (document.documentElement.setAttribute("data-sidebar-size", "sm"), T("data-sidebar-size", "sm"), sessionStorage.setItem("data-sidebar-size", "sm"))
                        : "md" == sessionStorage.getItem("data-sidebar-size")
                        ? (document.documentElement.setAttribute("data-sidebar-size", "md"), T("data-sidebar-size", "md"), sessionStorage.setItem("data-sidebar-size", "md"))
                        : "sm-hover" == sessionStorage.getItem("data-sidebar-size")
                        ? (document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), T("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover"))
                        : (document.documentElement.setAttribute("data-sidebar-size", "lg"), T("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg"));
            }
            switch (e["data-bs-theme"]) {
                case "light":
                    T("data-bs-theme", "light"), document.documentElement.setAttribute("data-bs-theme", "light"), sessionStorage.setItem("data-bs-theme", "light");
                    break;
                case "dark":
                    T("data-bs-theme", "dark"), document.documentElement.setAttribute("data-bs-theme", "dark"), sessionStorage.setItem("data-bs-theme", "dark");
                    break;
                default:
                    sessionStorage.getItem("data-bs-theme") && "dark" == sessionStorage.getItem("data-bs-theme")
                        ? (sessionStorage.setItem("data-bs-theme", "dark"), document.documentElement.setAttribute("data-bs-theme", "dark"), T("data-bs-theme", "dark"))
                        : (sessionStorage.setItem("data-bs-theme", "light"), document.documentElement.setAttribute("data-bs-theme", "light"), T("data-bs-theme", "light"));
            }
            switch (e["data-layout-width"]) {
                case "fluid":
                    T("data-layout-width", "fluid"), document.documentElement.setAttribute("data-layout-width", "fluid"), sessionStorage.setItem("data-layout-width", "fluid");
                    break;
                case "boxed":
                    T("data-layout-width", "boxed"), document.documentElement.setAttribute("data-layout-width", "boxed"), sessionStorage.setItem("data-layout-width", "boxed");
                    break;
                default:
                    "boxed" == sessionStorage.getItem("data-layout-width")
                        ? (sessionStorage.setItem("data-layout-width", "boxed"), document.documentElement.setAttribute("data-layout-width", "boxed"), T("data-layout-width", "boxed"))
                        : (sessionStorage.setItem("data-layout-width", "fluid"), document.documentElement.setAttribute("data-layout-width", "fluid"), T("data-layout-width", "fluid"));
            }
            switch (e["data-sidebar"]) {
                case "light":
                    T("data-sidebar", "light"), sessionStorage.setItem("data-sidebar", "light"), document.documentElement.setAttribute("data-sidebar", "light");
                    break;
                case "dark":
                    T("data-sidebar", "dark"), sessionStorage.setItem("data-sidebar", "dark"), document.documentElement.setAttribute("data-sidebar", "dark");
                    break;
                case "gradient":
                    T("data-sidebar", "gradient"), sessionStorage.setItem("data-sidebar", "gradient"), document.documentElement.setAttribute("data-sidebar", "gradient");
                    break;
                case "gradient-2":
                    T("data-sidebar", "gradient-2"), sessionStorage.setItem("data-sidebar", "gradient-2"), document.documentElement.setAttribute("data-sidebar", "gradient-2");
                    break;
                case "gradient-3":
                    T("data-sidebar", "gradient-3"), sessionStorage.setItem("data-sidebar", "gradient-3"), document.documentElement.setAttribute("data-sidebar", "gradient-3");
                    break;
                case "gradient-4":
                    T("data-sidebar", "gradient-4"), sessionStorage.setItem("data-sidebar", "gradient-4"), document.documentElement.setAttribute("data-sidebar", "gradient-4");
                    break;
                default:
                    sessionStorage.getItem("data-sidebar") && "light" == sessionStorage.getItem("data-sidebar")
                        ? (sessionStorage.setItem("data-sidebar", "light"), T("data-sidebar", "light"), document.documentElement.setAttribute("data-sidebar", "light"))
                        : "dark" == sessionStorage.getItem("data-sidebar")
                        ? (sessionStorage.setItem("data-sidebar", "dark"), T("data-sidebar", "dark"), document.documentElement.setAttribute("data-sidebar", "dark"))
                        : "gradient" == sessionStorage.getItem("data-sidebar")
                        ? (sessionStorage.setItem("data-sidebar", "gradient"), T("data-sidebar", "gradient"), document.documentElement.setAttribute("data-sidebar", "gradient"))
                        : "gradient-2" == sessionStorage.getItem("data-sidebar")
                        ? (sessionStorage.setItem("data-sidebar", "gradient-2"), T("data-sidebar", "gradient-2"), document.documentElement.setAttribute("data-sidebar", "gradient-2"))
                        : "gradient-3" == sessionStorage.getItem("data-sidebar")
                        ? (sessionStorage.setItem("data-sidebar", "gradient-3"), T("data-sidebar", "gradient-3"), document.documentElement.setAttribute("data-sidebar", "gradient-3"))
                        : "gradient-4" == sessionStorage.getItem("data-sidebar") &&
                          (sessionStorage.setItem("data-sidebar", "gradient-4"), T("data-sidebar", "gradient-4"), document.documentElement.setAttribute("data-sidebar", "gradient-4"));
            }
            switch (e["data-sidebar-image"]) {
                case "none":
                    T("data-sidebar-image", "none"), sessionStorage.setItem("data-sidebar-image", "none"), document.documentElement.setAttribute("data-sidebar-image", "none");
                    break;
                case "img-1":
                    T("data-sidebar-image", "img-1"), sessionStorage.setItem("data-sidebar-image", "img-1"), document.documentElement.setAttribute("data-sidebar-image", "img-1");
                    break;
                case "img-2":
                    T("data-sidebar-image", "img-2"), sessionStorage.setItem("data-sidebar-image", "img-2"), document.documentElement.setAttribute("data-sidebar-image", "img-2");
                    break;
                case "img-3":
                    T("data-sidebar-image", "img-3"), sessionStorage.setItem("data-sidebar-image", "img-3"), document.documentElement.setAttribute("data-sidebar-image", "img-3");
                    break;
                case "img-4":
                    T("data-sidebar-image", "img-4"), sessionStorage.setItem("data-sidebar-image", "img-4"), document.documentElement.setAttribute("data-sidebar-image", "img-4");
                    break;
                default:
                    sessionStorage.getItem("data-sidebar-image") && "none" == sessionStorage.getItem("data-sidebar-image")
                        ? (sessionStorage.setItem("data-sidebar-image", "none"), T("data-sidebar-image", "none"), document.documentElement.setAttribute("data-sidebar-image", "none"))
                        : "img-1" == sessionStorage.getItem("data-sidebar-image")
                        ? (sessionStorage.setItem("data-sidebar-image", "img-1"), T("data-sidebar-image", "img-1"), document.documentElement.setAttribute("data-sidebar-image", "img-2"))
                        : "img-2" == sessionStorage.getItem("data-sidebar-image")
                        ? (sessionStorage.setItem("data-sidebar-image", "img-2"), T("data-sidebar-image", "img-2"), document.documentElement.setAttribute("data-sidebar-image", "img-2"))
                        : "img-3" == sessionStorage.getItem("data-sidebar-image")
                        ? (sessionStorage.setItem("data-sidebar-image", "img-3"), T("data-sidebar-image", "img-3"), document.documentElement.setAttribute("data-sidebar-image", "img-3"))
                        : "img-4" == sessionStorage.getItem("data-sidebar-image") &&
                          (sessionStorage.setItem("data-sidebar-image", "img-4"), T("data-sidebar-image", "img-4"), document.documentElement.setAttribute("data-sidebar-image", "img-4"));
            }
            switch (e["data-layout-position"]) {
                case "fixed":
                    T("data-layout-position", "fixed"), sessionStorage.setItem("data-layout-position", "fixed"), document.documentElement.setAttribute("data-layout-position", "fixed");
                    break;
                case "scrollable":
                    T("data-layout-position", "scrollable"), sessionStorage.setItem("data-layout-position", "scrollable"), document.documentElement.setAttribute("data-layout-position", "scrollable");
                    break;
                default:
                    sessionStorage.getItem("data-layout-position") && "scrollable" == sessionStorage.getItem("data-layout-position")
                        ? (T("data-layout-position", "scrollable"), sessionStorage.setItem("data-layout-position", "scrollable"), document.documentElement.setAttribute("data-layout-position", "scrollable"))
                        : (T("data-layout-position", "fixed"), sessionStorage.setItem("data-layout-position", "fixed"), document.documentElement.setAttribute("data-layout-position", "fixed"));
            }
            switch (e["data-preloader"]) {
                case "disable":
                    T("data-preloader", "disable"), sessionStorage.setItem("data-preloader", "disable"), document.documentElement.setAttribute("data-preloader", "disable");
                    break;
                case "enable":
                    T("data-preloader", "enable"),
                        sessionStorage.setItem("data-preloader", "enable"),
                        document.documentElement.setAttribute("data-preloader", "enable"),
                        (t = document.getElementById("preloader")) &&
                            window.addEventListener("load", function () {
                                (t.style.opacity = "0"), (t.style.visibility = "hidden");
                            });
                    break;
                default:
                    var t;
                    sessionStorage.getItem("data-preloader") && "disable" == sessionStorage.getItem("data-preloader")
                        ? (T("data-preloader", "disable"), sessionStorage.setItem("data-preloader", "disable"), document.documentElement.setAttribute("data-preloader", "disable"))
                        : "enable" == sessionStorage.getItem("data-preloader")
                        ? (T("data-preloader", "enable"),
                          sessionStorage.setItem("data-preloader", "enable"),
                          document.documentElement.setAttribute("data-preloader", "enable"),
                          (t = document.getElementById("preloader")) &&
                              window.addEventListener("load", function () {
                                  (t.style.opacity = "0"), (t.style.visibility = "hidden");
                              }))
                        : document.documentElement.setAttribute("data-preloader", "disable");
            }
            switch (e["data-body-image"]) {
                case "img-1":
                    T("data-body-image", "img-1"),
                        sessionStorage.setItem("data-sidebabodyr-image", "img-1"),
                        document.documentElement.setAttribute("data-body-image", "img-1"),
                        document.getElementById("theme-settings-offcanvas") && document.documentElement.removeAttribute("data-sidebar-image");
                    break;
                case "img-2":
                    T("data-body-image", "img-2"), sessionStorage.setItem("data-body-image", "img-2"), document.documentElement.setAttribute("data-body-image", "img-2");
                    break;
                case "img-3":
                    T("data-body-image", "img-3"), sessionStorage.setItem("data-body-image", "img-3"), document.documentElement.setAttribute("data-body-image", "img-3");
                    break;
                case "none":
                    T("data-body-image", "none"), sessionStorage.setItem("data-body-image", "none"), document.documentElement.setAttribute("data-body-image", "none");
                    break;
                default:
                    sessionStorage.getItem("data-body-image") && "img-1" == sessionStorage.getItem("data-body-image")
                        ? (sessionStorage.setItem("data-body-image", "img-1"),
                          T("data-body-image", "img-1"),
                          document.documentElement.setAttribute("data-body-image", "img-1"),
                          document.getElementById("theme-settings-offcanvas") &&
                              document.getElementById("sidebar-img") &&
                              ((document.getElementById("sidebar-img").style.display = "none"), document.documentElement.removeAttribute("data-sidebar-image")))
                        : "img-2" == sessionStorage.getItem("data-body-image")
                        ? (sessionStorage.setItem("data-body-image", "img-2"), T("data-body-image", "img-2"), document.documentElement.setAttribute("data-body-image", "img-2"))
                        : "img-3" == sessionStorage.getItem("data-body-image")
                        ? (sessionStorage.setItem("data-body-image", "img-3"), T("data-body-image", "img-3"), document.documentElement.setAttribute("data-body-image", "img-3"))
                        : "none" == sessionStorage.getItem("data-body-image") && (sessionStorage.setItem("data-body-image", "none"), T("data-body-image", "none"), document.documentElement.setAttribute("data-body-image", "none"));
            }
        }
    }
    function h() {
        setTimeout(function () {
            var e,
                t,
                a = document.getElementById("navbar-nav");
            a &&
                300 < (e = (a = a.querySelector(".nav-item .active")) ? a.offsetTop : 0) &&
                (t = document.getElementsByClassName("app-menu") ? document.getElementsByClassName("app-menu")[0] : "") &&
                t.querySelector(".simplebar-content-wrapper") &&
                setTimeout(function () {
                    t.querySelector(".simplebar-content-wrapper").scrollTop = 330 == e ? e + 85 : e;
                }, 0);
        }, 250);
    }
    var f,
        v,
        I,
        w,
        A,
        L,
        B,
        k,
        S,
        z,
        $,
        q,
        x = new Event("resize");
    function T(e, t) {
        Array.from(document.querySelectorAll("input[name=" + e + "]")).forEach(function (a) {
            t == a.value ? (a.checked = !0) : (a.checked = !1),
                a.addEventListener("change", function () {
                    document.documentElement.setAttribute(e, a.value),
                        sessionStorage.setItem(e, a.value),
                        l(),
                        "data-layout-width" == e && "boxed" == a.value
                            ? (document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover"), (document.getElementById("sidebar-size-small-hover").checked = !0))
                            : "data-layout-width" == e &&
                              "fluid" == a.value &&
                              (document.documentElement.setAttribute("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg"), (document.getElementById("sidebar-size-default").checked = !0)),
                        "data-layout" == e &&
                            ("vertical" == a.value
                                ? (y("vertical"), s(), feather.replace())
                                : "horizontal" == a.value
                                ? (document.getElementById("sidebarimg-none") && document.getElementById("sidebarimg-none").click(), y("horizontal"), feather.replace())
                                : "twocolumn" == a.value
                                ? (y("twocolumn"), document.documentElement.setAttribute("data-layout-width", "fluid"), document.getElementById("layout-width-fluid").click(), d(), u(), s(), feather.replace())
                                : "semibox" == a.value &&
                                  (y("semibox"),
                                  document.documentElement.setAttribute("data-layout-width", "fluid"),
                                  document.getElementById("layout-width-fluid").click(),
                                  document.documentElement.setAttribute("data-layout-style", "default"),
                                  document.getElementById("sidebar-view-default").click(),
                                  s(),
                                  feather.replace()));
                    var t,
                        n = "block";
                    "semibox" == document.documentElement.getAttribute("data-layout") &&
                        ("hidden" == document.documentElement.getAttribute("data-sidebar-visibility")
                            ? (document.documentElement.removeAttribute("data-sidebar"), document.documentElement.removeAttribute("data-sidebar-image"), document.documentElement.removeAttribute("data-sidebar-size"), (n = "none"))
                            : (document.documentElement.setAttribute("data-sidebar", sessionStorage.getItem("data-sidebar")),
                              document.documentElement.setAttribute("data-sidebar-image", sessionStorage.getItem("data-sidebar-image")),
                              document.documentElement.setAttribute("data-sidebar-size", sessionStorage.getItem("data-sidebar-size")))),
                        (document.getElementById("sidebar-size").style.display = n),
                        (document.getElementById("sidebar-color").style.display = n),
                        document.getElementById("sidebar-img") && (document.getElementById("sidebar-img").style.display = n),
                        "data-preloader" == e && "enable" == a.value
                            ? (document.documentElement.setAttribute("data-preloader", "enable"),
                              (t = document.getElementById("preloader")) &&
                                  setTimeout(function () {
                                      (t.style.opacity = "0"), (t.style.visibility = "hidden");
                                  }, 1e3),
                              document.getElementById("customizerclose-btn").click())
                            : "data-preloader" == e && "disable" == a.value && (document.documentElement.setAttribute("data-preloader", "disable"), document.getElementById("customizerclose-btn").click()),
                        "data-bs-theme" == e && window.dispatchEvent(x);
                });
        }),
            document.getElementById("collapseBgGradient") &&
                Array.from(document.querySelectorAll("#collapseBgGradient .form-check input")).forEach(function (e) {
                    var t = document.getElementById("collapseBgGradient");
                    1 == e.checked && new bootstrap.Collapse(t, { toggle: !1 }).show(),
                        document.querySelector("[data-bs-target='#collapseBgGradient']") &&
                            document.querySelector("[data-bs-target='#collapseBgGradient']").addEventListener("click", function (e) {
                                document.getElementById("sidebar-color-gradient").click();
                            });
                }),
            document.querySelectorAll("[data-bs-target='#collapseBgGradient.show']") &&
                Array.from(document.querySelectorAll("[data-bs-target='#collapseBgGradient.show']")).forEach(function (e) {
                    e.addEventListener("click", function () {
                        var e = document.getElementById("collapseBgGradient");
                        new bootstrap.Collapse(e, { toggle: !1 }).hide();
                    });
                }),
            Array.from(document.querySelectorAll("[name='data-sidebar']")).forEach(function (e) {
                document.querySelector("[data-bs-target='#collapseBgGradient']") &&
                    (document.querySelector("#collapseBgGradient .form-check input:checked")
                        ? document.querySelector("[data-bs-target='#collapseBgGradient']").classList.add("active")
                        : document.querySelector("[data-bs-target='#collapseBgGradient']").classList.remove("active"),
                    e.addEventListener("change", function () {
                        document.querySelector("#collapseBgGradient .form-check input:checked")
                            ? document.querySelector("[data-bs-target='#collapseBgGradient']").classList.add("active")
                            : document.querySelector("[data-bs-target='#collapseBgGradient']").classList.remove("active");
                    }));
            });
    }
    function _(e, t, a, n) {
        var l = document.getElementById(a);
        n.setAttribute(e, t), l && document.getElementById(a).click();
    }
    function C() {
        document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || document.body.classList.remove("fullscreen-enable");
    }
    function F() {
        var e = 0;
        Array.from(document.getElementsByClassName("cart-item-price")).forEach(function (t) {
            e += parseFloat(t.innerHTML);
        }),
            document.getElementById("cart-item-total") && (document.getElementById("cart-item-total").innerHTML = "$" + e.toFixed(2));
    }
    function N() {
        Array.from(document.querySelectorAll("#notificationItemsTabContent .tab-pane")).forEach(function (e) {
            0 < e.querySelectorAll(".notification-item").length
                ? e.querySelector(".view-all") && (e.querySelector(".view-all").style.display = "block")
                : (e.querySelector(".view-all") && (e.querySelector(".view-all").style.display = "none"),
                  e.querySelector(".empty-notification-elem") ||
                      (e.innerHTML +=
                          '<div class="empty-notification-elem">							<div class="w-25 w-sm-50 pt-3 mx-auto">								<img src="assets/images/svg/bell.svg" class="img-fluid" alt="user-pic">							</div>							<div class="text-center pb-5 mt-2">								<h6 class="fs-18 fw-semibold lh-base">Hey! You have no any notifications </h6>							</div>						</div>'));
        });
    }
    function H() {
        var e;
        "horizontal" !== document.documentElement.getAttribute("data-layout") &&
            (document.getElementById("navbar-nav") && (e = new SimpleBar(document.getElementById("navbar-nav"))) && e.getContentElement(),
            document.getElementsByClassName("twocolumn-iconview")[0] && (e = new SimpleBar(document.getElementsByClassName("twocolumn-iconview")[0])) && e.getContentElement(),
            clearTimeout(q));
    }
    sessionStorage.getItem("defaultAttribute")
        ? (((f = {})["data-layout"] = sessionStorage.getItem("data-layout")),
          (f["data-sidebar-size"] = sessionStorage.getItem("data-sidebar-size")),
          (f["data-bs-theme"] = sessionStorage.getItem("data-bs-theme")),
          (f["data-layout-width"] = sessionStorage.getItem("data-layout-width")),
          (f["data-sidebar"] = sessionStorage.getItem("data-sidebar")),
          (f["data-sidebar-image"] = sessionStorage.getItem("data-sidebar-image")),
          (f["data-layout-position"] = sessionStorage.getItem("data-layout-position")),
          (f["data-layout-style"] = sessionStorage.getItem("data-layout-style")),
          (f["data-topbar"] = sessionStorage.getItem("data-topbar")),
          (f["data-preloader"] = sessionStorage.getItem("data-preloader")),
          (f["data-body-image"] = sessionStorage.getItem("data-body-image")),
          p(f))
        : ((k = document.documentElement.attributes),
          (f = {}),
          Array.from(k).forEach(function (e) {
              var t;
              e && e.nodeName && "undefined" != e.nodeName && ((f[(t = e.nodeName)] = e.nodeValue), sessionStorage.setItem(t, e.nodeValue));
          }),
          sessionStorage.setItem("defaultAttribute", JSON.stringify(f)),
          p(f),
          (k = document.querySelector('.btn[data-bs-target="#theme-settings-offcanvas"]')) && k.click()),
        d(),
        (v = document.getElementById("search-close-options")),
        (I = document.getElementById("search-dropdown")),
        (w = document.getElementById("search-options")) &&
            (w.addEventListener("focus", function () {
                0 < w.value.length ? (I.classList.add("show"), v.classList.remove("d-none")) : (I.classList.remove("show"), v.classList.add("d-none"));
            }),
            w.addEventListener("keyup", function (e) {
                var t, a;
                0 < w.value.length
                    ? (I.classList.add("show"),
                      v.classList.remove("d-none"),
                      (t = w.value.toLowerCase()),
                      Array.from((a = document.getElementsByClassName("notify-item"))).forEach(function (e) {
                          var a,
                              n,
                              l = "";
                          e.querySelector("h6")
                              ? ((a = e.getElementsByTagName("span")[0].innerText.toLowerCase()), (l = (n = e.querySelector("h6").innerText.toLowerCase()).includes(t) ? n : a))
                              : e.getElementsByTagName("span") && (l = e.getElementsByTagName("span")[0].innerText.toLowerCase()),
                              l && (e.style.display = l.includes(t) ? "block" : "none");
                      }))
                    : (I.classList.remove("show"), v.classList.add("d-none"));
            }),
            v.addEventListener("click", function () {
                (w.value = ""), I.classList.remove("show"), v.classList.add("d-none");
            }),
            document.body.addEventListener("click", function (e) {})),
        (A = document.getElementById("search-close-options")),
        (L = document.getElementById("search-dropdown-reponsive")),
        (B = document.getElementById("search-options-reponsive")),
        A &&
            L &&
            B &&
            (B.addEventListener("focus", function () {
                0 < B.value.length ? (L.classList.add("show"), A.classList.remove("d-none")) : (L.classList.remove("show"), A.classList.add("d-none"));
            }),
            B.addEventListener("keyup", function () {
                0 < B.value.length ? (L.classList.add("show"), A.classList.remove("d-none")) : (L.classList.remove("show"), A.classList.add("d-none"));
            }),
            A.addEventListener("click", function () {
                (B.value = ""), L.classList.remove("show"), A.classList.add("d-none");
            }),
            document.body.addEventListener("click", function (e) {
                "search-options" !== e.target.getAttribute("id") && (L.classList.remove("show"), A.classList.add("d-none"));
            })),
        (k = document.querySelector('[data-toggle="fullscreen"]')) &&
            k.addEventListener("click", function (e) {
                e.preventDefault(),
                    document.body.classList.toggle("fullscreen-enable"),
                    document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement
                        ? document.cancelFullScreen
                            ? document.cancelFullScreen()
                            : document.mozCancelFullScreen
                            ? document.mozCancelFullScreen()
                            : document.webkitCancelFullScreen && document.webkitCancelFullScreen()
                        : document.documentElement.requestFullscreen
                        ? document.documentElement.requestFullscreen()
                        : document.documentElement.mozRequestFullScreen
                        ? document.documentElement.mozRequestFullScreen()
                        : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }),
        document.addEventListener("fullscreenchange", C),
        document.addEventListener("webkitfullscreenchange", C),
        document.addEventListener("mozfullscreenchange", C),
        (S = document.getElementsByTagName("HTML")[0]),
        ($ = document.querySelectorAll(".light-dark-mode")) &&
            $.length &&
            $[0].addEventListener("click", function (e) {
                S.hasAttribute("data-bs-theme") && "dark" == S.getAttribute("data-bs-theme") ? _("data-bs-theme", "light", "layout-mode-light", S) : _("data-bs-theme", "dark", "layout-mode-dark", S), window.dispatchEvent(x);
            }),
        document.addEventListener("DOMContentLoaded", function () {
            Array.from(document.getElementsByClassName("code-switcher")).forEach(function (e) {
                e.addEventListener("change", function () {
                    var t = e.closest(".card"),
                        a = t.querySelector(".live-preview"),
                        t = t.querySelector(".code-view");
                    e.checked ? (a.classList.add("d-none"), t.classList.remove("d-none")) : (a.classList.remove("d-none"), t.classList.add("d-none"));
                });
            }),
                feather.replace();
        }),
        window.addEventListener("resize", m),
        m(),
        Waves.init(),
        document.addEventListener("scroll", function () {
            var e;
            (e = document.getElementById("page-topbar")) && (50 <= document.body.scrollTop || 50 <= document.documentElement.scrollTop ? e.classList.add("topbar-shadow") : e.classList.remove("topbar-shadow"));
        }),
        window.addEventListener("load", function () {
            var e;
            ("twocolumn" == document.documentElement.getAttribute("data-layout") ? u : g)(),
                (e = document.getElementsByClassName("vertical-overlay")) &&
                    Array.from(e).forEach(function (e) {
                        e.addEventListener("click", function () {
                            document.body.classList.remove("vertical-sidebar-enable"),
                                "twocolumn" == sessionStorage.getItem("data-layout") ? document.body.classList.add("twocolumn-panel") : document.documentElement.setAttribute("data-sidebar-size", sessionStorage.getItem("data-sidebar-size"));
                        });
                    }),
                E();
        }),
        document.getElementById("topnav-hamburger-icon") &&
            document.getElementById("topnav-hamburger-icon").addEventListener("click", function e() {
                var t = document.documentElement.clientWidth;
                767 < t && document.querySelector(".hamburger-icon").classList.toggle("open"),
                    "horizontal" === document.documentElement.getAttribute("data-layout") && (document.body.classList.contains("menu") ? document.body.classList.remove("menu") : document.body.classList.add("menu")),
                    "vertical" === document.documentElement.getAttribute("data-layout") &&
                        (t <= 1025 && 767 < t
                            ? (document.body.classList.remove("vertical-sidebar-enable"),
                              "sm" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "") : document.documentElement.setAttribute("data-sidebar-size", "sm"))
                            : 1025 < t
                            ? (document.body.classList.remove("vertical-sidebar-enable"),
                              "lg" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "sm") : document.documentElement.setAttribute("data-sidebar-size", "lg"))
                            : t <= 767 && (document.body.classList.add("vertical-sidebar-enable"), document.documentElement.setAttribute("data-sidebar-size", "lg"))),
                    "semibox" === document.documentElement.getAttribute("data-layout") &&
                        (767 < t
                            ? "show" == document.documentElement.getAttribute("data-sidebar-visibility")
                                ? "lg" == document.documentElement.getAttribute("data-sidebar-size")
                                    ? document.documentElement.setAttribute("data-sidebar-size", "sm")
                                    : document.documentElement.setAttribute("data-sidebar-size", "lg")
                                : (document.getElementById("sidebar-visibility-show").click(), document.documentElement.setAttribute("data-sidebar-size", document.documentElement.getAttribute("data-sidebar-size")))
                            : t <= 767 && (document.body.classList.add("vertical-sidebar-enable"), document.documentElement.setAttribute("data-sidebar-size", "lg"))),
                    "twocolumn" == document.documentElement.getAttribute("data-layout") &&
                        (document.body.classList.contains("twocolumn-panel") ? document.body.classList.remove("twocolumn-panel") : document.body.classList.add("twocolumn-panel"));
            }),
        (e = JSON.parse((e = sessionStorage.getItem("defaultAttribute")))),
        (t = document.documentElement.clientWidth),
        "twocolumn" == e["data-layout"] &&
            t < 767 &&
            Array.from(document.getElementById("two-column-menu").querySelectorAll("li")).forEach(function (e) {
                e.addEventListener("click", function (e) {
                    document.body.classList.remove("twocolumn-panel");
                });
            }),
        (function e() {
            var t = document.querySelectorAll(".counter-value");
            function a(e) {
                return e.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            t &&
                Array.from(t).forEach(function (e) {
                    !(function t() {
                        var n = +e.getAttribute("data-target"),
                            l = +e.innerText,
                            i = n / 250;
                        i < 1 && (i = 1), l < n ? ((e.innerText = (l + i).toFixed(0)), setTimeout(t, 1)) : (e.innerText = a(n)), a(e.innerText);
                    })();
                });
        })(),
        r(),
        document.getElementsByClassName("dropdown-item-cart") &&
            ((z = document.querySelectorAll(".dropdown-item-cart").length),
            Array.from(document.querySelectorAll("#page-topbar .dropdown-menu-cart .remove-item-btn")).forEach(function (e) {
                e.addEventListener("click", function (e) {
                    z--,
                        this.closest(".dropdown-item-cart").remove(),
                        Array.from(document.getElementsByClassName("cartitem-badge")).forEach(function (e) {
                            e.innerHTML = z;
                        }),
                        F(),
                        document.getElementById("empty-cart") && (document.getElementById("empty-cart").style.display = 0 == z ? "block" : "none"),
                        document.getElementById("checkout-elem") && (document.getElementById("checkout-elem").style.display = 0 == z ? "none" : "block");
                });
            }),
            Array.from(document.getElementsByClassName("cartitem-badge")).forEach(function (e) {
                e.innerHTML = z;
            }),
            document.getElementById("empty-cart") && (document.getElementById("empty-cart").style.display = "none"),
            document.getElementById("checkout-elem") && (document.getElementById("checkout-elem").style.display = "block"),
            F()),
        document.getElementsByClassName("notification-check") &&
            (N(),
            Array.from(document.querySelectorAll(".notification-check input")).forEach(function (e) {
                e.addEventListener("change", function (e) {
                    e.target.closest(".notification-item").classList.toggle("active");
                    var t = document.querySelectorAll(".notification-check input:checked").length;
                    e.target.closest(".notification-item").classList.contains("active"), (document.getElementById("notification-actions").style.display = 0 < t ? "block" : "none"), (document.getElementById("select-content").innerHTML = t);
                }),
                    document.getElementById("notificationDropdown").addEventListener("hide.bs.dropdown", function (t) {
                        (e.checked = !1),
                            document.querySelectorAll(".notification-item").forEach(function (e) {
                                e.classList.remove("active");
                            }),
                            (document.getElementById("notification-actions").style.display = "");
                    });
            }) ),
        [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function (e) {
            return new bootstrap.Tooltip(e);
        }),
        [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map(function (e) {
            return new bootstrap.Popover(e);
        }),
        document.getElementById("reset-layout") &&
            document.getElementById("reset-layout").addEventListener("click", function () {
                sessionStorage.clear(), window.location.reload();
            }),
        Array.from(($ = document.querySelectorAll("[data-toast]"))).forEach(function (e) {
            e.addEventListener("click", function () {
                var t = {},
                    a = e.attributes;
                a["data-toast-text"] && (t.text = a["data-toast-text"].value.toString()),
                    a["data-toast-gravity"] && (t.gravity = a["data-toast-gravity"].value.toString()),
                    a["data-toast-position"] && (t.position = a["data-toast-position"].value.toString()),
                    a["data-toast-className"] && (t.className = a["data-toast-className"].value.toString()),
                    a["data-toast-duration"] && (t.duration = a["data-toast-duration"].value.toString()),
                    a["data-toast-close"] && (t.close = a["data-toast-close"].value.toString()),
                    a["data-toast-style"] && (t.style = a["data-toast-style"].value.toString()),
                    a["data-toast-offset"] && (t.offset = a["data-toast-offset"]),
                    Toastify({
                        newWindow: !0,
                        text: t.text,
                        gravity: t.gravity,
                        position: t.position,
                        className: "bg-" + t.className,
                        stopOnFocus: !0,
                        offset: { x: t.offset ? 50 : 0, y: t.offset ? 10 : 0 },
                        duration: t.duration,
                        close: "close" == t.close,
                        style: "style" == t.style ? { background: "linear-gradient(to right, #0AB39C, #405189)" } : "",
                    }).showToast();
            });
        }),
        Array.from(($ = document.querySelectorAll("[data-choices]"))).forEach(function (e) {
            var t = {},
                a = e.attributes;
            a["data-choices-groups"] && (t.placeholderValue = "This is a placeholder set in the config"),
                a["data-choices-search-false"] && (t.searchEnabled = !1),
                a["data-choices-search-true"] && (t.searchEnabled = !0),
                a["data-choices-removeItem"] && (t.removeItemButton = !0),
                a["data-choices-sorting-false"] && (t.shouldSort = !1),
                a["data-choices-sorting-true"] && (t.shouldSort = !0),
                a["data-choices-multiple-remove"] && (t.removeItemButton = !0),
                a["data-choices-limit"] && (t.maxItemCount = a["data-choices-limit"].value.toString()),
                a["data-choices-limit"] && (t.maxItemCount = a["data-choices-limit"].value.toString()),
                a["data-choices-editItem-true"] && (t.maxItemCount = !0),
                a["data-choices-editItem-false"] && (t.maxItemCount = !1),
                a["data-choices-text-unique-true"] && (t.duplicateItemsAllowed = !1),
                a["data-choices-text-disabled-true"] && (t.addItems = !1),
                a["data-choices-text-disabled-true"] ? new Choices(e, t).disable() : new Choices(e, t);
        }),
        Array.from(($ = document.querySelectorAll("[data-provider]"))).forEach(function (e) {
            var t, a, n;
            "flatpickr" == e.getAttribute("data-provider")
                ? ((n = e.attributes),
                  ((t = {}).disableMobile = "true"),
                  n["data-date-format"] && (t.dateFormat = n["data-date-format"].value.toString()),
                  n["data-enable-time"] && ((t.enableTime = !0), (t.dateFormat = n["data-date-format"].value.toString() + " H:i")),
                  n["data-altFormat"] && ((t.altInput = !0), (t.altFormat = n["data-altFormat"].value.toString())),
                  n["data-minDate"] && ((t.minDate = n["data-minDate"].value.toString()), (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-maxDate"] && ((t.maxDate = n["data-maxDate"].value.toString()), (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-deafult-date"] && ((t.defaultDate = n["data-deafult-date"].value.toString()), (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-multiple-date"] && ((t.mode = "multiple"), (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-range-date"] && ((t.mode = "range"), (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-inline-date"] && ((t.inline = !0), (t.defaultDate = n["data-deafult-date"].value.toString()), (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-disable-date"] && ((a = []).push(n["data-disable-date"].value), (t.disable = a.toString().split(","))),
                  n["data-week-number"] && ((a = []).push(n["data-week-number"].value), (t.weekNumbers = !0)),
                  flatpickr(e, t))
                : "timepickr" == e.getAttribute("data-provider") &&
                  ((a = {}),
                  (n = e.attributes)["data-time-basic"] && ((a.enableTime = !0), (a.noCalendar = !0), (a.dateFormat = "H:i")),
                  n["data-time-hrs"] && ((a.enableTime = !0), (a.noCalendar = !0), (a.dateFormat = "H:i"), (a.time_24hr = !0)),
                  n["data-min-time"] && ((a.enableTime = !0), (a.noCalendar = !0), (a.dateFormat = "H:i"), (a.minTime = n["data-min-time"].value.toString())),
                  n["data-max-time"] && ((a.enableTime = !0), (a.noCalendar = !0), (a.dateFormat = "H:i"), (a.minTime = n["data-max-time"].value.toString())),
                  n["data-default-time"] && ((a.enableTime = !0), (a.noCalendar = !0), (a.dateFormat = "H:i"), (a.defaultDate = n["data-default-time"].value.toString())),
                  n["data-time-inline"] && ((a.enableTime = !0), (a.noCalendar = !0), (a.defaultDate = n["data-time-inline"].value.toString()), (a.inline = !0)),
                  flatpickr(e, a));
        }),
        Array.from(document.querySelectorAll('.dropdown-menu a[data-bs-toggle="tab"]')).forEach(function (e) {
            e.addEventListener("click", function (e) {
                e.stopPropagation(), bootstrap.Tab.getInstance(e.target).show();
            });
        }),
        l(),
        s(),
        h(),
        window.addEventListener("resize", function () {
            q && clearTimeout(q), (q = setTimeout(H, 2e3));
        });
})();
var mybutton = document.getElementById("back-to-top");
function scrollFunction() {
    100 < document.body.scrollTop || 100 < document.documentElement.scrollTop ? (mybutton.style.display = "block") : (mybutton.style.display = "none");
}
function topFunction() {
    (document.body.scrollTop = 0), (document.documentElement.scrollTop = 0);
}
mybutton &&
    (window.onscroll = function () {
        scrollFunction();
    });
