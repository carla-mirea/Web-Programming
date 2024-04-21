document.addEventListener("DOMContentLoaded", function() {
    start();
});

function start() {
    var menuItems = [
        {title: "Home", components: ["Dashboard", "Profile", "Settings"]},
        {title: "Products", components: ["Electronics", "Clothing", "Books", "Toys"]},
        {title: "Services", components: ["Web Design", "Content Writing", "Marketing"]},
        {title: "About Us", components: ["Company History", "Our Team", "Mission and Vision"]},
        {title: "Contact", components: ["Email", "Phone", "Location"]}
    ];

    var menu = document.getElementById("menu");

    menuItems.forEach(function(item, index) {
        var menuItem = document.createElement("li");
        menuItem.textContent = item.title;

        var submenu = document.createElement("ul");
        submenu.className = "submenu";

        item.components.forEach(function(component, i) {
            
            var componentItem = document.createElement("li");
            componentItem.textContent = component;
            submenu.appendChild(componentItem);
        });

        var submenuId = 'submenu_' + index;
        submenu.id = submenuId;

        menuItem.addEventListener("click", function() {
            toggleSubmenu(submenu);
            localStorage.setItem('selectedSubmenu', submenuId);
        });

        
        menuItem.appendChild(submenu);
        menu.appendChild(menuItem);
    });

    var selectedSubmenuID = localStorage.getItem('selectedSubmenu');

    if (selectedSubmenuID) {
        var selectedSubmenu = document.getElementById(selectedSubmenuID);
        toggleSubmenu(selectedSubmenu);
        selectedSubmenu.parentElement.classList.add('active');
    }

}

function toggleSubmenu(submenu) {
    if(submenu.style.display == "block") {
        submenu.style.display = "none";
    } else {
        submenu.style.display = "block";
    }
}