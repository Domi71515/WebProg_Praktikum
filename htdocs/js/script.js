function toggleNav() {
    var d = document.getElementById("mobileNavigation");
    var mobileNav = d.classList.contains("moveIn");
    console.log(d);

    if(mobileNav) {
      d.className = "moveOut";
      mobileNav = !mobileNav;
    }
    else {
      d.className = "moveIn";
      mobileNav = !mobileNav;
    }
  }

  function showDetail(b) {
    var e = document.getElementById(b.id);
    var detail = e.classList.contains("showDetail")
    if(detail) {
      e.className = "hideDetail";
      detail = !detail;
    }
    else {
      e.className = "showDetail"; 
      detail = !detail;
    }
  }