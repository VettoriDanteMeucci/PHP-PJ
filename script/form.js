const t = document.getElementById("sub");

t.addEventListener("click", () => {
    fetch("/PHP-PJ/api/showImg.php?id=0").then(res =>
        console.log(res.body)
    )
})