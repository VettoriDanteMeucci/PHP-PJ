const search = document.querySelector("#search input");
const show = document.querySelector("#search #show")
let input = search.value
const isPage = input.charAt(0) != "#"

function addVoice(name ,id){
    let a = document.createElement("a")
    a.innerHTML = name
    a.href = "http://localhost/PHP-PJ/pages/viewTutorial.php?id="+ id
    a.className = "dropdown-item"
    let li = document.createElement("li");
    li.append(a)
    show.append(li)
}

function pages(info){
    show.innerHTML = ""
    if(info.length == 0){
        show.classList.remove("show")
    }else{
        info.forEach(item => {
            if(isPage){
                addVoice(item.name, item.id)
            }else{
                addVoice(item.username,item.id)
            }
        });
        show.classList.add("show")
    }
}

document.addEventListener("DOMContentLoaded", () => {
    console.log(search)
})

search.addEventListener("input", () => {
    input = search.value
    const fetchTo = isPage ? 
        "http://localhost/PHP-PJ/api/searchPage.php?name="
    :
        "http://localhost/PHP-PJ/api/searchUser.php?name=";
    
    if(!isPage){
        console.log("input")
    }else{
        console.log("mda")
        console.log(isPage)
    }
    if(input !== ""){
        fetch(fetchTo + input)
        .then(res =>
            {
            if(!res.ok){
                return null
            }else{
                return res.json()
            }
        }
        ).then(data => isPage && pages(data))
    }else{
        show.innerHTML = ""
        show.classList.remove("show")
        console.log("empty input")
    }
})