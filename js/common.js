 
  window.onscroll = function () {
    const btn = document.getElementById("goTopBtn");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      btn.style.display = "block";
    } else {
      btn.style.display = "none";
    }
  };

  // Scroll to top on click
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
 