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
    const addressSelectError = document.getElementById("address-select-error");
    const addAddress = document.getElementById("add-address");
    const availabilityCheckboxes = document.getElementsByClassName("availability-checkbox");
    const availabilityTimes = document.getElementsByClassName("availability-time");
    const addVehicleForm = document.getElementById("add-vehicle-form");
    const vehicleModel = document.getElementById("model");
    const vehicleModelError = document.getElementById("model-error");
    const vehicleBody = document.getElementById("body");
    const vehicleBodyError = document.getElementById("body-error");
    const vehicleTransmissionAuto = document.getElementById("trans-auto");
    const vehicleTransmissionManual = document.getElementById("trans-manual");
    const vehicleTransmissionError = document.getElementById("transmission-error");
    const vehicleDoors = document.getElementById("doors");
    const vehicleDoorsError = document.getElementById("doors-error");
    const vehicleSeats = document.getElementById("seats");
    const vehicleSeatsError = document.getElementById("seats-error");
    const addressLine1 = document.getElementById("location-input");
    const addressLine1Error = document.getElementById("address-line-1-error");
    const addressLocality = document.getElementById("locality-input");
    const addressLocalityError = document.getElementById("address-locality-error");
    const addressPostCode = document.getElementById("postal_code-input");
    const addressPostCodeError = document.getElementById("address-post-code-error");
    const addressCountry = document.getElementById("country-input");
    const addressCountryError = document.getElementById("address-country-error");
    const vehicleHourlyRate = document.getElementById("hourly-rate");
    const vehicleHourlyRateError = document.getElementById("hourly-rate-error");
    const vehicleDailyRate = document.getElementById("daily-rate");
    const vehicleDailyRateError = document.getElementById("daily-rate-error");
    const mondayAvailability = document.getElementById("monday-availability");
    const mondayFrom = document.getElementById("monday-from");
    const mondayFromError = document.getElementById("monday-from-error");
    const mondayTo = document.getElementById("monday-to");
    const mondayToError = document.getElementById("monday-to-error");
    const tuesdayAvailability = document.getElementById("tuesday-availability");
    const tuesdayFrom = document.getElementById("tuesday-from");
    const tuesdayFromError = document.getElementById("tuesday-from-error");
    const tuesdayTo = document.getElementById("tuesday-to");
    const tuesdayToError = document.getElementById("tuesday-to-error");
    const wednesdayAvailability = document.getElementById("wednesday-availability");
    const wednesdayFrom = document.getElementById("wednesday-from");
    const wednesdayFromError = document.getElementById("wednesday-from-error");
    const wednesdayTo = document.getElementById("wednesday-to");
    const wednesdayToError = document.getElementById("wednesday-to-error");
    const thursdayAvailability = document.getElementById("thursday-availability");
    const thursdayFrom = document.getElementById("thursday-from");
    const thursdayFromError = document.getElementById("thursday-from-error");
    const thursdayTo = document.getElementById("thursday-to");
    const thursdayToError = document.getElementById("thursday-to-error");
    const fridayAvailability = document.getElementById("friday-availability");
    const fridayFrom = document.getElementById("friday-from");
    const fridayFromError = document.getElementById("friday-from-error");
    const fridayTo = document.getElementById("friday-to");
    const fridayToError = document.getElementById("friday-to-error");
    const saturdayAvailability = document.getElementById("saturday-availability");
    const saturdayFrom = document.getElementById("saturday-from");
    const saturdayFromError = document.getElementById("saturday-from-error");
    const saturdayTo = document.getElementById("saturday-to");
    const saturdayToError = document.getElementById("saturday-to-error");
    const sundayAvailability = document.getElementById("sunday-availability");
    const sundayFrom = document.getElementById("sunday-from");
    const sundayFromError = document.getElementById("sunday-from-error");
    const sundayTo = document.getElementById("sunday-to");
    const sundayToError = document.getElementById("sunday-to-error");
    const availableDaysError = document.getElementById("available-days-error");
    const availableMonthsError = document.getElementById("available-months-error");
    const januaryAvailability = document.getElementById("january-availability");
    const februaryAvailability = document.getElementById("february-availability");
    const marchAvailability = document.getElementById("march-availability");
    const aprilAvailability = document.getElementById("april-availability");
    const mayAvailability = document.getElementById("may-availability");
    const juneAvailability = document.getElementById("june-availability");
    const julyAvailability = document.getElementById("july-availability");
    const augustAvailability = document.getElementById("august-availability");
    const septemberAvailability = document.getElementById("september-availability");
    const octoberAvailability = document.getElementById("october-availability");
    const novemberAvailability = document.getElementById("november-availability");
    const decemberAvailability = document.getElementById("december-availability");
    const addVehicleImage = document.getElementById("add-vehicle-image");
    const addVehicleImageError = document.getElementById("add-vehicle-image-error");
    
    var daysAvailabilityArray = [mondayAvailability.checked, tuesdayAvailability.checked, wednesdayAvailability.checked,
        thursdayAvailability.checked, fridayAvailability.checked, saturdayAvailability.checked,
        sundayAvailability.checked];
    var monthsAvailabilityArray = [januaryAvailability.checked, februaryAvailability.checked, marchAvailability.checked,
              aprilAvailability.checked, mayAvailability.checked, juneAvailability.checked,
              julyAvailability.checked, augustAvailability.checked, septemberAvailability.checked,
              octoberAvailability.checked, novemberAvailability.checked, decemberAvailability.checked];
    var addVehicleImageFile = null;
    var addVehicleImageFileSize = 0;
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
            signupFirstError.innerText = "*Required";
          } else if (signupFirst.validity.tooLong) {
            signupFirstError.innerText = "*Max length 256 characters";
          } else {
            signupFirstError.innerText = "";
          };

        //Last Name error
        if (signupLast.validity.valueMissing) {
            // If the field is empty,
            signupLastError.innerText = "*Required";
            } else if (signupLast.validity.tooLong) {
                signupLastError.innerText = "*Max length 256 characters";
            } else {
                signupLastError.innerText = "";
            };

        //Email error
        if (signupEmail.validity.valueMissing) {
          // If the field is empty,
          signupEmailError.innerText = "*Required";
        } else if (signupEmail.validity.typeMismatch) {
          // If the field doesn't contain an email address,
          signupEmailError.innerText = "*Must be a valid email address.";
        }  else {
            signupEmailError.innerText = "";
        };

        //Username errors
        if (signupUid.validity.valueMissing) {
            // If the field is empty,
            signupUidError.innerText = "*Required";
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
            signupPwdError.innerText = "*Required";
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
            signupPwd2Error.innerText = "*Required";
            }  else if (signupPwd.value !== signupPwd2.value) {
                signupPwd2Error.innerText = "*Passwords do not match";
            } else {
            signupPwd2Error.innerText = "";
        };

        //User Type Radio Errors
        if (!signupDriver.checked && !signupOwner.checked) {
            UserTypeError.innerText = "*Required";
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
            addressSelect.value = event.target.value;
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
    
    //Check and update day availability errors
    function dayAvailabilityError(dayAvailability, dayFrom, dayTo, dayFromError, dayToError) {
        if (dayAvailability.checked) {
            if (dayFrom.validity.valueMissing) {
                dayFromError.innerText = "*Required";
            } else if (dayFrom.validity.rangeUnderflow) {
                dayFromError.innerText = "*Min 08:00";
            } else if (dayFrom.validity.rangeOverflow) {
                dayFromError.innerText = "*Max 21:00";
            } else if (dayFrom.validity.typeMismatch) {
                dayFromError.innerText = "*Time format required (hh:mm)";
            } else if (dayFrom.validity.stepMismatch) {
                dayFromError.innerText = "*Must be an increment of 15 mins";
            } else {
                dayFromError.innerText = "";
            }
            
            if (dayTo.validity.valueMissing) {
                dayToError.innerText = "*Required";
            } else if (dayTo.validity.rangeUnderflow) {
                dayToError.innerText = "*Min 09:00";
            } else if (dayTo.validity.rangeOverflow) {
                dayToError.innerText = "*Max 22:00";
            } else if (dayTo.validity.typeMismatch) {
                dayToError.innerText = "*Time format required (hh:mm)";
            } else if (dayTo.validity.stepMismatch) {
                dayToError.innerText = "*Must be an increment of 15 mins";
            } else if (dayTo.value <= dayFrom.value) {
                dayToError.innerText = "*From must be earlier than To";
            } else {
                dayToError.innerText = "";
            }
        }
    };

    //add vehicle form validation
    function addVehicleShowError() {

        //Model error
        if (vehicleModel.validity.valueMissing) {
            // If the field is empty,
            vehicleModelError.innerText = "*Required";
        } else {
            vehicleModelError.innerText = "";
        };

        //Body error
        if (vehicleBody.validity.valueMissing) {
            // If the field is empty,
            vehicleBodyError.innerText = "*Required";
        } else {
            vehicleBodyError.innerText = "";
        };

        //Transmission error
        // If the field is empty
        if (!vehicleTransmissionAuto.checked && !vehicleTransmissionManual.checked) {
            vehicleTransmissionError.innerText = "*Required";
        } else {
            vehicleTransmissionError.innerText = "";
        };

        //Doors error
        if (vehicleDoors.validity.valueMissing) {
        // If the field is empty
            vehicleDoorsError.innerText = "*Required";
        } else if (vehicleDoors.validity.typeMismatch) {
            // If an input is not a number
            vehicleDoorsError.innerText = "*Input must be a number";
        } else if (vehicleDoors.validity.rangeOverflow || vehicleDoors.validity.rangeUnderflow) {
            // If input is out of range
            vehicleDoorsError.innerText = "*Input must be between 3 & 5";
        } else {
            vehicleDoorsError.innerText = "";
        };

        //Seats error
        if (vehicleSeats.validity.valueMissing) {
        // If the field is empty
            vehicleSeatsError.innerText = "*Required";
        } else if (vehicleSeats.validity.typeMismatch) {
            // If an input is not a number
            vehicleSeatsError.innerText = "*Input must be a number";
        } else if (vehicleSeats.validity.rangeOverflow || vehicleSeats.validity.rangeUnderflow) {
            // If input is out of range
            vehicleSeatsError.innerText = "*Input must be between 1 & 9";
        } else {
            vehicleSeatsError.innerText = "";
        };
        
        //Address select error
        if (addressSelect.validity.valueMissing) {
            addressSelectError.innerText = "*Required";
        } else {
            addressSelectError.innerText = "";
        };

        //New address error
        if (addressSelect.value === "add-new") {
            if (!addressLine1.validity.valid) {
                addressLine1Error.innerText = "*Required";
            } else {
                addressLine1Error.innerText = "";
            }

            if (!addressLocality.validity.valid) {
                addressLocalityError.innerText = "*Required";
            } else {
                addressLocalityError.innerText = "";
            }

            if (!addressPostCode.validity.valid) {
                addressPostCodeError.innerText = "*Required";
            } else {
                addressPostCodeError.innerText = "";
            }

            if (!addressCountry.validity.valid) {
                addressCountryError.innerText = "*Required";
            } else {
                addressCountryError.innerText = "";
            }
        };

        //Vehicle hire rate errors
        if (vehicleHourlyRate.validity.valueMissing) {
            vehicleHourlyRateError.innerText = "*Required";
        } else if (vehicleHourlyRate.validity.rangeUnderflow) {
            vehicleHourlyRateError.innerText = "*Min £1.00";
        } else if (vehicleHourlyRate.validity.rangeOverflow) {
            vehicleHourlyRateError.innerText = "*Max £100.00";
        } else if (vehicleHourlyRate.validity.typeMismatch) {
            vehicleHourlyRateError.innerText = "*Input must be a number";
        } else if (vehicleHourlyRate.validity.stepMismatch) {
            vehicleHourlyRateError.innerText = "*Must be an increment of £0.25";
        } else {
            vehicleHourlyRateError.innerText = "";
        };
        
        if (vehicleDailyRate.validity.valueMissing) {
            vehicleDailyRateError.innerText = "*Required";
        } else if (vehicleDailyRate.validity.rangeUnderflow) {
            vehicleDailyRateError.innerText = "*Min £5.00";
        } else if (vehicleDailyRate.validity.rangeOverflow) {
            vehicleDailyRateError.innerText = "*Max £1000.00";
        } else if (parseFloat(vehicleDailyRate.value) <= parseFloat(vehicleHourlyRate.value)) {
            vehicleDailyRateError.innerText = "*Daily rate must be more than hourly rate";
        } else if (vehicleDailyRate.validity.typeMismatch) {
            vehicleDailyRateError.innerText = "*Input must be a number";
        }  else if (vehicleDailyRate.validity.stepMismatch) {
            vehicleDailyRateError.innerText = "*Must be an increment of £0.25";
        } else {
            vehicleDailyRateError.innerText = "";
        };

        //Vehicle availability errors
        if (!daysAvailabilityArray.includes(true)) {
            availableDaysError.innerText = "*Please select at least one day";
        } else {
            availableDaysError.innerText = "";
        }

        if (mondayAvailability.checked) {
            if (mondayFrom.validity.valueMissing) {
                mondayFromError.innerText = "*Required";
            } else if (mondayFrom.validity.rangeUnderflow) {
                mondayFromError.innerText = "*Min 08:00";
            } else if (mondayFrom.validity.rangeOverflow) {
                mondayFromError.innerText = "*Max 21:00";
            } else if (mondayFrom.validity.typeMismatch) {
                mondayFromError.innerText = "*Time format required (hh:mm)";
            } else if (mondayFrom.validity.stepMismatch) {
                mondayFromError.innerText = "*Must be an increment of 15 mins";
            } else {
                mondayFromError.innerText = "";
            }
            
            if (mondayTo.validity.valueMissing) {
                mondayToError.innerText = "*Required";
            } else if (mondayTo.validity.rangeUnderflow) {
                mondayToError.innerText = "*Min 09:00";
            } else if (mondayTo.validity.rangeOverflow) {
                mondayToError.innerText = "*Max 22:00";
            } else if (mondayTo.validity.typeMismatch) {
                mondayToError.innerText = "*Time format required (hh:mm)";
            } else if (mondayTo.validity.stepMismatch) {
                mondayToError.innerText = "*Must be an increment of 15 mins";
            } else if (mondayTo.value <= mondayFrom.value) {
                mondayToError.innerText = "*From must be earlier than To";
            } else {
                mondayToError.innerText = "";
            }
        }

        dayAvailabilityError(mondayAvailability, mondayFrom, mondayTo, mondayFromError, mondayToError);
        dayAvailabilityError(tuesdayAvailability, tuesdayFrom, tuesdayTo, tuesdayFromError, tuesdayToError);
        dayAvailabilityError(wednesdayAvailability, wednesdayFrom, wednesdayTo, wednesdayFromError, wednesdayToError);
        dayAvailabilityError(thursdayAvailability, thursdayFrom, thursdayTo, thursdayFromError, thursdayToError);
        dayAvailabilityError(fridayAvailability, fridayFrom, fridayTo, fridayFromError, fridayToError);
        dayAvailabilityError(saturdayAvailability, saturdayFrom, saturdayTo, saturdayFromError, saturdayToError);
        dayAvailabilityError(sundayAvailability, sundayFrom, sundayTo, sundayFromError, sundayToError);

        if (!monthsAvailabilityArray.includes(true)) {
            availableMonthsError.innerText = "*Please select at least one month";
        } else {
            availableMonthsError.innerText = "";
        }

        if (!addVehicleImage.validity.valid) {
            if (addVehicleImage.validity.typeMisMatch) {
                addVehicleImageError.innerText = "*File type not supported";
            } else {
                addVehicleImageError.innerText = "";
            }
        }
        
        if ((addVehicleImageFileSize !== 0) && (addVehicleImageFileSize > 5000000)) {
            addVehicleImageError.innerText = "*File too large, max size 5mb";
        } else {
            addVehicleImageError.innerText = "";
        }

    }

    if (addVehicleForm) {
        addVehicleForm.addEventListener("submit", (event) => {
            //get checked availability days when submit button clicked
            daysAvailabilityArray = [mondayAvailability.checked, tuesdayAvailability.checked, wednesdayAvailability.checked,
                                     thursdayAvailability.checked, fridayAvailability.checked, saturdayAvailability.checked,
                                     sundayAvailability.checked];
            monthsAvailabilityArray = [januaryAvailability.checked, februaryAvailability.checked, marchAvailability.checked,
                                           aprilAvailability.checked, mayAvailability.checked, juneAvailability.checked,
                                           julyAvailability.checked, augustAvailability.checked, septemberAvailability.checked,
                                           octoberAvailability.checked, novemberAvailability.checked, decemberAvailability.checked];

            if (addVehicleImage.files.length > 0) {
                addVehicleImageFile = addVehicleImage.files.item(0);
                addVehicleImageFileSize = addVehicleImageFile['size'];
            }
            
            // if the first name field is invalid
            if (!vehicleModel.validity.valid) {
                addVehicleShowError();
                event.preventDefault();
            } else if (!vehicleTransmissionAuto.checked && !vehicleTransmissionManual.checked) {
                addVehicleShowError();
                event.preventDefault(); 
            } else if (!vehicleDoors.validity.valid) {
                addVehicleShowError();
                event.preventDefault();
            } else if (!vehicleSeats.validity.valid) {
                addVehicleShowError();
                event.preventDefault();
            } else if (!addressSelect.validity.valid) {
                addVehicleShowError();
                event.preventDefault();
            } else if (addressSelect.value === "add-new") {
                if (!addressLine1.validity.valid){
                    addVehicleShowError();
                    event.preventDefault();
                } else if (!addressLocality.validity.valid){
                    addVehicleShowError();
                    event.preventDefault();
                } else if (!addressPostCode.validity.valid){
                    addVehicleShowError();
                    event.preventDefault();
                } else if (!addressCountry.validity.valid){
                    addVehicleShowError();
                    event.preventDefault();
                };
            } 
            
            if (!vehicleHourlyRate.validity.valid) {
                addVehicleShowError();
                event.preventDefault();
            } else if (!vehicleDailyRate.validity.valid) {
                addVehicleShowError();
                event.preventDefault();
            } else if (!daysAvailabilityArray.includes(true)) {
                addVehicleShowError();
                event.preventDefault();
            }
            
            if (mondayAvailability.checked) {
                if (!mondayFrom.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                } else if (!mondayTo.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                }
            }
            
            if (tuesdayAvailability.checked) {
                if (!tuesdayFrom.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                } else if (!tuesdayTo.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                }
            }
            
            if (wednesdayAvailability.checked) {
                if (!wednesdayFrom.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                } else if (!wednesdayTo.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                }
            }
            
            if (thursdayAvailability.checked) {
                if (!thursdayFrom.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                } else if (!thursdayTo.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                }
            }
            
            if (fridayAvailability.checked) {
                if (!fridayFrom.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                } else if (!fridayTo.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                }
            }
            
            if (saturdayAvailability.checked) {
                if (!saturdayFrom.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                } else if (!saturdayTo.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                }
            }
            
            if (sundayAvailability.checked) {
                if (!sundayFrom.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                } else if (!sundayTo.validity.valid) {
                    addVehicleShowError();
                    event.preventDefault();
                }
            }
            
            if (!monthsAvailabilityArray.includes(true)) {
                addVehicleShowError();
                event.preventDefault();
            }

            if (addVehicleImage.files.length < 1) {
                addVehicleShowError();
                event.preventDefault();
            }
            
            if ((addVehicleImageFileSize !== 0) && (addVehicleImageFileSize > 5000000)) {
                addVehicleShowError();
                event.preventDefault();
            }
        });
    }

});