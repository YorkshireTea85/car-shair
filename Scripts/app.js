window.addEventListener("DOMContentLoaded", (event) => {
    const profileBtn = document.getElementById("user-menu-button");
    const profileMenu = document.getElementById("profile-menu");
    const mobileMenuBtn = document.getElementById("mobile-menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");
    const mobileMenuIcons = document.getElementsByClassName("menu-icon");
    const signupForm = document.getElementById("signup-form");
    const signupFirst = document.getElementById("signup-first");
    const signupFirstError = document.getElementById("first-error");
    const signupLast = document.getElementById("signup-last");
    const signupLastError = document.getElementById("last-error");
    const signupUid = document.getElementById("signup-uid");
    const signupUidError = document.getElementById("uid-error");
    const signupEmail = document.getElementById("signup-email");
    const signupEmailError = document.getElementById("email-error");
    const signupPwd = document.getElementById("signup-pwd");
    const signupPwd2 = document.getElementById("signup-pwd2");
    const signupPwdError = document.getElementById("pwd-error");
    const signupPwd2Error = document.getElementById("pwd2-error");
    const restrictedChars = ['&', '=', '_', "'" ,'-', '+', ',', '<', '>', '..'];
    const signupDriver = document.getElementById("signup-driver");
    const signupOwner = document.getElementById("signup-owner");
    const UserTypeError = document.getElementById("signup-user-type");
    const addressSelect = document.getElementById("address-select");
    const addAddress = document.getElementById("add-address");
    const availabilityCheckboxes = document.getElementsByClassName("availability-checkbox");
    const availabilityTimes = document.getElementsByClassName("availability-time");
    const addVehicleForm = document.getElementById("add-vehicle-form");
    const registration = document.getElementById("registration");
    const registrationError = document.getElementById("registration-error");
    
    
    var profileMenuIsActive = false;
    var mobileMenuIsActive = false;
    var uidErrorState = false;

    profileBtn.addEventListener("click", () => {
        if (profileMenuIsActive == false) {
            profileMenu.classList.remove("hidden");
            profileBtn.classList.add("border-2", "border-solid", "border-white");
            profileMenuIsActive = !profileMenuIsActive;
        } else {
            profileMenu.classList.add("hidden");
            profileBtn.classList.remove("border-2", "border-solid", "border-white");
            profileMenuIsActive = !profileMenuIsActive;
        }
    });

    mobileMenuBtn.addEventListener("click", () => {
        Array.from(mobileMenuIcons).forEach((icon) => {
            icon.classList.toggle("hidden");
            icon.classList.toggle("block");
        });
        mobileMenu.classList.toggle("hidden");
        if (mobileMenuIsActive == false) {
            mobileMenu.classList.remove("hidden");
            mobileMenuBtn.classList.add("border-2", "border-solid", "border-white");
            mobileMenuIsActive = !mobileMenuIsActive;
        } else {
            mobileMenu.classList.add("hidden");
            mobileMenuBtn.classList.remove("border-2", "border-solid", "border-white");
            mobileMenuIsActive = !mobileMenuIsActive;
        }
        
    });

    //  sigup form validation //

    function signupShowError() {
        //First Name error
        if (signupFirst.validity.valueMissing) {
            // If the field is empty,
            signupFirstError.innerText = "*First name required";
          } else if (signupFirst.validity.tooLong) {
            signupFirstError.innerText = "*Name is too long, max 256 characters";
          } else {
            signupFirstError.innerText = "";
          };

        //Last Name error
        if (signupLast.validity.valueMissing) {
            // If the field is empty,
            signupLastError.innerText = "*Last name required";
            } else {
                signupLastError.innerText = "";
            };

        //Email error
        if (signupEmail.validity.valueMissing) {
          // If the field is empty,
          signupEmailError.innerText = "*Please enter a valid email address";
        } else if (signupEmail.validity.typeMismatch) {
          // If the field doesn't contain an email address,
          signupEmailError.innerText = "*Entered value must be a valid email address.";
        }  else {
            signupEmailError.innerText = "";
        };

        //Username errors
        if (signupUid.validity.valueMissing) {
            // If the field is empty,
            signupUidError.innerText = "*Username required";
            uidErrorState = true;
        } else {
            for (char of restrictedChars) {
                if (signupUid.value.includes(char)) {
                    signupUidError.innerText = "*Username cannot contain special characters (& = _ ' - + , < > ..)";
                    uidErrorState = true;
                }
            };

            if (!uidErrorState) {
                signupUidError.innerText = "";
            };
        };

        //Password errors
        if (signupPwd.validity.valueMissing) {
            // If the field is empty,
            signupPwdError.innerText = "*Password required";
        } else if ((signupFirst.value && signupLast.value) && (signupPwd.value.includes(signupFirst.value) || signupPwd.value.includes(signupLast.value))) {
            signupPwdError.innerText = "Password must not contain first or last name";
        } else if ((signupUid.value) && (signupPwd.value.includes(signupUid.value) || signupPwd.value.includes(signupLast.value))) {
            signupPwdError.innerText = "Password cannot be the same as your username";
        } else {
            signupPwdError.innerText = "";
        };
        
        //Password reentry errors
        if (signupPwd2.validity.valueMissing) {
            // If the field is empty,
            signupPwd2Error.innerText = "*Please re-enter the password";
            }  else if (signupPwd.value !== signupPwd2.value) {
                signupPwd2Error.innerText = "*Passwords do not match";
            } else {
            signupPwd2Error.innerText = "";
        };

        //User Type Radio Errors
        if (!signupDriver.checked && !signupOwner.checked) {
            UserTypeError.innerText = "*Please select a user type.";
        } else {
            UserTypeError.innerText = "";
        }
        };
    
        if (signupForm) {
            signupForm.addEventListener("submit", (event) => {
                uidErrorState = false;
                // if the first name field is invalid
                if (!signupFirst.validity.valid) {
                    signupShowError();
                    event.preventDefault();
                // if the last name field is invalid   
                } else if (!signupLast.validity.valid) {
                    signupShowError();
                    event.preventDefault();
                // if the email field is invalid
                } else if (!signupEmail.validity.valid) {
                    signupShowError();
                    event.preventDefault();
                // if the uid field is invalid
                } else if (!signupUid.validity.valid) {
                    signupShowError();
                    event.preventDefault();
                // if the password field is invalid
                }  else if (!signupPwd.validity.valid) {
                    signupShowError();
                    event.preventDefault();
                // if the re-enter password field is invalid
                }  else if (!signupPwd2.validity.valid) {
                    signupShowError();
                    event.preventDefault();
                // if the account type field is invalid
                } else if (!signupDriver.checked && !signupOwner.checked) {
                    signupShowError();
                    event.preventDefault();
                };
            });
        }
        
    if (addressSelect) {
        addressSelect.addEventListener("change", (event)=> {
            console.log(event.target.value);
            if (event.target.value === "add-new") {
                addAddress.removeAttribute ("hidden");
            } else {
                addAddress.setAttribute("hidden", "");
            }
        })
    }

    for (let i = 0; i < availabilityCheckboxes.length; i++) {
      availabilityCheckboxes[i].addEventListener("click", () => {
        if (availabilityCheckboxes[i].checked) {
            availabilityTimes[i].removeAttribute("hidden");
        } else {
            availabilityTimes[i].setAttribute("hidden", "");
        }
      });
    }

    //add vehicle form validation
    function addVehicleShowError() {
        //First Name error
        if (registration.validity.valueMissing) {
            // If the field is empty,
            registrationError.innerText = "*Registration required";
          } else if (registration.validity.tooLong) {
            registrationError.innerText = "*Registration cannot be more than 8 characters inc spaces";
          } else {
            registrationError.innerText = "";
          };
    }

    if (addVehicleForm) {
        addVehicleForm.addEventListener("submit", (event) => {
            console.log(registration);
            // if the first name field is invalid
            if (!registration.validity.valid) {
                addVehicleShowError();
                event.preventDefault(); 
            } else {
                console.dir(registration);
            }
        })
    }

    

    // const w3wMap = document.getElementById("w3w-map");
    // w3wMap.addEventListener(
    //   "selected_square", (e) => {
    //     console.dir(e);
    //     console.log(e.detail['words']);
    // });

});