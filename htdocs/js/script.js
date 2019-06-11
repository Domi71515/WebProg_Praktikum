//Toggles Mobile Navigation
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

  //Toggle Description for Articles
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

//Helper function to check if Element is empty -> if empty marks background Red
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

//Helper function to check if Element is number -> if is not number marks background red
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

//Updates the button, from disabled to enabled, if all inputs are correct!
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


function searchItems(searchForm) {
  var test = searchForm.parentElement;

  var searchString = test.querySelector('input[name="search"]').value;
  var searchGroup = test.querySelector('select[name="filter"]').value;

  if(searchGroup == ''){
      searchGroup = -1;
  }
  
  fetch('includes/search.php?search=' + searchString + '&filter=' + searchGroup)
  .then((res) => res.json())
  .then((data) => {
    let output = '';
    data.forEach(function(post) {
        output += `
        <option>${post.ArtikelName}</option>
        `;
    });

    document.getElementById('browse').innerHTML = output;
  });

}
