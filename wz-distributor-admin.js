function myFunction() {
    var copyText = document.getElementById("wz-shortcode");
    copyText.select();
    document.execCommand("copy");
    
    var tooltip = document.getElementById("wz-Tooltip");
    tooltip.innerHTML = "Copied: " + copyText.value;
  }
  
  function outFunc() {
    var tooltip = document.getElementById("wz-Tooltip");
    tooltip.innerHTML = "Copy to clipboard";
  }