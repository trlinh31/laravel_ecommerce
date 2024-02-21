const sidebarElement = document.querySelector(".sidebar-body-menu");

const sidebar = [
    {
        title: "Dashboard",
        path: "dashboard",
        icon: '<i class="fa-solid fa-house"></i>',
        children: [],
    },
    {
        title: "Brand",
        path: "##",
        icon: '<i class="fa-solid fa-copyright"></i>',
        children: [
            {
                title: "All brands",
                path: "brands",
            },
        ],
    },
    {
        title: "Product",
        path: "##",
        icon: '<i class="fa-solid fa-restroom"></i>',
        children: [
            {
                title: "All products",
                path: "products",
            },
            {
                title: "Product Categories",
                path: "product_cates",
            },
        ],
    },
    {
        title: "User",
        path: "##",
        icon: '<i class="fa-solid fa-users"></i>',
        children: [
            {
                title: "All users",
                path: "users",
            },
        ],
    },
    {
        title: "Order",
        path: "##",
        icon: '<i class="fa-solid fa-cart-arrow-down"></i>',
        children: [
            {
                title: "All orders",
                path: "orders",
            },
        ],
    },
];

const renderSidebar = () => {
    const html = sidebar
        .map(
            (item) => `
        <li>
            <a
            href="/admin/${item.path}" class="${
                item.children.length > 0 ? "show-cat-btn" : ""
            } sidebar-menu-item">
            ${item.icon}
            <span class="ps-2">${item.title}</span>
            ${
                item.children.length > 0
                    ? `
                    <i class="fa-solid fa-chevron-down cat_btn"></i>
                    `
                    : ""
            }
            </a>
            ${
                item.children.length > 0
                    ? `
                    <ul class="cat-sub-menu">
                    ${item.children
                        .map(
                            (child) => `
                        <li>
                            <a href="/admin/${child.path}">${child.title}</a>
                        </li>
                    `
                        )
                        .join("")}
                    </ul>
                    `
                    : ""
            }
        </li>
`
        )
        .join("");

    sidebarElement.innerHTML = html;
};
renderSidebar();

function previewImage(event, previewNumber) {
    var input = event.target;
    var imagePreview = document.getElementById("imagePreview" + previewNumber);

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}

const handleShowSubMenu = () => {
    var btnShowSubMenu = document.querySelectorAll(".show-cat-btn");
    if (btnShowSubMenu) {
        btnShowSubMenu.forEach(function (item) {
            item.addEventListener("click", function (e) {
                e.preventDefault();
                var catSubMenu = item.nextElementSibling;
                catSubMenu.classList.toggle("visible");
                var catBtnToRotate = item.querySelector(".cat_btn");
                catBtnToRotate.classList.toggle("rotated");
            });
        });
    }
};
handleShowSubMenu();

const handleSwitchDarkMode = () => {
    var darkMode = localStorage.getItem("darkMode");
    var darkModeToggle = document.querySelector(".switch-theme .switch input");
    var tables = document.querySelector("table");

    var enableDarkMode = () => {
        document.body.classList.add("darkmode");
        if (tables) {
            tables.classList.add("table-dark");
        }
        localStorage.setItem("darkMode", "enabled");
    };

    var disableDarkMode = () => {
        document.body.classList.remove("darkmode");
        if (tables) {
            tables.classList.remove("table-dark");
        }
        localStorage.setItem("darkMode", null);
    };

    if (darkMode === "enabled") {
        enableDarkMode();
    } else {
        disableDarkMode();
        darkModeToggle.checked = true;
    }

    if (darkModeToggle) {
        darkModeToggle.addEventListener("change", function (e) {
            if (e.target.checked) {
                disableDarkMode();
            } else {
                enableDarkMode();
            }
        });
    }
};
handleSwitchDarkMode();

document.getElementById("price").addEventListener("input", function (e) {
    e.target.value = e.target.value
        .replace(/,/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
});
