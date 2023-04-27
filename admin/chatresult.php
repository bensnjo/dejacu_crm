function createForm() {
  const formDiv = document.createElement("div");
  formDiv.classList.add("row");

  const col1 = document.createElement("div");
  col1.classList.add("col");

  const formGroup1 = document.createElement("div");
  formGroup1.classList.add("form-group");

  const label1 = document.createElement("label");
  label1.textContent = "EQUIPMENT";

  const input1 = document.createElement("input");
  input1.type = "text";
  input1.classList.add("form-control");
  input1.id = "exampleInputPassword";
  input1.placeholder = "Name";
  input1.name = "equipment";
  input1.required = true;
  input1.value = "";

  formGroup1.appendChild(label1);
  formGroup1.appendChild(input1);
  col1.appendChild(formGroup1);

  const col2 = document.createElement("div");
  col2.classList.add("col");

  const formGroup2 = document.createElement("div");
  formGroup2.classList.add("form-group");

  const label2 = document.createElement("label");
  label2.textContent = "CHARGER";

  const input2 = document.createElement("input");
  input2.type = "checkbox";
  input2.classList.add("form-control");
  input2.name = "charger";
  input2.value = "";
  input2.id = "flexCheckChecked";
  input2.checked = true;

  formGroup2.appendChild(label2);
  formGroup2.appendChild(input2);
  col2.appendChild(formGroup2);

  const col3 = document.createElement("div");
  col3.classList.add("col");

  const formGroup3 = document.createElement("div");
  formGroup3.classList.add("form-group");

  const label3 = document.createElement("label");
  label3.textContent = "QTY";

  const input3 = document.createElement("input");
  input3.type = "text";
  input3.classList.add("form-control");
  input3.id = "exampleInputPassword";
  input3.placeholder = "Qty";
  input3.name = "serialNumber";
  input3.required = true;
  input3.value = "";

  formGroup3.appendChild(label3);
  formGroup3.appendChild(input3);
  col3.appendChild(formGroup3);

  const col4 = document.createElement("div");
  col4.classList.add("col");

  const formGroup4 = document.createElement("div");
  formGroup4.classList.add("form-group");

  const label4 = document.createElement("label");
  label4.textContent = "MODEL";

  const input4 = document.createElement("input");
  input4.type = "text";
  input4.classList.add("form-control");
  input4.id = "exampleInputPassword";
  input4.placeholder = "Model";
  input4.name = "modelseq";
  input4.required = true;
//////////////////////////////////////////////////////////////////////////
function replicateHTML() {
  // Get the container element where the HTML will be replicated
  const container = document.getElementById("container");

  // Create the HTML string
  const html = `
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label>EQUIPMENT</label>
          <input type="text" class="form-control" id="exampleInputPassword" 
          placeholder="Name" name="equpment" required value= "">
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label>CHARGER</label>
          <input class="form-control" type="checkbox" name="charger" value="" id="flexCheckChecked" checked>
        </div>
      </div>
    </div>
  `;

  // Add the HTML to the container
  container.innerHTML = html;

  // Get the first input field
  const input = document.querySelector('input[name="equpment"]');

  // Update the value of the first input field whenever the user types in it
  input.addEventListener("input", (event) => {
    const value = event.target.value;
    input.setAttribute("value", value);
  });
}

// Call the function to replicate the HTML and add the event listener
replicateHTML();

