
const sideNav = document.querySelector('#side_nav');
const openSideNavBtn = document.querySelector('#sidenavBtn');
const main = document.querySelector('#main');
const dropdown = document.getElementById('dropdown');
const navDrop = document.querySelector('#navDrop');

let isopen = false;
navDrop.addEventListener('click', () => {
    if (dropdown.style.display === "none") {
        dropdown.style.display = 'block';
    } else {
        dropdown.style.display = 'none';
    }
})
openSideNavBtn.addEventListener('click', () => {
    if (isopen) {
        sideNav.style.width = "0rem";
        main.style.marginLeft = "0rem";
        isopen = false;
    }
    else {
        sideNav.style.width = "20rem";
        main.style.marginLeft = "20rem";
        isopen = true;
    }
}
)
// Initialize and add the map
function initMap() {
    // The location of Uluru
    const lahore = { lat: 31.582045, lng: 74.329376 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 4,
      center: lahore,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
      position: lahore,
      map: map,
    });
  }