/*!
 * Start Bootstrap - Agency v7.0.11 (https://startbootstrap.com/theme/agency)
 * Copyright 2013-2022 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-agency/blob/master/LICENSE)
 */
//
// Scripts
window.addEventListener("DOMContentLoaded", (event) => {
  let lastScrollTop = 0;
  const navbar = document.querySelector(".navbar");

  window.addEventListener("scroll", function () {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > 50) {
      navbar.classList.add("scrolled");

      if (scrollTop > lastScrollTop) {
        // Scrolling down - ocultar navbar
        navbar.style.transform = "translateY(-100%)";
      } else {
        // Scrolling up - mostrar navbar
        navbar.style.transform = "translateY(0)";
      }
    } else {
      navbar.classList.remove("scrolled");
      navbar.style.transform = "translateY(0)";
    }

    lastScrollTop = scrollTop;
  });

  document.querySelectorAll(".formulario").forEach((formulario) => {
    formulario.addEventListener("submit", async (event) => {
      // console.log('here');
      event.preventDefault();
      const formData = new FormData(formulario);
      if (isNaN(formData.get("telefono"))) {
        fireToast("warning", "Telefono y WhatsApp solo deben ser numeros");
        return;
      }

      if (formData.get("telefono").length !== 10) {
        fireToast("warning", "Telefono y WhatsApp deben ser de 10 digitos");
        return;
      }
      if (
        !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(
          formData.get("email")
        )
      ) {
        fireToast("warning", "Email es Invalido");
        return;
      }

      // console.log('aca');

      // deshabilitamos el submit
      // document.getElementById("enviar-formulario2").disabled = true;
      document.getElementById("enviar-formulario").disabled = true;
      //
      const response = await fetch("https://secofyl.com/php/index.php", {
        method: "POST",
        body: formData,
      }).then((r) => r.json());
      if (response.success === false) {
        fireToast(
          "warning",
          "Hubo un error al momento de enviar el correo, por favor intente de nuevo"
        );
        return;
      }
      fireToast("success", "Mensaje Enviado con Exito");
      setTimeout(() => {
        window.location.reload();
      }, 2000);
    });
  });

  // formulario

  //
  //animaciones con la libreria aos
  AOS.init({
    startEvent: "DOMContentLoaded",
  });

  // Initialize Swiper for clients section
  new Swiper(".mySwiperClients", {
    slidesPerView: 2,
    spaceBetween: 20,
    loop: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 5,
        spaceBetween: 50,
      },
    },
  });
});

const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
});

const fireToast = (icon, title) => {
  Toast.fire({
    icon,
    title,
  });
};
