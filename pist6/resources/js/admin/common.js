const profileMenu = document.getElementById('profileMenu');

profileMenu.addEventListener('click', function() {
    let profileSubMenu = document.getElementById("profileSubMenu");
    if (profileSubMenu.className == 'visible-profile-sub-menu') {
        profileSubMenu.className = "invisible-profile-sub-menu";
    } else {
        profileSubMenu.className = "visible-profile-sub-menu";
    }
});