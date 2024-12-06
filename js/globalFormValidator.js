import usuarioFormValidator from "./usuarioFormValidator.js";
import alterarSenhaFormValidator from "./alterarSenhaFormValidator.js";
import pacienteFormValidator from "./pacienteFormValidator.js";
import medicoFormValidator from "./medicoFormValidator.js";
import consultaFormValidator from "./consultaFormValidator.js";

const consultaAddEditForm = document.getElementById("consultaAddEditForm");
const medicoAddEditForm = document.getElementById("medicoAddEditForm");
const pacienteAddEditForm = document.getElementById("pacienteAddEditForm");
const usuarioAddEditForm = document.getElementById("usuarioAddEditForm");
const usuarioAlterarSenhaForm = document.getElementById("usuarioAlterarSenhaForm");

const addEditValidationErrors = document.getElementById("addEditValidationErrors");
const alterSenhaValidationErrors = document.getElementById()
const  warningDiv = document.createElement("div");
warningDiv.classList.add("alert");
warningDiv.classList.add("alert-danger");
warningDiv.classList.add("text-center");
warningDiv.classList.add("w-25");
warningDiv.classList.add("mx-3");
addEditValidationErrors.appendChild(warningDiv);
alterSenhaValidationErrors.appendChild(warningDiv);

if(usuarioAddEditForm) {
    usuarioAddEditForm.addEventListener("submit", (e) => usuarioFormValidator(e, addEditValidationErrors, warningDiv));
}

if(usuarioAlterarSenhaForm) {
    usuarioAlterarSenhaForm.addEventListener("submit", (e) => alterarSenhaFormValidator(e, alterSenhaValidationErrors, warningDiv));
}

if(pacienteAddEditForm) {
    pacienteAddEditForm.addEventListener("submit", (e) => pacienteFormValidator(e, addEditValidationErrors, warningDiv));
}

if(medicoAddEditForm) {
    medicoAddEditForm.addEventListener("submit", (e) => medicoFormValidator(e, addEditValidationErrors, warningDiv));
}

if(consultaAddEditForm) {
    consultaAddEditForm.addEventListener("submit", (e) => consultaFormValidator(e, addEditValidationErrors, warningDiv));
}

