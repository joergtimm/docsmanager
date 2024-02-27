"use strict";

let mainContent;
(function () {
    let html = document.querySelector("html");
    mainContent = document.querySelector(".main-content");

    localStorageBackup();

})();


function localStorageBackup()
{
  // if there is a value stored, update color picker and background color
  // Used to retrive the data from local storage
    if (localStorage.primaryRGB) {
        if (document.querySelector(".theme-container-primary")) {
            document.querySelector(".theme-container-primary").value =
            localStorage.primaryRGB;
        }
        document
        .querySelector("html")
        .style.setProperty("--color-primary", localStorage.primaryRGB1);
        document
        .querySelector("html")
        .style.setProperty("--color-primary-rgb", localStorage.primaryRGB);

        if (localStorage.primaryRGB === "172, 172, 80") {
            if (document.querySelector("#switcher-primary2")) {
                document.querySelector("#switcher-primary2").checked = true;
            }
        }
        if (localStorage.primaryRGB == "58, 88, 146") {
            if (document.querySelector("#switcher-primary")) {
                document.querySelector("#switcher-primary").checked = true;
            }
        }
        if (localStorage.primaryRGB == "92, 144, 163") {
            if (document.querySelector("#switcher-primary1")) {
                document.querySelector("#switcher-primary1").checked = true;
            }
        }
        if (localStorage.primaryRGB == "165, 94, 131") {
            if (document.querySelector("#switcher-primary3")) {
                document.querySelector("#switcher-primary3").checked = true;
            }
        }
        if (localStorage.primaryRGB == "87, 68, 117") {
            if (document.querySelector("#switcher-primary4")) {
                document.querySelector("#switcher-primary4").checked = true;
            }
        }
    }
    if (localStorage.bodyBgRGB) {
        if (document.querySelector(".theme-container-background")) {
            document.querySelector(".theme-container-background").value =
            localStorage.bodyBgRGB;
        }
        document.querySelector("html").style.setProperty("--body-bg", localStorage.bodyBgRGB);
        document.querySelector("html").style.setProperty("--dark-bg", localStorage.darkBgRGB);
        let html = document.querySelector("html");
        html.classList.add("dark");
        html.classList.remove("light");
        localStorage.removeItem("Syntolighttheme");
        html.setAttribute("data-menu-styles", "dark");
        html.setAttribute("data-header-styles", "dark");
        if (!document.querySelector(".authentication-page") && !document.querySelector(".cover1")) {
            document.querySelector("#switcher-dark-theme").checked = true;
        }
        if (localStorage.bodyBgRGB == "64 76 107") {
            if (document.querySelector("#switcher-background")) {
                document.querySelector("#switcher-background").checked = true;
            }
        }
        if (localStorage.bodyBgRGB == "95 107 64") {
            if (document.querySelector("#switcher-background1")) {
                document.querySelector("#switcher-background1").checked = true;
            }
        }
        if (localStorage.bodyBgRGB == "93 64 107") {
            if (document.querySelector("#switcher-background2")) {
                document.querySelector("#switcher-background2").checked = true;
            }
        }
        if (localStorage.bodyBgRGB == "64 101 107") {
            if (document.querySelector("#switcher-background3")) {
                document.querySelector("#switcher-background3").checked = true;
            }
        }
        if (localStorage.bodyBgRGB == "107 64 64") {
            if (document.querySelector("#switcher-background4")) {
                document.querySelector("#switcher-background4").checked = true;
            }
        }
    }
    if (localStorage.Syntodarktheme) {
        let html = document.querySelector("html");
        html.classList.add("dark");
        html.classList.remove("light");
    }
    if (localStorage.Syntolighttheme) {
        let html = document.querySelector("html");
        html.classList.add("light");
        html.classList.remove("dark");
        if (document.querySelector("html").getAttribute("data-nav-layout") == "horizontal") {
            document.querySelector("html").setAttribute("data-menu-styles", "light");
        }
    }
    if (localStorage.Syntortl) {
        let html = document.querySelector("html");
        html.setAttribute("dir", "rtl");
    }
    if (localStorage.Syntolayout) {
        let html = document.querySelector("html");
        let layoutValue = localStorage.getItem("Syntolayout");
        switch (layoutValue) {
            case "vertical":
                html.setAttribute("data-nav-layout", "vertical");
            break;
            case "horizontal":
                html.setAttribute("data-nav-layout", "horizontal");
                let menuNav = document.querySelector(".main-menu");
                let mainContainer1 = document.querySelector(".main-sidebar");
                setTimeout(() => {
                    if (
                    !document.querySelector(".authentication-page") &&
                    !document.querySelector(".cover1")
                ) {
                    if (menuNav.scrollWidth < mainContainer1.offsetWidth) {
                        document.getElementById("slide-right").classList.add("hidden");
                        document.getElementById("slide-left").classList.add("hidden");
                    }
                    }
                }, 500);
            break;
        }
    }

}

