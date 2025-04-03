const search = document.querySelector("#search input");
const show = document.querySelector("#search #show")

function pages(info){
    show.innerHTML = ""
    console.log(info.length)
    if(info.length == 0){
        show.classList.remove("show")
    }else{
        info.forEach(item => {
            let a = document.createElement("a")
            a.innerHTML = item.name
            a.href = "http://localhost/PHP-PJ/pages/viewTutorial.php?id="+item.id
            a.className = "dropdown-item"
            let li = document.createElement("li");
            li.append(a)
            show.append(li)
            console.log()
        });
        show.classList.add("show")
    }
}

document.addEventListener("DOMContentLoaded", () => {
    console.log(search)
})

search.addEventListener("input", () => {
    let input = search.value
    console.log(input)
    if(input !== ""){
        fetch("http://localhost/PHP-PJ/api/searchPage.php?name=" + input)
        .then(res =>
            {
            if(!res.ok){
                return null
            }else{
                return res.json()
            }
        }
        ).then(data => pages(data))
    }else{
        show.innerHTML = ""
        show.classList.remove("show")
        console.log("empty input")
    }
})