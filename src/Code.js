var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
    } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
    } 
    });
}
					const myForm = document.getElementById("InfoList");

					function RemakeFields() {
						// Create elements
						const nef_wrapper = document.createElement("div");

						const NameLabel = document.createElement("label");
						const NameInput = document.createElement("input");

						const WeightLabel = document.createElement("Label");
						const WeightInput = document.createElement("input");

						const GradeLabel = document.createElement("label");
						const GradeInput = document.createElement("input");

						const btnAdd = document.createElement("button");
						const btnDel = document.createElement("button");

						// Add Class to main wrapper
						nef_wrapper.classList.add("input__w");

						//Add the name label
						NameLabel.for = "Classname";
						NameLabel.innerText = " Class Name: ";

						//Add the class weight label
						WeightLabel.for = "ClassWeight";
						WeightLabel.innerText = " Class Weight: ";

						//Add final grade label
						GradeLabel.for = "FinalGrade";
						GradeLabel.innerText = " Final Grade: ";
						//
						//
						//
						// set Input field
						NameInput.type = "text";
						NameInput.name = "ClassName";
						NameInput.id = "ClassName";
						NameInput.setAttribute("required", "");
						NameInput.classList.add("input-field");

						// set Input field
						WeightInput.type = "text";
						WeightInput.name = "ClassWeight";
						WeightInput.id = "ClassWeight";
						WeightInput.setAttribute("required", "");
						WeightInput.classList.add("input-field");

						// set Input field
						GradeInput.type = "text";
						GradeInput.name = "FinalGrade";
						GradeInput.id = "FinalGrade";
						GradeInput.setAttribute("required", "");
						GradeInput.classList.add("input-field");
						//
						//
						//
						// set button DEL
						btnDel.type = "button";
						btnDel.classList.add("btn-del-input");
						btnDel.innerText = "-";

						//append elements to main wrapper
						nef_wrapper.appendChild(NameLabel);
						nef_wrapper.appendChild(NameInput);
						nef_wrapper.appendChild(WeightLabel);
						nef_wrapper.appendChild(WeightInput);
						nef_wrapper.appendChild(GradeLabel);
						nef_wrapper.appendChild(GradeInput);
						nef_wrapper.appendChild(btnDel);

						// append element to DOM
						myForm.appendChild(nef_wrapper);
						btnDel.addEventListener("click", removeEmailField);

						function removeEmailField(el) {
							const field = el.target.parentElement;
							field.remove();
						}
					}