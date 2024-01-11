document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  darkMode();
});

function darkMode() {
  //Lee las preferencas del sistema
  const preferenciaDarkMode = window.matchMedia("(prefers-color-scheme:dark");

  //console.log(preferenciaDarkMode);

  if (preferenciaDarkMode.matches) {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }

  preferenciaDarkMode.addEventListener("change", function () {
    if (preferenciaDarkMode.matches) {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  });

  const botonDarkMode = document.querySelector(".dark-mode-boton");

  botonDarkMode.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");
  });
}





function eventListeners() {
  const mobileMenu = document.querySelector(".mobile-menu");
  mobileMenu.addEventListener("click", navegacionResponsive);

  //Muestra campos condicionales
  const metodoContacto = document.querySelectorAll(
    'input[name="contacto[contacto]"'
  );

  metodoContacto.forEach((input) =>
    input.addEventListener("click", mostrarMetodosContacto)
  );
}





function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");
  navegacion.classList.toggle("mostrar");
}




function mostrarMetodosContacto(event) {
  const contactoDiv = document.querySelector("#contacto");

  if (event.target.value === "telefono") {
    contactoDiv.innerHTML = `
    <label>Telefono</label>
        <input type="tel" placeholder="telefono" id="telefono" name="contacto[telefono]">
        
        <p>Si elijio telefono elija la fecha y la hora para la llamada</p>
                <label for="fecha">Fecha</label>
                <input  type="date" name="contacto[fecha]" id="fecha">

                <label for="hora">Hora</label>
                <input  type="time" id="hora" name="contacto[hora]" min="9:00" max="18:00">

        `;
  } else {
    contactoDiv.innerHTML = `     
        <label>Email</label>
        <input type="email"" placeholder="Email" id="email" name="contacto[email]" required>
`;
  }
}
