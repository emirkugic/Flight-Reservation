$(document).ready(function () {
	$("#skipCheckbox").change(function () {
		if ($(this).is(":checked")) {
			$(".name-input, .phone-input, .dob-input").prop("disabled", true);
			$(".name-input, .phone-input, .dob-input").css(
				"background-color",
				"darkgrey"
			);
		} else {
			$(".name-input, .phone-input, .dob-input").prop("disabled", false);
			$(".name-input, .phone-input, .dob-input").css(
				"background-color",
				"white"
			);
		}
	});
});

const showPassword = document.querySelector(".show-password");
const passwordInput = document.querySelector(".password-input");

showPassword.addEventListener("click", () => {
	const type =
		passwordInput.getAttribute("type") === "password" ? "text" : "password";
	passwordInput.setAttribute("type", type);
	showPassword.textContent = type === "password" ? "Show" : "Hide";
});
