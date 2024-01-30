<!DOCTYPE=html>
	<html>
	<meta charset=" UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="stylesheet" href="main.css" />
	<link rel="stylesheet" href="Stylation.css" />
	<div class="container-fluid">

		<head>

		<body>
			<div class="topnav">
				<a href="index.html">Home</a>
				<a class="active" href="Calculator.html">Calculator</a>
				<a href="FAQ.html">FAQ</a>
			</div>
		</body>
		</head>

		<body>
			<div class="CalcText">
				<h1>GPA Calculator</h1>
				<p>
				<h3>How to use the GPA calculator:</h3>
					<ol type="1">
					  <li>Type in your class name, the scale the class is weighed on (For an unweighed GPA set this equal to 4.0), and the final grads you finished with.</li>
					    <li>If more classes are needed press the teal button and if you added too many classes proceed to press the pink, subtract button to remove that field</li>
						  <li>Finally, after carefully reviewing all classes press the submit button and your GPA will be calculated.</li>
						  </ol>
				</p>
				<h2>Add Your Classes:</h2>
				<div class="AllClassTextBox">
					<form class="GPACalculator" id="GPACalculator"
						action="<?php echo htmlspecialchars('Results.php'); ?>" method="post" target="_blank">

						<fieldset class="InfoList" id="InfoList">
							<label for="ClassName">Class Name:</label>
							<input type="text" id="ClassName1" name="ClassName[]" class="input-field" required />

							<label for="ClassWeight1">Class Weight:</label>
							<input type="number" id="ClassWeight1" name="ClassWeight[]" class="input-field" step="0.1"
								max="5" required />

							<label for="FinalGrade1">Final Grade:</label>
							<input type="number" id="FinalGrade1" name="FinalGrade[]" class="input-field" step="1"
								max="110" required />
						</fieldset>
						<button class="btn-add-input" onclick="RemakeFields(event)" type="button">+</button>

						<button class="btn-submit" type="button" onclick="checkAndSubmit()">
							SUBMIT
						</button>

					</form>
				</div>
				<script>
					const myForm = document.getElementById("InfoList");
					let fieldCounter = 2;

					function RemakeFields(event) {
						event.preventDefault();
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
						NameInput.name = "ClassName[]";
						NameInput.id = "ClassName" + fieldCounter;
						NameInput.setAttribute("required", "");
						NameInput.classList.add("input-field");

						// set Input field
						WeightInput.type = "number";
						WeightInput.name = "ClassWeight[]" + fieldCounter;
						WeightInput.id = "ClassWeight" + fieldCounter;
						WeightInput.step = "0.1";
						WeightInput.max = "5";
						WeightInput.setAttribute("required", "");
						WeightInput.classList.add("input-field");

						// set Input field
						GradeInput.type = "text";
						GradeInput.name = "FinalGrade[]" + fieldCounter;
						GradeInput.id = "FinalGrade" + fieldCounter;
						GradeInput.step = "1";
						GradeInput.max = "110";
						GradeInput.setAttribute("required", "");
						GradeInput.classList.add("input-field");
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
						//raise the counter
						fieldCounter++;

						function removeEmailField(el) {
							const field = el.target.parentElement;
							field.remove();
						}

					}
					function checkAndSubmit() {
						const myForm = document.getElementById("GPACalculator");
						const classNames = document.getElementsByName("ClassName[]");
						const classWeights = document.getElementsByName("ClassWeight[]");

						for (let i = 0; i < classNames.length; i++) {
							const className = classNames[i].value.toLowerCase();
							const classWeightElement = classWeights[i];

							if (!classWeightElement) {
								continue;
							}

							const classWeight = parseFloat(classWeightElement.value);
							const lowerCaseClassName = className.toLowerCase();

							if ((lowerCaseClassName.includes('honors') && classWeight < 4.5) ||
								((lowerCaseClassName.includes('ap') || lowerCaseClassName.includes('advanced placement')) && classWeight < 5.0)) {
								const confirmed = confirm(`Warning: You have one or more classes with weights below the recommended level. Do you want to continue?`);
								if (!confirmed) {
									return; // Abort form submission
								}
							}
						}

						// If no issues found, submit the form
						myForm.submit();
					}









				</script>
			</div>
		</body>
	</div>

	</html>