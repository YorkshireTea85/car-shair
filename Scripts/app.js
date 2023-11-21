window.addEventListener("DOMContentLoaded", (event) => {
    const profileBtn = document.getElementById("user-menu-button");
    const profileMenu = document.getElementById("profile_menu");
    const mobileMenuBtn = document.getElementById("mobile-menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");
    const mobileMenuIcons = document.getElementsByClassName("menu-icon");
    var profileMenuIsActive = false;

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
    })

});