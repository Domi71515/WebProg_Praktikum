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

function checkNotEmpty(element) 
{
  if(element.value == "")
  {
    element.className = "inputError";
  }
  else
  {
    element.className = "";
  }

  updateButton();
}

function checkIsNumber(element)
{
  if(element.value == "")
  {
    element.className = "inputError";
  }
  else
  {
    var pattern = new RegExp('^\\d+$');
    if(!pattern.test(element.value))
    {
      element.className = "inputError";
    }
    else
    {
      element.className = "";
    }
  }

  updateButton();
}

function updateButton()
{
  var firstname = document.getElementsByName("firstname")[0];
  var lastname = document.getElementsByName("surename")[0];
  var telefon = document.getElementsByName("telefon")[0];
  var company = document.getElementsByName("company")[0];
  var address = document.getElementsByName("address")[0];
  var location = document.getElementsByName("location")[0];
  var country = document.getElementsByName("country")[0];
  var postcode = document.getElementsByName("postcode")[0];

  var inputs = [firstname, lastname, telefon, company, address, location, country, postcode];

  var submit = document.getElementsByName("submitRegister")[0];

  var errorFound = false;

  inputs.forEach(function(item){
    if(item.value == "") {
      errorFound = true;
    }
    if(item.className == "inputError"){
      errorFound = true;
    }
  });

  submit.disabled = errorFound;
  

}