let page_path = window.location.pathname.split("/").filter(foo => foo !== "");
const page_name = page_path.pop(),
    page_directory = page_path.pop(),
    sidebar_links = {
        "dashboard": "dashboard",
        "appointments": "appointments",
        "income": "income"
    };

$(".nav-item").removeClass("active start open");
$(`.sb-${sidebar_links[page_name]}`).addClass("active start open");
