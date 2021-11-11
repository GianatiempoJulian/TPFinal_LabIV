//userdashboard
const navBtn = document.getElementById('nav_btn');
const navOptions = document.getElementById('nav_btn_options');


navBtn.addEventListener('click', () => {
    navBtn.classList.toggle('active');
    navOptions.classList.toggle('active');
    navOptions.style.display = "flex";
    navOptions.style.opacity = "1";
})





function hideInfo() {
    navOptions.style.display = "none";
    navOptions.style.opacity = "0";
    navOptions.classList.toggle('inactive');

}