let sideBarIsOpen = true;

toggleBtn.addEventListener('click', (event) => {
    event.preventDefault();
// button is clicked to minimize the bar and get rid of the text
    if (sideBarIsOpen) {
        dashboard_sidebar.style.width = '5%';
        dashboard_sidebar.style.transition = '0.5s';
        dashboard_content_container.style.width = '95%';
        sidebar_logo.style.transition = '0.5s';
        sidebar_logo.style.fontSize = '40px';   
        sidebar_user.style.width = '100%';  

        // get rid of the text
        let menuIcons = document.getElementsByClassName('menuText'); 
        for (var i = 0; i < menuIcons.length; i++) {
            menuIcons[i].style.display = 'none'; // Hide menu text
        }
        // center icons
        let menuText = document.getElementsByClassName('centerIcons'); 
        for (var i = 0; i < menuText.length; i++) {
            menuText[i].style.display = 'block'; // Display icons
            menuText[i].style.margin = 'auto';   // Center icons horizontally
        }

        document.getElementsByClassName('sidebar_menus_list')[0].style.textAlign = 'center';
        sideBarIsOpen = false;
    } else { 
        // button was clicked again to maximize the bar to original width
        dashboard_sidebar.style.width = '15%';
        dashboard_sidebar.style.transition = '0.5s';
        dashboard_content_container.style.width = '85%';
        sidebar_logo.style.fontSize = '80px';   
        sidebar_user.style.width = '100%';  

        // Reset icon alignment
        let iconElements = document.querySelectorAll('.sidebar_menus_list li a i');
        for (let i = 0; i < iconElements.length; i++) {
            iconElements[i].style.margin = '0 10px 0 0'; 
        }

        //Reset Text
        let menuText = document.getElementsByClassName('menuText');
        for (var i = 0; i < menuText.length; i++) {
            menuText[i].style.display = 'inline-block'; // Show menu text
            menuText[i].style.margin = 'initial';       // Reset margin
        }

        document.getElementsByClassName('sidebar_menus_list')[0].style.textAlign = 'left';
        sideBarIsOpen = true;
    }
});



// js for the carousel in dashbaord tab

// using data attributes for a more logic based approach and not styling here
const buttons = document.querySelectorAll("[data-carousel-button]");

buttons.forEach(button => {
    button.addEventListener("click", () => {
        // offset provides logic for switching between slides
        const offset = button.dataset.carouselButton === "next" ? 1 : -1;

        // slides targets the div with data-carousel then the ul with data-slides
        const slides = button.closest("[data-carousel]").querySelector("[data-slides]");

        // targeting the ul list of slides and specifically targeting the data-active slide and assigning it the variable activeSlide
        const activeSlide = slides.querySelector("[data-active]");

        // take the HTML collection of ul and turns them into an array. then takes the index of activeSLide and adds the offset logic to determine which slide should be selected based off the newIndex
        let newIndex = [...slides.children].indexOf(activeSlide) + offset;

        // making sure the first and last slide can be accessed when clicking on previous or next on the first or last slides
        if (newIndex < 0) newIndex = slides.children.length - 1;
        if (newIndex >= slides.children.length) newIndex = 0;

        // add new active dataset to the new index
        slides.children[newIndex].dataset.active = true;
        // takes away the active dataset from the last slide who had it
        delete activeSlide.dataset.active;
    })
})