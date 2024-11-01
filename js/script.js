function showHiddenForm() {
    document.getElementById('hidden_form').style.display = 'block';
    document.getElementById('multi').value = 1;
    
}

function hideHiddenForm() {
    document.getElementById('hidden_form').style.display = 'none';
}

function addExtraInputs() {
    let extraInput_container = document.getElementById('extra_cfs');
    let extraInput_num = document.getElementById('num').value;  //todo L'input in html fa sì che questo valore sia sempre compreso tra 0 e 4 (inclusi)
    extraInput_container.innerHTML = "";                        //todo pulisce eventuali input di codice fiscali già presenti per rimpiazzarli con quelli nuovi in numero adeguato all'input inserito
    for(let i = 2; i <= extraInput_num; i++) {
        let current_id = "fiscal_code_add_" + i;
        let new_cf_input = document.createElement("input");
        new_cf_input.setAttribute("type", "text");
        new_cf_input.setAttribute("name", current_id);
        new_cf_input.setAttribute("id", current_id);
        new_cf_input.setAttribute("class", "form-control");
        new_cf_input.setAttribute("maxlength", "16");
        new_cf_input.setAttribute("required", true);
        new_cf_input.setAttribute("placeholder", "CF AGGIUNTIVO...");
        new_cf_input.setAttribute("value", "");
        extraInput_container.appendChild(new_cf_input);
    }
}
