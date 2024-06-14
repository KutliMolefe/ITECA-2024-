 document.addEventListener('DOMContentLoaded', function() {
      var dropdownToggle = document.querySelector('.dropdown_toggle');
      var dropdownContent = document.querySelector('.custom-dropdown');

      dropdownToggle.addEventListener('click', function(event) {
        event.preventDefault();
        if (dropdownContent.style.display === 'block') {
          dropdownContent.style.display = 'none';
        } else {
          dropdownContent.style.display = 'block';
        }
      });
	});
	    document.addEventListener('DOMContentLoaded', function() {
    var header = document.querySelector('header');
    var blackBackground = document.querySelector('#video-background2');

    var headerHeight = header.offsetHeight;
    var blackBackgroundTop = blackBackground.offsetTop;

    window.addEventListener('scroll', function() {
        var scrollTop = window.scrollY || window.pageYOffset;

        if (scrollTop >= blackBackgroundTop - headerHeight) {
            header.style.backgroundColor = 'rgba(255, 255, 255, 0.7)'; 
            header.style.boxShadow = '0 0 10px 10px rgba(255, 255, 255, 0.5)'; 
            header.style.backdropFilter = 'blur(10px)'; 
        } else {
            header.style.backgroundColor = 'transparent'; 
            header.style.boxShadow = 'none'; 
            header.style.backdropFilter = 'none';
        }
    });
});

		window.addEventListener('scroll', function() {
    var h3Elements = document.querySelectorAll('h3');
    h3Elements.forEach(function(element) {
        var elementTop = element.getBoundingClientRect().top;
        var screenHeight = window.innerHeight;
        if (elementTop < screenHeight * 0.75) { 
            element.style.animationPlayState = 'running'; 
        } else {
            element.style.animationPlayState = 'paused'; 
        }
    });
});
		window.addEventListener('scroll', function() {
    var h4Elements = document.querySelectorAll('h4');
    h4Elements.forEach(function(element) {
        var elementTop = element.getBoundingClientRect().top;
        var screenHeight = window.innerHeight;
        if (elementTop < screenHeight * 0.75) { 
            element.style.animationPlayState = 'running'; 
        } else {
            element.style.animationPlayState = 'paused'; 
        }
    });
});

 window.onload = function() {
           
            if (localStorage.getItem('userLoggedIn') === 'true') {
              
                document.getElementById('form-open').innerHTML = 'Logout';
                document.getElementById('form-open').onclick = function() {
                 
                    localStorage.setItem('userLoggedIn', 'false');
                    window.location.href = 'login.php'; 
                };
            }
        };

const formOpenBtn = document.querySelector("#form-open"),
  home = document.querySelector(".home"),
  formContainer = document.querySelector(".form_container"),
  formCloseBtn = document.querySelector(".form_close"),
  signupBtn = document.querySelector("#signup"),
  loginBtn = document.querySelector("#login"),
  pwShowHide = document.querySelectorAll(".pw_hide");

formOpenBtn.addEventListener("click", () => home.classList.add("show"));

formCloseBtn.addEventListener("click", () => home.classList.remove("show"));



pwShowHide.forEach((icon) => {
  icon.addEventListener("click", () => {
    let getPwInput = icon.parentElement.querySelector("input");
    if (getPwInput.type === "password") {
      getPwInput.type = "text";
      icon.classList.replace("uil-eye-slash", "uil-eye");
    } else {
      getPwInput.type = "password";
      icon.classList.replace("uil-eye", "uil-eye-slash");
    }
  });
});

signupBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.add("active");
});
loginBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.remove("active");
});

document.addEventListener('DOMContentLoaded', () => {
    const loginFormOpenButton = document.getElementById('form-open');
    const homeSection = document.querySelector('.home');
    const formContainer = document.querySelector('.form_container');
    const formCloseButton = document.querySelector('.form_close');

    loginFormOpenButton.addEventListener('click', () => {
        homeSection.classList.add('show');
        formContainer.classList.add('active');
    });

    formCloseButton.addEventListener('click', () => {
        homeSection.classList.remove('show');
        formContainer.classList.remove('active');
    });
});
