<!DOCTYPE=html>
	<html>
	<meta charset=" UTF-8" />
	<link rel="icon" type="image/x-icon" href="./Images/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="Stylation.css" />
	<div class="container-fluid">

		<head>
			<title>GPA Calculator</title>

		<body>
			<div class="topnav">
				<a href="index.html">About</a>
				<a class="active" href="Calculator.php">Calculator</a>
				<a href="CodeView.html">View Code</a>
			</div>
		</body>
		</head>

		<body>
			<div class="CalcText">
				<h1>GPA Calculator</h1>
				<p>
				<h3>How to use the GPA calculator:</h3>
				<ol type="1">
					<li>Type in your class name, the scale the class is weighed on (for an unweighed GPA set this equal
						to 4.0), and the final grades you finished with.</li>
					<li>If more classes are needed press the teal button and if you added too many classes proceed to
						press the pink, subtract button to remove that field</li>
					<li>Finally, after carefully reviewing all classes press the submit button and your GPA will be
						calculated.</li>
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

					// Function to set a cookie
					function setCookie(name, value, days) {
						const expires = new Date();
						expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
						document.cookie = name + '=' + value + ';expires=' + expires.toUTCString();
					}

					// Function to get a cookie value
					function getCookie(name) {
						const keyValue = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
						return keyValue ? keyValue[2] : null;
					}

					// Function to load data from cookies and recreate fields
					function loadAndRecreateFields() {
						const savedData = getCookie('gpaFormData');
						if (savedData) {
							const formData = JSON.parse(savedData);

							// Recreate the initial field
							document.getElementById('ClassName1').value = formData.ClassName[0];
							document.getElementById('ClassWeight1').value = formData.ClassWeight[0];
							document.getElementById('FinalGrade1').value = formData.FinalGrade[0];

							// Recreate additional fields
							for (let i = 1; i < formData.ClassName.length; i++) {
								RemakeFields(); // Call RemakeFields without an event argument
								const currentFieldCounter = fieldCounter - 1; // Field was already incremented in RemakeFields
								document.getElementById('ClassName' + currentFieldCounter).value = formData.ClassName[i];
								document.getElementById('ClassWeight' + currentFieldCounter).value = formData.ClassWeight[i];
								document.getElementById('FinalGrade' + currentFieldCounter).value = formData.FinalGrade[i];
							}
						}
					}

					// Load and recreate fields when the page is loaded
					window.addEventListener('load', loadAndRecreateFields);

					// Function to save form data to cookies
					function saveFormDataToCookie() {
						const formData = {
							ClassName: [],
							ClassWeight: [],
							FinalGrade: []
						};

						const classNames = document.getElementsByName("ClassName[]");
						const classWeights = document.getElementsByName("ClassWeight[]");
						const finalGrades = document.getElementsByName("FinalGrade[]");


						for (let i = 0; i < classNames.length; i++) {
							const className = classNames[i].value || '';
							const classWeight = classWeights[i] ? classWeights[i].value : '';
							const finalGrade = finalGrades[i] ? finalGrades[i].value : '';

							formData.ClassName.push(className);
							formData.ClassWeight.push(classWeight);
							formData.FinalGrade.push(finalGrade);
						}

						setCookie('gpaFormData', JSON.stringify(formData), 7);
					}


					function RemakeFields(event) {
						if (event) {
							event.preventDefault();
						}

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

						// Add the name label
						NameLabel.htmlFor = "Classname";
						NameLabel.innerText = " Class Name: ";

						// Add the class weight label
						WeightLabel.htmlFor = "ClassWeight";
						WeightLabel.innerText = " Class Weight: ";

						// Add final grade label
						GradeLabel.htmlFor = "FinalGrade";
						GradeLabel.innerText = " Final Grade: ";

						// Set Input fields
						const currentFieldCounter = fieldCounter; // Store current field counter value
						NameInput.type = "text";
						NameInput.name = "ClassName[]";
						NameInput.id = "ClassName" + currentFieldCounter;
						NameInput.setAttribute("required", "");
						NameInput.classList.add("input-field");

						// Set Input fields
						WeightInput.type = "number";
						WeightInput.name = "ClassWeight[]";
						WeightInput.id = "ClassWeight" + currentFieldCounter;
						WeightInput.step = "0.1";
						WeightInput.max = "5";
						WeightInput.setAttribute("required", "");
						WeightInput.classList.add("input-field");

						// Set Input fields
						GradeInput.type = "text";
						GradeInput.name = "FinalGrade[]";
						GradeInput.id = "FinalGrade" + currentFieldCounter;
						GradeInput.step = "1";
						GradeInput.max = "110";
						GradeInput.setAttribute("required", "");
						GradeInput.classList.add("input-field");

						// Set button DEL
						btnDel.type = "button";
						btnDel.classList.add("btn-del-input");
						btnDel.innerText = "-";

						// Append elements to main wrapper
						nef_wrapper.appendChild(NameLabel);
						nef_wrapper.appendChild(NameInput);
						nef_wrapper.appendChild(WeightLabel);
						nef_wrapper.appendChild(WeightInput);
						nef_wrapper.appendChild(GradeLabel);
						nef_wrapper.appendChild(GradeInput);
						nef_wrapper.appendChild(btnDel);

						// Append element to DOM
						myForm.appendChild(nef_wrapper);
						btnDel.addEventListener("click", removeEmailField);
						fieldCounter++;

						function removeEmailField(el) {
							const field = el.target.parentElement;
							field.remove();
							saveFormDataToCookie(); // Save data after removing a field
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
							saveFormDataToCookie();
						}

						// If no issues found, submit the form
						myForm.submit();
					}
				</script>
			</div>
		</body>
	</div>

	</html>