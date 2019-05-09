function toggleNav() {
    var d = document.getElementById("mobileNavigation");
    var mobileNav = d.classList.contains("moveIn");

    if(mobileNav) {
      d.className = "moveOut";
      mobileNav = !mobileNav;
    }
    else {
      d.className = "moveIn";
      mobileNav = !mobileNav;
    }
  }