</section>

<script>
    let mysidebar = document.querySelector(".mysidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
        mysidebar.classList.toggle("active");
        if (mysidebar.classList.contains("active")) {
            sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    };
</script>
</body>

</html>